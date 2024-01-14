
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

<?php
require 'vendor/autoload.php';
use OTPHP\TOTP;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$google2fa = new \PragmaRX\Google2FA\Google2FA();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["google2fa_code"])) {
        $username = $_SESSION["username"];
        $user_provided_code = $_POST["google2fa_code"];

        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "mydatabase";

        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT id, username, password, secret FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id, $db_username, $db_password_hash, $db_secret);
        $stmt->fetch();
        $stmt->close();

        if ($user_id) {
            $otp = TOTP::create($db_secret);
            $current_otp = $otp->now();

            echo '<div class="form-group">';
            //echo "Generated OTP: " . $current_otp;
            echo '<div>';

            if ($otp->verify($user_provided_code)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['authenticated'] = true;
                header("Location: index.php");
                exit();
            } else {
                echo '<p>Авторизація невдала. Введено неправильний Google Authenticator код.</p>';
                echo '<a href="index.php" class="back-button">Назад</a>';
            }
        } else {
            echo "Авторизація невдала. Користувача не знайдено";
        }

        $conn->close();
    } else {
        $username = isset($_POST["username"]) ? $_POST["username"] : null;
        $password = isset($_POST["password"]) ? $_POST["password"] : null;

        if ($username === null || $password === null) {
            echo "Недійсне надсилання форми.";
            exit();
        }

        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "mydatabase";

        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT id, username, password, secret FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id, $db_username, $db_password_hash, $db_secret);
        $stmt->fetch();
        $stmt->close();

        if ($user_id && password_verify($password, $db_password_hash)) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;

            if (!$db_secret) {
                $db_secret = $google2fa->generateSecretKey();
                
                $stmt = $conn->prepare("UPDATE users SET secret = ? WHERE id = ?");
                $stmt->bind_param("si", $db_secret, $user_id);
                $stmt->execute();
                $stmt->close();
            }

            // Generate QR code
            $text = $google2fa->getQRCodeUrl($username, 'http://localhost', $db_secret);
            $image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=' . $text;

            echo '<div class="container">';
            echo '<h2>Відскануйте QR-код Google Authenticator</h2>';
            echo '<img src="' . $image_url . '" /><br>';
            echo '<form method="post">';
            echo '<div class="form-group">';
            echo '<label for="google2fa_code">Введіть код:</label>';
            echo '<input type="text" name="google2fa_code" required>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<button type="submit">Увійти</button>';
            echo '</div>';
            echo '</form>';
            echo '</div>';
        } else {
            echo '<div class="form-group">';
            echo '<p>Авторизація невдала. Перевірте правильність свого паролю або імені.</p>';
            echo '<a href="index.php" class="back-button">Назад</a>';
            echo '<div>';
        }

        $conn->close();
    }
}
?>

</body>
</html>
