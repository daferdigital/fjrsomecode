<?Php include_once("procesos/conexion.php");?>
<script language="javascript">
	cadena_hiden='idcategoria';
</script>
<div class="titulo">Registro / Edici&oacute;n de Categorias</div>
<form name="categorias" method="post" action="procesos/guardar_categorias.php">
	<table width="100%" cellpadding="4px" cellspacing="0">
    	<tr valign="top">
        	<td width="50%">
            <label class="tit_campos">Nombre del Deporte:</label> <input type="text" name="nombre" id="nombre" value="" /> <label class="campo_obligatorio">*</label><br />
            <label class="tit_campos">Estatus:</label> <select name="estatus" id="estatus"><option value="0">Desactivado</option><option value="1">Activado</option></select> <label class="campo_obligatorio">*</label><br />
            </td>
    		<td class="" bgcolor="#999999">
            <label><b>Asociar a apuestas:</b></label><br />
            <table width="100%">
            	<tr class="titulo_tablas" style="background-color:#000 !important;">
                	<td></td>
                	<td>Nombre / descripcion apuesta:</td>
                </tr>
                <?Php
					$selectap="select * from vista_apuestas where estatus ='1' order by idtipo_apuesta,idapuesta";
					$queryap=mysql_query($selectap);
					$numap=mysql_num_rows($queryap);
						if($numap>0){ $contador=0;$tap='';//tipo apuestas
						?><input type="hidden" name="nregistros" value="<?php echo $numap; ?>" /><?Php
							while($varap=mysql_fetch_assoc($queryap)){
								if($tap!=$varap['nombre_tipo_apuesta']){
									$tap=$varap['nombre_tipo_apuesta'];
									?>
                                    	<tr><td colspan="2" bgcolor="#FFFFFF"><b><?Php echo $varap['nombre_tipo_apuesta'].' / Especial para '.$varap['tipo'];?></b></td></tr>
                                    <?Php
								}
								?>
									<tr class="tr"><td><input type="checkbox" name="idapuesta<?php echo $contador; ?>" id="idapuesta<?php echo $varap['idapuesta']; ?>" value="<?php echo $varap['idapuesta']; ?>" /><?php echo $varap['idapuesta']; ?></td><td><?Php echo $varap['nombre'].' / '.$varap['descripcion'];?></td></tr>                                    
								<?Php
								$contador++;
							}
						}else{
							?><tr><td colspan="2">No se encontraron apuestas registradas en la BD</td></tr><?Php
						}
				?>
            </table>
                
             </td></tr>
        <tr><td align="left" colspan="2"><input name="guardar" type="button" class="boton" onclick="javascript:validar(document.categorias,'categorias.php');" value="Guardar" /><input name="cancelar" type="reset" class="boton" style=" margin-left:20px;" value="Deshacer" onclick="deshacer(cadena_hiden)" /></td></tr>
    </table>
    <input type="hidden" name="idcategoria" id="idcategoria" value="" />
    <div id="listado">
    <?Php
		include("procesos/listar_categorias.php");
	?>
    </div>
</form>