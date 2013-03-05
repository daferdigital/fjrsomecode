<?Php session_start();//include_once("/procesos/sesiones.php");
	include_once("conexion.php");
	
	echo $_REQUEST["busca"];
	
		if($_SESSION['datos']['idbanquero']) $where=" where idbanquero='".$_SESSION['datos']['idbanquero']."'";
		$selectequipos="select * from vista_taquillas $where";
		$queryequipos=mysql_query($selectequipos);
			if(mysql_num_rows($queryequipos)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;">
  <tr class="titulo_tablas"><td class="columna_sola">ID</td>
    <td>Taquilla</td>
    <td>Intermediario</td><td>Banquero</td><td>Estatus</td><td></td></tr><?Php
				$npagl=0;$c=1;
				while($varequipos=mysql_fetch_assoc($queryequipos)){
					//$varequipos=convertArrayKeysToUtf8($varequipos);
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>"><td class="titulo_tablas columna_sola"><?php echo $varequipos['idtaquilla']; ?></td><td><?php echo $varequipos['nombre']; ?></td><td><?php echo $varequipos['nombre_intermediario']; ?></td><td><?php echo $varequipos['nombre_banquero']; ?></td><td><?php echo $varequipos['estatus']; ?></td><td align="right"><img src="imagenes/editar.png" title="Editar" width="16px" border="0" onclick="javascript:jQuery('[name=\'guardar\']').val('Modificar');editar_datos('nombre,intermediario,idtaquilla,cedula,telefono,direccion,email,usuario,clave,tipo,mjpd,mpjpd,mjpdrl,mapt,mjpp,mp,mjr,pdu,pdv,pdvd,cmina,cdpp,cdpd,tlpat,pp,cmlp,cmht,cmmt,pagr,cmapd,cma2,cma3,cma4,cma5,cma6,cma7,cma8,cma9,cma10,usuario_actual,fa','<?php echo $varequipos['nombre'].','.$varequipos['idintermediario'].','.$varequipos['idtaquilla'].','.$varequipos['cedula'].','.$varequipos['telefono'].','.$varequipos['direccion'].','.$varequipos['email'].','.$varequipos['usuario'].','.$varequipos['clave'].','.$varequipos['tipo'].','.$varequipos['mjpd'].','.$varequipos['mpjpd'].','.$varequipos['mjpdrl'].','.$varequipos['mapt'].','.$varequipos['mjpp'].','.$varequipos['mp'].','.$varequipos['mjr'].','.$varequipos['pdu'].','.$varequipos['pdv'].','.$varequipos['pdvd'].','.$varequipos['cmina'].','.$varequipos['cdpp'].','.$varequipos['cdpd'].','.$varequipos['tlpat'].','.$varequipos['pp'].','.$varequipos['cmlp'].','.$varequipos['cmht'].','.$varequipos['cmmt'].','.$varequipos['pagr'].','.$varequipos['cmapd'].','.$varequipos['cma2'].','.$varequipos['cma3'].','.$varequipos['cma4'].','.$varequipos['cma5'].','.$varequipos['cma6'].','.$varequipos['cma7'].','.$varequipos['cma8'].','.$varequipos['cma9'].','.$varequipos['cma10'].','.$varequipos['usuario'].','.$varequipos['fa']; ?>');" /></td></tr>
					<?Php
					$c++;
				}
				?></table><?Php
			}else{
				?><div align="center"><strong>No se han registro taquillas</strong></div><?Php
			}
	?>