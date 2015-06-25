<?Php session_start();include("procesos/conexion.php"); //sleep(2);
$array_lanzadores=dame_array_js("select idequipo,idroster,nombre,efectividad from roster where estatus='1' and nombre!='no' order by nombre",'4','_','|');

//echo $array_lanzadores.'<hr>';
?>
<div class="titulo">Registro / Edici&oacute;n de Logros para Basket</div>
<form name="logros" id="Formulario" method="post" action="procesos/guardar_logros.php">
	<div align="left" class="color_2colum" style="padding-right:40px;"><label class="tit_campos">Logro Nº:</label> <input type="text" name="idlogro" id="idlogro" value="" size="3" readonly="readonly" /> | <label class="tit_campos">Fecha:</label> <input type="text" name="fecha" id="fecha" readonly="readonly" value="<?php echo $_REQUEST['fecha']; ?>" size="10" /> | <label class="tit_campos">Hora:</label> <label id="aqui_hora"></label><img src="imagenes/clock.png" alt="Time" border="0" style="position:absolute;margin:4px 0 0 6px;" id="trigger-test" /></div>
	<table width="" align="left" cellpadding="4px" cellspacing="0">
    	
        <tr>
          <td colspan="2" class="" align="right">
   	  <table width="100%" cellspacing="0" cellpadding="4" class="logros_tabla">
      			<tr class="titulo_tablas"><td></td><td align="center" colspan="2">A Ganar</td>
      			<td align="center" colspan="2">Run Line</td>
      			<td colspan="2" align="center" bgcolor="#000000">Altas y Bajas</td><td colspan="2" align="center" bgcolor="#000000">Puntos</td></tr>
            	<tr valign="bottom">
                	<td width="200"><label class="tit_campos"><strong>Visitante:</strong></label><br /><?php $atributos="name=\'lvisitante\' id=\'lvisitante\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."' order by nombre",' name="visitante" id="visitante" required="required" onchange=""');?></td>
                        <td align="center" width="50" class="td_left"><label class="tit_campos">Logro<br />JC:</label></td><td width="80"><input type="text" name="idapuesta56" id="idapuesta56" value="" size="4" /></td>                        
                        <td width="80" valign="top" align="center" class="td_left">
                        	<label class="tit_campos">-</label><input type="radio" checked="checked" value="-2" name="m60" id="idm601" onclick="javascript: document.getElementById('idm612').checked='true';" /><label class="tit_campos">+</label><input type="radio" value="2" name="m60" id="idm602" onclick="javascript: document.getElementById('idm611').checked='true';" /><br />
                            <input type="text" value="" size="3" maxlength="4" name="vm60" id="vm60" onkeyup="javascript:jQuery('#vm61').val(this.value);" />
                        </td><td width="80"><input type="text" name="idapuesta60" id="idapuesta60" value="-110" size="4" /></td>
                        
                        <td align="center" width="40" class="td_left"><label class="tit_campos">A JC</label></td><td><input type="text" name="idapuesta64" id="idapuesta64" value="-110" size="4" /></td>
                        <td class="td_left"><label class="tit_campos">Puntos JC</label></td><td><input type="text" name="idapuesta68" id="idapuesta68" value="" size="4" /></td>
                </tr>
                <tr valign="bottom" class="">
                	<td class="linesep"><label class="tit_campos">Ref.:</label><br /><input type="text" value="" name="referenciaA" id="referenciaA" size="3" maxlength="4" required="required" />
                    	</td>
                        <td align="center" class="linesep td_left"><!--<label class="tit_campos">Logro<br />
                          1M:</label>-->Run Line MJ</td><td class="linesep"><div style="display:inline;"><input type="text" name="idapuesta57" id="idapuesta57" value="" size="4" /></div></td>                        
                        
                        <td align="center" class="linesep td_left">
                        	<label class="tit_campos">-</label><input type="radio" value="-2" checked="checked" name="m62" id="idm621" onclick="javascript: document.getElementById('idm632').checked='true';" /><label class="tit_campos">+</label><input type="radio" value="2" name="m62" id="idm622" onclick="javascript: document.getElementById('idm631').checked='true';" /><br /><input type="text" value="" size="3" maxlength="4" name="vm62" id="vm62" onkeyup="javascript:jQuery('#vm63').val(this.value);" />
                            
                            
                        </td><td class="linesep"><input type="text" name="idapuesta62" id="idapuesta62" value="-110" size="4" /></td>
                        <td align="center" class="td_left"><label class="tit_campos">B JC</label></td><td><input type="text" name="idapuesta65" id="idapuesta65" value="-110" size="4" /></td>
                        <td class="td_left"><label class="tit_campos">Puntos 1M</label></td><td><input type="text" name="idapuesta69" id="idapuesta69" value="" size="4" /></td>
                </tr>
                <tr valign="bottom" bgcolor="#ebebeb">
                  <td bgcolor="#FFFFFF" class="linesep">&nbsp;</td>
                  <td align="center" bgcolor="#FFFFFF" class="linesep td_left">Logro Alternativo<!--<span class="tit_campos">Logro<br />
                  Alternativo</span>--></td>
                  <td bgcolor="#FFFFFF" class="linesep"><div style="display:none;"><input type="text" name="idapuesta82" id="idapuesta82" value="" size="4" /></div></td>
                  <td align="center" bgcolor="#FFFFFF" class="linesep td_left">
                  
                  <label class="tit_campos">-</label><input type="radio" value="-2" checked="checked" name="m84" id="idm841" onclick="javascript: document.getElementById('idm852').checked='true';" /><label class="tit_campos">+</label><input type="radio" value="2" name="m84" id="idm842" onclick="javascript: document.getElementById('idm851').checked='true';" /><br /><input type="text" value="" size="3" maxlength="4" name="vm84" id="vm84" onkeyup="javascript:jQuery('#vm85').val(this.value);" />
                  </td>
                  <td valign="bottom" bgcolor="#FFFFFF" class="linesep">
                  <input type="text" name="idapuesta84" id="idapuesta84" value="" size="4" /></td>
                  <td align="center" bgcolor="#FFFFFF" class="td_left linesep"><label class="tit_campos">A 1M</label></td>
                  <td bgcolor="#FFFFFF" class="linesep"><input type="text" name="idapuesta66" id="idapuesta66" value="-110" size="4" /></td>
                  <td bgcolor="#FFFFFF" class="td_left"><!--<label class="tit_campos">Puntos 2M</label>--></td>
                  <td bgcolor="#FFFFFF"><div style="display:none;"><input type="text" name="idapuesta94" id="idapuesta94" value="" size="4" /></div></td>
          </tr>
                <tr valign="bottom" bgcolor="#ebebeb">
                	<td class="linesep"><label class="tit_campos"><strong>Home Club:</strong></label><br /><?php $atributos="name=\'lhome\' id=\'lhome\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."'  order by nombre",' name="home" id="home" required="required" onchange=""');?></td>
                        <td align="center" class="linesep td_left"><label class="tit_campos">Logro<br />
                        JC:</label></td><td class="linesep"><input type="text" name="idapuesta58" id="idapuesta58" value="" size="4" /></td>                        
                        <td class="linesep td_left" align="center">
                        	<label class="tit_campos2">-</label><input type="radio" checked="checked" value="-2" name="m61" id="idm611" onclick="javascript: document.getElementById('idm602').checked='true';"  /><label class="tit_campos2">+</label><input type="radio" value="2" name="m61" id="idm612" onclick="javascript: document.getElementById('idm601').checked='true';"  /><br />
                            <input type="text" value="" size="3" maxlength="4" name="vm61" id="vm61" onkeyup="javascript:jQuery('#vm60').val(this.value);" />
                        </td><td class="linesep" valign="bottom"><input type="text" name="idapuesta61" id="idapuesta61" value="-110" size="4" /></td>
                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">B 1M</label></td>
                        <td bgcolor="#FFFFFF" class=""><input type="text" name="idapuesta67" id="idapuesta67" value="-110" size="4" /></td>
                        <td bgcolor="#FFFFFF" class="td_left" ></td><td bgcolor="#FFFFFF"><br /></td>
                </tr>
                <tr valign="bottom" bgcolor="#ebebeb" class="">
                	<td class="linesep"><label class="tit_campos">Ref.:</label><br /><input type="text" value="" name="referenciaB" id="referenciaB" size="3" maxlength="4" required="required" />
                    	</td>
                        <td align="center" class="linesep td_left"><!--<label class="tit_campos">Logro<br />
                        1M</label>-->
                        Run Line MJ</td><td class="linesep"><div style="display:inline;"><input type="text" name="idapuesta59" id="idapuesta59" value="" size="4" /></div></td>                        
                        
                        <td align="center" class="linesep td_left">
                        	<label class="tit_campos">-</label><input type="radio" checked="checked" value="-2" name="m63" id="idm631" onclick="javascript: document.getElementById('idm622').checked='true';"  /><label class="tit_campos">+</label><input type="radio" value="2" name="m63" id="idm632" onclick="javascript: document.getElementById('idm621').checked='true';"  /><br /><input type="text" value="" size="3" maxlength="4" name="vm63" id="vm63" onkeyup="javascript:jQuery('#vm62').val(this.value);" />
                        </td><td class="linesep"><input type="text" name="idapuesta63" id="idapuesta63" value="-110" size="4" /></td>
                        <td align="center" bgcolor="#FFFFFF" class="td_left linesep"><div style="display:none;"><label class="tit_campos">A 2M</label></div></td>
                        <td bgcolor="#FFFFFF" class="linesep"><div style="display:none;"><input type="text" name="idapuesta92" id="idapuesta92" value="" size="4" /></div></td>
                        <td bgcolor="#FFFFFF"  class="td_left"></td><td bgcolor="#FFFFFF" class=""></td>
                </tr>
                <tr valign="bottom" bgcolor="#ebebeb" class="">
                  <td class="linesep">&nbsp;</td>
                  <td align="center" class="linesep td_left"><!--Logro<br />
                  <span class="tit_campos">Alternativo</span>-->Logro Alternativo</td>
                  <td class="linesep"><div style="display:none;"><input type="text" name="idapuesta83" id="idapuesta83" value="" size="4" /></div></td>
                  <td align="center" class="linesep td_left">                  
                  <label class="tit_campos">-</label><input checked="checked" type="radio" value="-2" name="m85" id="idm851" onclick="javascript: document.getElementById('idm842').checked='true';" /><label class="tit_campos">+</label>
                  <input type="radio" value="2" name="m85" id="idm852" onclick="javascript: document.getElementById('idm841').checked='true';" /><br /><input type="text" value="" size="3" maxlength="4" name="vm85" id="vm85" onkeyup="javascript:jQuery('#vm84').val(this.value);" />
                  
                  </td>
                  <td class="linesep"><input type="text" name="idapuesta85" id="idapuesta85" value="" size="4" /></td>
                  <td align="center" bgcolor="#FFFFFF" class="td_left"><div style="display:none;"><label class="tit_campos">B 2M</label></div></td>
                  <td bgcolor="#FFFFFF"><div style="display:none;"><input type="text" name="idapuesta93" id="idapuesta93" value="" size="4" /></div></td>
                  <td bgcolor="#FFFFFF"  class="td_left"></td>
                  <td bgcolor="#FFFFFF" class=""></td>
                </tr>
            </table>
            
             <?Php if($_SESSION['datos']['tipo']=='1'): ?>
            <div>&nbsp;&nbsp;&nbsp;<label class="tit_campos">El estatus del logro es: </label><select name="estatus" id="estatus"><option value="0">Deshabilitado</option><option value="1">Habilitado</option></select></div>
            <?Php endif; ?>
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
	$('[name="vm60"],[name="vm62"],[name="vm84"],[name="vm61"],[name="vm63"],[name="vm85"],[name="idapuesta68"],[name="idapuesta69"],[name="idapuesta94"]').numeric({ negative: false }, function() {  this.value = ""; this.focus(); });
	$('#aqui_hora').html('<input type="text" name="hora" id="hora" value="<?php echo date("H:i:00"); ?>" required="required" size="5" />');
});
</script>
    <div id="listado" style=" clear:both;">
      <?Php
            include("procesos/listar_logros.php");
       ?>
    </div>
</form>
<script language="javascript">
cadena_hiden='idlogro,idlogro_equipoA,idlogro_equipoB';
categoria_sel="<?php echo $_REQUEST['categoria']; ?>";
liga_sel="<?php echo $_REQUEST['liga']; ?>";
$("#fecha_ld").datepicker();
//$('#tabletwo').tableHover({colClass: 'hover'});
</script>