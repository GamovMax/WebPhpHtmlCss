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
            <h2>Курсовой проект</h2>
            <p class="p_faq">Разработал: Гамов М. Н.</p>
            <p class="p_faq">Чат: имеется функция очистки чата.</p>
            <p class="p_faq">Права: админы и модераторы обладают расширенными правами.</p>
            <p class="p_faq">Новостные блоки: только модераторы и админы могут добавлять информацию.</p>
            <p class="p_faq">Функциональность: нацелена на максимальное удобство использования для обычных пользователей, а так же администрации. Гостям, которые не прошли регистрацию и дальнейшую авторизацию предоставляются ограниченные возможности.</p>
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