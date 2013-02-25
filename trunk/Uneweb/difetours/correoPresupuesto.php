<?php
$mailFrom = "";
$mailTo = "";
$subject="";

$headers = "From: ".strip_tags($mailFrom) ."\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = $_POST["mailContent"]."<br />";
$message .= "Nombre y Apellido: ".$_POST["nombre"]."<br />";
$message .= "Sexo: ".$_POST["sexo"]."<br />";
$message .= "Nacionalidad: ".$_POST["nacionalidad"]."<br />";
$message .= "Idioma Materno: ".$_POST["idiomaMaterno"]."<br />";
$message .= "Direcci&oacute;n: ".$_POST["direccion"]."<br />";
$message .= "Ciudad: ".$_POST["ciudad"]."<br />";
$message .= "Pa&iacute;s: ".$_POST["pais"]."<br />";
$message .= "C&oacute;digo Postal: ".$_POST["codigoPostal"]."<br />";
$message .= "Tel&eacute;fonos: ".$_POST["telefonos"]."<br />";
$message .= "Email: ".$_POST["email"]."<br />";
$message .= "Contacto de Emergencia: ".$_POST["contactoEmergencia"]."<br />";
$message .= "Tlf del contacto de Emergencia: ".$_POST["tlfEmergencia"]."<br />";
$message .= "¿Tiene alguna condici&oacute;n m&eacute;dica que debamos tener en cuenta?: ".$_POST["condicionMedica"]."<br />";
$message .= "En caso afirmativo, por favor especifique: ".$_POST["detalleCondicionMedica"]."<br />";
$message .= "¿Toma medicaci&oacute;n diaria?: ".$_POST["medicacionDiaria"]."<br />";
$message .= "En caso afirmativo, por favor especifique: ".$_POST["detalleMedicacionDiaria"]."<br />";
$message .= "¿Tiene seguro m&eacute;dico?: ".$_POST["seguroMedico"]."<br />";
$message .= "En caso afirmativo, especificar la empresa: ".$_POST["detalleSeguroMedico"]."<br />";
$message .= "¿Fuma?: ".$_POST["fuma"]."<br />";

if(isset($_POST["comida"])){
	$message .= "¿Come?: ";
	$isFirst = true;
	
	foreach ($_POST["comida"] as $comida){
		if(! $isFirst){
			$message .= ", ".$comida;
		} else{
			$isFirst = false;
			$message .= $comida;
		}
	}
	
	$message .= "<br />";
}

$message .= "Me siento c&oacute;modo con los ni&ntilde;os en el hogar entre las edades de: ".$_POST["otrosNinos"]."<br />";
$message .= "¿Se siente c&oacute;modo con perros en el hogar?: ".$_POST["perros"]."<br />";
$message .= "¿Se siente c&oacute;modo con gatos en el hogar?: ".$_POST["gatos"]."<br />";
$message .= "Por favor especificar cualquier otro tipo de animal dom&eacute;stico con el que se sienta c&oacute;modo: ".$_POST["otrosAnimales"]."<br />";
$message .= "¿Se siente c&oacute;modo con cualquier otro estudiante en el hogar?: ".$_POST["otroEstudiante"]."<br />";
$message .= "¿Qu&eacute; idiomas hablas?: ".$_POST["otrosIdiomas"]."<br />";
$message .= "Intereses y Comentarios: ".$_POST["comentarios"]."<br />";
$message .= "¿Requiere Seguro de viaje?: ".$_POST["seguroDeViaje"]."<br />";
$message .= "¿Requiere boleto a&eacute;reo?: ".$_POST["boletoAereo"]."<br />";
$message .= "¿Requiere Carta para tr&aacute;mites Cadivi?: ".$_POST["cadivi"]."<br />";

echo $message;

mail($mailTo, $subject, $message, $headers);
?>
<script>
	alert("Sus datos fueron enviados");
	window.location = "calculadora.php";
</script>