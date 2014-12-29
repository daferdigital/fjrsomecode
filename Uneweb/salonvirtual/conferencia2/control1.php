<?php 
include("conexion.php");
$sql="select id,lo,status from chutos where lo='$_POST[nombre]' and cl='$_POST[clave]' and status>0";
$seleccionar=mysql_query($sql,$conex);
if($fila=mysql_fetch_array($seleccionar)){
session_start(); 
$_SESSION['quien']=$fila[0];
$_SESSION['quiensoy']=$fila[1];
$_SESSION["clan"]= 1967; 
$_SESSION["nivel"]= $fila[2];; 

header("Location:aqui.php"); 
}else { 
header("Location:index.php?error=1"); 
} 
?> 