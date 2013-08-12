<?php
header('Content-Type: text/html; charset=ISO-8859-1');
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';

$ids = $_POST["ids"];
$table = $_POST["tableName"];

$query = "UPDATE ".$table." SET activo = '0' WHERE id IN (".$ids.")";

$exito = DBUtil::executeQuery($query);

if($exito){
	echo "Los registros seleccionados fueron eliminados satisfactoriamente.";
} else {
	echo "Ocurrio un error procesando la petición de borrado. Por favor intente de nuevo.";
}
?>
