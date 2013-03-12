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

PageAccess::validateAccess(Constants::$OPCION_ADMIN_REACTIVAR_USUARIO);
BitacoraDAO::registrarComentario("Acceso autorizado al ajax para obtener logs del sistema");

$pageNumber = $_POST[Constants::$PAGE_NUMBER];
$scriptFunction = $_POST[Constants::$SCRIPT_FUNCTION];

//obtenemos el extra where
$extraWhere = "";
if($_POST["usuario"] != "-1"){
	$extraWhere .= " AND u.id=".$_POST["usuario"];	
}
if($_POST["fechaDesde"] != ""){
	$extraWhere .= " AND sl.fecha >= '".$_POST["fechaDesde"]."'";
}
if($_POST["fechaHasta"] != ""){
	$extraWhere .= " AND sl.fecha <= '".$_POST["fechaHasta"]."'";
}
if($_POST["query"] != ""){
	$extraWhere .= " AND LOWER(sl.query) LIKE LOWER('".$_POST["query"]."')";
}
if(isset($_POST["justErrors"])){
	$extraWhere .= " AND LOWER(sl.was_error) = '".$_POST["justErrors"]."'";
}

$query = "SELECT sl.*, u.nombre, u.apellido"
." FROM system_log sl LEFT JOIN usuarios u ON u.id = sl.id_usuario"
." WHERE 1 = 1"
.$extraWhere
." ORDER BY fecha DESC";

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
		<div id="tdElement">
		</div>
		<div id="tdElement">
		</div>
	</div>
	<div id="row">
		<div style="width: 15%;" id="tdHeader">
      		Fecha
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Usuario
    	</div>
    	<div style="width: 30%;" id="tdHeader">
      		Consulta
    	</div>
    	<div style="width: 30%;" id="tdHeader">
      		Resultado
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Error?
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
			<div style="width: 30%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["query"];?>
				</span>
			</div>
			<div style="width: 30%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["result"];?>
				</span>
			</div>
			<div style="width: 10%;" id="tdElement">
				<?php echo $row["was_error"];?>
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