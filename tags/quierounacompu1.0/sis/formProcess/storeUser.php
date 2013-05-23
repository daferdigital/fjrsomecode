<?php
	include_once '../classes/Constants.php';
	include_once '../classes/BitacoraDAO.php';
	include_once '../classes/PageAccess.php';
	include_once '../classes/UsuarioDTO.php';
	include_once '../classes/DBUtil.php';
	include_once '../includes/session.php';
	
	PageAccess::validateAccess(Constants::$OPCION_ADMIN_CREAR_USUARIO);
	
	BitacoraDAO::registrarComentario("Acceso autorizado a la funcionalidad de guardar nuevo usuario");
	
	$query = "INSERT INTO usuarios (nombre, apellido, login, clave, correo, tiempo_sesion)"
	." VALUES('".$_POST["nombre"]."', '".$_POST["apellido"]."', '".$_POST["login"]."', MD5('".$_POST["clave"]."'), '".$_POST["correo"]."', ".$_POST["tiempoSesion"].")";
		
	DBUtil::executeQuery($query);
		
	BitacoraDAO::registrarComentario("Usuario [".$_POST["login"]."] creado con exito");
		
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Su operaci&oacute;n fue realizada";
	
	header("Location: ../crearUsuario.php")
?>
