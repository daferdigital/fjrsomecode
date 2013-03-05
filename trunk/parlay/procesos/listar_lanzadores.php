<?Php //include_once("/procesos/sesiones.php");
	include_once("conexion.php");
		$selectequipos="select * from vista_lanzadores where nombre!='no'";
		$queryequipos=mysql_query($selectequipos);
			if(mysql_num_rows($queryequipos)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Lanzador</td>
    <td>Equipo</td>
    <td>Liga</td><td>Deporte</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varequipos=mysql_fetch_assoc($queryequipos)){
					//$varequipos=convertArrayKeysToUtf8($varequipos);
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varequipos['idroster']; ?></td><td><?php echo $varequipos['nombre'].' ('.ucwords($varequipos['lado']).')'; ?></td><td><?php echo $varequipos['nombre_equipo']; ?></td><td><?php echo $varequipos['nombre_liga']; ?></td><td><?php echo $varequipos['nombre_categoria']; ?></td><td><?php echo ($varequipos['estatus']>0?'Habilitado':'Deshabilitado'); ?></td><td align="right"><img src="imagenes/editar.png" title="Editar" width="16px" border="0" onclick="javascript:$('html, body').animate({ scrollTop: 0 }, 0);editar_datos('nombre,equipo,idroster,efectividad,ganados,perdidos,lado,estatus','<?php echo $varequipos['nombre'].','.$varequipos['idequipo'].','.$varequipos['idroster'].','.$varequipos['efectividad'].','.$varequipos['ganados'].','.$varequipos['perdidos'].','.$varequipos['lado'].','.$varequipos['estatus']; ?>');" /><!--<img style="padding-left:5px;" src="imagenes/<?php echo ($varequipos['estatus']=='1'?'eliminar.png':'BIEN.png'); ?>" width="16px" border="0" onclick="if(confirm('Presione aceptar si desea <?php echo ($varequipos['estatus']=='1'?'Deshabilitar':'Habilitar'); ?> el registro <?php echo $varequipos['nombre']; ?> ')){location.href='procesos/habilita_deshabilita.php?equipo=roster&deshab=<?php echo ($varequipos['estatus']);?>&id=<?php echo $varequipos['idroster']; ?>&redir=ingreso_lanzadores.php';}" />--></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro lanzadores</strong></div><?Php
			}
	?>