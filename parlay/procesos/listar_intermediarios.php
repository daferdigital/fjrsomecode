<?Php session_start();//include_once("/procesos/sesiones.php");
	include_once("conexion.php");
		if($_SESSION['datos']['idbanquero']) $where=" where idbanquero='".$_SESSION['datos']['idbanquero']."'";
		$selectligas="select * from vista_intermediarios $where";
		$queryligas=mysql_query($selectligas);
			if(@mysql_num_rows($queryligas)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;"><tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Intermediario</td><td>Banquero</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varligas=mysql_fetch_assoc($queryligas)){
					//$varligas=convertArrayKeysToUtf8($varligas);
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varligas['idintermediario']; ?></td><td><?php echo $varligas['nombre']; ?></td><td><?php echo $varligas['nombres']; ?></td><td><?php echo $varligas['estatus']; ?></td><td align="right"><img src="imagenes/editar.png" width="16px" border="0" onclick="javascript:editar_datos('nombre,banquero,idintermediario,direccion,telefono,cedula,pp,pd,usuario,clave,usuario_actual,mt','<?php echo $varligas['nombre'].','.$varligas['idbanquero'].','.$varligas['idintermediario'].','.$varligas['direccion'].','.$varligas['telefono'].','.$varligas['cedula'].','.$varligas['pp'].','.$varligas['pd'].','.$varligas['usuario'].','.$varligas['clave'].','.$varligas['usuario'].','.$varligas['mt']; ?>');" /><img style="padding-left:5px;" src="imagenes/<?php echo ($varligas['estatus']=='1'?'eliminar.png':'BIEN.png'); ?>" width="16px" border="0" onclick="if(confirm('Presione aceptar si desea <?php echo ($varligas['estatus']=='1'?'Deshabilitar':'Habilitar'); ?> el registro <?php echo $varligas['nombre']; ?> ')){location.href='procesos/habilita_deshabilita.php?equipo=ligas&deshab=<?php echo ($varligas['estatus']);?>&id=<?php echo $varligas['idliga']; ?>&redir=ingreso_ligas.php';}" /></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro intermediarios</strong></div><?Php
			}
	?>