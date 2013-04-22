<?php
if (form_mail("p.delduca@bormedica.net", "AFILIACION CERTIFICACION Tecnología MynxGrip Grip ",
		"Los datos introducidos en el formulario son:\n\n", $_POST[email]))
	echo "Su cita ha sido enviada con éxito";

$mailFrom = "p.delduca@bormedica.net";
$mailTo = $_POST["email"];
$subject = "Respuestas al cuestionario";

$headers = "From: ".strip_tags($mailFrom) ."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = file_get_contents("./plantillaAfiliacion.html");
$subject = "=?ISO-8859-1?B?".base64_encode($subject)."=?=";

if(@mail($mailTo, $subject, $message, $headers)){
	echo "Se envio el correo con la respuesta";
}
?>