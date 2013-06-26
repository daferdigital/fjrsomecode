<?php
header('Content-Type: text/html; charset=ISO-8859-1');
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/PagingDAO.php';

$pageNumber = $_POST[Constants::$PAGE_NUMBER];
$scriptFunction = $_POST[Constants::$SCRIPT_FUNCTION];

//obtenemos el extra where
$extraWhere = "";
if($_POST["cedula"] != ""){
	$extraWhere .= " AND ac.cedula LIKE ('%".$_POST["cedula"]."%')";
}

$query = "SELECT * "
." FROM alumno_constancia ac "
." WHERE 1 = 1"
.$extraWhere
." ORDER BY ac.nombre";

$maxRecordsNumbers = 50;
$totalRecords = DBUtil::getRecordCountToQuery($query);
$pageRecords = DBUtil::getRecordsByPage($query, $pageNumber, $maxRecordsNumbers);
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
		<div align="center" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging($maxRecordsNumbers);?>
		</div>
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
	</div>
	<div id="row">
		<div style="width: 15%;" id="tdHeader">
      		C&eacute;dula
    	</div>
    	<div style="width: 30%;" id="tdHeader">
      		Nombre
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Trimestre
    	</div>
    	<div style="width: 30%;" id="tdHeader">
      		Horario
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
				<?php echo $row["cedula"];?>
			</div>
			<div id="tdElement">
				<?php echo $row["nombre"];?>
			</div>
			<div id="tdElement">
				<?php echo $row["trimestre"];?>
			</div>
			<div id="tdElement">
				<?php echo $row["horario"];?>
			</div>
			<div id="tdElement">
				<a href="#" onclick="openPopUp('buildConstanciaPDF.php?id=<?php echo $row["cedula"];?>')">
					<img src="./images/icons/pdfExport.png" border="0"/>
				</a>
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
		<div align="center" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging($maxRecordsNumbers);?>
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