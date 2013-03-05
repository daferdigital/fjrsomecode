<?Php session_start();include_once("procesos/conexion.php");?>
<script language="javascript">
	cadena_hiden='idtaquilla,usuario_actual';
	jQuery(document).ready(function(){
		jQuery('#dapuestas input').addClass('texto_derecha');
		jQuery('#dapuestas input').css("width","80px");
	});
</script>
<div class="titulo">Registro / Edici&oacute;n de Taquillas</div>
<form name="taquillas" method="post" action="procesos/guardar_taquillas.php">
<fieldset style="width:75%"><legend>Datos personales</legend>
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">Nombre Taquilla:</label> <input type="text" name="nombre" id="nombre" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><label class="tit_campos">Intermediario:</label>
            <select name="intermediario" id="intermediario">
                    <option value=""><b>Intermediario</b></option>
            <?Php 
				if($_SESSION['datos']['idbanquero']) $where=" where idbanquero='".$_SESSION['datos']['idbanquero']."'";
				$selectligas="select * from intermediarios $where";
				$queryligas=mysql_query($selectligas);
					if(mysql_num_rows($queryligas)>0){
						while($varligas=mysql_fetch_assoc($queryligas)){
						?>
                            <option <?php echo $sel; ?> value="<?php echo $varligas['idintermediario']; ?>"><?php echo $varligas['nombre']; ?></option>               
                <?Php }//fin while
					}//fin if?>
                 </select>
                <label class="campo_obligatorio">*</label>
             </td></tr>   
             <tr>
        	<td width="50%"><label class="tit_campos">Cedula:</label> <input type="text" name="cedula" id="cedula" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><label class="tit_campos">Teléfono:</label> <input type="text" name="telefono" id="telefono" value="" /> <label class="campo_obligatorio">*</label>
             </td></tr>  
             <tr>
        	<td width="50%"><label class="tit_campos">Dirección:</label> <input type="text" name="direccion" id="direccion" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><label class="tit_campos">Email:</label> <input type="text" name="email" id="email" value="" /> <label class="campo_obligatorio">*</label>
             </td></tr> 
               
    </table>
</fieldset> 

<fieldset style="width:75%"><legend>Datos de apuestas</legend>   
	<table id="dapuestas" width="100%" cellpadding="4px" cellspacing="0">  
    	<tr>
        	<td width="50%"><label class="tit_campos">Tipo de taquilla:</label> <select name="tipo" id="tipo"><option value="">Tipo de taquilla</option><option value="prepagada">Prepagada</option><option value="postpagada">Postpagada</option></select> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><!--<label class="tit_campos">Máximo jugada por derecho:</label> <input type="text" name="mjpd" id="mjpd" value="" /> <label class="campo_obligatorio">*</label>-->
             <label class="tit_campos">Porcentaje de Ventas por parley: </label><input type="text" name="pdv" id="pdv" value="" /> <label class="campo_obligatorio">*</label></td></tr>
             <tr>
        	<td width="50%"><!--<label class="tit_campos">Máximo perdida en jugada por derecho:</label> <input type="text" name="mpjpd" id="mpjpd" value="" /> <label class="campo_obligatorio">*</label>--></td>
    		<td  class="color_2colum"><!--<label class="tit_campos">Máximo jugada por derecho RL:</label> <input type="text" name="mjpdrl" id="mjpdrl" value="" /> <label class="campo_obligatorio">*</label>-->
             </td></tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Cantidad máxima de premio BsF.:</label> <input type="text" name="mp" id="mp" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><!--label class="tit_campos">Máximo jugada por parley:</label> <input type="text" name="mjpp" id="mjpp" value="" /> <label class="campo_obligatorio">*</label-->
             <label class="tit_campos">Porcentaje de Ventas por derecho: </label>
             <input type="text" name="pdvd" id="pdvd" value="" /> <label class="campo_obligatorio">*</label></td></tr>	
             <tr>
        	<td width="50%"><label class="tit_campos">Máximo de apuestas por ticket:</label> <input type="text" name="mapt" id="mapt" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><label class="tit_campos">Minimo de apuestas por ticket:</label> <input type="text" name="cmina" id="cmina" value="" /> <label class="campo_obligatorio">*</label><!--<label class="tit_campos">Máximo de jugadas repetidas:</label> <input type="text" name="mjr" id="mjr" value="" /> <label class="campo_obligatorio">*</label>-->
             </td></tr>
             <tr>
               <td><label class="tit_campos">Porcentaje de Utilidad: </label><input type="text" name="pdu" id="pdu" value="" /> <label class="campo_obligatorio">*</label></td>
               <td  class="color_2colum"><label class="tit_campos">Porcentaje de Participación: </label>
                 <input type="text" name="pp" id="pp" value="" /> <label class="campo_obligatorio">*</label></td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad Maxima de combinaciones permitidas: </label><select name="cmlp" id="cmlp"><?Php for($iy=1;$iy<11;$iy++){?><option value="<?Php echo $iy;?>"><?Php echo $iy;?></option><?Php }?></select></td>
               <td  class="color_2colum"><label class="tit_campos">Cantidad maxima de hembras por ticket: </label><input type="text" name="cmht" id="cmht" value="" /> <label class="campo_obligatorio">*</label></td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad maxima de machos por ticket: </label><input type="text" name="cmmt" id="cmmt" value="" /> <label class="campo_obligatorio">*</label></td>
               <td  class="color_2colum">
               <label class="tit_campos">Factor apuesta: <b>1x</b> </label><input type="text" name="fa" id="fa" value="" /> <label class="campo_obligatorio">*</label>
               <!--<label class="tit_campos">Permitir Apostar Ganador y Runline al mismo tiempo: </label><select name="pagr" id="pagr"><option value="0">no</option><option value="1">si</option></select>--></td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cupo diario por derecho: </label><input type="text" name="cdpd" id="cdpd" value="" noobli="noobli" />BsF. <label class="campo_obligatorio">0 = Infinito</label></td>
               <td  class="color_2colum"><label class="tit_campos">Cupo diario por parley: </label><input type="text" name="cdpp" id="cdpp" value="" noobli="noobli" />BsF. <label class="campo_obligatorio">0 = Infinito</label></td>
             </tr>
             <tr>
               <td><label class="tit_campos">Tiempo limite para anular ticket: </label><input type="text" name="tlpat" id="tlpat" value="" /> Min. <label class="campo_obligatorio">*</label></td>
               <td  class="color_2colum"></td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas por derecho: </label>
                 <input type="text" name="cmapd" id="cmapd" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 2 logros : </label>
                 <input type="text" name="cma2" id="cma2" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 3 logros : </label>
                 <input type="text" name="cma3" id="cma3" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 4 logros : </label>
                 <input type="text" name="cma4" id="cma4" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 5 logros : </label>
                 <input type="text" name="cma5" id="cma5" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
              <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 6 logros : </label>
                 <input type="text" name="cma6" id="cma6" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
              <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 7 logros : </label>
                 <input type="text" name="cma7" id="cma7" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 8 logros : </label>
                 <input type="text" name="cma8" id="cma8" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
        	<tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 9 logros : </label>
                 <input type="text" name="cma9" id="cma9" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
             <tr>
               <td><label class="tit_campos">Cantidad maxima de apuestas con 10 logros : </label>
                 <input type="text" name="cma10" id="cma10" value="" size="5" maxlength="8" noobli="noobli" /> <label class="campo_obligatorio">BsF.</label></td>
               <td  class="color_2colum">&nbsp;</td>
             </tr>
    </table>
</fieldset>
<fieldset style="width:75%"><legend>Datos de logueo</legend>
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr valign="top">
        	<td width="50%">
            	<label class="tit_campos">Usuario:</label> <input type="text" name="usuario" id="usuario" value=""  onblur="javascript:if(this.value) usuario_disponible(this.value);" /> <label class="campo_obligatorio">*</label>
                <div id="aviso_disp"></div>
            </td>
    		<td class="color_2colum"><label class="tit_campos">Clave:</label> <input type="password" name="clave" id="clave" value="" /> <label class="campo_obligatorio">*</label>            
                
             </td></tr>  
             <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.taquillas,'taquillas.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer"  onclick="deshacer(cadena_hiden)" /></td></tr>                   
    </table>
    </fieldset>
    <input type="hidden" name="idtaquilla" id="idtaquilla" value="" />
    <div id="listado">
    <?Php
		include("procesos/listar_taquillas.php");
	?>
    </div>
   <input type="hidden" name="usuario_actual" id="usuario_actual" value="" /> 
</form>