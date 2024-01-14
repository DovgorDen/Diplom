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
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "mydatabase";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Перевірка, чи не існує вже користувач з таким ім'ям
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Якщо користувач з таким ім'ям вже існує, вивести повідомлення та завершити виконання
    if ($stmt->num_rows > 0) {
        echo '<div class="form-group">';
        echo '<p>Користувач з данним ім`ям існує.Спробуйте інше.</p>';
        echo '<a href="index.php" class="back-button">Назад</a>';
        echo '<div>';
        $stmt->close();
        $conn->close();
        exit();
    }

    $stmt->close();

    // Вставка нового користувача тільки якщо його не існує
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    header("Location: index.php");
    exit();
}
?>

</body>
</html>