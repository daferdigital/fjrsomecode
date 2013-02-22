<?php
	include_once ("classes/UsuarioDTO.php");
	include_once ("classes/UsuarioDTO.php");
	include_once ("includes/session.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>QuieroUnaCompu - Sistema Integral de Seguimiento</title>
	<link href="css/sis.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/siteSIS.js"></script>
</head>
<body>

<table class="bodyTable">
	<tr>
   		<td colspan="3">
   			<img border="0" alt="" id="header" src="images/headerquierounacompu.gif" name="header">
   		</td>
  	</tr>
  	<?php
  		//si el usuario esta logueado, mostramos el menu
  		if(isset($_SESSION["isLogged"]) && $_SESSION["isLogged"] == true){
			$usuarioDTO = $_SESSION["usuario"];
	?>
	<tr>
		<td>&nbsp;</td>
		<td align="right">
			<a class="headerLinks" href="#">Confirmados</a>
			<a class="headerLinks" href="#">Presupuestados</a>
			<a class="headerLinks" href="#">Facturados</a>
			<a class="headerLinks" href="#">Pagos no Encontrados</a>
			<a class="headerLinks" href="#">Enviados</a>
		</td>
  		<td align="right">
  			<span class="welcomeText"> 
  				Bienvenido 
  				<?php 
  					echo $usuarioDTO->getNombre().$usuarioDTO->getApellido();
  					echo "<br />";
  					echo $usuarioDTO->getRolDTO()->getRoleDesc();
  				?>
  			</span>
  			<a href="doLogout.php" style="display: inline-block;" title="Cerrar sesion">
  					<img border="0" src="images/logout.png"/>
  			</a>
  		</td>
  	</tr>
	<?php
		} 
  	?>
  	<tr>
  	    <td>
