<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
    <title>&copy; Гамов М.Н., 2012</title>
    <link href="unique.css" rel="stylesheet" type="text/css" />
</head>
<body>
<a name="top"></a>
<div id="header">

    <div id="logo"><IMG src="img/logo.png" align="left"></div>
    <div id="title">
        <h1>Немецкие автомобили</h1>
    </div>

    <div id="user">
        <?php
        if (file_exists('header_user.html')) { include_once("header_user.html"); } else {
            echo '<p>Элемент интерфейса недоступен из за неполадок</p>'; }
        ?>
    </div>

</div>
<div id="content">
    <div id="menu">
        <?php
        if (file_exists('menu.html')) { include_once("menu.html"); } else {
            echo '<p>Элемент интерфейса не доступен из за неполадок</p>'; }
        ?>
    </div>
    <div id="text">
        <div id="text_box">
            <?php
            include("infodb.php");
            if (!empty($_GET['id'])) {
                $id = $_GET['id'];
                $sql = mysql_query("select * from users where id = '{$id}'");
                if ( mysql_num_rows($sql) > 0 ) {
                    $user_info = mysql_fetch_array($sql);
                    echo '<table class = "table_profile"><tr><td>Имя:</td><td>'.$user_info['name'].'</td></tr>';
                    echo '<tr><td>Возраст: </td><td>'.$user_info['age'].'</td></tr>';
                    echo '<tr><td>Пол: </td><td>'.$user_info['pol'].'</td></tr>';
                    echo '<tr><td>О себе: </td><td>'.$user_info['infa'].'</td></tr>';
                    echo '<tr><td>Email: </td><td>'.$user_info['email'].'</td></tr>';
                    echo '<tr><td>Дата рег: </td><td>'.$user_info['creat'].'</td></tr>';
                    echo '<tr><td>Статус: </td><td>'.$user_info['status'].'</td></tr></table>';

                    if (!empty($_SESSION['ids'])){
                        if ($id == $_SESSION['ids']) {
                            echo '<p class="p_profile">Ваш профиль.<br>Удалить аккаунт? <a href="delete.php">Да</a> / <a href="/">Нет</a></p>'; }
                    }}
                else { echo '<h1>Аккаунта не существует</h1>';  }}

            else {echo "<h1>Аккаунт успешно удалён</h1>";}

            mysql_close($link);
            ?>
        </div></div></div>
<div id="footer">
    <b>
        &copy; Гамов М.Н. 2012
    </b>
</div>
</body>
</html>