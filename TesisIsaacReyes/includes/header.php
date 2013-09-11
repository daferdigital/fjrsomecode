<?php
	include_once 'classes/UsuarioDTO.php';
	include_once 'classes/Constants.php';
	include_once 'classes/SessionUtil.php';
	
	session_start();
	
	$isLogged = false;
	if(isset($_SESSION[SessionUtil::$KEY_USER_LOGGED])){
		$isLogged = $_SESSION[SessionUtil::$KEY_USER_LOGGED];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>.::: Coordinaci&oacute;n de Seguridad :::.</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/jquerycssmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/jsDatePick_ltr.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	
		<script type="text/javascript" src="js/jquery-1.8.0.js"></script>
		<script type="text/javascript" src="js/jquerycssmenu.js"></script>
		<script type="text/javascript" src="js/jquery.bpopup-0.9.0.min.js"></script>
		<script type="text/javascript" src="js/jsDatePick.full.1.3.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/site.js"></script>
	</head>
<body>
<table width="1000"  border="0" align="center" cellpadding="0" cellspacing="0" id="tab" >
	<tr>
    	<th colspan="2" scope="col"><img src="images/header.png" id="td1"/></th>
  	</tr>
  	<?php
  		//si el usuario esta logueado, mostramos el menu
  		if($isLogged){
			$usuarioDTO = $_SESSION["usuario"];
	?>
	<tr>
		<td align="right">
			<?php include ("includes/modulesMenu.php");?>
		</td>
		<td align="right" width="300px">
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
			<br />
    		<br />
		</td>
	</tr>