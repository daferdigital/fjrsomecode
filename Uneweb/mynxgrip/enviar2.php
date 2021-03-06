<?php

include_once 'class.phpmailer.php';

/**
 * 
 * @param unknown_type $mailFrom
 * @param unknown_type $mailFromName
 * @param unknown_type $mailTo
 * @param unknown_type $subject
 * @param unknown_type $message
 * @return boolean
 */
function sendEmail($mailFrom, $mailFromName, $mailTo, $subject, $message){
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
	
	$wasSent = $mail->Send();
	//$wasSent = true;
	return $wasSent;
}

/**
 * 
 * @param unknown_type $numCuestionario
 */
function obtenerDatosDelCuestionario($numCuestionario){
	$arrayEnunciados1 = array();
	$arrayEnunciados1[1] = "El MynxGrip � es un dispositivo de cierre que ofrece una soluci�n activa, extravascular y c�moda para el paciente";
	$arrayEnunciados1[2] = "MynxGrip � es el �nico dispositivo de Cierre Vascular que proporciona";
	$arrayEnunciados1[3] = "La Tecnolog�a Grip. a�ade al Mynx la capacidad activa de agarrase y sellar la arteria mientras se expande";
	$arrayEnunciados1[4] = "�Cu�les son los dos segmentos que conforman el sello del MynxGrip?";
	$arrayEnunciados1[5] = "EL sello del Mynx Grip � es soluble en agua, bio-inerte, no trombog�nico y antibacterial";
	$arrayEnunciados1[6] = "El sello del MynxGrip � se disuelve en menos de 30 d�as sin dejar nada dentro de la arteria y permite repunsar inmediatamente dejando una arteria sana";
	$arrayEnunciados1[7] = "MynxGrip reaccionando al entrar en contacto con el tejido, la temperatura y PH del cuerpo, agarr�ndose a la Arteria";
	$arrayEnunciados1[8] = "Cu�l es el largo m�ximo del introductor para el uso del Mynx Grip";
	$arrayEnunciados1[9] = "�Cuando Usa un Introductor 5Fr que tipo de Mynx Grip debe usar?";
	$arrayEnunciados1[10] = "�Cuando Usa un Introductor 6 o7F que tipo de Mynx Grip debe usar?";
	$arrayEnunciados1[11] = "�Cu�l es el di�metro m�nimo de la arteria femoral para ser colocado el MynxGrip?";
	$arrayEnunciados1[12] = "El Iindicador de Inflado permite saber si el bal�n se encuentra";
	
	$arrayRespuestasCorrectas1 = array();
	$arrayRespuestasCorrectas1[1] = 1;
	$arrayRespuestasCorrectas1[2] = 3;
	$arrayRespuestasCorrectas1[3] = 1;
	$arrayRespuestasCorrectas1[4] = 3;
	$arrayRespuestasCorrectas1[5] = 1;
	$arrayRespuestasCorrectas1[6] = 1;
	$arrayRespuestasCorrectas1[7] = 1;
	$arrayRespuestasCorrectas1[8] = 1;
	$arrayRespuestasCorrectas1[9] = 1;
	$arrayRespuestasCorrectas1[10] = 2;
	$arrayRespuestasCorrectas1[11] = 1;
	$arrayRespuestasCorrectas1[12] = 3;
	
	$arrayEnunciados2 = array();
	$arrayEnunciados2[1] = "�Cuando se prepara el Dispositivo Mynx se debe retirar del empaque por el?";
	$arrayEnunciados2[2] = "�Cuando preparamos el bal�n del Mynx que debemos observar para estar   seguro de su funcionamiento?";
	$arrayEnunciados2[3] = "Al retirar el Dispositivo Mynx  del empaque �C�mo estamos seguro que esta funcionando correctamente?";
	$arrayEnunciados2[4] = "Utilizando el introductor existente �hasta que marca debe ingresar el Mynx?";
	$arrayEnunciados2[5] = "�C�mo sabemos que el bal�n se infl� correctamente?";
	$arrayEnunciados2[6] = "Al comenzar a retirar el cat�ter �Por cual mango del Mynx se debe tomar?";
	$arrayEnunciados2[7] = "�Cuantas y cuales son las resistencias que debe sentir al retirar el cat�ter?";
	$arrayEnunciados2[8] = "Al sentir la 2da resistencia se debe verificar la hemostasis Temporal �Qu� se debe hacer?";
	$arrayEnunciados2[9] = "�Cuando avanzamos el sello Mynx para su colocaci�n debemos dejar la llave del introductor abierta, tomar el Tubo Conector (Mango Verde) y separarlo del Mango Negro, desliz�ndolo hasta sentir una resistencia, manteniendo el �ngulo de la inclinaci�n y una tensi�n adecuada";
	$arrayEnunciados2[10] = "�Cuando Liberamos el sellador Mynx debemos mantenerlo  por el Mango Negro  y estar alineados  y con la misma inclinaci�n, manteniendo una tensi�n adecuada?";
	$arrayEnunciados2[11] = "Al momento de posicionar el sello en la pared del vaso, manteniendo una tensi�n adecuada  para mantener el bal�n adherido, sujete inmediatamente el Tubo de Avance en la piel, h�galo avanzar suavemente hasta que la marca verde este visible y mant�ngalo en esa posici�n durante un m�ximo de 30 segundos";
	$arrayEnunciados2[12] = "La T�cnica  de Empujar  y Retener nos garantiza que a los 30 seg la punta del Grip";
	$arrayEnunciados2[13] = "La T�cnica recomienda los siguientes tiempos: 30 seg. (Empujar  y Retener), 90 seg. (Expansi�n) y 60 seg. (Post-Hold)";
	$arrayEnunciados2[14] = "La T�cnica de Expansi�n nos garantiza que a los 90 seg.";
	$arrayEnunciados2[15] = "Despu�s de desinflar el bal�n, �qu� es lo que tenemos que confirmar?";
	
	$arrayRespuestasCorrectas2 = array();
	$arrayRespuestasCorrectas2[1] = 3;
	$arrayRespuestasCorrectas2[2] = 2;
	$arrayRespuestasCorrectas2[3] = 1;
	$arrayRespuestasCorrectas2[4] = 2;
	$arrayRespuestasCorrectas2[5] = 2;
	$arrayRespuestasCorrectas2[6] = 2;
	$arrayRespuestasCorrectas2[7] = 2;
	$arrayRespuestasCorrectas2[8] = 1;
	$arrayRespuestasCorrectas2[9] = 1;
	$arrayRespuestasCorrectas2[10] = 1;
	$arrayRespuestasCorrectas2[11] = 1;
	$arrayRespuestasCorrectas2[12] = 3;
	$arrayRespuestasCorrectas2[13] = 1;
	$arrayRespuestasCorrectas2[14] = 2;
	$arrayRespuestasCorrectas2[15] = 3;
	
	if($numCuestionario == 1) {
		return array($arrayEnunciados1, $arrayRespuestasCorrectas1);
	} else if($numCuestionario == 2) {
		return array($arrayEnunciados2, $arrayRespuestasCorrectas2);
	}
}

$numCuestionario = $_POST["numeroCuestionario"];
$datos = obtenerDatosDelCuestionario($numCuestionario);

$arrayEnunciados = $datos[0];
$arrayRespuestasCorrectas = $datos[1];


$respuestasIncorrectas = 0;
$detalleEnunciados = "";
$detalleRespuestasIncorrectas = "";

//recorremos las respuestas de la pagina para observar si son correctas o no
foreach ($arrayRespuestasCorrectas as $pregunta => $respuesta){
	$incorrecta = false;
	if(isset($_POST["respuesta_".$pregunta])){
		if($_POST["respuesta_".$pregunta] != $respuesta){
			//si se marco esta respuesta, pero fue incorrecta la seleccion
			$incorrecta = true;
		}
	} else{
		//no se marco esta respuesta, la sumamos como incorrecta
		$incorrecta = true;
	}
	
	if($incorrecta == true){
		$respuestasIncorrectas++;
		//agregamos el enunciado incorrecto al mensaje de correo
		$detalleEnunciados.="<li>".$arrayEnunciados[$pregunta]."</li>\n";
		//anotamos las preguntas incorrectas
		if($detalleRespuestasIncorrectas != ""){
			$detalleRespuestasIncorrectas.=",";
		}
		$detalleRespuestasIncorrectas.=$pregunta;
	}
}

//echo "Respuestas Incorrectas: ".$respuestasIncorrectas;
$mailFromName = "Equipo de Certificaci�n MynxGrip";
$mailTo = "p.delduca@bormedica.net";
$subject = "Respuestas al cuestionario ".$numCuestionario;

$message = "<b>".$_POST["nombre"]."</b> ha respondido el cuestionario n&uacute;mero ".$numCuestionario." obteniendo como resultado:<br /><br />";
$message.= ($respuestasIncorrectas == 0) ? "<h3>Todas las respuestas correctas</h3>" : "<h3>".$respuestasIncorrectas." respuesta(s) incorrecta(s)</h3>";
if($respuestasIncorrectas > 0){
	$message.="<br /><br />";
	$message.="Este es el listado de preguntas contestadas de manera incorrecta:";
	$message.="<ul>".$detalleEnunciados."</ul>";
} 

$wasSent = sendEmail($_POST["correo"], "", $mailTo, $subject, $message);

//$wasSent = true;
$htmlAnswer = "";
if($wasSent){
	if($respuestasIncorrectas == 0){
		$htmlAnswer = "Respondiste correctamente el cuestionario!!!|0|http://www.bordemedica.com.ve/tutorial";
		
		//se le enviara un correo al estudiante para darle algunas instrucciones ya que respondio correctamente
		if($numCuestionario == 1){
			//$htmlAnswer .= "cuestionario1.html";
			//se respondio correctamente el primer cuestionario
			$message = "Felicitaciones ha presentado el cuestionario 1 exitosamente<br />\n";
			$message.= "Le invitamos a continuar con el cuestionario 2 despu�s de estudiar el tutorial 2.<br />\n";
			$message.= "<br/>Equipo de Certificaci&oacute;n MynxGrip";
			
			$mailFromName = "Equipo de Certificaci�n MynxGrip";
			$mailFrom = "p.delduca@bormedica.net";
			$subject = "Felicitaciones por responder correctamente el cuestionario n�mero ".$numCuestionario;
			
			sendEmail($mailFrom, $mailFromName, $_POST["correo"], $subject, $message);
		} else {
			//$htmlAnswer .= "cuestionario2.html";
			//se respondio correctamente el primer cuestionario
			$message = "Felicitaciones ha concluido su entrenamiento te&oacute;rico<br />\n";
			$message.= "Le contactaremos para programar los casos en vivo, recuerde tramitar la autorizaci&oacute;n con el Jefe del Centro.<br />\n";
			$message.= "<br/>Equipo de Certificaci&oacute;n MynxGrip";
				
			$mailFromName = "Equipo de Certificaci�n MynxGrip";
			$mailFrom = "p.delduca@bormedica.net";
			$subject = "Felicitaciones por responder correctamente el cuestionario n�mero ".$numCuestionario;
				
			sendEmail($mailFrom, $mailFromName, $_POST["correo"], $subject, $message);
		}
	} else {
		$htmlAnswer = "Disculpa, tuviste ".$respuestasIncorrectas." respuesta(s) incorrectas(s). Por favor intenta de nuevo.\nNOTA: Las preguntas respondidas de manera incorrecta seran limpiadas.";
		$htmlAnswer.= "|".$respuestasIncorrectas;
		$htmlAnswer.= "|".$detalleRespuestasIncorrectas;
	}
} else{
	$htmlAnswer = "Disculpe, hubo un problema procesando sus respuestas. Por favor intente de nuevo";
}

echo $htmlAnswer;
?>