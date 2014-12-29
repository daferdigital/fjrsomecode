<?php 
include("conexion.php");
$sql="update cual set cual='$_POST[modo]'";
if($seleccionar=mysql_query($sql,$conex)){

header("Location:pizarra.php"); 
}else { 
header("Location:modos.php"); 
} 
?> 