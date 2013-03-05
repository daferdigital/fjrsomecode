<?php 
	include("conexion.php");
	$_POST=convertArrayKeysToUtf82($_POST);
		if(!$_POST['idtipo_apuesta']){
			$cadena=sprintf("insert into tipo_apuestas() values('','%s','".$_POST['tipo']."','1')",mysql_escape_string($_POST['nombre']));
			mysql_query($cadena)or die(mysql_error());// exit;
		}else{
			$cadena=sprintf("update tipo_apuestas set nombre='%s',tipo='".$_POST['tipo']."' where idtipo_apuesta='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['idtipo_apuesta']));
			mysql_query($cadena);
		}
		//header ("Location: ../ingreso_tipo_apuestas.php?res=modexito");
?>