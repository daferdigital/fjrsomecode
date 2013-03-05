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
             </td></tr><tr>
        	<td class="color_2colum"><label class="tit_campos">Liga padre:</label>
            <select name="liga_padre" id="liga_padre">
                            <option value="1">Si</option>
                            <option value="0">No</option>                            
                 </select>
                <label class="campo_obligatorio">*</label>
             </td>
    		<td><label class="tit_campos">Estatus:</label>
            <select name="estatus" id="estatus">
                            <option value="1">Activo</option>
                            <option value="0">Desactivo</option>                            
                 </select>
                <label class="campo_obligatorio">*</label></td></tr>
             <tr>
          <td align="left" colspan="2"><p>Indique a que <strong>Otras Ligas</strong> pertenece el equipo</p>
            <table width="900" border="1" cellspacing="0" cellpadding="0" align="center">
			<?
				$sql="select * from ligas where liga_padre!=1 order by nombre";////RECUERDA COLOCAR EL WHERE = 1 PARA IDENTIFICAR LOS PADRES
				$result2 = mysql_query($sql,$conexion);
				$columnes = 4;
				
				if (($rows=mysql_num_rows($result2))==0) {
				  echo "<tr><td colspan=$columnes>No hay resultados en la BD.</td></tr>";
				}?>
				<td colspan="<? echo $columnes;?>" align="center"><strong>Indique a que Otras Ligas pertenecen los equipo de esta liga</strong></td><?
				$contador=0;
				for ($i=1; $rows=mysql_fetch_array($result2); $i++) {
				$resto = ($i % $columnes); 
				if ($resto == 1) {echo "<tr>";} 
					if ($rows["estatus"]!='0'){?>
					<td width="240" align="left" style="padding-left:5px; height:20px;">
                    <input type="checkbox" name="idoliga<?php echo $contador; ?>" id="idoliga<?php echo $rows['idliga']; ?>" value="<?php echo $rows['idliga']; ?>" /><?Php echo $rows['idliga'];?>
					<?	
					$contador++;
					echo $nom=$rows["nombre"];?>
					</td>
					<? }
				if ($resto == 0) {echo "</tr>";}
				}
				?><input type="hidden" name="nregistros" value="<?Php echo $contador;?>" /><?Php
				if ($resto <> 0) {
				$ajust = $columnes - $resto;
				for ($j = 0; $j < $ajust; $j++) {echo "<td>&nbsp;</td>";}
				echo "</tr>";
				}?></table>
          <p>&nbsp;</p></td>
        </tr>
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.ligas,'ligas.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <input type="hidden" name="idliga" id="idliga" value="" />
     <div id="listado">
    <?Php
		include("procesos/listar_ligas.php");
	?>
    </div>
</form>