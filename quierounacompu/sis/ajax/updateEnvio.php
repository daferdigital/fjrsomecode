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

$recordId = $_GET["id"];
$canEdit = false;
$envioDTO = EnvioDAO::getEnvioInfo($recordId);

$statusEnvio = $envioDTO->getIdStatusActual();

BitacoraDAO::registrarComentario("Ingreso en pagina ajax para vizualizar envio[".$recordId."]");

//vemos el tipo de envio que se desea buscar o si se viene de busqueda avanzada
//venimos de las opciones especificas por cada tipo de envio
//verificamos el permiso
if(EnvioDAO::$COD_STATUS_NOTIFICADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_NOTIFICADOS);
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_PAGOS_CONFIRMADOS);
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_PAGOS_NO_ENCONTRADOS);
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_FACTURADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_FACTURADO);
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_PRESUPUESTADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_ed);
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_ENVIADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_ENVIADO);
	$canEdit = true;
}

BitacoraDAO::registrarComentario("El usuario ".($canEdit ? "" : "NO")." puede editar el envio[".$recordId."]");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<div style="padding: 10px; width: 850px;" class="centered">
	<div id="myjquerymenu" class="jquerycssmenu" style="height: 25px;">
		<ul>
			<li><a href="#tabs-0">Datos de Compra</a></li>
			<li><a href="#tabs-1">Datos de Pago</a></li>
			<li><a href="#tabs-2">Datos para el env&iacute;o</a></li>
			<li><a href="#tabs-3">Envio desde Quierounacompu</a></li>
			<li><a href="#tabs-4">Status Final y Comentarios</a></li>
		</ul>
		<br style="clear: both;" />
		<div id="tabs-0" style="background-color: white;">
			<br />
			<br />
			<table>
				<tr>
					<td>Nombre:</td>
					<td><?php echo $envioDTO->getNombreCompleto();?></td>
				</tr>
				<tr>
					<td>Seudonimo MercadoLibre:</td>
					<td><?php echo $envioDTO->getSeudonimoML();?></td>
				</tr>
				<tr>
					<td>C.I. RIF:</td>
					<td><?php echo $envioDTO->getCiRIF();?></td>
				</tr>
				<tr>
					<td>Correo:</td>
					<td><?php echo $envioDTO->getCorreo();?></td>
				</tr>
				<tr>
					<td>Detalle de la Compra:</td>
					<td><?php echo $envioDTO->getDetalleCompra();?></td>
				</tr>
			</table>
		</div>
		<div id="tabs-1" style="background-color: white;">
			<br />
			<br />
			<table>
				<tr>
					<td>Banco:</td>
					<td><?php echo $envioDTO->getDescBanco();?></td>
				</tr>
				<tr>
					<td>Medio de Pago:</td>
					<td><?php echo $envioDTO->getDescMedioPago();?></td>
				</tr>
				<tr>
					<td>Fecha del pago:</td>
					<td><?php echo $envioDTO->getFechaPago();?></td>
				</tr>
				<tr>
					<td>Vauche:</td>
					<td><?php echo $envioDTO->getNumVoucher();?></td>
				</tr>
				<tr>
					<td>Monto:</td>
					<td><?php echo $envioDTO->getMontoPago();?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
</body>
</html>