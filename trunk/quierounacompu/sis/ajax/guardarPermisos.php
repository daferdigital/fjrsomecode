<?php
include_once '../classes/DBUtil.php';

if(isset($_POST["submit"])){
	//recibimos el formulario para almacenar la informacion
	//eliminamos los registros previos de permisos para actualizar
	$query = "DELETE FROM usuario_modulo";
	$dbUtilObj = new DBUtil();
	$dbUtilObj->executeQuery($query);

	//recorremos el arreglo POST para almacenar los nuevos permisos
	
} else {
	//acceso no permitido a esta pagina
}

header("Location: ../permisos.php");
?>