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
	$query = "INSERT INTO personal (nombre, apellido, cedula, direccion, turno, ubicacion, fecha_ingreso, telefono, id_cargo, id_supervisor)";
	$query .= " VALUES (";
	$query .= " '".$_POST["nombre"]."',";
	$query .= " '".$_POST["apellido"]."',";
	$query .= " '".$_POST["ci"]."-".$_POST["cedula"]."',";
	$query .= " '".$_POST["direccion"]."',";
	$query .= " '".$_POST["turno"]."',";
	$query .= " '".$_POST["ubicacion"]."',";
	$query .= " '".$_POST["fechaIngresoHidden"]."',";
	$query .= " '".$_POST["telefono"]."',";
	$query .= $_POST["cargo"].",";
	$query .= ($_POST["supervisor"] == "" ? "NULL" : $_POST["supervisor"]).")";
	
	if(DBUtil::executeQuery($query)){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_DONE;
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_ERROR;
	}
} else {
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_FORM_NOT_SUBMITED;
}

header("Location: ../formAgregarPersonal.php");
?>