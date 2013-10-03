<?php
session_start();

include_once '../classes/Constants.php';
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';

//verificamos que efectivamente venimos del submit del formulario
if(isset($_POST["botonSubmit"])){
	//intentamos realizar el insert
	$query = "INSERT INTO alumnos (nombre, apellido, cedula_alumno, direccion, lugar_nacimiento, fecha_nacimiento, sexo, nombre_representante, cedula_representante, literal, telefono, id_grado)";
	$query .= " VALUES (";
	$query .= " '".$_POST["nombre"]."',";
	$query .= " '".$_POST["apellido"]."',";
	$query .= " '".$_POST["cedula"]."',";
	$query .= ((trim($_POST["direccion"]) == "") ? "NULL" : " '".$_POST["direccion"]."',");
	$query .= " '".$_POST["lugarNacimiento"]."',";
	$query .= " '".$_POST["fechaNacimientoHidden"]."',";
	$query .= " '".$_POST["sexo"]."',";
	$query .= " '".$_POST["representante"]."',";
	$query .= " '".$_POST["ci"]."-".$_POST["cedulaR"]."',";
	$query .= " '".$_POST["literal"]."',";
	$query .= " '".$_POST["telefono"]."',";
	$query .= " ".$_POST["grado"].")";
	
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