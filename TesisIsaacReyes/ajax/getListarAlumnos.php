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
	$extraWhere .= " AND LOWER(a.nombre) LIKE('%".strtolower($_POST["nombre"])."%')";	
}
if($_POST["apellido"] != ""){
	$extraWhere .= " AND LOWER(a.apellido) LIKE('%".strtolower($_POST["apellido"])."%')";
}
if($_POST["cedula"] != ""){
	$extraWhere .= " AND a.cedula LIKE('%".$_POST["cedula"]."%')";
}
if($_POST["activo"] != ""){
	$extraWhere .= " AND a.activo = '".$_POST["activo"]."'";
}

//$query = "SELECT DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW()) - TO_DAYS(a.fecha_nacimiento)), '%Y') + 0 AS edad, a.* "
$query = "SELECT a.* "
." FROM alumnos a"
." WHERE 1 = 1 "
.$extraWhere
." ORDER BY a.nombre, a.apellido, a.cedula, a.fecha_nacimiento DESC";

//echo $query."<br />	";

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
	</div>
	<div id="row">
		<div style="width: 10%;" id="tdHeader">
      		<input type="checkbox" id="checkAll" onclick="checkAll('delete[]')" title="Marcar Todos"/>
      		<input type="button" value="Eliminar" onclick="doDelete('alumnos', 'delete[]');"/>
    	</div>
    	<div style="width: 35%;" id="tdHeader">
      		Nombre
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		C&eacute;dula
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Edad
    	</div>
    	<div style="width: 15%;" id="tdHeader">
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
			<div style="width: 35%;" id="tdElement">
				<?php echo $row["nombre"]." ".$row["apellido"].($row["activo"] == "0" ? " (Retirado)" : "");?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php echo $row["cedula"];?>
			</div>
			<div style="width: 10%;" id="tdElement">
				<?php
					$age = floor((strtotime(date('Y-m-d')) - strtotime($row["fecha_nacimiento"])) / 31556926);
					echo $age;
				?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<?php 
					if($row["activo"] == "1"){
				?>
					<a href="formUpdatePersonal.php?id=<?php echo $row["id"];?>">
						<img src="./images/icons/edit.gif" title="Modificar Registro" border="0" />
					</a>
				<?php 
					}
				?>
			</div>
			<div style="width: 15%;" id="tdElement">
				<a href="#" onclick="openPopUp('fichaPDF.php?id=<?php echo $row["id"];?>')">
					<img src="./images/icons/pdfExport.png" title="Exportar a PDF" border="0" />
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