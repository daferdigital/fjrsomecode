<?Php session_start();include_once("procesos/conexion.php");
//print_r($_SESSION['datos']);
?>
<script language="javascript">
	cadena_hiden='idintermediario,usuario_actual';
</script>
<div class="titulo">Registro / Edici&oacute;n de Intermediarios</div>
<form name="intermediarios" method="post" action="procesos/guardar_intermediarios.php">
<fieldset style="width:70%"><legend>Datos del intermediario</legend>
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">Nombre del intermediario:</label> <input type="text" name="nombre" id="nombre" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Banquero:</label>
            <select name="banquero" id="banquero">
                    <option value=""><b>Banquero</b></option>
            <?Php 
				if($_SESSION['datos']['idbanquero']) $where=" where idbanquero='".$_SESSION['datos']['idbanquero']."' limit 1";
				$selectcategorias="select * from banqueros $where";
				$querycategorias=mysql_query($selectcategorias);
					if(mysql_num_rows($querycategorias)>0){
						while($varcategorias=mysql_fetch_assoc($querycategorias)){
						?>
                            <option <?php echo $sel; ?> value="<?php echo $varcategorias['idbanquero']; ?>"><?php echo $varcategorias['nombres'].' '.$varcategorias['apellidos']; ?></option>               
                <?Php }//fin while
					}//fin if?>
                 </select>
                <label class="campo_obligatorio">*</label>
             </td></tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Cedula:</label> <input type="text" name="cedula" id="cedula" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Teléfono:</label>  <input type="text" name="telefono" id="telefono" value="" /> <label class="campo_obligatorio">*</label>
             </td></tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Dirección:</label> <input type="text" name="direccion" id="direccion" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum">
            	<label class="tit_campos">Porcentaje parley:  <input type="text" name="pp" id="pp" class="solo_numeros" maxlength="2" size="2" value="" /> %</label> <label class="campo_obligatorio">*</label>
             </td></tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Porcentaje derecho:  <input type="text" name="pd" id="pd" maxlength="2" size="2" value="" /> %</label> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum">
            	
             </td></tr>
        
    </table>
</fieldset>
<fieldset style="width:70%"><legend>Datos de logueo</legend>
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr valign="top">
        	<td width="50%">
            	<label class="tit_campos">Usuario:</label> <input type="text" name="usuario" id="usuario" value=""  onblur="javascript:if(this.value) usuario_disponible(this.value);" /> <label class="campo_obligatorio">*</label>
                <div id="aviso_disp"></div>
            </td>
    		<td class="color_2colum"><label class="tit_campos">Clave:</label> <input type="password" name="clave" id="clave" value="" /> <label class="campo_obligatorio">*</label>            
                
             </td></tr>  
             <?Php if($_SESSION['perfil']<3 && $_SESSION['perfil']>0):?><tr valign="top">
        	<td width="50%">
            	<label class="tit_campos">Puede modificar parametros de taquillas? </label> <select name="mt" id="mt"><option value="1">Si</option><option value="0">No</option></select>                
            </td>
    		<td class="color_2colum"></td></tr>           
            <?Php endif;?>           
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.intermediarios,'intermediarios.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    </fieldset>
    <input type="hidden" name="idintermediario" id="idintermediario" value="" />
     <div id="listado">
    <?Php
		include("procesos/listar_intermediarios.php");
	?>
    </div>
    <input type="hidden" name="usuario_actual" id="usuario_actual" value="" />
</form>