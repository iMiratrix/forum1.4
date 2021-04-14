<?php
session_start();
require "../server/config.php";
if (isset($_SESSION['permission'])) {
    if ($_SESSION['permission'] == 0) {
        print "<a href='$site_url/admin_panel/admin.php'>Админ панель<a><br>";
        print "<a href='$site_url/server/logout.php'>Выйти из записи<br></a>";
    } else {
        print "<a href='$site_url/modules/person.php'>Личный кабинет<a><br>";
        print "<a href='$site_url/server/logout.php'>Выйти из записи<br></a>";
    }
}
$stmt = $pdo->prepare("SELECT * FROM themes t LEFT JOIN images i ON t.id_image=i.id_image LEFT JOIN categories c ON t.id_category = c.id_category WHERE (t.status) IN (?) ORDER BY t.date DESC LIMIT 4");
$stmt->execute([1]);
if ($stmt->rowCount() > 0) {
    print "<h1>Решенные заявки:</h1>";
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $show_img = base64_encode($data['img']);
        $show_img2 = base64_encode($data['new_img']);
        echo <<<HTML
<head>
<title>Решенные заявки</title>
<link rel="stylesheet" href="../style/style.css">
</head>
<body>
<p>${data['name_category']}</p>
<p>${data['title']}</p>
<p>${data['date']}</p>
<div class="container">
<img class="img" width="350" height="350" src="data:image/jpeg;base64,${show_img}" alt="">
<img class="img2" width="350" height="350" src="data:image/jpeg;base64,${show_img2}" alt="">
</div>
<hr>

</body> 


HTML;
    }
    if (isset($_SESSION['id_user'])) {

        if ($_SESSION['id_user'] == 2) {
            print "Вы заблокированы";
        } else {
            print "<br><a href='$site_url/modules/addtheme.php'>Добавить</a>";
        }
    } else {
        print "<br><a href='$site_url/modules/auth.php'>Авторизуйтесь, чтобы добавить тему</a>";
    }


} else {
    print "Нет тем <a href='$site_url/modules/addtheme.php'>Создать</a><br>";
}

