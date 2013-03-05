<?Php //include("procesos/conexion.php"); sleep(2);
session_start();include("procesos/conexion.php"); //sleep(2);
//$array_lanzadores=dame_array_js("select idequipo,idroster,nombre,efectividad from roster where estatus='1'",'4','_','|');
$array_lanzadores=dame_array_js("select idequipo,idroster,nombre,efectividad from roster where estatus='1' and nombre!='no' order by nombre",'4','_','|');

//echo $array_lanzadores.'<hr>';
?>
<div class="titulo">Registro / Edici&oacute;n de Logros para Fútbol Americano</div>
<form name="logros" id="Formulario" method="post" action="procesos/guardar_logros.php">
    <div id="listado" style=" clear:both;"><?Php include("procesos/listar_logros.php");?></div>
<br>
	<div align="left" class="color_2colum" style="padding-right:40px;"><label class="tit_campos">Logro Nº:</label> <input type="text" name="idlogro" id="idlogro" value="" size="3" readonly="readonly" /> | <label class="tit_campos">Fecha:</label> <input type="text" name="fecha" id="fecha" readonly="readonly" value="<?php echo $_REQUEST['fecha']; ?>" size="10" /> | <label class="tit_campos">Hora:</label> <label id="aqui_hora"></label><img src="imagenes/clock.png" alt="Time" border="0" style="position:absolute;margin:4px 0 0 6px;" id="trigger-test" /></div>
	<table width="" align="left" cellpadding="4px" cellspacing="0">
    	
        <tr>
          <td colspan="2" class="" align="right">
   	  <table width="100%" cellspacing="0" cellpadding="4" class="logros_tabla">
      			<tr class="titulo_tablas"><td></td><td align="center" colspan="2">Money Line</td><td colspan="2" align="center">Run Line</td>
      			  <td colspan="2" align="center" bgcolor="#000000">Altas y Bajas</td>
      			  <td colspan="2"  align="center" bgcolor="#000000">&nbsp;</td>
   			    </tr>
            	<tr valign="bottom">
                	<td width="200"><label class="tit_campos"><strong>Equipo 1:</strong></label><br /><?php $atributos="name=\'lvisitante\' id=\'lvisitante\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."'",' name="visitante" id="visitante" required="required" ');?></td>
                        <td align="center" width="50"><label class="tit_campos">Logro<br />JC:</label></td><td width="80"><input type="text" name="idapuesta19" id="idapuesta19" value="" size="4" /></td>                        
                        <td width="50">
                        	<input type="radio" value="-2" name="m16" id="idm161" onclick="javascript: document.getElementById('idm172').checked='true';" />
                        	<label class="tit_campos">-</label><br />
                            <input type="radio" value="2" name="m16" id="idm162" onclick="javascript: document.getElementById('idm171').checked='true';" />
                          <label class="tit_campos">+</label>
                            <br />                            
                        </td><td width="80"><input type="text" name="idapuesta16" id="idapuesta16" value="" size="4" /></td>
                        <td width="40" align="center" class="td_left"><label class="tit_campos">Logro<br />
                          AL JC</label></td>
                        <td><input type="text" name="idapuesta41" id="idapuesta41" value="" size="4" /></td>
                        <td class="td_left"><label class="tit_campos">Puntos</br>Juego</label></td>
                        <td><input type="text" name="idapuesta52" id="idapuesta52" value="" size="4" /></td>
                </tr>
                <tr valign="bottom" class="">
                	<td><label class="tit_campos">Ref.:</label>
                	  <br />
               	    <input type="text" value="" name="referenciaA" id="referenciaA" size="3" maxlength="3" required="required" />                	  <br /></td>
                        <td align="center"><label class="tit_campos">Logro<br />
                          MJ:</label></td><td><input type="text" name="idapuesta20" id="idapuesta20" value="" size="4" /></td>                        
                        
                        <td><br />                            
                  </td><td>&nbsp;</td>
                        <td align="center" class="td_left"><label class="tit_campos">Logro<br />
                          BA JC</label></td>
                        <td><input type="text" name="idapuesta42" id="idapuesta42" value="" size="4" /></td>
                        <td class="td_left"><label class="tit_campos">Puntos</br>1er T</label></td>
                        <td><input type="text" name="idapuesta53" id="idapuesta53" value="" size="4" /></td>
                </tr>
                
                <!--
                <?php $atributos="name=\'lvisitante\' id=\'lvisitante\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."'",' name="visitante" id="visitante" required="required" ');?>
                 -->
                <tr valign="top" bgcolor="#ebebeb">
                	<td class="linesep"><label class="tit_campos"><strong>Equipo 2:</strong></label><br /><?php $atributos="name=\'lhome\' id=\'lhome\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."'",' name="home" id="home" required="required" ');?></td>
                        <td align="center" class="linesep"><label class="tit_campos">Logro<br />
                        JC:</label></td><td class="linesep"><input type="text" name="idapuesta21" id="idapuesta21" value="" size="4" /></td>                        
                        <td class="linesep">
                        	<input type="radio" value="-2" name="m17" id="idm171" onclick="javascript: document.getElementById('idm162').checked='true';" />
                        	<label class="tit_campos2">-</label>
                        	<br />
                            <input type="radio" value="2" name="m17" id="idm172" onclick="javascript: document.getElementById('idm161').checked='true';" />
                            <label class="tit_campos2">+</label>
                          <br />                            
                        </td><td class="linesep"><input type="text" name="idapuesta17" id="idapuesta17" value="" size="4"  /></td>
                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">Logro<br />
                          AL MJ</label></td>
                        <td bgcolor="#FFFFFF" class=""><input type="text" name="idapuesta43" id="idapuesta43" value="" size="4" /></td>
                        <td bgcolor="#FFFFFF" class="td_left linesep"><label class="tit_campos">Puntos</br>Runline JC</label></td>
                  <td bgcolor="#FFFFFF" class="linesep"><input type="text" name="vm16" id="vm16" value="" size="4" maxlength="4" onkeyup="javascript:jQuery('#vm17').val(this.value);" />
                  <input type="hidden" name="vm17" id="vm17" value="" size="4" maxlength="4" onkeyup="javascript:jQuery('#vm16').val(this.value);" /></td>
                </tr>
                <tr valign="top" bgcolor="#ebebeb" class="">
                	<td><label class="tit_campos">Ref.:</label>
                	  <br />
               	    <input type="text" value="" name="referenciaB" id="referenciaB" size="3" maxlength="3" required="required" />                	  <br /></td>
                        <td align="center"><label class="tit_campos">Logro<br />
                        MJ:</label></td><td><input type="text" name="idapuesta22" id="idapuesta22" value="" size="4" /></td>                        
                        
                        <td><br />                            
                  </td><td>&nbsp;</td>
                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">Logro<br />
                          BA MJ</label></td>
                        <td bgcolor="#FFFFFF"><input type="text" name="idapuesta44" id="idapuesta44" value="" size="4" /></td>
                        <td bgcolor="#FFFFFF" class="td_left">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
            </table>
             <?Php ///if($_SESSION['datos']['tipo']=='1'): ?>
            <div>&nbsp;&nbsp;&nbsp;<label class="tit_campos">El estatus del logro es: </label><select name="estatus" id="estatus"><option value="0">Deshabilitado</option><option value="1">Habilitado</option></select></div>
            <?Php //endif; ?>
   	  </td></tr>
    		<tr>
            	<td>
                	</td>
            </tr>
             
             
             
        <tr><td align="left"><input name="guardar" type="button" class="boton" onClick="javascript:comentario='Complete los campos';validar(document.logros,'logros.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onClick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <script language="javascript">
jQuery(document).ready(function(){ 

	<?Php if($_SESSION['datos']['condicion_esp']=='2'):?>
		jQuery('[type="text"],[type="radio"]').attr('disabled',true);
		jQuery('[required="required"]').attr('disabled',false);
	<?Php elseif($_SESSION['datos']['condicion_esp']=='1'):?>
		jQuery('[required="required"]').attr('disabled',true);
		//jQuery('select').attr('onClick','this.value');
	<?Php endif;?>
	$('[type="text"]').numeric(false, function() {  this.value = ""; this.focus(); });
	//$('[name="idapuesta79"]').numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
	$('[name="vm16"],[name="vm17"],[name="idapuesta52"],[name="idapuesta53"]').numeric({ negative: false }, function() {  this.value = ""; this.focus(); });
	$('#aqui_hora').html('<input type="text" name="hora" id="hora" value="<?php echo date("H:i:00"); ?>" required="required" size="5" />');
});
</script>
    <div style=" clear:both;"></div>
</form>
<script language="javascript">
cadena_hiden='idlogro,idlogro_equipoA,idlogro_equipoB';
categoria_sel="<?php echo $_REQUEST['categoria']; ?>";
liga_sel="<?php echo $_REQUEST['liga']; ?>";
$("#fecha_ld").datepicker();
//$('#tabletwo').tableHover({colClass: 'hover'});
</script>