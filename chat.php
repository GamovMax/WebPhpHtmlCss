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
        <a href = "#footer" ><font color = "white">Вниз</font></a>
        <?php
        if (isset($_SESSION['status'])) {
            include("infodb.php");
            if (isset($_POST['com'])) {
                if (!empty($_POST['com'])) {
                    $comment = htmlspecialchars($_POST['com']);
                    $name = $_SESSION['user'];
                    $ids = $_SESSION['ids'];
                    $pol = $_SESSION['pol'];
                    $create = date("Y-m-d");
                    mysql_query("Insert into chat (name, creat, comment, ids, pol) values ('{$name}','{$create}','{$comment}','{$ids}', '{$pol}')");
                } }
            $sql = mysql_query("select * from chat order by id");

            while ( $info = mysql_fetch_array($sql)) {
                if ( $info['pol'] == 'мужской')  { $add = 'написал';} else { $add = 'написала';}
                echo "<table class=\"news\">
<tr class=\"news_top\"><td>

<table width=\"100%\"><tr><td>
<b>Сообщение ".$add." </b><a href=\"profile.php?id=".$info['ids']."\"><font color = \"#333333\" size=\"4\"><b>".$info['name']."</b></font></a> :</td>
<td align=\"right\"><font size=\"2\"><b>".$info['creat']."</b></font>
</td></tr></table>

</td></tr>
<tr><td><font size=\"3\"><div class=\"news_bot\">".$info['comment']."</div></font></td></tr>
</table>"; }
            mysql_close($link);
            echo '<a href = "#top" ><font color = "white">Вверx</font></a>';
            if (isset($_SESSION['status']))  {
                print<<<E
<div id="comment"><h2>Добавить запись:</h2>
<form action="chat.php" method="post">
<textarea name="com" cols="40" rows="4" required></textarea><br><br>
<input type="submit" value="Отправить"/>
<input type="reset" value="Очистить" />
</form>
</div>
E;
            }
        } else { echo '<h2>Страница недоступна незарегестрированным пользователям</h2>';}
        ?>
        <a name="footer"></a>
    </div>
</div>
<div id="footer">
    <b>
        &copy; Гамов М.Н. 2012
    </b>
</div>
</body>
</html>