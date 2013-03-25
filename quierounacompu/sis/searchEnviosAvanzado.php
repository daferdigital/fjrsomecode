<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/EnvioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("includes/header.php");

$seccionTitle = "B&uacute;squeda Avanzada";
$seccionDetail = "(Consulte y actualize la informaci&oacute;n de los envios en cualquier estado)";

PageAccess::validateAccess(Constants::$OPCION_BUSQUEDA_AVANZADA);

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