<?php
session_start();

include_once '../classes/Constants.php';
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';

//verificamos que efectivamente venimos del submit del formulario
if(isset($_POST["botonSubmit"])){
	//intentamos realizar el insert
	$query = "INSERT INTO profesores (nombre, apellido, cedula, direccion, telefono)";
	$query .= " VALUES (";
	$query .= " '".$_POST["nombre"]."',";
	$query .= " '".$_POST["apellido"]."',";
	$query .= ((trim($_POST["cedula"]) == "") ? "NULL" : "'".$_POST["ci"]."-".$_POST["cedula"]."',");
	$query .= " '".$_POST["direccion"]."',";
	$query .= " '".$_POST["telefono"]."')";
	
	if(DBUtil::executeQuery($query)){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_DONE;
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_ERROR;
	}
} else {
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_FORM_NOT_SUBMITED;
}

header("Location: ../formAgregarProfesores.php");
?>