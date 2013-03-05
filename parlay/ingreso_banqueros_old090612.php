<?Php session_start();include_once("procesos/conexion.php");?>
<script language="javascript">
	cadena_hiden='idbanquero,usuario_actual';
</script>
<div class="titulo">Registro / Edici&oacute;n de Categorias</div>
<form name="banqueros" method="post" action="procesos/guardar_banqueros.php">
	<fieldset style="width:60%"><legend>Datos del banquero</legend>
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">Nombres:</label> <input type="text" name="nombres" id="nombres" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Apellidos:</label> <input type="text" name="apellidos" id="apellidos" value="" /> <label class="campo_obligatorio">*</label>            
                
             </td></tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Cedula / Rif:</label> <input type="text" name="cedula" id="cedula" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Direcci&oacute;n:</label> <input type="text" name="direccion" id="direccion" value="" /> <label class="campo_obligatorio">*</label>                            
             </td></tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Tel&eacute;fono:</label> <input type="text" name="telefono" id="telefono" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Correo:</label> <input type="text" name="correo" id="correo" value="" /> <label class="campo_obligatorio">*</label>                            
             </td></tr>
             <tr>
        	<td width="50%"><label class="tit_campos">Web:</label> <input type="text" name="web" id="web" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum">        </td></tr>
        
    </table>
    </fieldset>
    <fieldset style="width:60%"><legend>Datos de logueo</legend>
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr valign="top">
        	<td width="50%">
            	<label class="tit_campos">Usuario:</label> <input type="text" name="usuario" id="usuario" value="" onblur="javascript:if(this.value) usuario_disponible(this.value);" /> <label class="campo_obligatorio">*</label>
                <div id="aviso_disp"></div>
            </td>
    		<td class="color_2colum"><label class="tit_campos">Clave:</label> <input type="password" name="clave" id="clave" value="" /> <label class="campo_obligatorio">*</label>            
                
             </td></tr>  
             <?Php if($_SESSION['perfil']==1):?><tr valign="top">
        	<td width="50%">
            	<label class="tit_campos">Puede modificar logros? </label> <select name="ml" id="ml"><option value="1">Si</option><option value="0">No</option></select>                
            </td>
    		<td class="color_2colum"></td></tr>           
            <?Php endif;?>
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.banqueros,'banqueros.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    </fieldset>
    <input type="hidden" name="idbanquero" id="idbanquero" value="" />
    <div id="listado">
    <?Php
		include("procesos/listar_banqueros.php");
	?>
    </div>
    <input type="hidden" name="usuario_actual" id="usuario_actual" value="" />
</form>