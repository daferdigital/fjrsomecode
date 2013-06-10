<?php
/**
 * @author David Antunes
 * @project WinWeb - 2009
 */

session_start(); 
extract($_REQUEST);
include("conexion.php");

include_once 'class.phpmailer.php';

/**
 *
 * @param unknown_type $mailFrom
 * @param unknown_type $mailFromName
 * @param unknown_type $mailTo
 * @param unknown_type $subject
 * @param unknown_type $message
 * @param adjuntos array
 * @return boolean
 */
function sendEmail($mailFrom, $mailFromName, $mailTo, $subject, $message, $adjuntos){
	/*
	 $headers = "From: ";
	if($mailFromName == ""){
	$headers .= strip_tags($mailFrom) ."\r\n";
	} else {
	$headers .= $mailFromName." <".strip_tags($mailFrom) .">\r\n";
	}
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$wasSent = mail($mailTo, $subject, $message, $headers);
	*/

	$subject = "=?ISO-8859-1?B?".base64_encode($subject)."=?=";

	$mail = new PHPMailer();

	$mail->IsSMTP();                                      // set mailer to use SMTP
	$mail->Host = "localhost";  // specify main and backup server
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "********";  // SMTP username
	$mail->Password = "********"; // SMTP password

	$mail->From = $mailFrom;
	$mail->FromName = $mailFromName;
	$mail->AddAddress($mailTo);
	$mail->AddReplyTo($mailFrom, $mailFromName);

	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $message;
	//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

	
	foreach ($adjuntos as $vAdjunto){
		$mail->AddAttachment($vAdjunto["tmp_name"]);
	}
	
	$wasSent = $mail->Send();
	//$wasSent = true;
	return $wasSent;
}

//cambiar aqui el email
if (sendEmail("afiliacionmynx@gmail.com", "Afiliacion Bormedicave", $_POST[email], "AFILIACION",
		"Los datos introducidos en el formulario son:\n\n", $_FILES)){
		echo "Su afiliación ha sido enviada con éxito";
}

$mailFromName = "Equipo de Certificación MynxGrip";
$mailFrom = "afiliacionmynx@gmail.com";
$mailTo = $_POST["email"];
$subject = "Ingrese al Tutorial y Cuestionario Tecnología MynxGrip";

$message = file_get_contents("./plantillaAfiliacion.html");

if(sendEmail($mailFrom, $mailFromName, $mailTo, $subject, $message, null)){
	echo "";
}

if($_POST[nombre]){
	$sql="insert into registros values('','$_POST[nombre]','$_POST[email]','$_POST[direccion]','$_POST[telefonos]')";
	mysql_query($sql,$conexion);
	$error = mysql_error();
	
	mysql_close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php 
if(! $error()){ 
?>
	<script type="text/javascript">
		alert("Se envio con exito su informacion");
		window.location = "index.php";
	</script>
<?php
	}else{ 
?>
	<script type="text/javascript">
		alert("estamos en mantenimiento, intente mas tarde");
		window.location = "index.php";
	</script>
<?php 
	}
?>
</body>
</html>
