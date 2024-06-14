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
        <div id="all_reg">
            <?php
            if (isset($_SESSION['status'])) {
                include("infodb.php");
                $sql = mysql_query("select * from users order by id");
                if (mysql_num_rows($sql) > 0) {
                    echo '<h2>Зарегистрированные:</h2>';
                    echo '<table border=1 align="center"><tr><th>Имя</th><th>Email</th><th>Возраст</th><th>Пол</th><th>Инфа</th><th>Дата</th><th>Статус</th></tr>';
                    while ($x = mysql_fetch_array($sql)) {
                        echo  '<tr><td>'.$x['name'].'</td><td>'.$x['email'].'</td><td>'.$x['age'].'</td><td>'.$x['pol'].'</td><td>'.$x['infa'].'</td><td>'.$x['creat'].'</td><td>'.$x['status'].'</td></tr>';}
                    echo '</table>'; } else { echo '<h2>Зарегистрированных нет</h2>'; }
                echo '</div><div id="all_log">';
                $sql = mysql_query("select * from online order by id");
                if (mysql_num_rows($sql) > 0) {
                    echo '<h2>Все посещения:</h2>';
                    echo '<table border=1  align="center" ><tr><th>Имя</th><th>Дата</th><th>Статус</th></tr>';
                    while ($x = mysql_fetch_array($sql)) {
                        echo  "<tr><td> <a href=\"profile.php?id=".$x['ids']."\"><font color = \"white\">".$x['name']."</font></a> </td><td> ".$x['creat']." </td><td>".$x['status']."</td></tr>";}
                    echo '</table>'; } else { echo '<h2>Посещений нет</h2>'; }
                mysql_close($link);
            } else { echo '<h2>Страница недоступна незарегистрированным пользователям</h2>';}
            ?>
        </div>
        <a href = "#top" ><font color = "white">Вверx</font></a>
    </div>
</div>
<div id="footer">
    <b>
        &copy; Гамов М.Н. 2012
    </b>
</div>
</body>
</html>