<?php

$hostname_web = "localhost";
$database_web = "transviajes";
//$username_web = "transviajes_user";
//$password_web = "#m1.cl4v3.d4t4#";
$username_web = "root";
$password_web = "root1006";

$conexion = mysql_connect($hostname_web, $username_web, $password_web) or die(mysql_error());
mysql_select_db($database_web, $conexion);

?>