<?Php 

//include_once("/procesos/sesiones.php");
	include_once("conexion.php");
		$selectcategorias="select * from categorias";
		$querycategorias=mysql_query($selectcategorias);
			if(mysql_num_rows($querycategorias)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Deporte</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varcategorias=mysql_fetch_assoc($querycategorias)){
					//$varcategorias=convertArrayKeysToUtf8($varcategorias);
					$cadenaids=dameids("select idapuesta from categorias_apuestas where idcategoria='".$varcategorias['idcategoria']."' and estatus='1'");
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varcategorias['idcategoria']; ?></td><td><?php echo $varcategorias['nombre']; ?></td><td><?php echo ($varcategorias['estatus']>0?'Activado':'Desactivado'); ?></td>
                        <td align="right"><img src="imagenes/editar.png" width="16px" border="0" onclick="javascript:deshacer(cadena_hiden);editar_datos('nombre,idcategoria,estatus','<?php echo $varcategorias['nombre'].','.$varcategorias['idcategoria'].','.$varcategorias['estatus'];?>');tildar('idapuesta','<?Php echo $cadenaids;?>');" /></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro categorias</strong></div><?Php
			}
	?>