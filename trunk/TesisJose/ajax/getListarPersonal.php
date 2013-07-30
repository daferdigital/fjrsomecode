<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/UsuarioDAO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../classes/PagingDAO.php';

session_start();

$pageNumber = $_POST[Constants::$PAGE_NUMBER];
$scriptFunction = $_POST[Constants::$SCRIPT_FUNCTION];

//obtenemos el extra where
$extraWhere = "";
if($_POST["nombre"] != ""){
	$extraWhere .= " AND LOWER(p.nombre) LIKE('%".strtolower($_POST["nombre"])."%')";	
}
if($_POST["apellido"] != ""){
	$extraWhere .= " AND LOWER(p.apellido) LIKE('%".strtolower($_POST["apellido"])."%')";
}
if($_POST["cedula"] != ""){
	$extraWhere .= " AND p.cedula LIKE('%".$_POST["cedula"]."%')";
}
if($_POST["cargo"] != ""){
	$extraWhere .= " AND p.id_cargo = ".$_POST["cargo"];
}

$query = "SELECT p.*, c.nombre AS cargo"
." FROM personal p, cargo c"
." WHERE p.id_cargo = c.id "
.$extraWhere
." ORDER BY p.cedula DESC";

$totalRecords = DBUtil::getRecordCountToQuery($query);
$pageRecords = DBUtil::getRecordsByPage($query, $pageNumber);
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
		<div align="center" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging();?>
		</div>
		<div id="tdElement">
		</div>
	</div>
	<div id="row">
		<div style="width: 25%;" id="tdHeader">
      		Nombre
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		C&eacute;dula
    	</div>
    	<div style="width: 70%;" id="tdHeader">
      		Cargo
    	</div>
	</div>
	<?php
		foreach ($pageRecords as $row){
	?>
		<div id="row">
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["nombre"]." ".$row["apellido"];?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["cedula"];?>
			</div>
			<div style="width: 70%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["cargo"];?>
				</span>
			</div>
		</div>
	<?php
		}
	?>
	<div id="row">
		<div id="tdElement">
		</div>
		<div align="center" id="tdElement">
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