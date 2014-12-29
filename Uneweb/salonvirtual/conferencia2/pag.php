<?php
session_start();
if($_SESSION['clan']!=1967){
header("location:index.php");
exit();} 
include "conexion.php";

$sql="insert into chat values('','$_SESSION[quiensoy]','$_REQUEST[numero]',1)";
mysql_query($sql,$conex);
$ju="select usu,cuento from chat order by id desc limit 0,15";
$consu=mysql_query($ju,$conex);
while($ver=mysql_fetch_array($consu)){
print $ver[0].": ".$ver[1]."<br>";
}
