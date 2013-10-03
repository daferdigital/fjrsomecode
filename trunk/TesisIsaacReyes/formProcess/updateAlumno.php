<?php
session_start();

include_once '../classes/Constants.php';
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';

//verificamos que efectivamente venimos del submit del formulario
if(isset($_POST["botonSubmit"])){
	//intentamos realizar el insert
	$query = "UPDATE alumnos SET ";
	$query .= " nombre='".$_POST["nombre"]."',";
	$query .= " apellido='".$_POST["apellido"]."',";
	$query .= " cedula_alumno='".$_POST["cedula"]."',";
	$query .= " direccion=".((trim($_POST["direccion"]) == "") ? "NULL" : " '".$_POST["direccion"]."'").",";
	$query .= " lugar_nacimiento='".$_POST["lugarNacimiento"]."',";
	$query .= " fecha_nacimiento='".$_POST["fechaNacimientoHidden"]."',";
	$query .= " sexo='".$_POST["sexo"]."',";
	$query .= " nombre_representante='".$_POST["representante"]."',";
	$query .= " cedula_representante='".$_POST["ci"]."-".$_POST["cedulaR"]."',";
	$query .= " literal='".$_POST["literal"]."',";
	$query .= " telefono='".$_POST["telefono"]."',";
	$query .= " id_grado=".$_POST["grado"];
	$query .= " WHERE id=".$_POST["id"];
	
	if(DBUtil::executeQuery($query)){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_DONE;
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_OPERATION_ERROR;
	}
} else {
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_FORM_NOT_SUBMITED;
}

header("Location: ../formAgregarAlumnos.php");
?>