<?php session_start();
if($_SESSION['clan']!=3535){
header("location:admin.php");
exit();}
include "conexion.php"; 

$img=$_FILES['dia']['tmp_name'];
$tipo=getimagesize($img);
if($tipo[2]==1){
$ext=".gif"; }
elseif($tipo[2]==2){
$ext=".jpg"; }
elseif($tipo[2]==3){
$ext=".png"; }
$buscar="select max(id) from diapositivas";
$consulta2=mysql_query($buscar,$conex);
$ultimo=mysql_fetch_array($consulta2);
$maximo=$ultimo[0]+1;
$ruta="dia/".$maximo.$ext;
$ya=$maximo.$ext;
move_uploaded_file($img,$ruta);
$fecha=date("Y-m-d");
$hora=date("h:i:s a");


	 $sql="insert into diapositivas values('','$_POST[nombre]','$ya','$_POST[curso]',1)";

	mysql_query($sql,$conex); 
	
	if(!mysql_error()){ ?>
		 <script> alert('La operacion se realizo exitosamente')</script><?php }else{ ?><script> alert('Ocurrio un error intente nuevamente o comuniquese con el programador')</script><?php }
		 ?>
<meta http-equiv="refresh" content="0;URL=cargardia.php">