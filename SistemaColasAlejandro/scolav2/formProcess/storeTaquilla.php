<?php
	include_once '../classes/Constants.php';
	include_once '../classes/BitacoraDAO.php';
	include_once '../classes/PageAccess.php';
	include_once '../classes/UsuarioDTO.php';
	include_once '../classes/DBUtil.php';
	include_once '../includes/session.php';
	
	$query  = "INSERT INTO taquilla (nombre, orden, fecha_creacion, id_operador, id_sub_departamento) VALUES(";
	$query .= "'".$_POST["nombre"]."', ";
	$query .= "(SELECT COUNT(*) + 1 FROM (SELECT * FROM taquilla) t WHERE t.id_sub_departamento=".$_POST["idSubDpto"]."), ";
	$query .= "NOW(), ";
	$query .= $_POST["idOperador"].", ";
	$query .= $_POST["idSubDpto"].")";
	
	$result = DBUtil::executeQuery($query);
	if($result == true){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Su operaci&oacute;n fue realizada";
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Ocurrio un error en la ejecuci&oacute;n de su solicitud.";
	}
	
	header("Location: ../createTaquillas.php")
?>