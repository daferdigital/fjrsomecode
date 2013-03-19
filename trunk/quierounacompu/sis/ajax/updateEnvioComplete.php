<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/PageAccess.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/ModuloDAO.php';
include_once '../classes/EnvioDAO.php';
include_once '../classes/EnvioDTO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../includes/session.php';

PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_AVANZADA);

$recordId = $_GET["id"];
$envioDTO = EnvioDAO::getEnvioInfo($recordId);
$statusEnvio = $envioDTO->getIdStatusActual();

BitacoraDAO::registrarComentario("Ingreso en pagina ajax para vizualizar envio[".$recordId."]");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<div style="padding: 10px; width: 650px;" class="centered">
	<div id="myjquerymenu" class="jquerycssmenu" style="height: 25px;">
		<ul>
			<li><a href="#tabs-0">Datos de Compra</a></li>
			<li><a href="#tabs-1">Datos de Pago</a></li>
			<li><a href="#tabs-2">Datos para el env&iacute;o</a></li>
			<li><a href="#tabs-3">Envio desde Quierounacompu</a></li>
			<li><a href="#tabs-4">Datos Modificables</a></li>
		</ul>
		<div id="tabs-0">
		</div>
	</div>
	<table class="borderCollapse">
		<tr>
			<td>Fecha:</td>
			<td><?php echo $result[0]["fecha"];?></td>
		</tr>
		<tr>
			<td>Usuario:</td>
			<td><?php echo $result[0]["nombre"]." ".$result[0]["apellido"];?></td>
		</tr>
		<tr>
			<td>Error?:</td>
			<td><?php echo $result[0]["was_error"] == 0 ? "No" : "S&iacute;";?></td>
		</tr>
		<tr>
			<td>Consulta:</td>
			<td><?php echo $result[0]["query"];?></td>
		</tr>
		<tr>
			<td>Resultado:</td>
			<td><?php echo $result[0]["result"];?></td>
		</tr>
	</table>	
</div>
</body>
</html>