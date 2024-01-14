<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h2>Реєстрація</h2>
        <form action="register_process.php" method="post">
            <div class="form-group">
            <label for="username">Ваше ім'я':</label>
            <input type="text" name="username" required>
            </div>

            <div class="form-group">
            <label for="password">Ваш пароль:</label>
            <input type="password" name="password" required>
            </div>

            <div class="form-group">
            <button type="submit">Реєстрація</button>
            </div>
        </form>
        <p>Вже є аккаунт? <a href="login.php">Авторизуйтесь</a>.</p>
    </div>
</body>
</html>