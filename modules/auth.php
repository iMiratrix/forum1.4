<?php
session_start();
require '../server/config.php';

if (!isset($_SESSION['id'])) {
    print "<a href='$site_url/modules/themes.php'>Главная</a><br>";
    echo <<<HTML
<head>
<title>Авторизация</title>
</head>
<body>
<form action="${site_url}/server/auth.php" method="post">
<input required type="text" name="login" placeholder="Логин">
<input required type="password" name="password" placeholder="Пароль">
<input type="submit" name="sub" value="enter">
</form>
</body>
<a href="${site_url}/modules/reg.php">Регистрация</a>
HTML;
} else {
    header("Location:" . $site_url);
}