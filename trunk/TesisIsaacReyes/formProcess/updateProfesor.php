<?php
session_start();

include_once '../classes/Constants.php';
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';

//verificamos que efectivamente venimos del submit del formulario
if(isset($_POST["botonSubmit"])){
	//intentamos realizar el insert
	$query = "UPDATE profesores SET";
	$query .= " nombre='".$_POST["nombre"]."',";
	$query .= " apellido='".$_POST["apellido"]."',";
	$query .= " cedula='".$_POST["ci"]."-".$_POST["cedula"]."',";
	$query .= " direccion='".$_POST["direccion"]."',";
	$query .= " telefono='".$_POST["telefono"]."'";
	$query .= " WHERE id=".$_POST["id"];
	
	if(DBUtil::executeQuery($query)){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_DONE;
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_ERROR;
	}
} else {
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_FORM_NOT_SUBMITED;
}

header("Location: ../formListarProfesores.php");
?>