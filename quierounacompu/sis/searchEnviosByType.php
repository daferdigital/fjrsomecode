<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/EnvioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("includes/header.php");

$seccionTitle = "";
$seccionDetail = "";
$type = -1;

if(isset($_GET["type"])){
	$type = $_GET["type"];
}

//es una busqueda por tipo, vemos cual
if($type == EnvioDAO::$COD_STATUS_ENVIADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_ENVIADO);
	$seccionTitle = "Envios con estado \"Enviado\"";
	$seccionDetail = "(Consulte y actualize la informaci&oacute;n de los envios con status \"Enviado\")";
} else if($type == EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PAGOS_NO_ENCONTRADOS);
	$seccionTitle = "Envios con estado \"Pago No Encontrado\"";
	$seccionDetail = "(Consulte y actualize la informaci&oacute;n de los envios con status \"Pago no Encontrado\")";	
} else if($type == EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PAGOS_CONFIRMADOS);
	$seccionTitle = "Envios con estado \"Pago Confirmado\"";
	$seccionDetail = "(Consulte y actualize la informaci&oacute;n de los envios con status \"Pago Confirmado\")";
} else if($type == EnvioDAO::$COD_STATUS_NOTIFICADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_NOTIFICADOS);
	$seccionTitle = "Envios con estado \"Notificado\"";
	$seccionDetail = "(Consulte y actualize la informaci&oacute;n de los envios con status \"Notificado\")";
} else if($type == EnvioDAO::$COD_STATUS_FACTURADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_FACTURADO);
	$seccionTitle = "Envios con estado \"Facturado\"";
	$seccionDetail = "(Consulte y actualize la informaci&oacute;n de los envios con status \"Facturado\")";
} else if($type == EnvioDAO::$COD_STATUS_PRESUPUESTADO){
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_PRESUPUESTADO);
	$seccionTitle = "Envios con estado \"Presupuestado\"";
	$seccionDetail = "(Consulte y actualize la informaci&oacute;n de los envios con status \"Presupuestado\")";
}

$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
BitacoraDAO::registrarComentario("Acceso a modulo de busqueda de ".$seccionTitle.": ".$userDTO->getNombreCompleto());
?>

<div class="seccionTitle">
	<?php echo $seccionTitle;?>
	<br />
	<span>
		<?php echo $seccionDetail;?>
	</span>
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