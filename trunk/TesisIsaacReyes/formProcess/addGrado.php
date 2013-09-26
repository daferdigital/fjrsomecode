<?php
session_start();

include_once '../classes/Constants.php';
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';

//verificamos que efectivamente venimos del submit del formulario
if(isset($_POST["botonSubmit"])){
	//intentamos realizar el insert
	$query = "INSERT INTO grados (turno, grado, descripcion, id_profesor)";
	$query .= " VALUES (";
	$query .= " '".$_POST["turno"]."',";
	$query .= " '".$_POST["grado"]."',";
	$query .= " '".$_POST["descripcion"]."',";
	$query .= " ".$_POST["profesor"].")";
	
	if(DBUtil::executeQuery($query)){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_DONE;
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_ERROR;
	}
} else {
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_FORM_NOT_SUBMITED;
}

header("Location: ../formAgregarGrados.php");
?>