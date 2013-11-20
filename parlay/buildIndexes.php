<?php 
$enviromentProd = false;
if(substr($tableName[0], 0, strlen($_SERVER["HTTP_HOST"])) === "www.ingenieriadesistemas.com.ve"){
	$enviromentProd = true;
}

$message = "<table border='1' style='margin-left: auto; margin-right: auto'>";
$message .= "<tr>";
$message .= "<td colspan='2'><b>Ajuste de Indices (".$_SERVER["HTTP_HOST"].")</b></td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td><b>Tabla</b></td>";
$message .= "<td><b>Resultado</b></td>";
$message .= "</tr>";

include_once ("./procesos/conexion.php");
	
$query = "SHOW TABLES";
$analyzeQuery = "ANALYZE TABLE ";
$time0 = time();
$globalTime = time();
	
$result = DBUtil::executeSelect($query);
foreach ($result as $tableName){
	$message .= "<tr>";
	$message .= "<td>".$tableName[0]."</td>";
	$message .= "<td>";
	
	if(substr($tableName[0], 0, 6) === "vista_"){
		$message .= "Es una vista, no se procesa.";
	} else {
		$result1 = DBUtil::executeSelect($analyzeQuery.$tableName[0]);
		foreach ($result1 as $salida){
			$message .= $salida[2]."<br />".$salida[3]." (".(time() - $time0)." s)";
		}
		$time0 = time();
	}
	
	$message .= "</td>";
	$message .= "</tr>";
}

$message .= "<tr>";
$message .= "<td colspan='2'><b>Duraci&oacute;n Total: ".(time() - $globalTime)." s</b></td>";
$message .= "</tr>";
$message .= "</table>";

$mailTo = "felipe.rojasg@gmail.com";
$headers = "";
if($enviromentProd){
	//produccion
	$headers = "From: ".strip_tags("ingenier@ingenieriadesistemas.com.ve") ."\r\n";
	$mailTo .= ";corpovence@gmail.com";
} else {
	//calidad
	$headers = "From: ".strip_tags("granparl@granparlay.com.ve") ."\r\n";
	
}

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$subject = "=?ISO-8859-1?B?".base64_encode("Ejecución de comandos de actualización de indices")."=?=";

mail($mailTo, $subject, $message, $headers);

//echo $message;
?>