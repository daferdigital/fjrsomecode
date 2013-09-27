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
if($_POST["grado"] != ""){
	$extraWhere .= " AND LOWER(g.grado) LIKE('%".strtolower($_POST["grado"])."%')";
}

$query = "SELECT g.id AS idGrado, g.turno, g.grado, g.id_profesor, p.nombre, p.apellido, p.cedula"
." FROM grados g, profesores p"
." WHERE g.id_profesor = p.id "
.$extraWhere
." ORDER BY g.grado, g.turno, p.nombre, p.apellido, p.cedula";

//echo $query."<br />	";

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
		<div id="tdElement" style="width: 10%;">
		</div>
		<div id="tdElement" style="width: 30%;">
		</div>
		<div align="left" id="tdElement" style="width: 15%;">
			<?php echo $pagingDAO->getTRFooterPaging();?>
		</div>
		<div id="tdElement" style="width: 10%;">
		</div>
	</div>
	<div id="row">
		<div id="tdHeader">
      		<input type="checkbox" id="checkAll" onclick="checkAll('delete[]')" title="Marcar Todos"/>
      		<input type="button" value="Eliminar" onclick="doDelete('alumnos', 'delete[]');"/>
    	</div>
    	<div id="tdHeader">
      		Grado
    	</div>
    	<div id="tdHeader">
      		Profesor
    	</div>
    	<div id="tdHeader">
    		Modificar?
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
				<?php echo $row["grado"]." (".$row["turno"].")";?>
			</div>
			<div id="tdElement">
				<?php echo $row["nombre"]." ".$row["apellido"]." (".$row["cedula"].")";?>
			</div>
			<div id="tdElement">
				<a href="formUpdateGrado.php?id=<?php echo $row["idGrado"];?>">
					<img src="./images/icons/edit.gif" title="Modificar Registro" border="0" />
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