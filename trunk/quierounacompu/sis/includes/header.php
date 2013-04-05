<?php
	include_once ("classes/UsuarioDTO.php");
	include_once ("classes/PageAccess.php");
	include_once ("includes/session.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
	<title>QuieroUnaCompu - Sistema Integral de Seguimiento</title>
	
	<link rel="stylesheet" type="text/css" href="css/sis.css" />
	<link rel="stylesheet" type="text/css" href="css/jquerycssmenu.css" />
	<link rel="stylesheet" type="text/css" href="css/jsDatePick_ltr.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	
	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="js/jquerycssmenu.js"></script>
	<script type="text/javascript" src="js/jquery.bpopup-0.9.0.min.js"></script>
	<script type="text/javascript" src="js/jsDatePick.full.1.3.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/siteSIS.js"></script>
	
	<!--[if lte IE 7]>
		<style type="text/css">
			html .jquerycssmenu{height: 1%;} 
			/*Holly Hack for IE7 and below*/
		</style>
	<![endif]-->
</head>
<body>

<table class="bodyTable">
	<tr>
   		<td colspan="2">
   			<img border="0" alt="" id="header" src="images/headerquierounacompu.gif" name="header">
   		</td>
  	</tr>
  	<?php
  		//si el usuario esta logueado, mostramos el menu
  		if(PageAccess::userIsLogged()){
			$usuarioDTO = $_SESSION["usuario"];
	?>
	<tr>
		<td align="right">
			<?php include ("includes/modulesMenu.php");?>
		</td>
		<td align="right" width="200px">
			<span class="welcomeText"> 
  				Bienvenido 
  				<?php 
  					echo $usuarioDTO->getNombreCompleto();
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
  	    <td colspan="2">
