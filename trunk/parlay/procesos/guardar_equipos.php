<?php 
	include("conexion.php");
	$_POST=convertArrayKeysToUtf82($_POST);
		if(!$_POST['idequipo']){
			$cadena=sprintf("insert into equipos() values('','%s','%s','%s','')",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['liga']),mysql_escape_string($_POST['estatus']));
			mysql_query($cadena)or die(mysql_error());// exit;
		}else{
			$cadena=sprintf("update equipos set nombre='%s', idliga='%s', estatus='%s' where idequipo='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['liga']),mysql_escape_string($_POST['estatus']),mysql_escape_string($_POST['idequipo']));
			mysql_query($cadena);
		}
		header ("Location: ../ingreso_equipos.php?res=modexito");
?>