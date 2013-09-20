<?php
	session_start();
	if($_SESSION["usuario"]==1315){
		$i=0; //Nada
	}else{
		header("location: formulario2.php");
	}
	
	//estamos logueados, ahora revisamos si venimos desde el formulario
	if(isset($_POST["enviar"])){
		//el formulario fue enviado, debemos registrarlo en la base de datos
		include("conexion.php");
		
		$query = "INSERT INTO pago_registrado (nombre_pagador,cia_pagadora,ci_rif,email,direccion,telefono,celular,cod_transaccion,"
			."cod_factura,comentarios,fecha_pago,id_cliente)"
			. " VALUES('".$_POST["nombre"]."', '".$_POST["compania"]."', '".$_POST["cedula_rif"]."', '".$_POST["email"]
			."', '".$_POST["direccion"]."', '".$_POST["telefono"]."', '".$_POST["celular"]."', '".$_POST["transaccion"]
			."', '".$_POST["factura"]."', '".$_POST["comentarios"]."', '".$_POST["fechaPago"]."', ".$_SESSION["codigo"].")";
		mysql_query($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<?php
		if(mysql_error()) {
			echo mysql_error();
?>
			<script type="text/javascript">
				alert("Disculpe, hubo un error al registrar su pago, favor intente de nuevo.");
				window.location = "reporte1.php";
			</script>
<?php			
		} else {
?>
			<script type="text/javascript">
				alert("Su pago fue registrado correctamente.");
				window.location = "reporte1.php";
			</script>
<?php			
		}
		
		mysql_close();
	} else {
		header("location: formulario2.php");
	}
	
	/*
	$check=1;
	$error="";
	if(isset($enviar)){
	
		$error.= "<p style='margin:0; color: red; font-size: 16px'><b>No se pudo Enviar el Reporte</b></p><br />";
	
		if(empty($nombre)){
			$error.= "<p style='margin:1; '>Debe indicar <b>Nombre y Apellido</b></p>";
			$check=0;
		}
	
		if(empty($cedula_rif)){
			$error.= "<p style='margin:1; '>Debe indicar <b>C&eacute;dula o RIF</b></p>";
			$check=0;
		}
	
		if(empty($email)){
			$error.= "<p style='margin:1; '>Debe indicar <b>Email</b></p>";
			$check=0;
		}
	
		if(empty($direccion)){
			$error.= "<p style='margin:1; '>Debe indicar <b>Direccion</b></p>";
			$check=0;
		}
	
		if(empty($telefono)){
			$error.= "<p style='margin:1; '>Debe indicar <b>Telefono</b></p>";
			$check=0;
		}
	
		if(empty($celular)){
			$error.= "<p style='margin:1; '>Debe indicar <b>Celular</b></p>";
			$check=0;
		}
	
		if(empty($transaccion)){
			$error.= "<p style='margin:1; '>Debe indicar <b>Nro. de Transacci&oacute;n</b></p>";
			$check=0;
		}
	
		if(empty($factura) && $factura>0){
			$error.= "<p style='margin:1; '>Debe indicar <b>Nro. de Factura Correcto</b></p>";
			$check=0;
		}
		//Envio de Correo del Reporte
		if($check==1){
	
			$comentarios= nl2br($comentarios);
	
			$body=  "Reporte de Pago de Factura Nro $factura <br /><br />";
			$body.= "Nombre y Apellido: $nombre <br />";
			$body.= "Compania: $compania <br />";
			$body.= "Cedula o RIF: $cedula_rif <br />";
			$body.= "Email: $email <br />";
			$body.= "Direccion: $direccion <br />";
			$body.= "Telefono: $telefono <br />";
			$body.= "Celular: $celular <br />";
			$body.= "Nro de Transaccion: $transaccion <br />";
			$body.= "Comentarios: $comentarios <br />";
	
			$body = ereg_replace("<br />","\r\n",$body);
			$body= html_entity_decode($body);
	
			if(@mail("soporte@uneweb.com","Reporte de Pago",$body,"From:".$email." \r\nContent-type: text/html\r\n")){
					
				echo "<script> alert('Su Reporte ha sido enviado!')</script>";
				print "Gracias por su compra, espere nuestra respuesta.";
			}else{
					
				echo "<script> alert('No se pudo enviar el Reporte, intente mas tarde ')</script>";
					
			}
		}
	}
	*/
?>
</body>
</html>