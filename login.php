<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Авторизація</h2>
        <form action="login_process.php" method="post">
            <div class="form-group">

                <div class="label-container">
                <label for="username">Ваше ім'я:</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Ваш пароль:</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit">Увійти</button>
            </div>

        </form>
        <p>Немає облікового запису? <a href="register.php">Зареєструйтесь</a>.</p>
        <a href="google_login.php">
            <img src="google_logo.png" class="google-logo">
            Увійти з Google
        </a>
    </div>
</body>
</html>