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

$recordId = $_GET["id"];

PageAccess::validateAccess(Constants::$OPCION_LOGS_SISTEMA);
BitacoraDAO::registrarComentario("Buscando detalle de registro de log tecnico con id[".$recordId."]");

$query = "SELECT sl.*, u.nombre, u.apellido"
." FROM system_log sl LEFT JOIN usuarios u ON u.id = sl.id_usuario"
." WHERE sl.id=".$recordId;

$dbUtil = new DBUtil();
$result = $dbUtil->executeSelect($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<div style="padding: 10px; width: 450px;" class="centered">
	<table class="borderCollapse">
		<tr>
			<td>Fecha:</td>
			<td><?php echo $result[0]["fecha"];?></td>
		</tr>
		<tr>
			<td>Usuario:</td>
			<td><?php echo $result[0]["nombre"]." ".$result[0]["apellido"];?></td>
		</tr>
		<tr>
			<td>Error?:</td>
			<td><?php echo $result[0]["was_error"] == 0 ? "No" : "S&iacute;";?></td>
		</tr>
		<tr>
			<td>Consulta:</td>
			<td><?php echo $result[0]["query"];?></td>
		</tr>
		<tr>
			<td>Resultado:</td>
			<td><?php echo $result[0]["result"];?></td>
		</tr>
	</table>	
</div>
</body>
</html>