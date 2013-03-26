<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/EnvioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("includes/header.php");

$seccionTitle = "";
$type = -1;

if(isset($_GET["type"])){
	$type = $_GET["type"];
}

//es una busqueda por tipo, vemos cual
if($type == EnvioDAO::$COD_STATUS_ENVIADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_ENVIADO);
	$seccionTitle = "Envios con estado \"Enviado\"";
} else if($type == EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PAGOS_NO_ENCONTRADOS);
	$seccionTitle = "Envios con estado \"Pago No Encontrado\"";
} else if($type == EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PAGOS_CONFIRMADOS);
	$seccionTitle = "Envios con estado \"Pago Confirmado\"";
} else if($type == EnvioDAO::$COD_STATUS_NOTIFICADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_NOTIFICADOS);
	$seccionTitle = "Envios con estado \"Notificado\"";
} else if($type == EnvioDAO::$COD_STATUS_FACTURADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_FACTURADO);
	$seccionTitle = "Envios con estado \"Facturado\"";
} else if($type == EnvioDAO::$COD_STATUS_PRESUPUESTADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PRESUPUESTADO);
	$seccionTitle = "Envios con estado \"Presupuestado\"";
}

$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
BitacoraDAO::registrarComentario("Acceso a modulo de busqueda de ".$seccionTitle.": ".$userDTO->getNombreCompleto());
?>

<div class="seccionTitle" style="width: 70%">
	<?php echo $seccionTitle;?>
</div>

<div class="seccionDetail">
	<input type="hidden" id="statusEnvio" name="statusEnvio" value="<?php echo $type;?>" />
</div>

<div style="width: 100%" id="ajaxPageResult">
	&nbsp;
</div>

<script>
	searchEnviosAjaxSimple('<?php echo $type;?>');
</script>
<?php include_once 'includes/footer.php';?>