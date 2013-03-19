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

$esBusquedaAvanzada = false;
if(isset($_GET["isAdv"])){
	$esBusquedaAvanzada = true;
	$seccionTitle = "B&uacute;squeda Avanzada";
	$seccionDetail = "(Consulte y actualize la informaci&oacute;n de los envios en cualquier estado)";
}

$type = -1;
if(isset($_GET["type"])){
	$type = $_GET["type"];
}

if(! $esBusquedaAvanzada){
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
} else {
	PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_AVANZADA);
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
	<table width="60%">
    <?php
    	if($esBusquedaAvanzada){
    ?>
    		<tr>
    			<td>
    				Estado del envio:
    			</td>
    			<td>
    				<input type="hidden" name="fromBusquedaAvanzada" id="fromBusquedaAvanzada" value=""/>
    				<select id="statusEnvio" name="statusEnvio">
    					<option value="-1">Todos</option>
    					<?php 
    						$result = EnvioDAO::getAllStatus();
    						foreach ($result as $row){
    					?>
    						<option value="<?php echo $row["id"]?>"><?php echo $row["descripcion"]?></option>
    					<?php
    						}
    					?>
    				</select>
    			</td>
    		</tr>
    <?php	
    	}
    ?>
    	<tr>
    		<td>
    			Seudonimo de MercadoLibre
    		</td>
    		<td>
    		    <?php
    		    if(! $esBusquedaAvanzada){
    		    ?>
    		    	<input type="hidden" id="statusEnvio" name="statusEnvio" value="<?php echo $type;?>" />
    		    <?php
    		    } 
    		    ?>
    			<input type="text" id="seudonimoML" name="seudonimoML" value=""/>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			C.I. RIF
    		</td>
    		<td>
    			<input type="text" id="ciRif" name="ciRif" value=""/>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			N&uacute;mero del vauche:
    		</td>
    		<td>
    			<input type="text" id="boucher" name="boucher" value=""/>
    		</td>
    	</tr>
    	<tr>
    		<td class="title Estilo17">
    			Desde:
    		</td>
    		<td>
    			<input type="text" id="fechaDesde" name="fechaDesde" size="25" readonly="true"/>
			
				<script>
					new JsDatePick({
				        useMode:2,
				        target:"fechaDesde",        
				        isStripped:true,
				       	weekStartDay:0,
				        limitToToday:true,
				        dateFormat:"%Y-%m-%d",
				        imgPath:"../img/"
				    });
				</script>
      		</td>
      	</tr>
      	<tr>
    		<td class="title Estilo17">
    			Hasta:
    		</td>
    		<td>
    			<input type="text" id="fechaHasta" name="fechaHasta" size="25" readonly="true"/>
			
				<script>
					new JsDatePick({
				        useMode:2,
				        target:"fechaHasta",        
				        isStripped:true,
				       	weekStartDay:0,
				        limitToToday:true,
				        dateFormat:"%Y-%m-%d",
				        imgPath:"../img/"
				    });
				</script>
      		</td>
      	</tr>
      	<tr>
    		<td colspan="2" align="right">
    			<input type="button" value="Buscar" onclick="javascript:searchEnviosAjax(1);"/>
    		</td>
    	</tr>
    </table>
</div>

<div style="width: 100%" id="ajaxPageResult">
	&nbsp;
</div>

<?php include_once 'includes/footer.php';?>