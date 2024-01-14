<!DOCTYPE html>
<html lang="uk"
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <?php
            session_start();

            if (isset($_SESSION['user_id'])) {
                echo '<h2>Вітаю, ' . $_SESSION['username'] . '!</h2>';
                echo '<a href="logout.php">Вийти</a>';
            } else {
                echo '<h2>Головна сторінка!</h2>';
                echo '<a href="login.php">Авторизація</a> | <a href="register.php">Реєстрація</a>';
            }
        ?>
    </div>
</body>
</html>