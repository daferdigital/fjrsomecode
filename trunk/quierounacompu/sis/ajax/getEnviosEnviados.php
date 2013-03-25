<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/PageAccess.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/ModuloDAO.php';
include_once '../classes/UsuarioDAO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../classes/PagingDAO.php';
include_once "../classes/EnvioDAO.php";
include_once '../includes/session.php';

$statusEnvio = $_POST["statusEnvio"];
$canEdit = false;
$editPage = "showEnvio.php";
$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];

//venimos de las opciones especificas por cada tipo de envio
//verificamos el permiso
if(EnvioDAO::$COD_STATUS_NOTIFICADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_NOTIFICADOS);
	BitacoraDAO::registrarComentario("Ingreso en pagina ajax para realizar busqueda de envios notificados");
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_NOTIFICADOS)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PAGOS_CONFIRMADOS);
	BitacoraDAO::registrarComentario("Ingreso en pagina ajax para realizar busqueda de envios con estado de pagos confirmados");
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_PAGOS_CONFIRMADOS)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PAGOS_NO_ENCONTRADOS);
	BitacoraDAO::registrarComentario("Ingreso en pagina ajax para realizar busqueda de envios con estado de pago no encontrado");
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_PAGOS_NO_ENCONTRADOS)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_FACTURADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_FACTURADO);
	BitacoraDAO::registrarComentario("Ingreso en pagina ajax para realizar busqueda de envios facturados");
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_FACTURADO)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_PRESUPUESTADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PRESUPUESTADO);
	BitacoraDAO::registrarComentario("Ingreso en pagina ajax para realizar busqueda de envios presupuestados");
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_PRESUPUESTADO)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_ENVIADO == $statusEnvio){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_ENVIADO);
	BitacoraDAO::registrarComentario("Ingreso en pagina ajax para realizar busqueda de envios con status de enviado");
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_ENVIADO)){
		$canEdit = true;
	}
}

//obtenemos el extra where
$extraWhere = "";
if($statusEnvio != "-1"){
	$extraWhere .= " AND e.id_status_actual=".$statusEnvio;	
}

$query = "SELECT e.*, es.descripcion as statusEnvio"
." FROM envios_status es, envios e"
." WHERE e.id_status_actual = es.id"
.$extraWhere
." ORDER BY e.fecha_pago DESC";

//$totalRecords = DBUtil::getRecordCountToQuery($query);
//$pageRecords = DBUtil::getRecordsByPage($query, $pageNumber);
$pageRecords = DBUtil::executeSelect($query);
//$pagingDAO = new PagingDAO($pageNumber, $scriptFunction, $totalRecords);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<div id="container" class="centered">
<?php
if(count($pageRecords) == 0){
	//no se obtuvieron registros para los criterios de busqueda
?>
	<span class="smallError">
		<?php echo Constants::$TEXT_NO_PAGE_RECORDS;?>
	</span>
<?php
} else {
?>
	<div id="row">
		<div style="width: 5%;" id="tdHeader">
      		&nbsp;
    	</div>
		<div style="width: 15%;" id="tdHeader">
      		Fecha
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Seudonimo MercadoLibre
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Cedula/RIF
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		# Vauche 
    	</div>
    	<div style="width: 40%;" id="tdHeader">
      		Compra
    	</div>
	</div>
	<?php
		foreach ($pageRecords as $row){
	?>
		<div id="row">
			<div style="width: 5%;" id="tdElement">
				<?php 
				if($canEdit){
				?>
					<a href="#" onclick="javascript:loadAjaxPopUp('ajax/<?php echo $editPage;?>?id=<?php echo $row["id"];?>')">
						<img alt="ver" title="Editar" src="images/pageEdit.png" border="0"/>
					</a>
				<?php
				}
				?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["fecha_pago"];?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["seudonimo_ml"];?>
			</div>
			<div style="width: 10%;" id="tdElement">
				<?php echo $row["ci_rif"];?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["num_voucher"];?>
			</div>
			<div style="width: 40%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["detalle_compra"];?>
				</span>
			</div>
		</div>
	<?php
		} 
}
?>
</div>
</body>
</html>