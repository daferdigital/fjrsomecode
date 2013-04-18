<?php
$arrayRespuestasCorrectas = array();
$arrayRespuestasCorrectas[1] = 1;
$arrayRespuestasCorrectas[2] = 3;
$arrayRespuestasCorrectas[3] = 1;
$arrayRespuestasCorrectas[4] = 3;
$arrayRespuestasCorrectas[5] = 1;
$arrayRespuestasCorrectas[6] = 1;
$arrayRespuestasCorrectas[7] = 1;
$arrayRespuestasCorrectas[8] = 3;
$arrayRespuestasCorrectas[9] = 2;
$arrayRespuestasCorrectas[10] = 1;
$arrayRespuestasCorrectas[11] = 2;
$arrayRespuestasCorrectas[12] = 2;
$arrayRespuestasCorrectas[13] = 2;
$arrayRespuestasCorrectas[14] = 2;
$arrayRespuestasCorrectas[15] = 1;
$arrayRespuestasCorrectas[16] = 1;
$arrayRespuestasCorrectas[17] = 1;
$arrayRespuestasCorrectas[18] = 1;
$arrayRespuestasCorrectas[19] = 3;
$arrayRespuestasCorrectas[20] = 1;
$arrayRespuestasCorrectas[21] = 2;
$arrayRespuestasCorrectas[22] = 3;

$respuestasIncorrectas = 0;

//recorremos las respuestas de la pagina para observar si son correctas o no
foreach ($arrayRespuestasCorrectas as $pregunta => $respuesta){
	if(isset($_POST["respuesta_".$pregunta])){
		if($_POST["respuesta_".$pregunta] == $respuesta){
			
		}else{
			//si se marco esta respuesta, pero fue incorrecta la seleccion
			$respuestasIncorrectas++;
		}
	} else{
		//no se marco esta respuesta, la sumamos como incorrecta
		$respuestasIncorrectas++;
	}
}

echo "Respuestas Incorrectas: ".$respuestasIncorrectas;

$mailTo = "xxx@xxxxxx.xxx";
$subject = "Respuestas al cuestionario";

$headers = "From: ".strip_tags($_POST["correo"]) ."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = "<b>".$_POST["nombre"]."</b> ha respondido el cuestionario obteniendo como resultado:<br /><br />";
$message.= ($respuestasIncorrectas == 0) ? "<h3>Todas las respuestas correctas</h3>" : "<h3>".$respuestasIncorrectas." respuesta(s) incorrecta(s)</h3>";

$subject = "=?ISO-8859-1?B?".base64_encode($subject)."=?=";
$wasSent = mail($mailTo, $subject, $message, $headers);
?>
<script type="text/javascript">
	if(<?php echo $wasSent;?> == true){
		if(<?php echo $respuestasIncorrectas;?> == 0){
			alert("Respondiste correctamente el cuestionario!!!");
		} else {
			alert("Disculpa, tuviste <?php echo $respuestasIncorrectas;?> respuesta(s) incorrectas(s). Por favor intenta de nuevo.");
		}
	} else {
		alert("Disculpe, hubo un problema procesando sus respuestas. Por favor intente de nuevo");
	}
	window.location = "index.html";
</script>