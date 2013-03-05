<?php 
	include("conexion.php");	
		if(!$_POST['idintermediario']){
			$cadena=sprintf("insert into intermediarios() values('','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','1')",mysql_escape_string($_POST['banquero']),mysql_escape_string($_POST['cedula']),mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['direccion']),mysql_escape_string($_POST['telefono']),mysql_escape_string($_POST['pp']),mysql_escape_string($_POST['pd']),mysql_escape_string($_POST['usuario']),mysql_escape_string($_POST['clave']),mysql_escape_string($_POST['mt']));
			mysql_query($cadena)or die(mysql_error());// exit;
		}else{
			if($_SESSION['perfil']<3):
				$cadena=sprintf("update intermediarios set nombre='%s', idbanquero='%s', direccion='%s', telefono='%s', cedula='%s', pp='%s', pd='%s', usuario='%s',clave='%s', mt='%s' where idintermediario='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['banquero']),mysql_escape_string($_POST['direccion']),mysql_escape_string($_POST['telefono']),mysql_escape_string($_POST['cedula']),mysql_escape_string($_POST['pp']),mysql_escape_string($_POST['pd']),mysql_escape_string($_POST['usuario']),mysql_escape_string($_POST['clave']),mysql_escape_string($_POST['mt']),mysql_escape_string($_POST['idintermediario']));
			else:	
				$cadena=sprintf("update intermediarios set nombre='%s', idbanquero='%s', direccion='%s', telefono='%s', cedula='%s', pp='%s', pd='%s', usuario='%s',clave='%s' where idintermediario='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['banquero']),mysql_escape_string($_POST['direccion']),mysql_escape_string($_POST['telefono']),mysql_escape_string($_POST['cedula']),mysql_escape_string($_POST['pp']),mysql_escape_string($_POST['pd']),mysql_escape_string($_POST['usuario']),mysql_escape_string($_POST['clave']),mysql_escape_string($_POST['idintermediario']));
			endif;
			
			mysql_query($cadena)or die(mysql_error());
		}		
?>