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
        <div id = "box_v1">
            <?php
            include("infodb.php");
            $create = date("Y-m-d");
            if (isset($_POST['gsub1']))  { if (!empty($_POST['g1'])) { mysql_query("insert into inter (name, creat,comment, ids, pol, numview) values('{$_SESSION['user']}','{$create}', '{$_POST['g1']}', '{$_SESSION['ids']}', '{$_SESSION['pol']}', '1' )"); } else { echo '<h2>Выберите один из вариантов</h2>'; } }
            ?>
            <table class ="tab_opr">
                <tr><td>Что на ваш взгляд лучше Mercedes или BMW?<br>
                        <form method="post" action="interview.php">
                            <?php
                            $sql = mysql_query("select ids from inter where ids = '{$_SESSION['ids']}' and numview = '1'");
                            if (mysql_num_rows($sql) == 0 )  {
                                echo '<label><input type="radio" name = "g1" value = "Mercedes" required> Mercedes</label><br>';
                                echo '<label><input type="radio" name = "g1" value = "BMW" required> BMW<br></label>';
                                echo '<label><input type="radio" name = "g1" value = "Затрудняюсь ответить" required> Затрудняюсь ответить</label><br>';
                                echo '<p align="right"><input type="submit" name = "gsub1" value = "Отправить"></p>';
                                echo '</form></td></tr></table>';
                            } else {
                                echo '</form></td></tr></table>';
                                echo '<p  class ="p_view">Результат опроса:</p> <table class ="tab_res">';
                                $sql = mysql_query("select comment from inter where comment = 'Mercedes' and numview = '1'");
                                $kol_1 = mysql_num_rows($sql);
                                $sql = mysql_query("select comment from inter where comment = 'BMW' and numview = '1'");
                                $kol_2 = mysql_num_rows($sql);
                                $sql = mysql_query("select comment from inter where comment = 'Затрудняюсь ответить' and numview = '1'");
                                $kol_3 = mysql_num_rows($sql);
                                $sum = $kol_1 + $kol_2 + $kol_3;
                                if ($kol_1 !=  0) { $kol_1 = $kol_1/($sum / 100); }
                                if ($kol_2 !=  0) { $kol_2 = $kol_2/($sum / 100); }
                                if ($kol_3 !=  0) { $kol_3 = $kol_3/($sum / 100);}
                                echo "<tr><td>Mercedes</td><td>$kol_1 %</td></tr>";
                                echo "<tr><td>BMW</td><td>$kol_2 %</td></tr>";
                                echo "<tr><td>Затрудняюсь ответить</td><td>$kol_3 %</td></tr>";
                                echo "<tr><td>Всего:</td><td>$sum </td></tr>";
                                echo '</table> <p  class ="p_view">Кто как ответил:</p>';

                                $sql = mysql_query("select * from inter where numview = '1' order by id desc");
                                while ( $a = mysql_fetch_array($sql)) {
                                    if ( $a['pol'] == 'мужской')  { $add = 'ответил';} else { $add = 'ответила';}
                                    echo "<table  class=\"inter_o\">
<tr><td><a href=\"profile.php?id=".$a['ids']."\"><font color = \"white\">".$a['name']."</font></a> ".$add.":</td></tr>
<tr><td><font size=\"3\">".$a['comment']."</font></td></tr>
<tr><td align=\"right\"><font color=\"white\" size=\"2\">".$a['creat']."</font></td></tr></table>";
                                } }
                            ?>
        </div>
        <div id = "box_v2">
            <?php
            if (isset($_POST['gsub2']))  { if (!empty($_POST['g2'])) { mysql_query("insert into inter (name, creat,comment, ids, pol, numview) values('{$_SESSION['user']}','{$create}', '{$_POST['g2']}', '{$_SESSION['ids']}', '{$_SESSION['pol']}', '2' )"); } else { echo '<h2>Выберите один из вариантов</h2>'; } }
            ?>
            <table class ="tab_opr">
                <td>Какой привод вам предпочтительнее?<br>
                    <form method="post"><label>
                            <?php
                            $sql = mysql_query("select ids from inter where ids = '{$_SESSION['ids']}' and numview = '2'");
                            if (mysql_num_rows($sql) == 0 )  {
                                echo '<input type="radio" name = "g2" value = "Передний привод" required> Передний привод</label><br>';
                                echo '<label><input type="radio" name = "g2" value = "Задний привод" required> Задний привод</label><br>';
                                echo '<label><input type="radio" name = "g2" value = "Полный привод" required> Полный привод</label><br>';
                                echo '<p align="right"><input type="submit" name = "gsub2" value = "Отправить"></p>';
                                echo '</form></td></tr></table>';
                            } else {
                                echo '</form></td></tr></table>';
                                echo '<p  class ="p_view">Результат опроса:</p>   <table class ="tab_res">';
                                $sql = mysql_query("select comment from inter where comment = 'Передний привод' and numview = '2'");
                                $kol_1 = mysql_num_rows($sql);
                                $sql = mysql_query("select comment from inter where comment = 'Задний привод' and numview = '2'");
                                $kol_2 = mysql_num_rows($sql);
                                $sql = mysql_query("select comment from inter where comment = 'Полный привод' and numview = '2'");
                                $kol_3 = mysql_num_rows($sql);
                                $sum = $kol_1 + $kol_2 + $kol_3;
                                if ($kol_1 !=  0) { $kol_1 = $kol_1/($sum / 100); }
                                if ($kol_2 !=  0) { $kol_2 = $kol_2/($sum / 100);  }
                                if ($kol_3 !=  0) { $kol_3 = $kol_3/($sum / 100); }
                                echo "<tr><td>Передний привод</td><td>$kol_1 %</td></tr>";
                                echo "<tr><td>Задний привод</td><td>$kol_2 %</td></tr>";
                                echo "<tr><td>Полный привод</td><td>$kol_3 %</td></tr>";
                                echo "<tr><td>Всего:</td><td>$sum</td></tr>";
                                echo '</table> <p  class ="p_view">Кто как ответил:</p> ';
                                $sql = mysql_query("select * from inter where numview = '2' order by id desc");
                                while ( $a = mysql_fetch_array($sql)) {
                                    if ( $a['pol'] == 'мужской')  { $add = 'ответил';} else { $add = 'ответила';}
                                    echo "<table  class=\"inter_o\">
<tr><td><a href=\"profile.php?id=".$a['ids']."\"><font color = \"white\">".$a['name']."</font></a> ".$add.":</td></tr>
<tr><td><font size=\"3\">".$a['comment']."</font></td></tr>
<tr><td align=\"right\"><font color=\"white\" size=\"2\">".$a['creat']."</font></td></tr></table>";
                                } }
                            ?>
        </div>
        <div id = "box_v3">
            <?php
            if (isset($_POST['gsub3']))  { if (!empty($_POST['g3'])) { mysql_query("insert into inter (name, creat,comment, ids, pol, numview) values('{$_SESSION['user']}','{$create}', '{$_POST['g3']}', '{$_SESSION['ids']}', '{$_SESSION['pol']}', '3' )"); } else { echo '<h2>Выберите один из вариантов</h2>'; } }
            ?>
            <table class ="tab_opr">
                <td>Какая сборка вам предпочтительнее?<br>
                    <form method="post">
                        <?php
                        $sql = mysql_query("select ids from inter where ids = '{$_SESSION['ids']}' and numview = '3'");
                        if (mysql_num_rows($sql) == 0 )  {
                            echo '<label><input type="radio" name = "g3" value = "Российская сборка" required> Российская сборка</label><br>';
                            echo '<label><input type="radio" name = "g3" value = "Немецкая сборка" required> Немецкая сборка</label><br>';
                            echo '<label><input type="radio" name = "g3" value = "Затрудняюсь ответить" required> Затрудняюсь ответить</label><br>';
                            echo '<p align="right"><input type="submit" name = "gsub3" value = "Отправить"></p>';
                            echo '</form></td></tr></table>';
                        } else {
                            echo '</form></td></tr></table>';
                            echo '<p  class ="p_view">Результат опроса:</p> ';
                            echo '<table class ="tab_res">';

                            $sql = mysql_query("select comment from inter where comment = 'Российская сборка' and numview = '3'");
                            $kol_1 = mysql_num_rows($sql);
                            $sql = mysql_query("select comment from inter where comment = 'Немецкая сборка' and numview = '3'");
                            $kol_2 = mysql_num_rows($sql);
                            $sql = mysql_query("select comment from inter where comment = 'Затрудняюсь ответить' and numview = '3'");
                            $kol_3 = mysql_num_rows($sql);
                            $sum = $kol_1 + $kol_2 + $kol_3;
                            if ($kol_1 !=  0) { $kol_1 = $kol_1/($sum / 100); }
                            if ($kol_2 !=  0) { $kol_2 = $kol_2/($sum / 100);}
                            if ($kol_3 !=  0) { $kol_3 = $kol_3/($sum / 100);}
                            echo"<tr><td>Российская сборка</td><td>$kol_1 %</td></tr>";
                            echo"<tr><td>Немецкая сборка</td><td>$kol_2 %</td></tr>";
                            echo"<tr><td>Затрудняюсь ответить</td><td>$kol_3 %</td></tr>";
                            echo"<tr><td>Всего:</td><td>$sum</td></tr>";
                            echo '</table>';
                            echo '<p  class ="p_view">Кто как ответил:</p>';
                            $sql = mysql_query("select * from inter where numview = '3' order by id desc");
                            while ( $a = mysql_fetch_array($sql)) {
                                if ( $a['pol'] == 'мужской')  { $add = 'ответил';} else { $add = 'ответила';}
                                echo "<table  class=\"inter_o\">
<tr><td><a href=\"profile.php?id=".$a['ids']."\"><font color = \"white\">".$a['name']."</font></a> ".$add.":</td></tr>
<tr><td><font size=\"3\">".$a['comment']."</font></td></tr>
<tr><td align=\"right\"><font color=\"white\" size=\"2\">".$a['creat']."</font></td></tr></table>";} }
                        mysql_close($link);
                        ?>
        </div>
    </div>
</div>
<div id="footer">
    <b>
        &copy; Гамов М.Н. 2012
    </b>
</div>
</body>
</html>