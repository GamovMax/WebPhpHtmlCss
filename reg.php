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
  {include_once("menu.html");}
else
  {echo '<p>Элемент интерфейса не доступен из за неполадок</p>';}
?>

        </div>

        <div id="text">
          <div id="text_box">
            <form action="happy_reg.php" method="POST">
              <table>
                <tr>
                  <td>Имя: </td>
                  <td><input type="text" name="name" required></td>
                </tr>

                <tr>
                  <td colspan="2"><p class="p_reg">Используется как подпись к комментариям</p></td>
                </tr>

                <tr>
                  <td>Email: </td>
                  <td><input type="text" name="email" required></td>
                </tr>

                <tr>
                  <td colspan="2"><p class="p_reg">Используется как логин для авторизации</p></td>
                </tr>

                <tr>
                  <td>Пароль: </td>
                  <td><input type="password" name="pass" required></td>
                </tr>

                <tr>
                  <td>Re-пароль:</td>
                  <td><input type="password" name="pass2" required></td>
                </tr>

                <tr>
                  <td>Возраст: </td>
                  <td><input type="text" name="age" required></td>
                </tr>

                <tr>
                  <td>Пол: </td>
                  <td><label><input type="radio" name="pol" value="мужской" required/>мужской</label><br /><label><input type="radio" name="pol" value="женский" required/>женский</label></td>
                </tr>

                <tr>
                  <td>Пару тройку слов о себе: <br /></td>
                  <td><textarea name="infa" cols="41" rows="5" required placeholder ="Напишите о себе"></textarea></td>
                </tr>

                <tr>
                  <td colspan="2"><input type="submit" value="Создать аккаунт" name="submit" ></td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      </div>

      <div id="footer">
        <b>&copy; Гамов М.Н. 2012</b>
      </div>

    </body>
  </html>