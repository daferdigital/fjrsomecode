<?php 

$errorCode = 0;
print_r($_POST);

//validamos los datos recibidos
if(isset($_POST["comentarios"]) && strlen(trim($_POST["comentarios"]))){
	//no fue escrito ningun comentario
	$errorCode = 1;
} else {
	if(!isset($_POST["todosClientes"]) || !isset($_POST["clientes"])){
		//no fue indicado ningun destinatario
		$errorCode = 2;
	} else {
		//valor de la cuenta del remitente
		$email = "soporte@uneweb.com";
		
		//podemos proceder con el envio del correo
		$body = "Ud. ha recibido un mensaje del administrador, favor ingresar al sistema para leerlo."
		."\r\n\r\n"
		."";
		$body= html_entity_decode($body);
		
		$bccHeader = "";
		//construimos el bcc
		if(isset($_POST["clientes"])){
			
		}
		
		if(! @mail(null,"Mensaje del sistema",$body,"From:".$email." \r\nContent-type: text/html\r\n".$bccHeader)){
			$errorCode = 3;	
		} else {
			
		}
	}
}

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>
</html>
