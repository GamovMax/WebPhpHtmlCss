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

<?php
include("infodb.php");

if (isset($_POST['new']))
{
  if (!empty($_POST['new']))
  {
    $comment = $_POST['new'];
    $name = $_SESSION['user'];
    $ids = $_SESSION['ids'];
    $pol = $_SESSION['pol'];
    $create = date("Y-m-d");

    mysql_query("Insert into news (name, creat, comment, ids, pol) values ('{$name}','{$create}','{$comment}','{$ids}', '{$pol}')"); 
  }
}

$sql = mysql_query("select * from news order by id desc");
while ( $info = mysql_fetch_array($sql)) {
if ( $info['pol'] == 'мужской')
  { $add = 'добавил';}
else
  { $add = 'добавила';}

echo "<table class=\"news\">
<tr class=\"news_top\"><td>

<table width=\"100%\"><tr><td>
<b>Новость ".$add." </b><a href=\"profile.php?id=".$info['ids']."\"><font color = \"#333333\" size=\"4\"><b>".$info['name']."</b></font></a> :</td>
<td align=\"right\"><font size=\"2\"><b>".$info['creat']."</b></font>
</td></tr></table>

</td></tr>
<tr><td><font size=\"3\"><div class=\"news_bot\">".$info['comment']."</div></font></td></tr>
</table>"; }

mysql_close($link);

echo '<a href = "#top" ><font color = "white">Вверx</font></a>';

if(isset ($_SESSION['status']))
{
  if ($_SESSION['status'] == 'admin' or $_SESSION['status'] == 'mod' )
  {
print<<<E
<div id="comment"><h2>Добавить новость:</h2>
<form action="index.php" method="post">
<textarea name="new" cols="40" rows="4" required></textarea><br><br>
<input type="submit" value="Отправить"/>
<input type="reset" value="Очистить" />
</form>
</div>
E;
  }
}

?>

          </div>
        </div>

      <div id="footer">
        <b>&copy; Гамов М.Н. 2012</b>
      </div>
    </body>
  </html>