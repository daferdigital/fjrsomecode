<?php
	session_start();
	$imageName = "images/header1.jpg";
	$isLogged = false;
	
	if(isset($_SESSION["imageHeader"])){
		$imageName = $_SESSION["imageHeader"];
	}
	if(isset($_SESSION["isLogged"])){
		$isLogged = $_SESSION["isLogged"];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>.::: Coordinaci&oacute;n de Seguridad :::.</title>
		<link rel="stylesheet" type="text/css" href="css/sis.css" />
		<link rel="stylesheet" type="text/css" href="css/jquerycssmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/jsDatePick_ltr.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	
		<script type="text/javascript" src="js/jquery-1.8.0.js"></script>
		<script type="text/javascript" src="js/jquerycssmenu.js"></script>
		<script type="text/javascript" src="js/jquery.bpopup-0.9.0.min.js"></script>
		<script type="text/javascript" src="js/jsDatePick.full.1.3.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/siteSIS.js"></script>
	</head>
<body>
<table width="1000"  border="0" align="center" cellpadding="0" cellspacing="0" id="tab" >
	<tr>
    	<th colspan="2" scope="col"><img src="<?php echo $imageName;?>" id="td1"/></th>
  	</tr>
  	<tr>
  		<?php if($isLogged){?>
    	<td colspan="2" align="center"  >
    		<div id="myjquerymenu" class="jquerycssmenu" style="height: 25px;">
				<ul>
					<li>
						<a href="#" class="MenuBarItemSubmenu">Funcionarios</a>
						<ul>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Agregar Funcionario
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Modificar Funcionario
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Listar Funcionarios
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Eliminar Funcionario
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" class="MenuBarItemSubmenu">Vacaciones</a>
						<ul>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Registro
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Consulta
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Actualizaci&oacute;n
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Borrado
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#" class="MenuBarItemSubmenu">Permisos</a>
						<ul>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Registro
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Consulta
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Actualizaci&oacute;n
								</a>
							</li>
							<li>
								<a href="searchEnviosByType.php?type=<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>">
									Borrado
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<br style="clear: right;" />
				</div>
		</td>
		<?php }?>
  	</tr>