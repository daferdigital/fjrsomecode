<?Php //include_once("/procesos/sesiones.php");
	include_once("conexion.php");
		$selectligas="select * from vista_apuestas order by idtipo_apuesta,idapuesta";
		$queryligas=mysql_query($selectligas);
			if(mysql_num_rows($queryligas)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Apuesta</td>
    <td>Descripción / Para el equipo</td>
    <td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1; $tap='';
				while($varligas=mysql_fetch_assoc($queryligas)){
					//$varligas=convertArrayKeysToUtf8($varligas);
					if($tap!=$varligas['nombre_tipo_apuesta']){
						$tap=$varligas['nombre_tipo_apuesta'];
						?>
							<tr><td colspan="5"><b><?Php echo $varligas['nombre_tipo_apuesta'].' / Especial para '.$varligas['tipo'];?></b></td></tr>
						<?Php
					}
					
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varligas['idapuesta']; ?></td><td><?php echo $varligas['nombre']; ?></td><td><?php echo $varligas['descripcion'].' / '.$varligas['que_equipo']; ?></td><td><?php echo $varligas['estatus']; ?></td><td align="right"><img src="imagenes/editar.png" width="16px" border="0" onclick="javascript:editar_datos('nombre,tipo_apuesta,idapuesta,descripcion,que_equipo','<?php echo $varligas['nombre'].','.$varligas['idtipo_apuesta'].','.$varligas['idapuesta'].','.$varligas['descripcion'].','.$varligas['que_equipo']; ?>');" /><img style="padding-left:5px;" src="imagenes/<?php echo ($varligas['estatus']=='1'?'eliminar.png':'BIEN.png'); ?>" width="16px" border="0" onclick="if(confirm('Presione aceptar si desea <?php echo ($varligas['estatus']=='1'?'Deshabilitar':'Habilitar'); ?> el registro <?php echo $varligas['nombre']; ?> ')){location.href='procesos/habilita_deshabilita.php?equipo=apuestas&deshab=<?php echo ($varligas['estatus']);?>&id=<?php echo $varligas['idapuesta']; ?>&redir=ingreso_apuestas.php';}" /></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro apuestas</strong></div><?Php
			}
	?>