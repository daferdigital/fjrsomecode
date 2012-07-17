<?php 
	
	/**
	 * verificamos si la cuenta existe en la tabla visitantes o en cu_usuario
	 * @param string $accountMail
	 */
	function checkIfAccountMailExists($conexion, $accountMail){
		$accountExists = false;
		$query = "SELECT COUNT(*)
		FROM visitantes
		WHERE correo = '$accountMail'
		UNION
		SELECT COUNT(*)
		FROM cu_usuario
		WHERE usu_correo = '$accountMail'";
	
		$result = mysql_query($query, $conexion);
		if(mysql_error()){
				
		} else {
			//se hizo la consulta sin problemas, verificamos
			//si alguna de las cuentas dio mayor a cero
			while($row = mysql_fetch_array($result)){
				if($row[0] > 0){
					$accountExists = true;
					break;
				}
			}
		}
	
		return $accountExists;
	}
	
	include "conexion.php";
	session_start();
	
	if(isset($_REQUEST['submitCC']) == true){
		//procesamos los valores para crear la cuenta
		//verificamos primero si la cuenta existe
		$showContactForm = true;
		$accountExists = checkIfAccountMailExists($conexion, $_REQUEST['correo']);
		
		
		if($accountExists == true){
?>
			<script type="text/javascript">
				alert("El usuario indicado ya existe y no fue creado.\nPor favor ingrese con su login y clave");
				window.location="contacto.php?id=" + <?php echo $_SESSION['id'];?>;
			</script>
<?php
			exit();
		} else {
			$query = "INSERT INTO visitantes VALUES (NULL, '".$_REQUEST['correo']."', md5('".$_REQUEST['clave']."'),'".$_REQUEST['direccion']."','".$_REQUEST['estado']."','".$_REQUEST['ciudad']."','".$_REQUEST['nombre']."','".$_REQUEST['telefono']."')";
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
				header("Location: contactForm.php");
			} else {
				echo "Ocurrio el siguiente error '".mysql_error()."'. Por favor intente de nuevo <br />";
			}
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
	<script>
		function validateFormSubmit(form){
			var mustSubmit = MM_validateForm2('nombre', 'Nombre', 'R', 
					'correo','Correo (E-mail)','RisEmail',
					'email','Correo (E-mail)','R',
					'clave','Clave','R',
					'estado','Estado','R',
					'ciudad','Ciudad','R',
					'direccion','Direccion','R',
					'telefono','Telefono','R');

			if(mustSubmit){
				form.submit();
			}
		}
	</script>
</head>
<body>
	<div style="text-align: center;"><img src="logo.png" width="165" height="80" /></div>
	
	<form action="createAccountForm.php" method="post" name="formCC" enctype="application/x-www-form-urlencoded">
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
	      		<input type="hidden" name="submitCC" id="submitCC" value="" />
	      		<input type="button" value="Crear cuenta" onclick="validateFormSubmit(this.form)" />
	      	</td>
	    </tr>
	</table>
</form>
</body>
</html>
<?php 
	mysql_close($conexion);
?>
