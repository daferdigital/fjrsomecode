<?php
session_start();

include_once '../classes/Constants.php';
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';
include_once '../classes/SessionUtil.php';
include_once '../classes/UsuarioDAO.php';
include_once '../classes/UsuarioDTO.php';

//verificamos el acceso
if(! SessionUtil::checkIfUserIsLogged()){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_MUST_BE_LOGGED;
	header("Location: ../index.php");
}

//verificamos que efectivamente venimos del submit del formulario
if(isset($_POST["botonSubmit"])){
	//intentamos realizar el insert
	$query = "UPDATE solicitud SET ";
	$query .= "fecha_inicio='".$_POST["fechaSalidaHidden"]."', ";
	$query .= "fecha_fin='".$_POST["fechaLlegadaHidden"]."', ";
	$query .= "comentario='".$_POST["comentario"]."', ";
	$query .= "id_personal=".$_POST["funcionario"].", ";
	$query .= "id_tipo_permiso=".$_POST["tipoSolicitud"];
	$query .= " WHERE id=".$_POST["id"];
	
	if(DBUtil::executeQuery($query)){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_DONE;
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_ERROR." ".$query;
	}
} else {
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_FORM_NOT_SUBMITED;
}

header("Location: ../formListarSolicitudes.php");
?>