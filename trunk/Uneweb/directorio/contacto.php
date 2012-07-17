<?php 
	//vemos si el usuario viene con el ID de la persona que le va a prestar el servicio
	//o si desea entrar a las calificaciones
	// sino, entonces lo sacamos de esta pagina
	
	if(isset($_REQUEST['id']) || isset($_REQUEST['goto'])){
		session_start();
		if(isset($_REQUEST['id'])){
			unset($_SESSION['goto']);
			$_SESSION['id'] = $_REQUEST['id'];
		}
		if(isset($_REQUEST['goto'])){
			unset($_SESSION['id']);
			$_SESSION['qlfy'] = true;
		}
		
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
	<script type="text/javascript" src="scripts/validaciones.js"></script>
	<script type="text/javascript">
		function validarLoginForm(form){
			var mustSubmit = MM_validateForm2('correo', 'Login', 'R', 
					'clave', 'Clave', 'R');

			if(mustSubmit){
				form.submit();
			}
		}
	</script>
</head>
<body>
	<div style="text-align: center;"><img src="logo.png" width="165" height="80" /></div>
	
	<form action="validateLogin.php" method="post" enctype="multipart/form-data" name="form1" target="_self" id="form1">
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
		      		<input type="hidden" name="submitLogin" id="submitLogin" value="Ingresar"></input>
		      		<input type="button" value="Ingresar" onclick="validarLoginForm(this.form)"/>
		      	</td>
		    </tr>
		    <tr>
		      	<td colspan="2" align="center">
		      		<a href="createAccountForm.php">Crear mi cuenta</a>
		      	</td>
		    </tr>
		</table>
	</form>
</body>
</html>