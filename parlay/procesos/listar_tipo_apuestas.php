<?Php //include_once("/procesos/sesiones.php");
	include_once("conexion.php");
		$selectcategorias="select * from tipo_apuestas";
		$querycategorias=mysql_query($selectcategorias);
			if(mysql_num_rows($querycategorias)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Tipo de apuestas / Especial para</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varcategorias=mysql_fetch_assoc($querycategorias)){
					$varcategorias=$varcategorias;
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varcategorias['idtipo_apuesta']; ?></td><td><?php echo $varcategorias['nombre'].' / '.ucfirst($varcategorias['tipo']); ?></td><td><?php echo $varcategorias['estatus']; ?></td><td align="right"><img src="imagenes/editar.png" width="16px" border="0" onclick="javascript:editar_datos('nombre,idtipo_apuesta,tipo','<?php echo $varcategorias['nombre'].','.$varcategorias['idtipo_apuesta'].','.$varcategorias['tipo'];?>');" /><img style="padding-left:5px;" src="imagenes/<?php echo ($varcategorias['estatus']=='1'?'eliminar.png':'BIEN.png'); ?>" width="16px" border="0" onclick="if(confirm('Presione aceptar si desea <?php echo ($varcategorias['estatus']=='1'?'Deshabilitar':'Habilitar'); ?> el registro <?php echo $varcategorias['nombre']; ?> ')){location.href='procesos/habilita_deshabilita.php?equipo=tipo_apuestas&deshab=<?php echo ($varcategorias['estatus']);?>&id=<?php echo $varcategorias['idtipo_apuesta']; ?>&redir=ingreso_tipo_apuestas.php';}" /></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro categorias</strong></div><?Php
			}
	?>