<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("includes/header.php");

PageAccess::validateAccess(Constants::$OPCION_LOGS_TRANSACCIONES);

$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
BitacoraDAO::registrarComentario("Acceso a modulo de log de transacciones del sistema: ".$userDTO->getNombreCompleto());
?>

<div class="seccionTitle">
	Logs de transacciones
</div>

<div class="seccionDetail">
    <table width="60%">
    	<tr>
    		<td>
    			Usuario que realizo la transacci&oacute;n:
    		</td>
    		<td>
    			<select id="usuario">
    				<option value="-1">Todos</option>
					<?php
						$allUsers = UsuarioDAO::getAllActiveUsers();
						foreach ($allUsers as $userDTO){
					?>
							<option value="<?php echo $userDTO->getId()?>">
								<?php echo $userDTO->getNombreCompleto()?>
							</option>
					<?php
						} 
					?>
				</select>
    		</td>
    	</tr>
    	<tr>
    		<td class="title Estilo17">
    			Desde:
    		</td>
    		<td>
    			<input type="text" id="fechaDesde" name="fechaDesde" size="25" readonly="readonly"/>
			
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
    			<input type="text" id="fechaHasta" name="fechaHasta" size="25" readonly="readonly"/>
			
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
    		<td class="title Estilo17">
    			Detalle de la transacci&oacute;n:
    		</td>
    		<td>
    			<input type="text" id="operacion" name="operacion" size="25"/>
      		</td>
      	</tr>
      	<tr>
    		<td colspan="2" align="right">
    			<input type="button" value="Buscar" onclick="javascript:logBitacoraAjax(1);"/>
    		</td>
    	</tr>
    </table>
</div>

<div style="width: 100%" id="ajaxPageResult">
	&nbsp;
</div>

<?php include_once("includes/footer.php");?>