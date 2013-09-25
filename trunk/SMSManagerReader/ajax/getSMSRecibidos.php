<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/UsuarioDAO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../classes/PagingDAO.php';

session_start();
$pageNumber = $_POST[Constants::$PAGE_NUMBER];
$scriptFunction = $_POST[Constants::$SCRIPT_FUNCTION];

//obtenemos el extra where
$extraWhere = "";
if($_POST["texto"] != ""){
	$extraWhere .= " AND LOWER(sms.texto_sms) LIKE LOWER('%".$_POST["usuario"]."%')";	
}
if($_POST["fechaDesde"] != ""){
	$extraWhere .= " AND b.fecha >= '".$_POST["fechaDesde"]."'";
}
if($_POST["fechaHasta"] != ""){
	$extraWhere .= " AND b.fecha <= '".$_POST["fechaHasta"]."'";
}
if($_POST["remitente"] != ""){
	$extraWhere .= " AND LOWER(sms.number_from) LIKE LOWER('%".$_POST["remitente"]."%')";
}

$query = "SELECT sms.*"
." FROM mensajes sms"
." WHERE 1 = 1"
.$extraWhere
." ORDER BY sms.fecha_sms, sms.hora_sms DESC";

$totalRecords = DBUtil::getRecordCountToQuery($query);
$pageRecords = DBUtil::getRecordsByPage($query, $pageNumber);
$pagingDAO = new PagingDAO($pageNumber, $scriptFunction, $totalRecords);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
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
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
		<div align="left" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging();?>
		</div>
		<div id="tdElement">
		</div>
	</div>
	<div id="row">
		<div style="width: 10%;" id="tdHeader">
      		Fecha
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Hora
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Remitente
    	</div>
    	<div style="width: 55%;" id="tdHeader">
      		Mensaje
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Exportar
    	</div>
	</div>
	<?php
		foreach ($pageRecords as $row){
	?>
		<div id="row">
			<div style="width: 10%;" id="tdElement">
				<?php echo $row["fecha_sms"];?>
			</div>
			<div style="width: 10%;" id="tdElement">
				<?php echo $row["hora_sms"];?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["number_from"];?>
			</div>
			<div style="width: 55%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["texto_sms"];?>
				</span>
			</div>
			<div style="width: 10%;" id="tdElement">
				<img style="display: inline; border: 0px;" alt="PDF" src="images/exportToPDF.png" />
				<img style="display: inline; border: 0px;" alt="XLS" src="images/exportToExcel.png" />
			</div>
		</div>
	<?php
		}
	?>
	<div id="row">
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
		<div align="left" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging();?>
		</div>
		<div id="tdElement">
		</div>
	</div>
<?php 
}
?>
</div>
</body>
</html>