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
if(isset($_POST["fromBusquedaAvanzada"])){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_AVANZADA);
	$canEdit = true;
}else{
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
}

BitacoraDAO::registrarComentario("El usuario ".($canEdit ? "" : "NO")." puede editar el envio[".$recordId."]");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<div style="padding: 10px; width: 650px;" class="centered">
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