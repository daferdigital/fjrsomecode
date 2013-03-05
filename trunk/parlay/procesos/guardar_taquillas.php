<?php 
	include("conexion.php");	
		if(!$_POST['idtaquilla']){
			$cadena="insert into taquillas(idtaquilla,estatus) values('','1')";
			mysql_query($cadena)or die(mysql_error());// exit;
			$id=mysql_insert_id();
		}else{
			$id=$_POST['idtaquilla'];
		}
		
		$cadena=sprintf("
			update 
				taquillas set nombre='%s', idintermediario='%s', cedula='%s', telefono='%s', direccion='%s', email='%s', usuario='%s', clave='%s', tipo='%s', mjpd='%s', mpjpd='%s', mjpdrl='%s', mapt='%s', mjpp='%s', mp='%s', mjr='%s', pdu='%s', pdv='%s', pdvd='%s', cmina='%s', cdpp='%s', cdpd='%s', tlpat='%s', pp='%s', cmlp='%s', cmht='%s', cmmt='%s', pagr='%s', cmapd='%s', cma2='%s', cma3='%s', cma4='%s', cma5='%s', cma6='%s', cma7='%s', cma8='%s', cma9='%s', cma10='%s', fa='%s' 
			where 
				idtaquilla='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['intermediario']),mysql_escape_string($_POST['cedula']),mysql_escape_string($_POST['telefono']),mysql_escape_string($_POST['direccion']),mysql_escape_string($_POST['email']),mysql_escape_string($_POST['usuario']),mysql_escape_string($_POST['clave']),mysql_escape_string($_POST['tipo']),mysql_escape_string($_POST['mjpd']),mysql_escape_string($_POST['mpjpd']),mysql_escape_string($_POST['mjpdrl']),mysql_escape_string($_POST['mapt']),mysql_escape_string($_POST['mjpp']),mysql_escape_string($_POST['mp']),mysql_escape_string($_POST['mjr']),mysql_escape_string($_POST['pdu']),mysql_escape_string($_POST['pdv']),mysql_escape_string($_POST['pdvd']),mysql_escape_string($_POST['cmina']),mysql_escape_string($_POST['cdpp']),mysql_escape_string($_POST['cdpd']),mysql_escape_string($_POST['tlpat']),mysql_escape_string($_POST['pp']),mysql_escape_string($_POST['cmlp']),mysql_escape_string($_POST['cmht']),mysql_escape_string($_POST['cmmt']),mysql_escape_string($_POST['pagr']),mysql_escape_string($_POST['cmapd']),mysql_escape_string($_POST['cma2']),mysql_escape_string($_POST['cma3']),mysql_escape_string($_POST['cma4']),mysql_escape_string($_POST['cma5']),mysql_escape_string($_POST['cma6']),mysql_escape_string($_POST['cma7']),mysql_escape_string($_POST['cma8']),mysql_escape_string($_POST['cma9']),mysql_escape_string($_POST['cma10']),mysql_escape_string($_POST['fa']),mysql_escape_string($id));
		mysql_query($cadena);
		
?>