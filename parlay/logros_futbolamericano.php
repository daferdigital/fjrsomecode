<?Php session_start();include("procesos/conexion.php"); //sleep(2);

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

          <td width="726" colspan="2" align="right" class="">

   	  <table width="100%" cellspacing="0" cellpadding="4" class="logros_tabla">

      			<tr class="titulo_tablas"><td></td><td align="center" colspan="2">Money Line</td><td colspan="2" align="center">Run Line</td><td colspan="2" align="center" bgcolor="#000000">Altas y Bajas</td>

      			<td colspan="2" align="center" bgcolor="#000000">Puntos</td></tr>

            	<tr valign="bottom">

                	<td width="200"><label class="tit_campos"><strong>Visitante:</strong></label><br /><?php  $atributos="name=\'lvisitante\' id=\'lvisitante\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."' and estatus='1' ",' name="visitante" id="visitante" required="required" ');

					

					/*$atributos="name=\'lvisitante\' id=\'lvisitante\' required=\'required\'"; genera_select("select idequipo,nombre from vista_equipos where idliga='".$_REQUEST['liga']."' or otras_ligas like '%|".$_REQUEST['liga']."|%' order by nombre",' name="visitante" id="visitante" required="required" onchange=""'); */?></td>

                        <td align="center" width="50"><label class="tit_campos">Logro<br />JC:</label></td><td width="80"><input type="text" name="idapuesta100" id="idapuesta100" value="" size="4" /></td>                        

                        <td width="60" valign="top" align="center">

                        	<label class="tit_campos">-</label><input type="radio" value="-2" name="m95" id="idm951" onclick="javascript: document.getElementById('idm962').checked='true';" /><label class="tit_campos">+</label><input type="radio" value="2" name="m95" id="idm952" onclick="javascript: document.getElementById('idm961').checked='true';" /><br />

                            <input type="text" value="" size="3" maxlength="4" name="vm95" id="vm95" onkeyup="javascript:jQuery('#vm96').val(this.value);" />

                        </td><td width="80"><input type="text" name="idapuesta95" id="idapuesta95" value="" size="4" /></td>

                        

                        <td align="center" width="45" class="td_left"><label class="tit_campos">A JC</label></td><td width="31"><input type="text" name="idapuesta102" id="idapuesta102" value="" size="4" /></td>

                        <td width="82" class="td_left">Puntos JC</td><td width="24"><span class="linesep">

                          <input type="text" name="idapuesta109" id="idapuesta109" value="" size="4" />

                        </span></td>

                </tr>

                <tr valign="bottom" class="">

                	<td><label class="tit_campos">Ref.:</label><br /><input type="text" value="" name="referenciaA" id="referenciaA" size="3" maxlength="4" required="required" />

                    	</td>

                        <td align="center"><label class="tit_campos">Logro<br />

                          MJ:</label></td><td><input type="text" name="idapuesta101" id="idapuesta101" value="" size="4" /></td>                        

                        

                        <td><!--

                        	<input type="radio" value="-0.5" name="m18" id="idm181" onclick="javascript: document.getElementById('idm512').checked='true';" /><label class="tit_campos">-&frac12;</label><br />

                            <input type="radio" value="0.5" name="m18" id="idm182" onclick="javascript: document.getElementById('idm511').checked='true';" /><label class="tit_campos">+&frac12;</label>--><br />                           

            </td><td><!--<input type="text" name="idapuesta18" id="idapuesta18" value="" size="4" />--></td>

                        <td align="center" class="td_left"><label class="tit_campos">                        B JC</label></td><td><input type="text" name="idapuesta103" id="idapuesta103" value="" size="4" /></td>

                        <td class="td_left">Puntos MJ</td><td><input type="text" name="idapuesta110" id="idapuesta110" value="" size="4" /></td>

                </tr>

                <tr valign="bottom" bgcolor="#ebebeb">

                	<td class="linesep"><label class="tit_campos"><strong>Home Club:</strong></label><br /><?php $atributos="name=\'lhome\' id=\'lhome\' required=\'required\'"; genera_select("select idequipo,nombre from equipos where idliga='".$_REQUEST['liga']."' and estatus='1' ",' name="home" id="home" required="required" ');/* $atributos="name=\'lhome\' id=\'lhome\' required=\'required\'"; genera_select("select idequipo,nombre from vista_equipos where idliga='".$_REQUEST['liga']."' or otras_ligas like '%|".$_REQUEST['liga']."|%'  order by nombre",' name="home" id="home" required="required" onchange=""'); */?></td>

                        <td align="center" class="linesep"><label class="tit_campos">Logro<br />

                        JC:</label></td><td class="linesep"><input type="text" name="idapuesta111" id="idapuesta111" value="" size="4" /></td>                        

                        <td class="linesep" align="center">

                        	<label class="tit_campos2">-</label><input type="radio" value="-2" name="m96" id="idm961" onclick="javascript: document.getElementById('idm952').checked='true';"  /><label class="tit_campos2">+</label><input type="radio" value="2" name="m96" id="idm962" onclick="javascript: document.getElementById('idm951').checked='true';"  /><br />

                            <input type="text" value="" size="3" maxlength="4" name="vm96" id="vm96" onkeyup="javascript:jQuery('#vm95').val(this.value);" />

                        </td><td class="linesep"><input type="text" name="idapuesta96" id="idapuesta96" value="" size="4" /></td>

                        

                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">                        A MJ</label></td><td bgcolor="#FFFFFF" class=""><input type="text" name="idapuesta104" id="idapuesta104" value="" size="4" /></td>

                        <td bgcolor="#FFFFFF" class="td_left linesep">

                        

                        <!--Empate JC<input type="text" name="idapuesta106" id="idapuesta106" value="" size="4" />-->

                        </td><td bgcolor="#FFFFFF" class="linesep">&nbsp;</td>

                </tr>

                <tr valign="top" bgcolor="#ebebeb" class="">

                	<td><label class="tit_campos">Ref.:</label><br /><input type="text" value="" name="referenciaB" id="referenciaB" size="3" maxlength="4" required="required" />

                    	</td>

                        <td align="center"><label class="tit_campos">Logro<br />

                        MJ:</label></td><td><input type="text" name="idapuesta99" id="idapuesta99" value="" size="4" /></td>                        

                        

                        <td>

                        	<!--<input type="radio" value="-0.5" name="m51" id="idm511" onclick="javascript: document.getElementById('idm182').checked='true';"  /><label class="tit_campos">-&frac12;</label><br />

                            <input type="radio" value="0.5" name="m51" id="idm512" onclick="javascript: document.getElementById('idm181').checked='true';"  /><label class="tit_campos">+&frac12;</label><br />  -->                          

                        </td><td><!--<input type="text" name="idapuesta51" id="idapuesta51" value="" size="4" />--></td>

                        <td align="center" bgcolor="#FFFFFF" class="td_left"><label class="tit_campos">                        B MJ</label></td><td bgcolor="#FFFFFF"><input type="text" name="idapuesta105" id="idapuesta105" value="" size="4" /></td>

                        <td bgcolor="#FFFFFF" class="td_left">

                        <!--Empate MJ<input type="text" name="idapuesta107" id="idapuesta107" value="" size="4" />--></td><td bgcolor="#FFFFFF"></td>

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

	$('[name="vm95"],[name="vm96"],[name="idapuesta109"],[name="idapuesta110"]').numeric({ negative: false }, function() {  this.value = ""; this.focus(); });

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