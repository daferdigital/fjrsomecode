<?php
	session_start();
	include "conexion.php";
	
	$adminMail = "contacto@gentedeoficio.com";
	$subject = "Han solicitado tus servicios";
	$header = "From: " . $adminMail . "\r\n"; //optional headerfields
	$message = "";
	
	
	if (isset($_REQUEST['submitContact'])) {
		//validamos el captcha
		if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
			// Insert you code for processing the form here, e.g emailing the submission, entering it into a database.
			unset($_SESSION['security_code']);
			
			if(isset($_SESSION['id'])){
				//tenemos el id de la persona que presta el servicio
				//ubicamos su correo
				$query = "SELECT nombre, correo, telefono, website from directorio WHERE id=".$_SESSION['id'];
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				if($row){
					$mail = $row['correo'];
					$ROOT_SITE_URL = 'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['REQUEST_URI'], 0, $pos + 1);
					
					$messageToEspecialist = "La persona: ".$_REQUEST['nombre']." ha solicitado tus servicios.".
							"\n\n".
							"Este es su correo -> ".$_SESSION['loggedUser']['correo'].
							"\n\n".
							"Y este es su telefono -> ".$_SESSION['loggedUser']['telefono'].
							"\n\n".
						//	"Desde la direccion : ".$_REQUEST['direccion'].
						//	"\n\n".
						//	"Para la fecha: ".$_REQUEST['dateValue'].
						//	"\n\n".
							"La solicitud es la siguiente: ".$_REQUEST['descSolicitud'].
							"\n\n".
						//	"El codigo de esta solicitud es: ".$_REQUEST['codSolicitud'].
						//	"\n\n".
							"NOTA: El usuario tiene un mes para calificarte por este servicio.";

					$messageToVisitante = "Haz solicitado los servicios de: ".$row['nombre'].
					"\n\n".
					"Para la fecha: ".$_REQUEST['dateValue'].
					"\n\n".
					"La solicitud es la siguiente: ".$_REQUEST['descSolicitud'].
					"\n\n".
					"El codigo de esta solicitud es: ".$_REQUEST['codSolicitud'].
					"\n\n".
					"Estos son los numeros de telefonos del especialista: ".$row['telefono'].
					"\n\n".
					($row['website'] != null ? "Y esta es su pagina web: ".$row['website'] : "").
					"\n\n".
					"Para calificar este servicio por favor ingrese a esta direccion --> ".$ROOT_SITE_URL."/contacto.php?goto=qlfy".
					"\n\n".
					"NOTA: Tiene un mes para calificar este servicio.";
					
					if(mail($row['correo'], $subject, $messageToEspecialist, $header)
							&& mail($_SESSION['loggedUser']['correo'], $subject, $messageToVisitante, $header)){
						//registramos la solicitud de servicio
						$query = "INSERT INTO servicio_contactado (id, fecha_servicio, descripcion, id_solicitante, id_especialista)
						VALUES (".$_REQUEST['codSolicitud'].", '".
						$_REQUEST['dateValue']."', '".
						$_REQUEST['descSolicitud']."', ".
						$_SESSION['loggedUser']['id'].", ".
						$_SESSION['id'].")";
						mysql_query($query);
						
						unset($_SESSION['id']);
												
						echo '<script language="javascript">alert("El correo fue enviado de manera exitosa."); window.location="asociese2.php"</script>';
					}else{
						echo '<script language="javascript">alert("Disculpe no se pudo enviar el correo intente de nuevo."); window.location="contactForm.php"</script>';
					}
				} else {
					echo '<script language="javascript">alert("Disculpe no se encontro informacion sobre el servicio solicitado."); window.location="asociese2.php"</script>';
				}
			} else {
				echo '<script language="javascript">alert("Disculpe no ha seleccionado el servicio que desea solicitar."); window.location="asociese2.php"</script>';
			}
		} else {
			echo '<script language="javascript">alert("El codigo de validacion no es correcto, intente de nuevo."); window.location="contactForm.php"</script>';
		}
	}
?>