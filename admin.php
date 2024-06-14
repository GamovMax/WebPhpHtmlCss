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
        <?php
        if ($_SESSION['status'] == 'admin' or $_SESSION['status'] == 'mod')
        {
            include("infodb.php");
            if ($_SESSION['status'] == 'admin')
            {
                if (!empty($_POST['email_user'])) {
                    $sql = mysql_query("select * from users where email = '{$_POST['email_user']}'");
                    if(mysql_num_rows($sql) > 0 ) {

                        if (isset($_POST['create_admin'])) { mysql_query("update users set status = 'admin' where email = '{$_POST['email_user']}'");   }
                        if (isset($_POST['create_mod'])) { mysql_query("update users set status = 'mod' where email = '{$_POST['email_user']}'");     }
                        if (isset($_POST['create_user'])) {  mysql_query("update users set status = 'user' where email = '{$_POST['email_user']}'");    }
                        if (isset($_POST['delete_profile']))
                        {
                            $sql = mysql_query("select * from users where email = '{$_POST['email_user']}'");
                            $info = mysql_fetch_array($sql);
                            $delete = date("Y-m-d");
                            mysql_query("insert into del_users (name, status, pol, email , age, infa, creat, delet) values ('{$info['name']}','{$info['status']}','{$info['pol']}','{$info['email']}', '{$info['age']}','{$info['infa']}', '{$info['creat']}', '$delete')");
                            mysql_query("delete from users where email = '{$_POST['email_user']}'");
                        }

                    }
                    else echo"Ошибка";}

                if (isset($_POST['delete_all'])) {  mysql_query("truncate table users");  }
                print<<<K
<div id = "admblock1">
<form action="admin.php" method="post">
<table><tr><td>
Введите Email участника: <br>
<input type="text" name="email_user" />
</td><td>
<input type="submit" value="        дать права админа        " name="create_admin" class="yellow" /> 
</td></tr>
<tr><td></td><td>
<input type="submit" value="   дать права модератора   " name="create_mod" class="yellow" />  </td></tr>
<tr><td></td><td>
<input type="submit" value="дать права пользователя" name="create_user" class="yellow" /> </td></tr>
<tr><td><input type="submit" value="удалить аккаунт" name="delete_profile" class="yellow" /> </td><td></td></tr>
<tr><td></td><td><input type="submit" value="удалить все аккаунты" name="delete_all" class="red"/></td></tr>
</table>
</form></div>
K;
            }
            if (isset($_POST['clear_chat'])) {  mysql_query("truncate table chat");  }
            if (isset($_POST['clear_delete_users'])) {  mysql_query("truncate table del_users");  }
            if (isset($_POST['clear_online'])) {  mysql_query("truncate table online"); }
            if (isset($_POST['clear_message_private'])) {  mysql_query("delete from message where label = 'лично'");    }
            if (isset($_POST['clear_message_public'])) {   mysql_query("delete from message where label = 'публично'");  }
            if (isset($_POST['clear_message_all'])) {   mysql_query("truncate table message");  }
            if (isset($_POST['clear_inter'])) {   mysql_query("truncate table inter");  }
            if (isset($_POST['clear_comments'])) {   mysql_query("truncate table comments");  }
            print<<<S
<div id = "admblock2">
<form action="admin.php" method="post">
<table>
<tr><td><input type="submit" value="очистить чат" name="clear_chat" class="blue"/></td></tr>
<tr><td><input type="submit" value="очистить историю удалившихся" name="clear_delete_users" class="blue"/> </td></tr>
<tr><td><input type="submit" value="очистить историю посещений" name="clear_online" class="blue"/></td></tr>
<tr><td><input type="submit" value="очистить личные сообщения" name="clear_message_private" class="blue"/> </td></tr>
<tr><td><input type="submit" value="очистить публичные сообщения" name="clear_message_public" class="blue"/> </td></tr>
<tr><td><input type="submit" value="очистить все сообщения админам" name="clear_message_all" class="blue"/> </td></tr>
<tr><td><input type="submit" value="очистить результаты опроса" name="clear_inter" class="blue"/> </td></tr>
<tr><td><input type="submit" value="очистить комментарии к фото" name="clear_comments" class="blue"/> </td></tr>
</table>
</form>
</div>
S;
            $sql = mysql_query("select * from del_users order by id");
            if(!$sql)
            {
                die("Возникла ошибка - ".mysql_error()."<br>");
            }
            if (mysql_num_rows($sql) > 0) {
                echo '<h2>Таблица удалившихся:</h2>';
                echo '<table border=1 id = "all_reg"><tr><th>Имя</th><th>Email</th><th>Возраст</th><th>Пол</th><th>Инфа</th><th>Создание</th><th>Удаление</th><th>Статус</th></tr>';
                while ($x = mysql_fetch_array($sql)) {
                    echo  '<tr><td>'.$x['name'].'</td><td>'.$x['email'].'</td><td>'.$x['age'].'</td><td>'.$x['pol'].'</td><td>'.$x['infa'].'</td><td>'.$x['creat'].'</td><td>'.$x['delet'].'</td><td>'.$x['status'].'</td></tr>';
                }
                echo '</table>'; } else { echo '<h2>Таблица удалившихся пуста</h2>'; }

            $sql = mysql_query("select * from message where label = 'Лично' order by id");
            while ( $info = mysql_fetch_array($sql)) {
                if ( $info['pol'] == 'мужской')  { $add = 'написал';} else { $add = 'написала';}

                echo "<table class=\"news\">
<tr class=\"news_top\"><td>

<table width=\"100%\"><tr><td>
<b>".$info['label']." ".$add." </b><a href=\"profile.php?id=".$info['ids']."\"><font color = \"#333333\" size=\"4\"><b>".$info['name']."</b></font></a> :</td>
<td align=\"right\"><font size=\"2\"><b>".$info['creat']."</b></font>
</td></tr></table>

</td></tr>
<tr><td><font size=\"3\"><div class=\"news_bot\">".$info['comment']."</div></font></td></tr>
</table>";

            }

            $sql = mysql_query("select * from message where label = 'Публично' order by id");
            while ( $info = mysql_fetch_array($sql)) {
                if ( $info['pol'] == 'мужской')  { $add = 'написал';} else { $add = 'написала';}

                echo "<table class=\"news\">
<tr class=\"news_top\"><td>

<table width=\"100%\"><tr><td>
<b>".$info['label']." ".$add." </b><a href=\"profile.php?id=".$info['ids']."\"><font color = \"#333333\" size=\"4\"><b>".$info['name']."</b></font></a> :</td>
<td align=\"right\"><font size=\"2\"><b>".$info['creat']."</b></font>
</td></tr></table>

</td></tr>
<tr><td><font size=\"3\"><div class=\"news_bot\">".$info['comment']."</div></font></td></tr>
</table>";

            }

            mysql_close($link);
        } else { echo '<h2>Только администраторы и модераторы имеют доступ к этой странице!</h2>'; }
        ?>

    </div>
</div>
<div id="footer">
    <b>
        &copy; Гамов М.Н. 2012
    </b>
</div>
</body>
</html>