<?php 
session_start();
	
include_once './classes/class.phpmailer.php';

/**
 * 
 * @param unknown_type $mailFrom
 * @param unknown_type $mailFromName
 * @param unknown_type $mailTo
 * @param unknown_type $subject
 * @param unknown_type $message
 * @param array $attachments
 * @return boolean
 */
function sendEmail($mailFrom, $mailFromName, $mailTo, $subject, $message, $attachments){
	$subject = "=?ISO-8859-1?B?".base64_encode($subject)."=?=";

	$mail = new PHPMailer();

	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.correo.com';     // turn on SMTP authentication
	$mail->Username = "usuario@correo.com";  // SMTP username
	$mail->Password = "clave"; // SMTP password

	$mail->From = $mailFrom;
	$mail->FromName = $mailFromName;
	$mail->AddAddress($mailTo);
	$mail->AddReplyTo($mailFrom, $mailFromName);

	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $message;
	//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	foreach ($attachments AS $fileAttach){
		$mail->AddAttachment($fileAttach);	
	}
	
	$wasSent = $mail->Send();
	//$wasSent = true;
	return $wasSent;
}
	
$message = "Se ha solicitado el siguiente tipo de trabajo:";
$message .= "<br /> Tipo de trabajo: ".$_SESSION["tipo"];
$message .= "<br /> Contenido: ".$_SESSION["contenido"];
$message .= "<br /> Cantidad: ".$_SESSION["cantidad"];

$attachments = array();
if(isset($_SESSION["artFile"])){
	$attachments[] = "./artFiles/".$_SESSION["artFile"];
}

//enviamos el correo con la solicitud
sendEmail($_POST["correoContacto"], 
		$_POST["personaContacto"], 
		"correo_de_pedidos", 
		"Pedido Realizado", 
		$message,
		$attachments);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  	<title></title>
  	<link rel="stylesheet" href="css/smoothness/jquery-ui.css" />
  	<link rel="stylesheet" href="css/papeleria.css" />
  	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
  	<script type="text/javascript" src="js/jquery-ui.js"></script>
  	<script type="text/javascript" src="js/papeleria.js"></script>
</head>
<body>
	<script type="text/javascript">
		alert("Su solicitud fue registrada");
		window.location = "index.php";
	</script>
</body>
</html>
<?php 
	session_destroy();
?>
