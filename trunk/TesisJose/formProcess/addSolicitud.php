<?php
include_once '../classes/Constants.php';
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';
include_once '../classes/SessionUtil.php';
include_once '../classes/UsuarioDAO.php';
include_once '../classes/UsuarioDTO.php';

session_start();

//verificamos el acceso
if(! SessionUtil::checkIfUserIsLogged()){
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_MUST_BE_LOGGED;
	header("Location: ../index.php");
}

//verificamos que efectivamente venimos del submit del formulario
if(isset($_POST["botonSubmit"])){
	$usuarioDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
	
	//intentamos realizar el insert
	$query = "INSERT INTO solicitud (fecha_inicio, fecha_fin, id_personal, id_usuario, comentario, id_tipo_permiso)";
	$query .= " VALUES (";
	$query .= " '".$_POST["fechaSalidaHidden"]."',";
	$query .= " '".$_POST["fechaLlegadaHidden"]."',";
	$query .= " ".$_POST["funcionario"].",";
	$query .= " ".$usuarioDTO->getId().",";
	$query .= " '".$_POST["comentario"]."',";
	$query .= " ".$_POST["tipoSolicitud"].")";
	
	if(DBUtil::executeQuery($query)){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_DONE;
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_ERROR." ".$query;
	}
} else {
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_FORM_NOT_SUBMITED;
}

header("Location: ../formAgregarSolicitud.php");
?>