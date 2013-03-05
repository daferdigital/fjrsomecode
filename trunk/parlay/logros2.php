<script language="javascript">
cadena_hiden='idlogro,idlogro_equipoA,idlogro_equipoB';
</script>
<?Php include("procesos/conexion.php");
$array_lanzadores=dame_array_js("select idequipo,idroster,nombre,efectividad from roster where estatus='1'",'4','_','|');
//echo $array_lanzadores.'<hr>';
?>
<div class="titulo">Registro / Edici&oacute;n de Logros para Béisbol</div>
<form name="logros" id="Formulario" method="post" action="procesos/guardar_logros.php">
	<div align="right" class="color_2colum" style="padding-right:40px;"><label class="tit_campos">Logro Nº:</label> <input type="text" name="idlogro" id="idlogro" value="" size="3" readonly="readonly" /> | <label class="tit_campos">Fecha:</label> <input type="text" name="fecha" id="fecha" readonly="readonly" value="<?php echo date("d/m/Y"); ?>" size="10" /> | <label class="tit_campos">Hora:</label> <input type="text" name="hora" id="hora" value="<?php echo date("h:i A"); ?>" required="required" size="5" /><img src="imagenes/clock.png" alt="Time" border="0" style="position:absolute;margin:4px 0 0 6px;" id="trigger-test" /></div>
	<table width="" align="left" cellpadding="4px" cellspacing="0">
    	
        <tr>
          <td colspan="2" class="" align="right">
   	  <table width="100%" cellspacing="0" cellpadding="4" class="logros_tabla">
      			<tr class="titulo_tablas"><td></td><td align="center" colspan="2">Money Line</td><td colspan="2" align="center">Run Line</td><td colspan="2" align="center" bgcolor="#000000">Altas y Bajas</td></tr>
            	<tr valign="bottom">
                	<td width="200px"><label class="tit_campos"><strong>Visitante:</strong></label><br /><?php $atributos="name=\'lvisitante\' id=\'lvisitante\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='1'",' name="visitante" id="visitante" required="required" onchange="dinamico_select(\'dinvisitante\',this.value,\''.$array_lanzadores.'\',\''.$atributos.'\')"');?></td>
                        <td align="center" width="50px"><label class="tit_campos">Logro<br />JC:</label></td><td width="80px"><input type="text" name="idapuesta23" id="idapuesta23" value="" size="4" /></td>                        
                        <td width="50px">
                        	<input type="radio" value="-1.5" name="m27" id="" /><label class="tit_campos">-1 &frac12;</label><br />
                            <input type="radio" value="1.5" name="m27" id="" /><label class="tit_campos">+1 &frac12;</label><br />                            
                        </td><td width="80px"><input type="text" name="idapuesta27" id="idapuesta27" value="" size="4" /></td>
                        
                        <td align="center" width="40px" class="td_left"><label class="tit_campos">Logro<br />AL JC</label></td><td><input type="text" name="idapuesta31" id="idapuesta31" value="" size="4" /></td>
                </tr>
                <tr valign="bottom" class="">
                	<td>
                    	<label class="tit_campos">Lanzador:</label><br /><label id="dinvisitante"><select name="lvisitante" required="required"><option value="">Seleccione</option></select></label></td>
                        <td align="center"><label class="tit_campos">Logro<br />
                          MJ:</label></td><td><input type="text" name="idapuesta24" id="idapuesta24" value="" size="4" /></td>                        
                        
                        <td>
                        	<input type="radio" value="-0.5" name="m29" /><label class="tit_campos">-&frac12;</label><br />
                            <input type="radio" value="0.5" name="m29" /><label class="tit_campos">+&frac12;</label><br />                            
                        </td><td><input type="text" name="idapuesta29" id="idapuesta29" value="" size="4" /></td>
                        <td align="center" class="td_left"><label class="tit_campos">Logro<br />
                        BA JC</label></td><td><input type="text" name="idapuesta32" id="idapuesta32" value="" size="4" /></td>
                </tr>
                <tr valign="top" bgcolor="">
                  <td class=""><label class="tit_campos">Ref.:</label><br /><input type="text" value="" name="referenciaA" id="referenciaA" size="3" maxlength="3" required="required" /></td>
                  <td align="center" class="">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td align="center" bgcolor="#FFFFFF" class="td_left">&nbsp;</td>
                  <td bgcolor="#FFFFFF" class="">&nbsp;</td>
                </tr>
                <tr valign="top" bgcolor="#ebebeb">
                	<td class="linesep"><label class="tit_campos"><strong>Home Club:</strong></label><br /><?php $atributos="name=\'lhome\' id=\'lhome\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='1'",' name="home" id="home" required="required" onchange="dinamico_select(\'dinhome\',this.value,\''.$array_lanzadores.'\',\''.$atributos.'\')"');?></td>
                        <td align="center" class="linesep"><label class="tit_campos">Logro<br />
                        JC:</label></td><td class="linesep"><input type="text" name="idapuesta25" id="idapuesta25" value="" size="4" /></td>                        
                        <td class="linesep">
                        	<input type="radio" value="-1.5" name="m28" /><label class="tit_campos2">-1</label>&frac12;<br />
                            <input type="radio" value="1.5" name="m28" /><label class="tit_campos2">+1 </label>&frac12;<br />                            
                        </td><td class="linesep"><input type="text" name="idapuesta28" id="idapuesta28" value="" size="4" /></td>
                        
                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">Logro<br />
                        AL MJ</label></td><td bgcolor="#FFFFFF" class=""><input type="text" name="idapuesta33" id="idapuesta33" value="" size="4" /></td>
                </tr>
                <tr valign="top" bgcolor="#ebebeb" class="">
                	<td>
                    	<label class="tit_campos">Lanzador:</label><br /><label id="dinhome"><select name="lhome" required="required"><option value="">Seleccione</option></select></label></td>
                        <td align="center"><label class="tit_campos">Logro<br />
                        MJ:</label></td><td><input type="text" name="idapuesta26" id="idapuesta26" value="" size="4" /></td>                        
                        
                        <td>
                        	<input type="radio" value="-0.5" name="m30" /><label class="tit_campos">-&frac12;</label><br />
                            <input type="radio" value="0.5" name="m30" /><label class="tit_campos">+&frac12;</label><br />                            
                        </td><td><input type="text" name="idapuesta30" id="idapuesta30" value="" size="4" /></td>
                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">Logro<br />
                        BA MJ</label></td><td bgcolor="#FFFFFF"><input type="text" name="idapuesta34" id="idapuesta34" value="" size="4" /></td>
                </tr>
                <tr valign="top" bgcolor="#ebebeb">
                  <td class=""><label class="tit_campos">Ref.:</label><br /><input type="text" value="" name="referenciaB" id="referenciaB" size="3" maxlength="3" required="required" /></td>
                  <td align="center" class="">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td class="">&nbsp;</td>
                  <td align="center" bgcolor="#FFFFFF" class="td_left">&nbsp;</td>
                  <td bgcolor="#FFFFFF" class="">&nbsp;</td>
                </tr>
            </table>
   	  </td></tr>
    		<tr>
            	<td>
                	</td>
            </tr>
             
             
             
        <tr><td align="left"><input name="guardar" type="button" class="boton" onClick="javascript:comentario='Complete los campos';validar(document.logros,'logros.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onClick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <table width="" cellspacing="0" class="logros_tabla" style="border:#003901 1px solid; margin-top:4px;" cellpadding="4px">
                        	<tr valign="bottom" align="center" class="titulo_tablas">
                            	<td width="100px" colspan="2"><label class="tit_campos"><strong>Carreras</strong></label></td><td width="100px" colspan="2"><label class="tit_campos"><strong>Quien<br />
                           	    Anota</strong></label></td><td width="100px" align="center" colspan="2" style="border:none;"><label class="tit_campos"><strong>1er<br />
                            	Inning</strong></label></td>
                            </tr>
                            <tr>
                            	<td ><label class="tit_campos">9 inninig</label></td><td><input type="text" size="4" name="idapuesta35" id="idapuesta35" maxlength="4" /></td><td><label class="tit_campos">Visitante</label></td><td><input type="text" size="4" name="idapuesta37" id="idapuesta37" maxlength="4" /></td><td ><label class="tit_campos">Si</label></td><td ><input type="text" size="4" name="idapuesta39" id="idapuesta39" maxlength="4" /></td>
                            </tr>
                             <tr>
                            	<td ><label class="tit_campos">5 inninig</label></td><td><input type="text" name="idapuesta36" id="idapuesta36" size="4" maxlength="4" /></td><td><label class="tit_campos">Home Club</label></td><td><input type="text" name="idapuesta38" id="idapuesta38" size="4" maxlength="4" /></td><td ><label class="tit_campos">No</label></td><td><input type="text" size="4" name="idapuesta40" id="idapuesta40" maxlength="4" /></td>
                            </tr>
                         </table>
    <div id="listado" style=" clear:both;">
	   <?Php
            include("procesos/listar_logros.php");
       ?>    
   </div>
</form>