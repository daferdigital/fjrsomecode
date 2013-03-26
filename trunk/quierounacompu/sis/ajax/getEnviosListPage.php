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

//vemos el tipo de envio que se desea buscar o si se viene de busqueda avanzada
if(isset($_POST["fromBusquedaAvanzada"])){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_AVANZADA);
	BitacoraDAO::registrarComentario("Ingreso en pagina ajax para realizar busquedas avanzadas de envios");
	$canEdit = true;
}
$pageNumber = $_POST[Constants::$PAGE_NUMBER];
$scriptFunction = $_POST[Constants::$SCRIPT_FUNCTION];

//obtenemos el extra where
$extraWhere = "";
if($statusEnvio != "-1"){
	$extraWhere .= " AND e.id_status_actual=".$statusEnvio;	
}
if($_POST["fechaDesde"] != ""){
	$extraWhere .= " AND e.fecha_pago >= '".$_POST["fechaDesde"]."'";
}
if($_POST["fechaHasta"] != ""){
	$extraWhere .= " AND e.fecha_pago <= '".$_POST["fechaHasta"]."'";
}
if($_POST["seudonimoML"] != ""){
	$extraWhere .= " AND LOWER(e.seudonimo_ml) LIKE LOWER('%".$_POST["seudonimoML"]."%')";
}
if($_POST["boucher"] != ""){
	$extraWhere .= " AND LOWER(e.num_voucher) LIKE LOWER('%".$_POST["boucher"]."%')";
}
if($_POST["ciRif"] != ""){
	$extraWhere .= " AND LOWER(e.ci_rif) LIKE LOWER('%".$_POST["ciRif"]."%')";
}

$query = "SELECT e.*, es.descripcion as statusEnvio, DATE_FORMAT(e.fecha_pago, '%d/%m/%Y') AS fechaPago, "
."DATE_FORMAT(e.fecha_registro, '%d/%m/%Y') AS fechaRegistro, b.nombre AS banco, mp.descripcion AS medioPago "
." FROM bancos b, medios_de_pago mp, envios e, envios_status es"
." WHERE e.id_status_actual = es.id"
." AND e.id_banco = b.id"
." AND e.id_medio_pago = mp.id"
.$extraWhere
." ORDER BY e.fecha_pago DESC";

//$totalRecords = DBUtil::getRecordCountToQuery($query);
//$pageRecords = DBUtil::getRecordsByPage($query, $pageNumber);
//$pagingDAO = new PagingDAO($pageNumber, $scriptFunction, $totalRecords);
$pageRecords = DBUtil::executeSelect($query);
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