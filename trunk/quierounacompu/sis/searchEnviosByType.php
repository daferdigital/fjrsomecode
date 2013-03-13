<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/EnvioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("includes/header.php");

$esBusquedaAvanzada = false;
if(isset($_GET["isAdv"])){
	//
}
PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_NOTIFICADOS);

$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
BitacoraDAO::registrarComentario("Acceso a modulo de busqueda de envios notificados: ".$userDTO->getNombreCompleto());
?>

<div class="seccionTitle">
	Envios Notificados
	<br />
	<span>
		(Consulte y actualize la informaci&oacute;n de los envios con estado "Notificado")
	</span>
</div>

<div class="seccionDetail">
	<input type="hidden" id="statusEnvio" name="statusEnvio" value="<?php echo EnvioDAO::$COD_STATUS_NOTIFICADO;?>" />
    <table width="60%">
    	<tr>
    		<td>
    			Seudonimo de MercadoLibre
    		</td>
    		<td>
    			<input type="text" id="seudonimoML" name="seudonimoML" value=""/>
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