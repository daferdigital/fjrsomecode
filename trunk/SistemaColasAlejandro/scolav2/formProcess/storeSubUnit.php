<?php
	include_once '../classes/Constants.php';
	include_once '../classes/BitacoraDAO.php';
	include_once '../classes/PageAccess.php';
	include_once '../classes/UsuarioDTO.php';
	include_once '../classes/DBUtil.php';
	include_once '../includes/session.php';
	
	$query  = "INSERT INTO sub_departamento (nombre, cupo_maximo, horario_inicial, horario_final, tiempo_promedio_atencion,
		atencion_previa_cita, id_departamento) VALUES(";
	$query .= "'".$_POST["nombre"]."', ";
	$query .= $_POST["cupoMaximo"].", ";
	$query .= "'".$_POST["horaInicio"]."', ";
	$query .= "'".$_POST["horaFin"]."', ";
	$query .= $_POST["promedioAtencion"].", ";
	$query .= "'".$_POST["previaCita"]."', ";
	$query .= $_POST["idDpto"].")";
	
	$result = DBUtil::executeQuery($query);
	if($result == true){
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Su operaci&oacute;n fue realizada";
	} else {
		$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Ocurrio un error en la ejecuci&oacute;n de su solicitud.";
	}
	
	header("Location: ../createSubUnidades.php")
?>
