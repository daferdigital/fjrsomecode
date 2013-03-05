<?Php session_start();include("procesos/conexion.php");

?>
<div class="titulo">Registro / Edici&oacute;n de Combinaciones</div>
<form name="combinaciones" id="Formulario" method="post" action="procesos/guardar_combinaciones.php">
<fieldset>
	<legend>Seleccione las combinaciones posibles para cada apuesta</legend>
    <table width="800px">
    	<tr>
        	<td width="250px;" valign="top"><label class="tit_campos"><strong>Apuesta:</strong></label> <input type="text" readonly="readonly" required="required" value="" name="napuesta" id="napuesta" /></td>
            <td><center>
                	<label class="tit_campos"><strong>Se puede combinar con:</strong></label>
                </center><br />
            	<?Php 
					$selectapuestas="select * from vista_categorias_apuestas where idcategoria='".$_REQUEST['categoria']."' and estatus='1' order by nombre_tipo_apuesta,nombre_apuesta,que_equipo";
					$queryapuestas=mysql_query($selectapuestas);
						if(mysql_num_rows($queryapuestas)>0){
							?><table width="100%"><?Php
								while($varapuestas=mysql_fetch_assoc($queryapuestas)){
									?>
										<tr class="tr"><td><input type="checkbox" name="<?Php echo $varapuestas['idcategoria_apuesta'];?>" id="idcas<?Php echo $varapuestas['idcategoria_apuesta'];?>" value="<?Php echo $varapuestas['idcategoria_apuesta'];?>" /></td><td><?Php echo $varapuestas['descripcion'].' -> '. $varapuestas['que_equipo'];?></td></tr>
									<?Php
								}
							?></table><?Php
						}else{
							echo "<div align='center'>No se encontraron apuestas para el deporte seleccionado</div>";	
						}
				?>
            </td></tr>
            <tr>
            	<td><input name="guardar" type="button" class="boton" onClick="javascript:comentario='Indique el tipo de apuesta a combinar';validar(document.combinaciones,'combinaciones.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onClick="deshacer(cadena_hiden)" /></td><td></td>
            </tr>
    </table>
</fieldset>
 <div id="listado" style=" clear:both;">
	   <?Php
            include("procesos/listar_combinaciones.php");
       ?>    
   </div>
   <input type="hidden" name="idcategoria_apuesta" id="idcategoria_apuesta" value="" />
</form>
<script language="javascript">
cadena_hiden='idcategoria_apuesta';//separados por comas ,
categoria_sel="<?php echo $_REQUEST['categoria']; ?>";
//liga_sel="<?php echo $_REQUEST['liga']; ?>";
//$("#fecha_ld").datepicker();
//$('#tabletwo').tableHover({colClass: 'hover'});
</script>