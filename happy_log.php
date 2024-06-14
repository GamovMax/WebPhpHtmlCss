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

<?php 
include("infodb.php");
if (isset($_POST['log']))
  {
    if (!empty($_POST['email']) and !empty($_POST['pass']))
      {
        $email= $_POST['email'];
        $pass= $_POST['pass'];
        $sql = mysql_query("SELECT id, name, status, pol  FROM users WHERE email = '".$email."' AND pass = '".$pass."'");
        if (mysql_num_rows($sql) > 0)
          {
            $qz = mysql_fetch_array($sql);
            $_SESSION['user'] = $qz['name'];
            $_SESSION['ids'] = $qz['id'];
          }
        }
      }
mysql_close($link); 
?>

      <div id="user"> 

<?php
if (file_exists('header_user.html'))
  {include_once("header_user.html");}
else
  {echo '<p>Элемент интерфейса недоступен из за неполадок</p>';}
?>
      </div>

    </div>

    <div id="content">
      <div id="menu">

<?php
if (file_exists('menu.html'))
  {include_once("menu.html");}
else
  {echo '<p>Элемент интерфейса не доступен из за неполадок</p>';}
?>
      </div>

      <div id="text">

<?php 
include("infodb.php");
if (isset($_POST['log']))
  {
    if (empty($_POST['email']))
      {echo '<div id="text_box"><h1>Не введен E-mail</h1><p><a href="log.php"><font color=\"#EEEEEE\">Назад</font></a></p></div>';}
    elseif (empty($_POST['pass']))
      {echo '<div id="text_box"><h1>Не введен пароль</h1><p><a href="log.php"><font color=\"#EEEEEE\">Назад</font></a></p></div>';}
    else
      {
        $email= $_POST['email'];
        $pass= $_POST['pass'];
        $sql = mysql_query("SELECT id, name, status, pol  FROM users WHERE email = '".$email."' AND pass = '".$pass."'");
        if (mysql_num_rows($sql) > 0)
          {
            $qz = mysql_fetch_array($sql);
            $_SESSION['user'] = $qz['name'];
            $_SESSION['status'] = $qz['status'];
            $_SESSION['ids'] = $qz['id'];
            $_SESSION['pol'] = $qz['pol'];
            $create = date("d.n.Y \в H:i");
            mysql_query("INSERT INTO online (name, email, creat, status, ids) values ('{$qz['name']}','{$email}','{$create}','{$qz['status']}','{$qz['id']}')");
            echo '<div id="text_box"><h1>Привет '.$qz['name'].'!</h1><h2>Вход успешно выполнен</h2>';
            echo '<a href = "profile.php?id='.$_SESSION['ids'].'"><font color = "white">Хотите увидеть свой профиль?</font></a></div>';
          }
        else
          {
            echo '<div id="text_box"><h1>Неверная пара логин / пароль Проверьте вводимые данные</h1><p><a href="log.php"><font color=\"#EEEEEE\">Назад</font></a></p></div>';
          }
      }
  }
mysql_close($link);
?>

      </div>
    </div>

    <div id="footer">
      <b>&copy; Гамов М.Н. 2012</b>
    </div>
  </body>
</html>