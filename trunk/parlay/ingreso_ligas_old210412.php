<?Php include_once("procesos/conexion.php");?>
<script language="javascript">
	cadena_hiden='idliga';
</script>
<div class="titulo">Registro / Edici&oacute;n de Ligas</div>
<form name="ligas" method="post" action="procesos/guardar_ligas.php">
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td width="50%"><label class="tit_campos">Nombre de la Liga:</label> <input type="text" name="nombre" id="nombre" value="" /> <label class="campo_obligatorio">*</label></td>
    		<td class="color_2colum"><label class="tit_campos">Deporte:</label>
            <select name="categoria" id="categoria">
                    <option value=""><b>Deporte</b></option>
            <?Php 
				$selectcategorias="select * from categorias";
				$querycategorias=mysql_query($selectcategorias);
					if(mysql_num_rows($querycategorias)>0){
						while($varcategorias=mysql_fetch_assoc($querycategorias)){
						?>
                            <option <?php echo $sel; ?> value="<?php echo $varcategorias['idcategoria']; ?>"><?php echo $varcategorias['nombre']; ?></option>               
                <?Php }//fin while
					}//fin if?>
                 </select>
                <label class="campo_obligatorio">*</label>
             </td></tr>
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.ligas,'ligas.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <input type="hidden" name="idliga" id="idliga" value="" />
     <div id="listado">
    <?Php
		include("procesos/listar_ligas.php");
	?>
    </div>
</form>