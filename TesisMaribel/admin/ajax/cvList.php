<?php
header('Content-Type: text/html; charset=ISO-8859-1');
include_once '../../classes/Constants.php';
include_once '../../classes/DBUtil.php';
include_once '../../classes/PagingDAO.php';

$pageNumber = $_POST[Constants::$PAGE_NUMBER];
$scriptFunction = $_POST[Constants::$SCRIPT_FUNCTION];

//obtenemos el extra where
$extraWhere = "";
if($_POST["dpto"] != ""){
	$extraWhere .= " AND d.id=".$_POST["dpto"];	
}
if($_POST["cargo"] != ""){
	$extraWhere .= " AND c.id=".$_POST["cargo"];	
}
if($_POST["fechaDesde"] != ""){
	$extraWhere .= " AND s.fecha_registro >= '".$_POST["fechaDesde"]."'";
}
if($_POST["fechaHasta"] != ""){
	$extraWhere .= " AND s.fecha_registro <= DATE_ADD('".$_POST["fechaHasta"]."', INTERVAL 1 DAY)";
}
if($_POST["cedula"] != ""){
	$extraWhere .= " AND s.ci LIKE ('%".$_POST["cedula"]."%')";
}

$query = "SELECT s.id, s.nombre, s.apellido, s.ci, s.especialista_en, d.nombre as departamento, c.nombre AS cargo "
." FROM departamento d, cargo c, solicitudes s"
." WHERE s.id_cargo = c.id"
." AND c.id_departamento = d.id"
.$extraWhere
." ORDER BY s.nombre, s.apellido, d.nombre, c.nombre";

$maxRecordsNumbers = 50;
$totalRecords = DBUtil::getRecordCountToQuery($query);
$pageRecords = DBUtil::getRecordsByPage($query, $pageNumber, $maxRecordsNumbers);
$pagingDAO = new PagingDAO($pageNumber, $scriptFunction, $totalRecords);
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
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
		<div align="center" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging($maxRecordsNumbers);?>
		</div>
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
	</div>
	<div id="row">
		<div style="width: 15%;" id="tdHeader">
      		<input type="checkbox" id="checkAll" onclick="checkAll('delete[]')" title="Marcar Todos"/>
      		<input type="button" value="Eliminar" onclick="doDelete('<?php echo $pageNumber;?>', 'delete[]');"/>
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Nombre
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		C&eacute;dula
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Departamento
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Cargo
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Especialidad
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Ver PDF
    	</div>
	</div>
	<?php
		foreach ($pageRecords as $row){
	?>
		<div id="row">
			<div id="tdElement">
				<input type="checkbox" name="delete[]" value="<?php echo $row["id"];?>"/>
			</div>
			<div id="tdElement">
				<?php echo $row["nombre"]." ".$row["apellido"];?>
			</div>
			<div id="tdElement">
				<?php echo $row["ci"];?>
			</div>
			<div id="tdElement">
				<?php echo $row["departamento"];?>
			</div>
			<div id="tdElement">
				<?php echo $row["cargo"];?>
			</div>
			<div id="tdElement">
				<?php echo $row["especialista_en"];?>
			</div>
			<div id="tdElement">
				<a href="#" onclick="openPopUp('buildCVPDF.php?id=<?php echo $row["id"];?>')"><img src="../images/icons/pdfExport.png" border="0"/></a>
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
		<div align="center" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging($maxRecordsNumbers);?>
		</div>
		<div id="tdElement">
		</div>
		<div id="tdElement">
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