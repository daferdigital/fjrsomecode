<?php
//busqueda avanzada
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

$editPage = "editUser.php";
$pageNumber = $_POST[Constants::$PAGE_NUMBER];
$scriptFunction = $_POST[Constants::$SCRIPT_FUNCTION];

//obtenemos el extra where
$extraWhere = "";
if($_POST["tipoUsuario"] != "0"){
	$extraWhere .= " AND u.id_tipo_usuario >= '".$_POST["tipoUsuario"]."'";
}
if($_POST["nombre"] != ""){
	$extraWhere .= " AND LOWER(u.nombre) LIKE LOWER('%".$_POST["nombre"]."%')";
}
if($_POST["apellido"] != ""){
	$extraWhere .= " AND LOWER(u.apellido) LIKE LOWER('%".$_POST["apellido"]."%')";
}
if($_POST["ci"] != ""){
	$extraWhere .= " AND LOWER(u.cedula) LIKE LOWER('%".$_POST["cedula"]."%')";
}

$query = "SELECT u.nombre, u.apellido, u.cedula, u.email, tu.nombre as tipoUsuario "
." FROM tipo_usuario tu, usuarios u"
." WHERE tu.id = u.id_tipo_usuario"
.$extraWhere
." ORDER BY LOWER(u.nombre), LOWER(u.apellido)";

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
		<div style="width: 10%;" id="tdHeader">
      		&nbsp;
    	</div>
		<div style="width: 25%;" id="tdHeader">
      		Nombre
    	</div>
    	<div style="width: 15%;" id="tdHeader">
      		Tipo de Usuario
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		C&eacute;dula
    	</div>
    	<div style="width: 10%;" id="tdHeader">
      		Email
    	</div>
	</div>
	<?php
		foreach ($pageRecords as $row){
	?>
		<div id="row">
			<div style="width: 10%;" id="tdElement">
				<a href="#" onclick="javascript:loadAjaxPopUp('ajax/<?php echo $editPage;?>?id=<?php echo $row["id"];?>&isAdv=1')">
					<img alt="ver" title="Editar" src="imagenes/pageEdit.png" border="0" style="display: inline;"/>
				</a>
			</div>
			<div style="width: 25%;" id="tdElement">
	      		<?php echo $row["nombre"]." ".$row["apellido"]?>
	    	</div>
	    	<div style="width: 10%;" id="tdElement">
	      		<?php echo $row["tipoUsuario"]?>
	    	</div>
	    	<div style="width: 15%;" id="tdElement">
	      		<?php echo $row["cedula"]?>
	    	</div>
	    	<div style="width: 10%;" id="tdElement">
	      		<?php echo $row["email"]?>
	    	</div>
		</div>
	<?php
		}
}
?>
</div>
</body>
</html>