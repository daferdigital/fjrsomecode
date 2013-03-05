<?Php //include_once("/procesos/sesiones.php");
	include_once("conexion.php");
		$selectlistado="select * from banqueros";
		$queryclistado=mysql_query($selectlistado);
			if(mysql_num_rows($queryclistado)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Banquero</td><td>Tel&eacute;fono</td><td>Correo</td><td>Web</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varlistado=mysql_fetch_assoc($queryclistado)){
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varlistado['idbanquero']; ?></td><td><?php echo $varlistado['nombres'].' '.$varlistado['apellidos']; ?></td><td><?php echo $varlistado['telefonos']; ?></td><td><?php echo $varlistado['correo']; ?></td><td><a href="<?php echo $varlistado['web']; ?>" target="_blank"><?php echo $varlistado['web']; ?></a></td><td><?php echo $varlistado['estatus']; ?></td><td align="right"><img src="imagenes/editar.png" width="16px" border="0" onclick="javascript:editar_datos('nombres,apellidos,cedula,direccion,telefono,correo,web,idbanquero,usuario,clave,usuario_actual,ml','<?php echo $varlistado['nombres'].','.$varlistado['apellidos'].','.$varlistado['ced_rif'].','.$varlistado['direccion'].','.$varlistado['telefonos'].','.$varlistado['correo'].','.$varlistado['web'].','.$varlistado['idbanquero'].','.$varlistado['usuario'].','.$varlistado['clave'].','.$varlistado['usuario'].','.$varlistado['ml'];?>');" /><img style="padding-left:5px;" src="imagenes/<?php echo ($varlistado['estatus']=='1'?'eliminar.png':'BIEN.png'); ?>" width="16px" border="0" onclick="if(confirm('Presione aceptar si desea <?php echo ($varlistado['estatus']=='1'?'Deshabilitar':'Habilitar'); ?> el registro <?php echo $varlistado['nombres']; ?> ')){location.href='procesos/habilita_deshabilita.php?equipo=banqueros&deshab=<?php echo ($varlistado['estatus']);?>&id=<?php echo $varlistado['idbanquero']; ?>&redir=ingreso_banqueros.php';}" /></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro banqueros</strong></div><?Php
			}
	?>