<?Php include("procesos/conexion.php"); //sleep(2);
$array_lanzadores=dame_array_js("select idequipo,idroster,nombre,efectividad from roster where estatus='1'",'4','_','|');

//echo $array_lanzadores.'<hr>';
?>
<div class="titulo">Registro / Edici&oacute;n de Logros para Béisbol</div>
<form name="logros" id="Formulario" method="post" action="procesos/guardar_logros_banqueros.php">
<div id="listado" style=" clear:both;">
	   <?Php
            include("procesos/listar_logros_banqueros.php");
       ?>    
   </div>
	<div align="left" class="color_2colum" style="padding-right:40px;"><label class="tit_campos">Logro Nº:</label> <input type="text" name="idlogro" required id="idlogro" value="" size="3" readonly="readonly" /> | <label class="tit_campos">Fecha:</label> <input type="text" name="fecha" id="fecha" readonly="readonly" value="<?php echo $_REQUEST['fecha']; ?>" size="10" /> | <label class="tit_campos">Hora:</label> <input type="text" name="hora" id="hora" value="<?php echo date("H:i:00"); ?>" required="required" size="5" /><img src="imagenes/clock.png" alt="Time" border="0" style="position:absolute;margin:4px 0 0 6px;" id="trigger-test" /></div>
	<table width="" align="" cellpadding="4px" cellspacing="0">
    	
        <tr>
          <td colspan="2" class="" align="right">
   	  <table width="" cellspacing="0" cellpadding="4" class="logros_tabla">
      			<tr class="titulo_tablas"><td>Equipos</td><td align="center" colspan="2">Money Line</td><td colspan="2" align="center">Super Run Line</td><td colspan="2" align="center">Run Line</td><td colspan="2" align="center">Run Line Alt.</td></tr>
            	<tr valign="bottom">
                	<td width="200px"><label class="tit_campos"><strong>Visitante:</strong></label><br /><?php $atributos="name=\'lvisitante\' disabled id=\'lvisitante\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."' order by nombre",' name="visitante" id="visitante" disabled required="required" onchange="dinamico_select(\'dinvisitante\',this.value,\''.$array_lanzadores.'\',\''.$atributos.'\')"');?></td>
                        <td align="center" width="50px" class="td_left"><label class="tit_campos">Logro<br />JC:</label></td><td width="80px"><input type="text" name="idapuesta23" id="idapuesta23" value="" size="4" /></td>                        
                        
                        <!--SUPER RUN LINE-->
                        <td width="50px" class="td_left">
                        	<input type="radio" value="-2.5" name="m47" id="idm471" onclick="javascript: document.getElementById('idm482').checked='true';" />
                        	<label class="tit_campos">-2 &frac12;</label><br />
                            <input type="radio" value="2.5" name="m47" id="idm472" onclick="javascript: document.getElementById('idm481').checked='true';" />
                            <label class="tit_campos">+2 &frac12;</label><br />                            
                        </td><td width="80px"><input type="text" name="idapuesta47" id="idapuesta47" value="" size="4" /></td>
                         <!--RUN LINE-->
                        <td width="50px" class="td_left">
                        	<input type="radio" value="-1.5" name="m27" id="idm271" onclick="javascript: document.getElementById('idm282').checked='true'; jQuery('#idm732').click();" /><label class="tit_campos">-1 &frac12;</label><br />
                            <input type="radio" value="1.5" name="m27" id="idm272" onclick="javascript: document.getElementById('idm281').checked='true'; jQuery('#idm731').click();" /><label class="tit_campos">+1 &frac12;</label><br />                            
                        </td><td width="80px"><input type="text" name="idapuesta27" id="idapuesta27" value="" size="4" /></td>
          <td width="50px" class="td_left">
                        	<input type="radio" value="-1.5" name="m73" id="idm731" onclick="javascript: document.getElementById('idm742').checked='true'; if(jQuery('#idm272').is(':checked')==false){jQuery('#idm272').attr('checked',true);jQuery('#idm272').click();}" /><label class="tit_campos">-1 &frac12;</label><br />
                            <input type="radio" value="1.5" name="m73" id="idm732" onclick="javascript: document.getElementById('idm741').checked='true'; if(jQuery('#idm271').is(':checked')==false){jQuery('#idm271').attr('checked',true);jQuery('#idm271').click();}" /><label class="tit_campos">+1 &frac12;</label><br />                            
                        </td><td width="80px"><input type="text" name="idapuesta73" id="idapuesta73" value="" size="4" /></td>
                </tr>
                <tr valign="bottom" class="linesep">
                	<td class="bnone">
                    	<label class="tit_campos">Lanzador:</label><br /><label id="dinvisitante"><select name="lvisitante" disabled="disabled" required="required"><option value="">Seleccione</option></select></label></td>
                        <td align="center" class="td_left"><label class="tit_campos">Logro<br />
                          MJ:</label></td><td><input type="text" name="idapuesta24" id="idapuesta24" value="" size="4" /></td>                        
                        
                        <!--SUPER RUNLINE-->
                        <td class="td_left">
                        	<!--<input type="radio" value="-1.5" name="m54" id="idm541" onclick="javascript: document.getElementById('idm552').checked='true';" /><label class="tit_campos">-1 &frac12;</label><br />
                            <input type="radio" value="1.5" name="m54" id="idm542" onclick="javascript: document.getElementById('idm551').checked='true';" /><label class="tit_campos">+1 &frac12;</label><br />   -->                         
                        </td><td><!--<input type="text" name="idapuesta54" id="idapuesta54" value="" size="4" />--></td>
                        <!-- RUNLINE-->
                        <td class="td_left">
                        	<input type="radio" value="-0.5" name="m29" id="idm291" onclick="javascript: document.getElementById('idm302').checked='true';" /><label class="tit_campos">-&frac12;</label><br />
                            <input type="radio" value="0.5" name="m29" id="idm292" onclick="javascript: document.getElementById('idm301').checked='true';" /><label class="tit_campos">+&frac12;</label><br />                            
                        </td><td><input type="text" name="idapuesta29" id="idapuesta29" value="" size="4" /></td>
                        
                        <!--RLA-->
          <td class="td_left">
                        	<!--<input type="radio" value="-0.5" name="m75" id="idm751" onclick="javascript: document.getElementById('idm762').checked='true'; if(jQuery('#idm292').is(':checked')==false){jQuery('#idm292').attr('checked',true);jQuery('#idm292').click();}" /><label class="tit_campos">-&frac12;</label><br />
                            <input type="radio" value="0.5" name="m75" id="idm752" onclick="javascript: document.getElementById('idm761').checked='true'; if(jQuery('#idm291').is(':checked')==false){jQuery('#idm291').attr('checked',true);jQuery('#idm291').click();}" /><label class="tit_campos">+&frac12;</label><br />-->                            
                        </td><td><!--<input type="text" name="idapuesta75" id="idapuesta75" value="" size="4" />--></td>
                </tr>
                <tr valign="bottom" bgcolor="" class="linesep">
                  <td class=""><label class="tit_campos">Ref.:</label><br /><input type="text" value="" name="referenciaA" id="referenciaA" size="3" disabled="disabled" maxlength="4" required="required" /></td>
                  <td align="center" class="td_left"><label class="tit_campos">Logro<br />
                          6to:</label></td>
                  <td class=""><input type="text" name="idapuesta80" id="idapuesta80" value="" size="4" /></td>
                  <td class="td_left">&nbsp;</td><td class="">&nbsp;</td>
                  <td class="td_left">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td class="td_left">&nbsp;</td>
                  <td class="">&nbsp;</td>
                </tr>
                <tr valign="top" bgcolor="#ebebeb">
                	<td class="linesep"><label class="tit_campos"><strong>Home Club:</strong></label><br /><?php $atributos="name=\'lhome\' id=\'lhome\' disabled required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."'  order by nombre",' name="home" id="home" required="required" disabled onchange="dinamico_select(\'dinhome\',this.value,\''.$array_lanzadores.'\',\''.$atributos.'\')"');?></td>
                        <td align="center" class="linesep td_left"><label class="tit_campos">Logro<br />
                        JC:</label></td><td class="linesep"><input type="text" name="idapuesta25" id="idapuesta25" value="" size="4" /></td> 
                        <!--SUPER RUNLINE-->                       
                        <td class="linesep td_left">
                        	<input type="radio" value="-2.5" name="m48" id="idm481" onclick="javascript: document.getElementById('idm472').checked='true';"  />
                        	<label class="tit_campos">-2</label>&frac12;<br />
                            <input type="radio" value="2.5" name="m48" id="idm482" onclick="javascript: document.getElementById('idm471').checked='true';"  />
                            <label class="tit_campos">+2 </label>&frac12;<br />                            
                        </td><td class="linesep"><input type="text" name="idapuesta48" id="idapuesta48" value="" size="4" /></td>
                        
                        
                        <td class="linesep td_left">
                        	<input type="radio" value="-1.5" name="m28" id="idm281" onclick="javascript: document.getElementById('idm272').checked='true'; jQuery('#idm742').click();"  /><label class="tit_campos">-1</label>&frac12;<br />
                            <input type="radio" value="1.5" name="m28" id="idm282" onclick="javascript: document.getElementById('idm271').checked='true'; jQuery('#idm741').click();"  /><label class="tit_campos">+1 </label>&frac12;<br />                            
                        </td><td class="linesep"><input type="text" name="idapuesta28" id="idapuesta28" value="" size="4" /></td>
                        <!--RLA-->
                        <td class="linesep td_left">
                        	<input type="radio" value="-1.5" name="m74" id="idm741" onclick="javascript: document.getElementById('idm732').checked='true'; if(jQuery('#idm282').is(':checked')==false){jQuery('#idm282').attr('checked',true);jQuery('#idm282').click();}"  /><label class="tit_campos">-1</label>&frac12;<br />
                            <input type="radio" value="1.5" name="m74" id="idm742" onclick="javascript: document.getElementById('idm731').checked='true'; if(jQuery('#idm281').is(':checked')==false){jQuery('#idm281').attr('checked',true);jQuery('#idm281').click();}"  /><label class="tit_campos">+1 </label>&frac12;<br />                            
                        </td><td class="linesep"><input type="text" name="idapuesta74" id="idapuesta74" value="" size="4" /></td>
                </tr>
                <tr valign="top" bgcolor="#ebebeb" class="linesep">
                	<td class="bnone">
                    	<label class="tit_campos">Lanzador:</label><br /><label id="dinhome"><select name="lhome" disabled required="required"><option value="">Seleccione</option></select></label></td>
                        <td align="center" class="td_left"><label class="tit_campos">Logro<br />
                        MJ:</label></td><td><input type="text" name="idapuesta26" id="idapuesta26" value="" size="4" /></td>                        
                        <!--SUPER RUNLINE-->
                        <td class="td_left">
                        	<!--<input type="radio" value="-1.5" name="m55" id="idm551" onclick="javascript: document.getElementById('idm542').checked='true';"  /><label class="tit_campos">-1 &frac12;</label><br />
                            <input type="radio" value="1.5" name="m55" id="idm552" onclick="javascript: document.getElementById('idm541').checked='true';"  /><label class="tit_campos">+1 &frac12;</label><br />                            -->
                        </td><td><!--<input type="text" name="idapuesta55" id="idapuesta55" value="" size="4" />--></td>
                        
                        <td class="td_left">
                        	<input type="radio" value="-0.5" name="m30" id="idm301" onclick="javascript: document.getElementById('idm292').checked='true';"  /><label class="tit_campos">-&frac12;</label><br />
                            <input type="radio" value="0.5" name="m30" id="idm302" onclick="javascript: document.getElementById('idm291').checked='true';"  /><label class="tit_campos">+&frac12;</label><br />                            
                        </td><td><input type="text" name="idapuesta30" id="idapuesta30" value="" size="4" /></td>
                        <!--RLA-->
                        <td class="td_left">
                        	<!--<input type="radio" value="-0.5" name="m76" id="idm761" onclick="javascript: document.getElementById('idm752').checked='true'; if(jQuery('#idm302').is(':checked')==false){jQuery('#idm302').attr('checked',true);jQuery('#idm302').click();}"  /><label class="tit_campos">-&frac12;</label><br />
                            <input type="radio" value="0.5" name="m76" id="idm762" onclick="javascript: document.getElementById('idm751').checked='true'; if(jQuery('#idm301').is(':checked')==false){jQuery('#idm301').attr('checked',true);jQuery('#idm301').click();}"  /><label class="tit_campos">+&frac12;</label><br />-->                            
                        </td><td><!--<input type="text" name="idapuesta76" id="idapuesta76" value="" size="4" />--></td>
                </tr>
                <tr valign="bottom" bgcolor="#ebebeb" class="linesep">
                  <td class=""><label class="tit_campos">Ref.:</label><br /><input type="text" value="" name="referenciaB" disabled id="referenciaB" size="3" maxlength="4" required="required" /></td>
                  <td align="center"  class="td_left"><label class="tit_campos">Logro<br />
                          6to:</label></td>
                  <td class=""><input type="text" name="idapuesta81" id="idapuesta81" value="" size="4" /></td>
                  <td class="td_left">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td class="td_left">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td class="td_left">&nbsp;</td>
                  <td class="">&nbsp;</td>
                </tr>
            </table><br />

<table cellspacing="0" cellpadding="4" align="left" class="logros_tabla">
      			<tr class="titulo_tablas"><td colspan="2" align="center" bgcolor="#000000">Altas y Bajas</td><td align="center" colspan="2" width="100px" class="td_left">CHE</td><td align="center" colspan="2" width="100px" class="td_left">Quien<br />Anota</td><td align="center" colspan="2" width="100px" class="td_left">1er<br />Inning</td></tr>
            	<tr valign="bottom">
                	<!--SUPER RUN LINE-->
                        <!--RUN LINE-->
                        <td align="center" width="40px" class="td_left"><label class="tit_campos">A JC</label></td><td><input type="text" name="idapuesta31" id="idapuesta31" value="" size="4" /></td>
                        <td class="td_left"><label class="tit_campos">A JC</label></td><td><input type="text" name="idapuesta71" id="idapuesta71" value="" size="4" /></td><td class="td_left"><label class="tit_campos">Visitante</label></td><td><input type="text" size="4" name="idapuesta37" id="idapuesta37" maxlength="4" /></td><td class="td_left"><label class="tit_campos">Si</label></td><td><input type="text" size="4" name="idapuesta39" id="idapuesta39" maxlength="4" /></td>
                </tr>
                <tr valign="bottom" class="">
                	<!--SUPER RUNLINE-->
                        <!-- RUNLINE-->
                        <td align="center" class="td_left"><label class="tit_campos">B JC</label></td><td><input type="text" name="idapuesta32" id="idapuesta32" value="" size="4" /></td><td class="td_left"><label class="tit_campos">B JC</label></td><td><input type="text" name="idapuesta72" id="idapuesta72" value="" size="4" /></td><td class="td_left"><label class="tit_campos">Home Club</label></td><td><input type="text" name="idapuesta38" id="idapuesta38" size="4" maxlength="4" /></td><td class="td_left"><label class="tit_campos">No</label></td><td><input type="text" size="4" name="idapuesta40" id="idapuesta40" maxlength="4" /></td>
                </tr>
                <tr valign="bottom" bgcolor="">
                  <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">C JC</label></td>
                  <td bgcolor="#FFFFFF" class=""><input type="text" size="4" name="idapuesta35" id="idapuesta35" maxlength="4" /></td><td valign="bottom" class="td_left"><label class="tit_campos">V CHE</label></td><td valign="bottom"><input type="text" name="idapuesta70" id="idapuesta70" value="" size="4" /></td><td class="td_left">&nbsp;</td><td>&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td>
                </tr>
                <tr valign="bottom" bgcolor="#FFFFFF">
                	<!--SUPER RUNLINE-->                       
                        <td align="center" bgcolor="#FFFFFF" class="td_left linesep"><label class="tit_campos">A MJ</label></td><td bgcolor="#FFFFFF" class="linesep"><input type="text" name="idapuesta33" id="idapuesta33" value="" size="4" /></td><td bgcolor="#FFFFFF" class="td_left linesep">&nbsp;</td><td bgcolor="#FFFFFF" class="linesep">&nbsp;</td><td class="linesep td_left">&nbsp;</td><td class="linesep">&nbsp;</td><td class="td_left linesep">&nbsp;</td><td class="linesep">&nbsp;</td>
                </tr>
                <tr valign="bottom" bgcolor="#FFFFFF" class="">
                	<!--SUPER RUNLINE-->
                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">B MJ</label></td><td bgcolor="#FFFFFF"><input type="text" name="idapuesta34" id="idapuesta34" value="" size="4" /></td><td bgcolor="#FFFFFF" class="td_left">&nbsp;</td><td bgcolor="#FFFFFF">&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td>
                </tr>
                <tr valign="bottom" bgcolor="#FFFFFF">
                  <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">C MJ</label></td>
                  <td bgcolor="#FFFFFF" class=""><input type="text" name="idapuesta36" id="idapuesta36" size="4" maxlength="4" /></td><td bgcolor="#FFFFFF" class="td_left">&nbsp;</td><td bgcolor="#FFFFFF">&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td>
                </tr>
                <tr valign="bottom" bgcolor="#FFFFFF" class="linesep">
                	<!--SUPER RUNLINE-->                       
                        <td align="center" bgcolor="#FFFFFF" class="td_left linesep"><label class="tit_campos">A 6to</label></td><td bgcolor="#FFFFFF" class="linesep"><input type="text" name="idapuesta77" id="idapuesta77" value="" size="4" /></td><td bgcolor="#FFFFFF" class="td_left linesep">&nbsp;</td><td bgcolor="#FFFFFF" class="linesep">&nbsp;</td><td class="td_left linesep">&nbsp;</td><td class="linesep">&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td>
                </tr>
                <tr valign="bottom" bgcolor="#FFFFFF" class="">
                	<!--SUPER RUNLINE-->
                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">B 6to</label></td><td bgcolor="#FFFFFF"><input type="text" name="idapuesta78" id="idapuesta78" value="" size="4" /></td><td bgcolor="#FFFFFF" class="td_left">&nbsp;</td><td bgcolor="#FFFFFF">&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td>
                </tr>
                <tr valign="bottom" bgcolor="#FFFFFF">
                  <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">C 6to</label></td>
                  <td bgcolor="#FFFFFF" class=""><input type="text" name="idapuesta79" id="idapuesta79" size="4" maxlength="4" /></td><td bgcolor="#FFFFFF" class="td_left">&nbsp;</td><td bgcolor="#FFFFFF">&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td><td class="td_left">&nbsp;</td><td>&nbsp;</td>
                </tr>
            </table>
   	  </td></tr>
    		<tr>
            	<td>
                	</td>
            </tr>
             
             <tr><td></td></tr>
             
        <tr><td align="left"><input name="guardar" type="button" class="boton" onClick="javascript:comentario='Seleccione el logro para guardar la apuesta';validar(document.logros,'logros_banqueros.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onClick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <script language="javascript">
jQuery(document).ready(function(){
	jQuery('[required="required"]').attr('disabled',true);
	$('[type="text"]').numeric(false, function() {  this.value = ""; this.focus(); });
	//$('[name="idapuesta79"]').numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
	$('[name="idapuesta79"],[name="idapuesta36"],[name="idapuesta35"]').numeric({ negative: false }, function() {  this.value = ""; this.focus(); });
	$('#scategorias,#sligas').attr('disabled',false);	
});
</script>
    
</form>
<script language="javascript">
cadena_hiden='idlogro,idlogro_equipoA,idlogro_equipoB';
categoria_sel="<?php echo $_REQUEST['categoria']; ?>";
liga_sel="<?php echo $_REQUEST['liga']; ?>";
$("#fecha_ld").datepicker();
//$('#tabletwo').tableHover({colClass: 'hover'});
jQuery(":radio").attr("readonly",'readonly');
</script>