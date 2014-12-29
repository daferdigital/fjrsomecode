<?php session_start();
if($_SESSION['clan']!=3535){
header("location:index.php");
exit();} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panel Adminitrativo 1.1</title>
<style>
ul li
{
display: inline;
list-style-type: none;
padding-right: 20px;
}
</style>
</head>

<body>
<table width="500" border="0">
  <tr>
    <td>Panel Administrativo Clases en linea</td>
  </tr>
   <tr>
    <td><ul><li><a href="admin2.php">Inicio</a></li><li><a href="llenar.php">Pizarra</a></li><li><a href="llenar2.php">Diapositivas</a></li><li><a href="cargardia.php">Cargar diapositivas</a></li></ul></td>
  </tr>
  <tr>
    <td><?php 
include "conexion.php";
if($_POST[modo]){
$va="update cual set cual='$_POST[modo]'";
mysql_query($va,$conex);
}?>
Modo actual:<?php  $esco="select cual from cual";
$tu=mysql_query($esco,$conex);
$cho=mysql_fetch_array($tu);
if($cho[0]==1) print "Pizarra";
if($cho[0]==2) print "Diapositiva";
if($cho[0]==3) print "Video";
?>
<form id="form1" name="form1" method="post" action="">
  <label for="modo">Modo que desea la clase</label>
  <select name="modo" id="modo" onchange="submit()">
   <option value="0">Elegir una......</option>
    <option value="1">Pizarra</option>
    <option value="2">Diapositiva</option>
    <option value="3">Video</option>
  </select>
</form>
</td>
  </tr>
</table>


</body>
</html>