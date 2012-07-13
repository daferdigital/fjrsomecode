<?php
	include "conexion.php";
	$showContactForm = false;
	$showCreateCount = false;
	
	if(isset($_REQUEST['cc'])){
		//se desea crear una cuenta
		$showCreateCount = true;
	} else {
		session_start();
		
		if(isset($_REQUEST['goto'])){
			if($_REQUEST['goto'] == 'qlfy'){
				$_SESSION['qualify'] = true;
			}
		}
		
		if(isset($_REQUEST['id'])){
			$_SESSION['id'] = $_REQUEST['id'];
		}
		
		if(isset($_REQUEST['submitCC'])){
			//procesamos los valores para crear la cuenta
			$showContactForm = true;
			$query = "INSERT INTO visitantes VALUES ('', '".$_REQUEST['correo']."', md5('".$_REQUEST['clave']."'),'".$_REQUEST['direccion']."','".$_REQUEST['estado']."','".$_REQUEST['ciudad']."','".$_REQUEST['nombre']."','".$_REQUEST['telefono']."')";
			$consulta = mysql_query($query);
			if(!mysql_error()){
				$query = "SELECT id, direccion, estado, ciudad, nombre, telefono FROM visitantes WHERE correo='".$_REQUEST['correo']."' AND md5('".$_REQUEST['clave']."') = clave";
				$consulta = mysql_query($query);
				$row = mysql_fetch_array($consulta);
				
				$_SESSION['loggedUser'] = array(
						'id' => $row['id'],
						'correo' => $_REQUEST['correo'],
						'direccion' => $_REQUEST['direccion'],
						'estado' => $_REQUEST['estado'],
						'ciudad' => $_REQUEST['ciudad'],
						'nombre' => $_REQUEST['nombre'],
						'telefono' => $_REQUEST['telefono']);
				header("Location: contacto.php");
			}else{
				//echo mysql_error();
			}
		}
		
		if(isset($_SESSION['loggedUser'])){
			//usuario ya esta logueado
			//mostramos el formulario de contacto
			$showContactForm = true;
		} else {
			//usuario no tiene sesion, debe loguearse
			//vemos si es justamente una peticion de logueo
			if(isset($_REQUEST['submitLogin'])){
				//el usuario desea hacer login, validamos y actualizamos la sesion de ser necesario
				$query = "SELECT id, direccion, estado, ciudad, nombre, telefono FROM visitantes WHERE correo='".$_REQUEST['correo']."' AND md5('".$_REQUEST['clave']."') = clave";
				$consulta = mysql_query($query);
				$row = mysql_fetch_array($consulta);
					
				if($row){
					//login valido
					$showContactForm = true;
					$_SESSION['loggedUser'] = array(
							'id' => $row['id'],
							'correo' => $_REQUEST['correo'],
							'direccion' => $row['direccion'],
							'estado' => $row['estado'],
							'ciudad' => $row['ciudad'],
							'nombre' => $row['nombre'],
							'telefono' => $row['telefono']);
				} else {
					echo '<script language="javascript">alert("Correo o clave invalidos.");</script>';
				}
			}
		}
		
		//en este punto estoy dentro del sistema
		//verifico si debo ir directo a calificar
		if(isset($_SESSION['qualify'])){
			unset($_SESSION['qualify']);
			header("Location: calificacionesPendientes.php");
		}
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
			MM_validateForm('descSolicitud', 'Descripcion de solicitud', 'R', 
					'dateValue', 'Fecha de solicitud', 'R', 
					'codSolicitud', 'Codigo de solicitud', 'R', 
					'security_code', 'Codigo de validacion', 'R');

			if(document.MM_returnValue){
				//validamos los terminos
				if(! document.getElementById('terminos_0').checked){
					alert("Para solicitar el servicio debe aceptar los terminos y condiciones.");
					document.MM_returnValue = false;
				}
			}
			
			return document.MM_returnValue;
		}
	</script>
</head>
<body>

<?php 
	if(! $showContactForm) {
		if($showCreateCount){
?>
<form action="contacto.php" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1" onsubmit="MM_validateForm('nombre', 'Nombre', 'R', 'correo','Correo (E-mail)','RisEmail','email','Correo (E-mail)','R','clave','Clave','R','estado','Estado','R','ciudad','Ciudad','R','direccion','Direccion','R','telefono','Telefono');return document.MM_returnValue;">
	<table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
	    <tr>
	      	<td height="35" colspan="2" align="center" bgcolor="#dddddd" style="border:1px solid #999;">
	      		<strong>::: CREAR CUENTA EN AL SISTEMA :::</strong>
	      	</td>
	    </tr>
	    <tr>
	    	<td width="40%" class="txt1" align="right">::: Nombre</td>
	      	<td>
	      		<input type="text" name="nombre" id="nombre" value=""/>
	      	</td>
	    </tr>
	    <tr>
	    	<td width="40%" class="txt1" align="right">::: Correo</td>
	      	<td>
	      		<input type="text" name="correo" id="correo" value=""/>
	      	</td>
	    </tr>
	    <tr>
	    	<td width="40%" class="txt1" align="right">::: Clave</td>
	      	<td>
	      		<input type="password" name="clave" id="clave" value=""/>
	      	</td>
	    </tr>
	   	<tr>
	   		<td class="txt1" align="right">::: Estado</td>
         	<td>
         		<select name="estado" id="estado" onchange="cargarCiudades(this.form.estado.value, this.form.ciudad)">
         			<option value="-1">Seleccione:</option>
         		    <?php 
	         			$query = "SELECT id, nombre FROM ubicaciones WHERE tipo_ubicacion = 1 ORDER BY LOWER(nombre)";
	         		    $consulta = mysql_query($query);
	         		    while(list($edoId, $edoNombre) = mysql_fetch_array($consulta)){
	         		?>
							<option value="<?php echo $edoNombre;?>"><?php echo $edoNombre;?></option>
	         		<?php 
	         			}
         		    ?>
       		    </select>
       		</td>
		</tr>
		<tr>
			<td class="txt1" align="right">::: Ciudad</td>
			<td>
				<span id="sprytextfield8">
					<select name="ciudad" id="ciudad">
         		    </select>
       		    </span>
       		</td>
		</tr>
		<tr>
	    	<td width="40%" class="txt1" align="right">::: Direcci&oacute;n</td>
	      	<td>
	      		<input type="text" name="direccion" id="direccion" value=""/>
	      	</td>
	    </tr>
	    <tr>
	    	<td width="40%" class="txt1" align="right">::: Tel&eacute;fono</td>
	      	<td>
	      		<input type="text" name="telefono" id="telefono" value=""/>
	      	</td>
	    </tr>
	    <tr>
	      	<td colspan="2" align="center">
	      		<input type="submit" name="submitCC" id="submitCC" value="Crear cuenta"/>
	      	</td>
	    </tr>
	</table>
</form>
<?php		
		} else {
?>
<form action="contacto.php" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">
	<table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
	    <tr>
	      	<td height="35" colspan="2" align="center" bgcolor="#dddddd" style="border:1px solid #999;">
	      		<strong>::: INGRESE AL SISTEMA :::</strong>
	      	</td>
	    </tr>
	    <tr>
	    	<td width="40%" class="txt1" align="right">::: Correo</td>
	      	<td>
	      		<input type="text" name="correo" id="correo" value=""/>
	      	</td>
	    </tr>
	    <tr>
	    	<td width="40%" class="txt1" align="right">::: Clave</td>
	      	<td>
	      		<input type="password" name="clave" id="clave" value=""/>
	      	</td>
	    </tr>
	    <tr>
	      	<td colspan="2" align="center">
	      		<input type="submit" name="submitLogin" id="submitLogin" value="Ingresar"/>
	      	</td>
	    </tr>
	    <tr>
	      	<td colspan="2" align="center">
	      		<a href="contacto.php?cc=1">Crear mi cuenta</a>
	      	</td>
	    </tr>
	</table>
</form>
<?php
		}
?>
<?php } else { ?>
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
	      				<a href="calificacionespendientes.php">[Calificar Servicios]</a>
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
<?php } ?>
</body>
</html>
<?php mysql_close();?>