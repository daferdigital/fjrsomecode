<?php

/**
 * 
 * @param unknown_type $numCuestionario
 */
function obtenerDatosDelCuestionario($numCuestionario){
	$arrayEnunciados1 = array();
	$arrayEnunciados1[1] = "El MynxGrip ™ es un dispositivo de cierre que ofrece una solución activa, extravascular y cómoda para el paciente";
	$arrayEnunciados1[2] = "MynxGrip ™ es el único dispositivo de Cierre Vascular que proporciona";
	$arrayEnunciados1[3] = "La Tecnología Grip. añade al Mynx la capacidad activa de agarrase y sellar la arteria mientras se expande";
	$arrayEnunciados1[4] = "¿Cuáles son los dos segmentos que conforman el sello del MynxGrip?";
	$arrayEnunciados1[5] = "EL sello del Mynx Grip ™ es soluble en agua, bio-inerte, no trombogénico y antibacterial";
	$arrayEnunciados1[6] = "El sello del MynxGrip ™ se disuelve en menos de 30 días sin dejar nada dentro de la arteria y permite repunsar inmediatamente dejando una arteria sana";
	$arrayEnunciados1[7] = "MynxGrip reaccionando al entrar en contacto con el tejido, la temperatura y PH del cuerpo, agarrándose a la Arteria";
	$arrayEnunciados1[8] = "El indicador de Inflado permite saber si el balón se encuentra";
	$arrayEnunciados1[9] = "Cuál es el largo máximo del introductor para el uso del Mynx Grip";
	
	$arrayEnunciados1[8] = "¿Cuando se prepara el Dispositivo Mynx se debe retirar del empaque por el?";
	$arrayEnunciados1[9] = "¿Cuando preparamos el balón del Mynx que debemos observar para estar   seguro de su funcionamiento?";
	$arrayEnunciados1[10] = "Al retirar el Dispositivo Mynx  del empaque ¿Cómo estamos seguro que esta funcionando correctamente?";
	$arrayEnunciados1[11] = "Utilizando el introductor existente ¿hasta que marca debe ingresar el Mynx?";
	$arrayEnunciados1[12] = "¿Cómo sabemos que el balón se infló correctamente?";
	$arrayEnunciados1[13] = "Al comenzar a retirar el catéter ¿Por cual mango del Mynx se debe tomar?";
	$arrayEnunciados1[14] = "¿Cuantas y cuales son las resistencias que debe sentir al retirar el catéter?";
	$arrayEnunciados1[15] = "Al sentir la 2da resistencia se debe verificar la hemostasis Temporal ¿Qué se debe hacer?";
	$arrayEnunciados1[16] = "¿Cuando avanzamos el sello Mynx para su colocación debemos dejar la llave del introductor abierta, tomar el Tubo Conector (Mango Verde) y separarlo del Mango Negro, deslizándolo hasta sentir una resistencia, manteniendo el ángulo de la inclinación y una tensión adecuada";
	$arrayEnunciados1[17] = "¿Cuando Liberamos el sellador Mynx debemos mantenerlo  por el Mango Negro  y estar alineados  y con la misma inclinación, manteniendo una tensión adecuada?";
	$arrayEnunciados1[18] = "Al momento de posicionar el sello en la pared del vaso, manteniendo una tensión adecuada  para mantener el balón adherido, sujete inmediatamente el Tubo de Avance en la piel, hágalo avanzar suavemente hasta que la marca verde este visible y manténgalo en esa posición durante un máximo de 30 segundos";
	$arrayEnunciados1[19] = "La Técnica  de Empujar  y Retener nos garantiza que a los 30 seg la punta del Grip";
	$arrayEnunciados1[20] = "La Técnica recomienda los siguientes tiempos: 30 seg. (Empujar  y Retener), 90 seg. (Expansión) y 60 seg. (Post-Hold)";
	$arrayEnunciados1[21] = "La Técnica de Expansión nos garantiza que a los 90 seg.";
	$arrayEnunciados1[22] = "Después de desinflar el balón, ¿qué es lo que tenemos que confirmar?";
	
	$arrayRespuestasCorrectas1 = array();
	$arrayRespuestasCorrectas1[1] = 1;
	$arrayRespuestasCorrectas1[2] = 3;
	$arrayRespuestasCorrectas1[3] = 1;
	$arrayRespuestasCorrectas1[4] = 3;
	$arrayRespuestasCorrectas1[5] = 1;
	$arrayRespuestasCorrectas1[6] = 1;
	$arrayRespuestasCorrectas1[7] = 1;
	$arrayRespuestasCorrectas1[8] = 3;
	$arrayRespuestasCorrectas1[9] = 1;
	
	$arrayRespuestasCorrectas1[9] = 2;
	$arrayRespuestasCorrectas1[10] = 1;
	$arrayRespuestasCorrectas1[11] = 2;
	$arrayRespuestasCorrectas1[12] = 2;
	$arrayRespuestasCorrectas1[13] = 2;
	$arrayRespuestasCorrectas1[14] = 2;
	$arrayRespuestasCorrectas1[15] = 1;
	$arrayRespuestasCorrectas1[16] = 1;
	$arrayRespuestasCorrectas1[17] = 1;
	$arrayRespuestasCorrectas1[18] = 1;
	$arrayRespuestasCorrectas1[19] = 3;
	$arrayRespuestasCorrectas1[20] = 1;
	$arrayRespuestasCorrectas1[21] = 2;
	$arrayRespuestasCorrectas1[22] = 3;
}

$arrayEnunciados = array();
$arrayRespuestasCorrectas = array();


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
		$detalleEnunciados.="<li>".$arrayEnunciados[$pregunta]."</li>";
		//anotamos las preguntas incorrectas
		if($detalleRespuestasIncorrectas != ""){
			$detalleRespuestasIncorrectas.=",";
		}
		$detalleRespuestasIncorrectas.=$pregunta;
	}
}

//echo "Respuestas Incorrectas: ".$respuestasIncorrectas;

$mailTo = "xxxxxxxxxx@gmail.com";
$subject = "Ingrese al Tutorial y cuestionario";

$headers = "From: ".strip_tags($_POST["correo"]) ."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = "<b>".$_POST["nombre"]."</b> ha respondido el cuestionario obteniendo como resultado:<br /><br />";
$message.= ($respuestasIncorrectas == 0) ? "<h3>Todas las respuestas correctas</h3>" : "<h3>".$respuestasIncorrectas." respuesta(s) incorrecta(s)</h3>";
if($respuestasIncorrectas > 0){
	$message.="<br /><br />";
	$message.="Este es el listado de preguntas contestadas de manera incorrecta:";
	$message.="<ul>".$detalleEnunciados."</ul>";
}

$subject = "=?ISO-8859-1?B?".base64_encode($subject)."=?=";
$wasSent = mail($mailTo, $subject, $message, $headers);
//$wasSent = true;
$htmlAnswer = "";
if($wasSent){
	if($respuestasIncorrectas == 0){
		$htmlAnswer = "Respondiste correctamente el cuestionario!!!";
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