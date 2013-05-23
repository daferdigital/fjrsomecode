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

$statusEnvio = EnvioDAO::$COD_STATUS_PRESUPUESTADO;
$editPage = "showEnvio.php";
$commentPage = "addComment.php";
$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];

//venimos de las opciones especificas por cada tipo de envio
//verificamos el permiso
PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PRESUPUESTADO);
BitacoraDAO::registrarComentario("Ingreso en pagina ajax para realizar busqueda de envios de presupuestados");

//colocamos el extra where
$extraWhere = " AND e.id_status_actual=".$statusEnvio;	

$query = "SELECT e.*, es.descripcion as statusEnvio, DATE_FORMAT(e.fecha_pago, '%d/%m/%Y') AS fechaPago, "
."DATE_FORMAT(e.fecha_registro, '%d/%m/%Y') AS fechaRegistro, b.nombre AS banco, mp.descripcion AS medioPago "
." FROM bancos b, medios_de_pago mp, envios e, envios_status es"
." WHERE e.id_status_actual = es.id"
." AND e.id_banco = b.id"
." AND e.id_medio_pago = mp.id"
.$extraWhere
." ORDER BY e.fecha_registro";

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
		<div style="width: 10%;" id="tdHeader">
      		Fecha
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Nombre
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Medio de Pago
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Banco 
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Fecha de Pago
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Nro Comprobante 
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Monto
    	</div>
	</div>
	<?php
		foreach ($pageRecords as $row){
	?>
		<div id="row">
			<div style="width: 5%;" id="tdElement">
				<a href="#" onclick="javascript:loadAjaxPopUp('ajax/<?php echo $editPage;?>?id=<?php echo $row["id"];?>')">
					<img alt="ver" title="Editar" src="images/see.png" border="0" style="display: inline;"/>
				</a>
				<a href="#" onclick="javascript:loadAjaxPopUp('ajax/<?php echo $commentPage;?>?id=<?php echo $row["id"];?>')">
					<img alt="ver" title="Comentar" src="images/pageEdit.png" border="0" style="display: inline;"/>
				</a>
			</div>
			<div style="width: 10%;" id="tdElement">
	      		<?php echo $row["fechaRegistro"]?>
	    	</div>
	    	<div style="width: 15%;" id="tdElement">
	      		<?php echo $row["nombre_completo"]?>
	    	</div>
	    	<div style="width: 10%;" id="tdElement">
	      		<?php echo $row["medioPago"]?>
	    	</div>
	    	<div style="width: 15%;" id="tdElement">
	      		<?php echo $row["banco"]?>
	    	</div>
	    	<div style="width: 10%;" id="tdElement">
	      		<?php echo $row["fechaPago"]?>
	    	</div>
	    	<div style="width: 15%;" id="tdElement">
	      		<?php echo $row["num_voucher"]?>
	    	</div>
	    	<div style="width: 10%;" id="tdElement">
	      		<?php echo $row["monto_pago"]?>
	    	</div>
		</div>
	<?php
		} 
}
?>
</div>
</body>
</html>