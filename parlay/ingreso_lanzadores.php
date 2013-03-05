<?Php include_once("procesos/conexion.php");?>
<script language="javascript">
	cadena_hiden='idroster';
</script>
<div class="titulo">Registro / Edici&oacute;n de Lanzadores</div>
<form name="lanzadores" method="post" action="procesos/guardar_lanzadores.php">
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">Nombre del Lanzador:</label> <input type="text" name="nombre" id="nombre" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><label class="tit_campos">Equipo:</label>
            <?php genera_select("select idequipo,nombre from vista_equipos where idcategoria='2' order by nombre",' name="equipo" id="equipo" required="required"',$_GET['idequipo']);?>
            
                <label class="campo_obligatorio">*</label>
             </td></tr>
             <tr valign="top">
        	<td width="50%"><label class="tit_campos">Efectividad:</label> <input name="efectividad" type="text" id="efectividad" value="" size="3" /> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><label class="tit_campos">Ganados:</label> <input name="ganados" type="text" id="ganados" value="" size="2" /> <label class="campo_obligatorio">*</label> 
             </td></tr>
             <tr valign="top">
        	<td width="50%"><label class="tit_campos">Tendencia:</label> <select name="lado" id="lado"><option value="no aplica">No Aplica</option><option value="derecho">Derecho</option><option value="zurdo">Zurdo</option></select> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><label class="tit_campos">
    		  Perdidos:</label> 
    		<input name="perdidos" type="text" id="perdidos" value="" size="2" /> <label class="campo_obligatorio">*</label> 
             </td></tr>
             <tr valign="top">
        	<td width="50%"><label class="tit_campos">Estatus:</label> <select name="estatus" id="estatus"><option value="0">Deshabilitado</option><option value="1">Habilitado</option></select> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum">
             </td></tr>
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.lanzadores,'lanzadores.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer"  onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <input type="hidden" name="idroster" id="idroster" value="" />
   <div id="listado">
	   <?Php
            include("procesos/listar_lanzadores.php");
       ?>    
   </div>
</form>