<?php 
session_start();

$errorCode = 0;
//print_r($_POST);
print_r($_FILES);

//validamos los datos recibidos
if(isset($_POST["comentarios"]) && strlen(trim($_POST["comentarios"])) == 0){
	//no fue escrito ningun comentario
	$errorCode = 1;
} else {
	if(!isset($_POST["todosClientes"]) && !isset($_POST["clientes"])){
		//no fue indicado ningun destinatario
		$errorCode = 2;
	} else {
		include("../conexion.php");
		//valor de la cuenta del remitente
		$email = "soporte@uneweb.com";
		
		//podemos proceder con el envio del correo
		$body = "Ud. ha recibido un mensaje del administrador, favor ingresar al sistema para leerlo."
		."\r\n\r\n"
		."";
		$body= html_entity_decode($body);
		
		//insertamos el registro del mensaje
		$query = "INSERT INTO mensajes (body, idAdmin, fecha_envio)"
				."VALUES('".$_POST["comentarios"]."',".$_SESSION["idAdmin"].",NOW())";
		mysql_query($query);
		
		if(!mysql_error()){
			//obtenemos el id asociado al mensaje
			$idMensaje = mysql_fetch_array(mysql_query("SELECT LAST_INSERT_ID()"));
			$idMensaje = $idMensaje[0];
			
			//revisamos los adjuntos
			$index = 0;
			while($index < count($_FILES["adjunto"]["name"])){
				if($_FILES["adjunto"]["error"][$index] == 0){
					//debemos mover este adjunto
					if(! file_exists("./adjuntos/".$idMensaje)){
						mkdir("./adjuntos/".$idMensaje);
					}
					
					move_uploaded_file($_FILES["adjunto"]["tmp_name"][$index],
						"./adjuntos/".$idMensaje."/".$_FILES["adjunto"]["name"][$index]);
				}
				
				$index ++;
			}
			
			$bccHeader = "Bcc:";
			//construimos el bcc
			$idClientes = array();
			
			if(isset($_POST["clientes"])){
				$arrayClientes = $_POST["clientes"];
				foreach ($arrayClientes as $cliente){
					$tmpArray = explode(";", $cliente);
					$bccHeader.=$tmpArray[1].", ";
					$idClientes[] = $tmpArray[0];
				}
			} else {
				$query = "SELECT id, login from clientes";
				$result = mysql_query($query);
				
				while($row = mysql_fetch_array($result)){
					$idClientes[] = $row["id"];
					$bccHeader.=$row["login"].", ";
				}
			}
			
			foreach ($idClientes as $idC) {
				mysql_query("INSERT INTO mensaje_clientes (id_mensaje, id_cliente) VALUES(".$idMensaje.", ".$idC.")");
			}
			
			if(! @mail(null,"Mensaje del sistema",$body,"From:".$email." \r\nContent-type: text/html\r\n".$bccHeader)){
				$errorCode = 3;
			} else {
				//Envio exitiso
			}
		} else {
			$errorCode = 4;
		}
	}
	
	mysql_close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	if($errorCode == 0){
    	//envio perfecto
?>
		<script type="text/javascript">
			alert("El mensaje fue enviado correctamente.");
			window.location = "createMessage.php";
		</script>
<?php
    } else if($errorCode == 1 || $errorCode == 2){
		//no se coloco ningun comentario
?>
		<script type="text/javascript">
			alert("Disculpe, debe indicar el mensaje a enviar y los destinatarios de manera obligatoria." + <?php echo $errorCode;?>);
			history.back(1);
		</script>
<?php
	} else if($errorCode == 3 || $errorCode == 4){
		//error en envio de correo como tal
?>
		<script type="text/javascript">
			alert("Disculpe, el envio del correo fallo. Por favor intente de nuevo.");
			history.back(1);
		</script>
<?php
	}
?>
</head>
</html>
