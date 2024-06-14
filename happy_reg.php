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
  {
    include_once("menu.html");
  }
else
  {echo '<p>Элемент интерфейса не доступен из за неполадок</p>';}
?>
      </div>
      <div id="text">
<?
include("infodb.php");

if (isset($_POST['submit']))
{
  if(empty($_POST['name']))
    {
      echo '<div id="text_box"><h1>Не введено имя</h1><p><a href="reg.php">Назад</a></p></div>';
    }
  elseif(empty($_POST['email']))
    {
      echo '<div id="text_box"><h1>Не введен E-mail</h1><p><a href="reg.php">Назад</a></p></div>';
    }
  elseif(empty($_POST['pass']))
    {
      echo '<div id="text_box"><h1>Не введен пароль</h1><p><a href="reg.php">Назад</a></p></div>';
    }
  elseif(empty($_POST['pass2']))
    {
      echo '<div id="text_box"><h1>Не подтвержден пароль</h1><p><a href="reg.php">Назад</a></p></div>';
    }
  elseif($_POST['pass'] != $_POST['pass2'])
    {
      echo '<div id="text_box"><h1>Пароли не совпадают</h1><p><a href="reg.php">Назад</a></p></div>';
    }
  elseif(empty($_POST['age']))
    {
      echo '<div id="text_box"><h1>Не введен возраст</h1><p><a href="reg.php">Назад</a></p></div>';
    }
  elseif(empty($_POST['pol']))
    {
      echo '<div id="text_box"><h1>Не указан ваш пол</h1><p><a href="reg.php">Назад</a></p></div>';
    }
  elseif(empty($_POST['infa']))
    {
      echo '<div id="text_box"><h1>Не заполнен последний пункт</h1><p><a href="reg.php">Назад</a></p></div>';
    }
  else
    {
      $name = $_POST['name'];
      $pass = ($_POST['pass']);
      $email = $_POST['email'];
      $age = $_POST['age'];
      $pol = $_POST['pol'];
      $infa = $_POST['infa'];
      $query = "SELECT * FROM users WHERE email = '{$email}'";
      $sql = mysql_query($query) or die(mysql_error());
      if (mysql_num_rows($sql) > 0)
        {
          echo '<div id="text_box"><h1>Уже иммется аккаунт с таким email</h1><p><a href="reg.php">Назад</a></p></div>';
        }
      else
        {
          $key = "user";
          $create =date("Y-m-d");
          $query = "INSERT INTO users (name, email, pass, age, pol, infa, creat, status) VALUES ('{$name}', '{$email}', '{$pass}', '{$age}', '{$pol}', '{$infa}', '{$create}', '{$key}')";
          $result = mysql_query($query) or die(mysql_error());
          $sql = mysql_query("SELECT id FROM users WHERE email = '{$email}'");
          $id = mysql_result($sql,'id');
          $_SESSION['user']= $name;
          $_SESSION['status']= $key;
          $_SESSION['ids']= $id;
          $_SESSION['pol'] = $pol;
          mysql_query("INSERT INTO online (name, email, creat, status, ids) VALUES ('{$name}','{$email}','{$create}','{$key}','{$id}')");
          echo '<div id="text_box"><h1>Успешная регистрация<br>Вы так же автоматически авторизованы</h1>';
          echo '<a href = "profile.php?id='.$_SESSION['ids'].'"  class="h1_box"><font color = "white">Хотите увидеть свой профиль?</font></a></div>';
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