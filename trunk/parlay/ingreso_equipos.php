<?Php include_once("procesos/conexion.php");?>
<script language="javascript">
	cadena_hiden='idequipo';
</script>
<div class="titulo">Registro / Edici&oacute;n de Equipos</div>
<form name="equipos" method="post" action="procesos/guardar_equipos.php">
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">Nombre del Equipo:</label> <input type="text" name="nombre" id="nombre" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum"><label class="tit_campos">Liga Padre:</label>
            <select name="liga" id="liga">
                    <option value=""><b>Liga</b></option>
            <?Php 
				$selectligas="select * from ligas";
				$queryligas=mysql_query($selectligas);
					if(mysql_num_rows($queryligas)>0){
						while($varligas=mysql_fetch_assoc($queryligas)){
						?>
                            <option <?php echo $sel; ?> value="<?php echo $varligas['idliga']; ?>"><?php echo $varligas['nombre']; ?></option>               
                <?Php }//fin while
					}//fin if?>
                 </select>
                <label class="campo_obligatorio">*</label>
             </td></tr>
        	<tr>
        	<td width="50%"><label class="tit_campos">Estatus:</label> <select name="estatus" id="estatus"><option value="0">Deshabilitado</option><option value="1">Habilitado</option></select> <label class="campo_obligatorio">*</label></td>
    		<td  class="color_2colum">
             </td></tr>
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.equipos,'equipos.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer"  onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
  <input type="hidden" name="idequipo" id="idequipo" value="" />
    <div id="listado">
    <?Php
		include("procesos/listar_equipos.php");
	?>
    </div>
</form>