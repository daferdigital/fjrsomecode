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

$query = "SELECT * FROM system_log"
." WHERE 1 = 1"
." ORDER BY fecha DESC";

$totalRecords = DBUtil::getRecordCountToQuery($query);
$pageRecords = DBUtil::getRecordsByPage($query, $pageNumber);

$pagingDAO = new PagingDAO($pageNumber, $scriptFunction, $totalRecords);

if(count($pageRecords) == 0){
	//no se obtuvieron registros para los criterios de busqueda
?>
	<span class="centered smallError">
		<?php echo Constants::$TEXT_NO_PAGE_RECORDS;?>
	</span>
<?php
} else {
?>
	<table>
		<tr>
			<td width="100%">
				<?php echo $pagingDAO->getTRFooterPaging();?>
			</td>
		</tr>
	</table>
<?php
}
?>