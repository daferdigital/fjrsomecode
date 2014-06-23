<?php
	include_once '../classes/Constants.php';
	include_once '../classes/BitacoraDAO.php';
	include_once '../classes/PageAccess.php';
	include_once '../classes/UsuarioDTO.php';
	include_once '../classes/DBUtil.php';
	include_once '../includes/session.php';
	
	BitacoraDAO::registrarComentario("Acceso autorizado a la funcionalidad de guardar nuevo usuario");
	
	$query  = "INSERT INTO usuarios (nombre, apellido, login, clave, email, cedula, id_tipo_usuario) VALUES(";
	$query .= "'".$_POST["nombre"]."', ";
	$query .= "'".$_POST["apellido"]."', ";
	$query .= "'".$_POST["login"]."', ";
	$query .= "MD5('".$_POST["clave"]."'), ";
	$query .= "'".$_POST["correo"]."', ";
	$query .= "'".$_POST["cedula"]."', ";
	$query .= $_POST["tipoUsuario"].")";
		
	$result = DBUtil::executeQuery($query);
	if($result == true){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Su operaci&oacute;n fue realizada";
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Ocurrio un error en la ejecuci&oacute;n de su solicitud.";
	}
	
	header("Location: ../createUsuarios.php")
?>
