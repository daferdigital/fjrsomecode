<?php 
	include("conexion.php");	
		if(!$_POST['idapuesta']){
			$cadena=sprintf("insert into apuestas() values('','%s','%s','%s','".$_POST['que_equipo']."','1')",mysql_escape_string($_POST['tipo_apuesta']),mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['descripcion']));
			mysql_query($cadena)or die(mysql_error());// exit;
		}else{
			$cadena=sprintf("update apuestas set nombre='%s', idtipo_apuesta='%s', descripcion='%s',que_equipo='".$_POST['que_equipo']."' where idapuesta='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['tipo_apuesta']),mysql_escape_string($_POST['descripcion']),mysql_escape_string($_POST['idapuesta']));
			mysql_query($cadena);
		}
?>