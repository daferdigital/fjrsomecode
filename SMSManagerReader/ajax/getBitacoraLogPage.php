<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/PageAccess.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/ModuloDAO.php';
include_once '../classes/UsuarioDAO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../classes/PagingDAO.php';
include_once '../includes/session.php';

PageAccess::validateAccess(Constants::$OPCION_LOGS_TRANSACCIONES);
BitacoraDAO::registrarComentario("Acceso autorizado al ajax para obtener logs de actividades del sistema");

$pageNumber = $_POST[Constants::$PAGE_NUMBER];
$scriptFunction = $_POST[Constants::$SCRIPT_FUNCTION];

//obtenemos el extra where
$extraWhere = "";
if($_POST["usuario"] != "-1"){
	$extraWhere .= " AND u.id=".$_POST["usuario"];	
}
if($_POST["fechaDesde"] != ""){
	$extraWhere .= " AND b.fecha >= '".$_POST["fechaDesde"]."'";
}
if($_POST["fechaHasta"] != ""){
	$extraWhere .= " AND b.fecha <= '".$_POST["fechaHasta"]."'";
}
if($_POST["operacion"] != ""){
	$extraWhere .= " AND LOWER(b.operacion) LIKE LOWER('%".$_POST["operacion"]."%')";
}

$query = "SELECT b.*, u.nombre, u.apellido"
." FROM bitacora b LEFT JOIN usuarios u ON u.id = b.id_usuario"
." WHERE 1 = 1"
.$extraWhere
." ORDER BY b.fecha DESC";

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
		<div id="tdElement">
		</div>
		<div align="center" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging();?>
		</div>
	</div>
	<div id="row">
		<div style="width: 15%;" id="tdHeader">
      		Fecha
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Usuario
    	</div>
    	<div style="width: 70%;" id="tdHeader">
      		Transacci&oacute;n
    	</div>
	</div>
	<?php
		foreach ($pageRecords as $row){
	?>
		<div id="row">
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["fecha"];?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["nombre"]." ".$row["apellido"];?>
			</div>
			<div style="width: 70%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["operacion"];?>
				</span>
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
			<?php echo $pagingDAO->getTRFooterPaging();?>
		</div>
	</div>
<?php 
}
?>
</div>
</body>
</html>