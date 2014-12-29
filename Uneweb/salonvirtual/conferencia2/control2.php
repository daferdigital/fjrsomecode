<?php 

include("conexion.php");
$sql="select id,n from jefes where n='$_POST[nombre]' and c='$_POST[clave]' and status=1";
$seleccionar=mysql_query($sql,$conex);
if($fila=mysql_fetch_array($seleccionar)){
session_start(); 
$_SESSION['quien']=$fila[0];
$_SESSION['quiensoy']=$fila[1];
$_SESSION["clan"]= 3535; 

header("Location:admin2.php"); 
}else { 
header("Location:admin.php?error=1");
} 
?> 