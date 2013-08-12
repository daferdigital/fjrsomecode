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
if($_POST["funcionario"] != ""){
	$extraWhere .= " AND p.id=".$_POST["funcionario"];	
}
if($_POST["tipoSolicitud"] != ""){
	$extraWhere .= " AND pe.id=".$_POST["tipoSolicitud"];
}
if($_POST["fechaSalida"] != ""){
	$extraWhere .= " AND s.fecha_inicio >= '".$_POST["fechaSalida"]."'";
}
if($_POST["fechaLlegada"] != ""){
	$extraWhere .= " AND s.fecha_fin <= DATE_ADD('".$_POST["fechaLlegada"]."', INTERVAL 1 DAY)";
}
if($_POST["activo"] != ""){
	$extraWhere .= " AND s.activo = '".$_POST["activo"]."'";
}

$query = "SELECT s.*, p.nombre AS nombreFuncionario, p.apellido, p.cedula, pe.nombre AS tipoPermiso"
." FROM personal p, solicitud s, permiso pe"
." WHERE s.id_personal = p.id "
." AND s.id_tipo_permiso = pe.id"  
.$extraWhere
." ORDER BY s.fecha_inicio";

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
		<div id="tdElement">
		</div>
		<div align="center" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging();?>
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
      		<input type="button" value="Eliminar" onclick="doDelete('solicitud', 'delete[]');"/>
    	</div>
    	<div style="width: 20%;" id="tdHeader">
      		Nombre
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		C&eacute;dula
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Fecha de Salida
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Fecha de Llegada
    	</div>
    	<div style="width: 10%;" id="tdHeader">
    		Tipo de Permiso
    	</div>
    	<div style="width: 15%;" id="tdHeader">
    	</div>
	</div>
	<?php
		foreach ($pageRecords as $row){
	?>
		<div id="row">
			<div id="tdElement">
				<input type="checkbox" name="delete[]" value="<?php echo $row["id"];?>"/>
			</div>
			<div style="width: 20%;" id="tdElement">
				<?php echo $row["nombreFuncionario"]." ".$row["apellido"];?>
			</div>
			<div style="width: 10%;" id="tdElement">
				<?php echo $row["cedula"];?>
			</div>
			<div style="width: 10%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["fecha_inicio"];?>
				</span>
			</div>
			<div style="width: 10%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["fecha_fin"];?>
				</span>
			</div>
			<div style="width: 10%;" id="tdElement">
				<span id="fixHeigth">
					<?php echo $row["tipoPermiso"];?>
				</span>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php 
					if($row["activo"] == "1"){
				?>
					<a href="formUpdateSolicitud.php?id=<?php echo $row["id"];?>">
						<img src="./images/icons/edit.gif" title="Modificar Registro" border="0" style="display: inline;"/>
					</a>
					&nbsp;&nbsp;&nbsp;&nbsp;
				<?php		
					}
				?>
				<a href="#" onclick="openPopUp('solicitudPDF.php?id=<?php echo $row["id"];?>')">
					<img src="./images/icons/pdfExport.png" title="Exportar a PDF" border="0" style="display: inline;" />
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
		<div id="tdElement">
		</div>
		<div align="center" id="tdElement">
			<?php echo $pagingDAO->getTRFooterPaging();?>
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