<?php
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/SendEmail.php';

/*
 * Se enviara un correo a los involucrados
 * cada 15 minutos durante los dias laborales
 * con la cuenta de cada status de envio dentro del sistema.
 * 
 */
$mustSendEmail = true;
$dayOfWeek = date("w");
$hourOfDay = date("G");

if(($dayOfWeek < 1 || $dayOfWeek > 5)
		|| ($hourOfDay < 9 || $hourOfDay > 16)){
	$mustSendEmail = false;
}

if($mustSendEmail){
	$mailTo = "ventas@quierounacompu.com,";
	$mailTo .= "administracion@quierounacompu.com,";
	$mailTo .= "caja@quierounacompu.com";
	
	//para debug	
	//$mailTo = "felipe.rojasg@gmail.com";
	
	$query = "SELECT es.descripcion, e.id_status_actual, COUNT(*) AS cuenta "
			."FROM envios_status es, envios e "
			."WHERE es.id = e.id_status_actual "
			."GROUP BY e.id_status_actual "
			."ORDER BY es.orden_correo";
	
	$message = "<table border='1' align='center'>";
	$message .= "<tr>";
	$message .= "<td><b>Status</b></td>";
	$message .= "<td><b>Cantidad</b></td>";
	$message .= "</tr>";
	
	$resultado = DBUtil::executeSelect($query);
	
	foreach ($resultado AS $registro){
		$message .= "<tr>";
		$message .= "<td>".$registro["descripcion"]."</td>";
		$message .= "<td>".$registro["cuenta"]."</td>";
		$message .= "</tr>";
	}
	
	$message .= "</table>";
	
	SendEmail::sendMail($mailTo,
		"Resumen de envios", 
		$message);
	
	//echo $message;
}
?>