<?php 
	include("conexion.php");
	$_POST=convertArrayKeysToUtf82($_POST);
		if(!$_POST['idroster']){
			$cadena=sprintf("insert into roster() values('','%s','%s','%s','%s','%s','%s','%s')",mysql_escape_string($_POST['equipo']),mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['efectividad']),mysql_escape_string($_POST['ganados']),mysql_escape_string($_POST['perdidos']),mysql_escape_string($_POST['lado']),mysql_escape_string($_POST['estatus']));
			//echo $cadena; exit;
			mysql_query($cadena)or die(mysql_error());// exit;
		}else{
			$cadena=sprintf("update roster set nombre='%s', idequipo='%s', efectividad='%s', ganados='%s', perdidos='%s', lado='%s', estatus='%s' where idroster='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['equipo']),mysql_escape_string($_POST['efectividad']),mysql_escape_string($_POST['ganados']),mysql_escape_string($_POST['perdidos']),mysql_escape_string($_POST['lado']),mysql_escape_string($_POST['estatus']),mysql_escape_string($_POST['idroster']));
			mysql_query($cadena);
		}
		//header ("Location: ../ingreso_lanzadores.php?res=modexito");
?>