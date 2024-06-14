<?php
session_start();
$id = $_SESSION['ids'];
include("infodb.php");

$sql_select = "SELECT * FROM users WHERE id = '{$id}'";
$query =  mysql_query ($sql_select);
$z = mysql_fetch_array($query);
$delete = date("Y-m-d");

$sql_insert = "INSERT INTO del_users (name, email, age, pol, infa, creat, delet, status) values ('{$z['name']}','{$z['email']}','{$z['age']}','{$z['pol']}','{$z['infa']}','{$z['creat']}','{$delete}','{$z['status']}')";
mysql_query ($sql_insert);

$sql_delete = "DELETE FROM users WHERE id = '{$id}'";
mysql_query ($sql_delete);
mysql_close($link);
session_destroy();
Header ("Location: profile.php");
?>