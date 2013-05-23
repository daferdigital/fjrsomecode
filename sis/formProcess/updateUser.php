<?php
include_once '../classes/Constants.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/PageAccess.php';
include_once '../classes/UsuarioDTO.php';
include_once '../classes/DBUtil.php';
include_once '../includes/session.php';
	
//a esta pagina se llega desde modificar usuario o reactivar usuario
$location = "";

if(isset($_POST[Constants::$KEY_MODULE_TO_REDIRECT])){
	//tenemos la informacion de a donde debemos regresar despues de esto
	//verificamos el permiso asociado
	
	if($_POST[Constants::$KEY_MODULE_TO_REDIRECT] == Constants::$OPCION_ADMIN_MODIFICAR_USUARIO){
		PageAccess::validateAccess(Constants::$OPCION_ADMIN_MODIFICAR_USUARIO);
		BitacoraDAO::registrarComentario("Acceso autorizado al submit del formulario de modificar usuario");
		$location = "Location: ../modificarUsuario.php";
	} else if($_POST[Constants::$KEY_MODULE_TO_REDIRECT] == Constants::$OPCION_ADMIN_REACTIVAR_USUARIO){
		PageAccess::validateAccess(Constants::$OPCION_ADMIN_REACTIVAR_USUARIO);
		BitacoraDAO::registrarComentario("Acceso autorizado al submit del formulario de reactivar usuario");
		$location = "Location: ../reactivarUsuario.php";
	} else {
		//opcion de acceso no conocida
		$_SESSION[Constants::$KEY_MESSAGE_ERROR] = Constants::$TEXT_UNKNOWN_ACCESS;
		BitacoraDAO::registrarComentario("Opcion de acceso [".$_POST[Constants::$KEY_MODULE_TO_REDIRECT]
				."] no conocida en la pagina formProcess/updateUser.php");
		
		header("Location: ../index.php");
	}
} else {
	//opcion de acceso no indicada
	$_SESSION[Constants::$KEY_MESSAGE_ERROR] = Constants::$TEXT_UNKNOWN_ACCESS;
	BitacoraDAO::registrarComentario("Opcion de acceso no indicada al accesar a la pagina formProcess/updateUser.php");
	
	header("Location: ../index.php");
}

//procedemos a armar el query de update
$query = "UPDATE usuarios SET "
." nombre='".$_POST["nombre"]."',"
." apellido='".$_POST["apellido"]."',"
." correo='".$_POST["correo"]."',"
." login='".$_POST["login"]."',"
.($_POST["clave"] != "" ? " clave=MD5('".$_POST["clave"]."'), " : "")
." tiempo_sesion=".$_POST["tiempoSesion"].", "
." active=".$_POST["active"].", "
." registros_por_pagina=".$_POST["registrosPorPagina"]
." WHERE id=".$_POST["usrId"];

DBUtil::executeQuery($query);

$_SESSION[Constants::$KEY_USER_ID]=$_POST["usrId"];
$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Su operaci&oacute;n fue realizada";

header($location);
?>
