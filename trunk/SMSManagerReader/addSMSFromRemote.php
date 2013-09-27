<?php
include_once ("classes/BitacoraDAO.php");
include_once ("classes/DBUtil.php");

$KEY = "SMSReaderAPP";

//validamos si vienen los valores
if(isset($_POST["mensaje"]) && isset($_POST["remitente"])
		&& isset($_POST["fecha"]) && isset($_POST["hora"])){
	if($KEY == $_POST["KEY"]){
		//podemos guardar el SMS
		$query = "INSERT INTO mensajes(texto_sms, fecha_sms, hora_sms, number_from)";
		$query .= " VALUES('".$_POST["mensaje"]."','".$_POST["fecha"]."','".$_POST["hora"]."','".$_POST["remitente"]."')";
		
		$lastId = DBUtil::executeQueryAndReturnLastId($query);
		if($lastId > 0){
			echo "Mensaje agregado";
		} else {
			echo "El mensaje no pudo ser agregado";
		}
	} else {
		echo "Parametros completos, pero mal KEY";
	}
} else {
	echo "Parametros POST no llegaron".print_r($_POST);
}
?>