<?php 
	include ("conexion.php");
	
	//vemos si el usuario viene con el ID de la persona que le va a prestar el servicio
	// sino, entonces lo sacamos de esta pagina
	session_start();
	if(isset($_SESSION['id'])){
		
	}else {
?>
		<script type="text/javascript">
			alert("Disculpe, no encontramos la referencia al especialista en su solicitud.\n"
					+"Por Favor intente de nuevo.");
		</script>
<?php 
		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Servicios</title>
	<style type="text/css">
	<!--
		.txt1{
			font-family:Arial, Helvetica, sans-serif;
			font-size:12px;
			font-weight:bold;
		}
		.txt2{
			font-family:Arial, Helvetica, sans-serif;
			font-size:12px;
		}
	-->
	</style>
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
	<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
	<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
	<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		<?php include ("scripts/ubicaciones.php");?>
	</script>
	<script type="text/javascript" src="scripts/validaciones.js"></script>
	<script type="text/javascript">
		function validarContactForm(){
			var returnValue = MM_validateForm2('descSolicitud', 'Descripcion de solicitud', 'R', 
					'dateValue', 'Fecha de solicitud', 'R', 
					'codSolicitud', 'Codigo de solicitud', 'R', 
					'security_code', 'Codigo de validacion', 'R');

			if(returnValue){
				//validamos los terminos
				if(! document.getElementById('terminos_0').checked){
					alert("Para solicitar el servicio debe aceptar los terminos y condiciones.");
					returnValue = false;
				}
			}
			
			return returnValue;
		}
	</script>
</head>
<body>
	<div style="text-align: center;"><img src="logo.png" width="165" height="80" /></div>
	
	<form action="doContact.php" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1" onsubmit="return validarContactForm()">
		
		<table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
		    <tr>
		      	<td height="35" colspan="2" align="center" bgcolor="#dddddd" style="border:1px solid #999;">
		      		<strong>::: CONTACTO DE SERVICIO :::</strong>
		      	</td>
		    </tr>
		    <tr>
		    	<td width="40%" class="txt1" align="right">::: Nombre</td>
		      	<td>
		      		<input type="hidden" name="nombre" id="nombre" value="<?php echo $_SESSION['loggedUser']['nombre']; ?>"/>
		      		<?php echo $_SESSION['loggedUser']['nombre']; ?>
		      		<?php 
		      			$query = "SELECT * FROM servicio_contactado WHERE calificacion_recibida = -1 AND id_solicitante = ".$_SESSION['loggedUser']['id'];
		      			$result = mysql_query($query);
		      			
		      			$rows = mysql_num_rows($result);
		      			
		      			if($rows > 0){
		      		?>
		      				<a href="calificacionesPendientes.php">[Calificar Servicios]</a>
		      		<?php 
		      			}
		      		?>
		      	</td>
		    </tr>
		    <tr>
		    	<td width="40%" class="txt1" align="right">::: Correo</td>
		      	<td>
		      		<input type="hidden" name="correo" id="correo" value="<?php echo $_SESSION['loggedUser']['correo']; ?>"/>
		      		<?php echo $_SESSION['loggedUser']['correo']; ?>
		      	</td>
		    </tr>
		    <tr>
		    	<td width="40%" class="txt1" align="right">::: Direcci&oacute;n</td>
		      	<td>
		      		<input type="hidden" name="direccion" id="direccion" value="<?php echo $_SESSION['loggedUser']['estado']." / ".$_SESSION['loggedUser']['ciudad']." / ".$_SESSION['loggedUser']['direccion']; ?>"/>
		      		<?php echo $_SESSION['loggedUser']['estado']." / ".$_SESSION['loggedUser']['ciudad']." / ".$_SESSION['loggedUser']['direccion']; ?>
		      	</td>
		    </tr>
		    <tr>
		    	<td width="40%" class="txt1" align="right">::: Descripci&oacute;n de solicitud</td>
		      	<td>
		      		<textarea name="descSolicitud" id="descSolicitud" rows="5" cols="30" style="resize: none;"></textarea>
		      	</td>
		    </tr>
		    <tr>
		    	<td width="40%" class="txt1" align="right">::: Fecha solicitada</td>
		      	<td>
		      		<?php include "dateCalendar.php";?>
		      	</td>
		    </tr>
		    <tr>
		    	<td width="40%" class="txt1" align="right">::: Codigo de la solicitud</td>
		      	<td>
		      		<?php $codSolicitud = time();?>
		      		<input type="hidden" name="codSolicitud" id="codSolicitud" value="<?php echo $codSolicitud;?>"/>
		      		<?php echo $codSolicitud;?>
		      	</td>
		    </tr>
		    <tr>
	         	<td width="40%" class="txt1" align="right">::: C&oacute;digo de validaci&oacute;n</td>
	         	<td>
	         		<img src="CaptchaSecurityImages.php?width=120&height=50&characters=5" /><br />
					<input id="security_code" name="security_code" type="text" />
	        	</td>
			</tr>
			<tr>
				<td align="right" class="txt1">::: Leer T&eacute;rminos y condiciones</td>
	         	<td>
	         		<p>
	         			<input type="radio" name="terminos" id="terminos_0" value="Acepto" checked="checked" /> Acepto
	         		    <br />
	         		    <input type="radio" name="terminos" id="terminos_1" value="No acepto" /> No acepto
	         		    <br />
	       		    </p>
	       		</td>
	        </tr>
		    <tr>
		      	<td colspan="2" align="center">
		      		<input type="submit" name="submitContact" id="submitContact" value="Contactar"/>
		      	</td>
		    </tr>
		</table>
	</form>
</body>
</html>
