<?Php //include_once("/procesos/sesiones.php");
	include_once("conexion.php");
		$selectligas="select * from vista_ligas";
		$queryligas=mysql_query($selectligas);
			if(mysql_num_rows($queryligas)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Liga</td><td>Deporte</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varligas=mysql_fetch_assoc($queryligas)){
					//$varligas=convertArrayKeysToUtf8($varligas);
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varligas['idliga']; ?></td><td><?php echo $varligas['nombre']; ?></td><td><?php echo $varligas['nombre_categoria']; ?></td><td><?php echo ($varligas['estatus']>0?'Activado':'Desactivado'); ?></td><td align="right"><img src="imagenes/editar.png" width="16px" border="0" onclick="javascript:$(':checkbox').attr('checked',false);editar_datos('nombre,categoria,idliga,liga_padre,estatus','<?php echo $varligas['nombre'].','.$varligas['idcategoria'].','.$varligas['idliga'].','.$varligas['liga_padre'].','.$varligas['estatus']; ?>');tildar('idoliga','<?Php echo str_replace('|','',$varligas['otras_ligas']);?>');" /></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro ligas</strong></div><?Php
			}
	?>