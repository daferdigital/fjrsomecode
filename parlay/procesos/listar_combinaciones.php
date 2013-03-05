<?Php //include_once("/procesos/sesiones.php");
	include_once("conexion.php");
	//selecciono los idcategoria_apuesta
	$idsca=dameids("select idcategoria_apuesta from vista_categorias_apuestas where idcategoria='".$_REQUEST['categoria']."' and estatus='1' order by nombre_tipo_apuesta,nombre_apuesta,que_equipo");
	
		$selectcategorias="select * from vista_categorias_apuestas where idcategoria='".$_REQUEST['categoria']."' and estatus='1' order by nombre_tipo_apuesta,nombre_apuesta,que_equipo";
		$querycategorias=mysql_query($selectcategorias);
			if(mysql_num_rows($querycategorias)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Tipo de apuesta</td><td>Descripción apuesta</td><td>Que equipo</td><td>Combinación</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varcategorias=mysql_fetch_assoc($querycategorias)){
					//$varcategorias=convertArrayKeysToUtf8($varcategorias);
					$cadenaids=dameids("select idcategoria_apuesta_combinar from categorias_apuestas_combinaciones where idcategoria_apuesta='".$varcategorias['idcategoria_apuesta']."' and estatus='1'");
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varcategorias['idcategoria_apuesta']; ?></td><td><?php echo $varcategorias['nombre_tipo_apuesta']; ?></td><td><?php echo $varcategorias['descripcion']; ?></td><td><?php echo $varcategorias['que_equipo']; ?></td><td><?Php echo $cadenaids;?></td><td><?php echo $varcategorias['estatus']; ?></td><td align="right"><img src="imagenes/editar.png" width="16px" border="0" onclick="javascript:deshacer(cadena_hiden);editar_datos('idcategoria_apuesta,napuesta','<?php echo $varcategorias['idcategoria_apuesta'].','.$varcategorias['descripcion'];?>');tildar('idcas','<?Php echo $cadenaids;?>');" /><!--<img style="padding-left:5px;" src="imagenes/<?php echo ($varcategorias['estatus']=='1'?'eliminar.png':'BIEN.png'); ?>" width="16px" border="0" onclick="if(confirm('Presione aceptar si desea <?php echo ($varcategorias['estatus']=='1'?'Deshabilitar':'Habilitar'); ?> el registro <?php echo $varcategorias['nombre']; ?> ')){location.href='procesos/habilita_deshabilita.php?equipo=categorias&deshab=<?php echo ($varcategorias['estatus']);?>&id=<?php echo $varcategorias['idcategoria']; ?>&redir=ingreso_categorias.php';}" />--></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro categorias</strong></div><?Php
			}
	?>
<input type="hidden" name="idsca" value="<?Php echo $idsca;?>" />