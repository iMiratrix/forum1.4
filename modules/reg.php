<?php
session_start();
require '../server/config.php';

if (!isset($_SESSION['id'])) {
    print "<a href='$site_url/modules/themes.php'>Главная</a><br>";
    echo <<<HTML
<head>
<title>Регистрация</title>
</head>
<body>
<form action="${site_url}/server/reg.php" method="post">
<input required type="text" name="login" placeholder="Логин">
<input required type="email" name="email" placeholder="email">
<input required type="text" name="name" placeholder="Имя">
<input required type="text" name="surname" placeholder="Фамилия">
<input required type="text" name="patronymic" placeholder="Отчество">
<input required type="password" name="password" placeholder="Пароль">
<input required type="password" name="password2" placeholder="Повторите пароль">
<input type="submit" name="sub" value="enter">
</form>
<a href="${site_url}/modules/auth.php">Авторизация</a>
</body>
HTML;
} else {
    header("Location:" . $site_url);
}
