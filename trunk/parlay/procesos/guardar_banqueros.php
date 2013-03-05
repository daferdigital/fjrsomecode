<?php session_start();
	include("conexion.php");
	$_POST=convertArrayKeysToUtf82($_POST);
		if(!$_POST['idbanquero']){
			$cadena=sprintf("insert into banqueros() values('','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','1')",mysql_escape_string($_POST['nombres']),mysql_escape_string($_POST['apellidos']),mysql_escape_string($_POST['cedula']),mysql_escape_string($_POST['direccion']),mysql_escape_string($_POST['telefono']),mysql_escape_string($_POST['correo']),mysql_escape_string($_POST['web']),mysql_escape_string($_POST['usuario']),mysql_escape_string($_POST['clave']),mysql_escape_string($_POST['ml']));
			mysql_query($cadena)or die(mysql_error());// exit;
			$idbanquero=mysql_insert_id();
			//verifico si hay logros cargados para la fecha, en caso de haber se los asigno al nuevo banquero
			$existe=dame_datos("select idlogro from logros where fecha='".date('Y-m-d')."' limit 1");
			if($existe){
				agregar_logros_banqueros(date('Y-m-d'),$idbanquero);
			}
		}else{
			if($_SESSION['perfil']==1):
				$cadena=sprintf("update banqueros set nombres='%s',apellidos='%s',ced_rif='%s',direccion='%s',telefonos='%s',correo='%s',web='%s',usuario='%s',clave='%s',ml='%s' where idbanquero='%s' limit 1",mysql_escape_string($_POST['nombres']),mysql_escape_string($_POST['apellidos']),mysql_escape_string($_POST['cedula']),mysql_escape_string($_POST['direccion']),mysql_escape_string($_POST['telefono']),mysql_escape_string($_POST['correo']),mysql_escape_string($_POST['web']),mysql_escape_string($_POST['usuario']),mysql_escape_string($_POST['clave']),mysql_escape_string($_POST['ml']),mysql_escape_string($_POST['idbanquero']));
			else:	
				$cadena=sprintf("update banqueros set nombres='%s',apellidos='%s',ced_rif='%s',direccion='%s',telefonos='%s',correo='%s',web='%s',usuario='%s',clave='%s' where idbanquero='%s' limit 1",mysql_escape_string($_POST['nombres']),mysql_escape_string($_POST['apellidos']),mysql_escape_string($_POST['cedula']),mysql_escape_string($_POST['direccion']),mysql_escape_string($_POST['telefono']),mysql_escape_string($_POST['correo']),mysql_escape_string($_POST['web']),mysql_escape_string($_POST['usuario']),mysql_escape_string($_POST['clave']),mysql_escape_string($_POST['idbanquero']));
			endif;
			mysql_query($cadena);
		}
?>