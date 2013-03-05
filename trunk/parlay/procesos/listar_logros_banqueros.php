<?Php if(!$_SESSION['datos']) session_start();
	include_once("conexion.php");
		$cadenaidsA=dameids("select idcategoria_apuesta from vista_categorias_apuestas where idcategoria='".$_REQUEST['categoria']."' and estatus='1' and que_equipo='A'");
		$cadenaidsB=dameids("select idcategoria_apuesta from vista_categorias_apuestas where idcategoria='".$_REQUEST['categoria']."' and estatus='1' and que_equipo='B'");
		//echo $cadenaids;
		//print_r($cadenaidsA);
		?>
        	
        	<input type="hidden" name="cadenaidsA" value="<?Php echo $cadenaidsA;?>" />
            <input type="hidden" name="cadenaidsB" value="<?Php echo $cadenaidsB;?>" />
            <input type="hidden" name="idlogro_equipoA" id="idlogro_equipoA" value="" />
            <input type="hidden" name="idlogro_equipoB" id="idlogro_equipoB" value="" />
		<?Php
		list($dia,$mes,$ano)=explode("/",$_REQUEST['fecha']);
		$selectlistado="select *,date_format(fecha,'%d/%m/%Y') as fecha_logro from vista_logros_categorias where fecha='".$ano.'-'.$mes.'-'.$dia."' and idliga='".$_REQUEST['liga']."' and estatus='1' group by idlogro ORDER BY hora";
		//echo $selectlistado; exit;
		$queryclistado=mysql_query($selectlistado);
			if(mysql_num_rows($queryclistado)>0){
				?><hr /><table width="100%" cellpadding="4px" cellspacing="0" style="margin-top:25px;" id="">
				<?Php if($_REQUEST['categoria']=='2'):?>
                <tr class="titulo_tablas"><td width="4%" class="columna_sola">ID</td>
                  <td width="1%" class="columna_sola">&nbsp;</td>
                <td width="10%">Fecha</td><td width="7%">Hora</td>
    <td width="32%">Visitante / Pitcher / Referencia</td>
    <td width="35%">Home Club / Pitcher / Referencia</td><td width="9%">Estatus</td></tr>
	
	<?Php
		else:
	?>
     <tr class="titulo_tablas">
     <td class="columna_sola">ID</td>
       <td class="columna_sola">&nbsp;</td>
                <td>Fecha</td><td>Hora</td>
    <td>Visitante / Referencia</td>
    <td>Home Club / Referencia</td><td>Estatus</td></tr>
    <?php	
		endif;
				$npagl=0;$c=1;
				while($varlistado=mysql_fetch_assoc($queryclistado)){
					$varlistado=$varlistado;
										
					$equipoA=dameids("select idequipo from logros_equipos where idlogro='".$varlistado['idlogro']."' and estatus='1' order by idlogro_equipo limit 0,1");
					$equipoB=dameids("select idequipo from logros_equipos where idlogro='".$varlistado['idlogro']."' and estatus='1' order by idlogro_equipo limit 1,1");
					$lanzadorA=dameids("select idroster from logros_equipos where idlogro='".$varlistado['idlogro']."' and estatus='1' order by idlogro_equipo limit 0,1");
					$lanzadorB=dameids("select idroster from logros_equipos where idlogro='".$varlistado['idlogro']."' and estatus='1' order by idlogro_equipo limit 1,1");
					$idlogroeA=dameids("select idlogro_equipo from logros_equipos where idlogro='".$varlistado['idlogro']."' and estatus='1' order by idlogro_equipo limit 0,1");
					$idlogroeB=dameids("select idlogro_equipo from logros_equipos where idlogro='".$varlistado['idlogro']."' and estatus='1' order by idlogro_equipo limit 1,1");
					$referenciaA=dameids("select referencia from logros_equipos where idlogro='".$varlistado['idlogro']."' and estatus='1' order by idlogro_equipo limit 0,1");
					$referenciaB=dameids("select referencia from logros_equipos where idlogro='".$varlistado['idlogro']."' and estatus='1' order by idlogro_equipo limit 1,1");
					
					$cadenaids2=dameids("select idcategoria_apuesta from vista_logros_banqueros where idlogro='".$varlistado['idlogro']."' and idbanquero='".$_SESSION['datos']['idbanquero']."' and estatus='1' order by que_equipo,idcategoria_apuesta");
					if($cadenaids2){
						//echo 'existe';
						$valoresids=dameids("select pago from vista_logros_banqueros where idlogro='".$varlistado['idlogro']."' and idbanquero='".$_SESSION['datos']['idbanquero']."' and estatus='1' order by que_equipo,idcategoria_apuesta");
						$valoresmult=dameids("select multiplicando from vista_logros_banqueros where idlogro='".$varlistado['idlogro']."' and idbanquero='".$_SESSION['datos']['idbanquero']."' and estatus='1' order by que_equipo,idcategoria_apuesta");
					}else{
						//echo 'no existe';
						$cadenaids2=dameids("select idcategoria_apuesta from vista_logros where idlogro='".$varlistado['idlogro']."' and estatus='1' order by que_equipo,idcategoria_apuesta");
						$valoresids=dameids("select pago from vista_logros where idlogro='".$varlistado['idlogro']."' and estatus='1' order by que_equipo,idcategoria_apuesta");
						$valoresmult=dameids("select multiplicando from vista_logros where idlogro='".$varlistado['idlogro']."' and estatus='1' order by que_equipo,idcategoria_apuesta");
					}
					//$varlistado=decodeUTF8($varlistado);
					if($c==3){$c=1;$npagl++; /*$ocultarfilas='display:none;';*/}
					if($_REQUEST['categoria']=='2'):
						$datos_lanzador1=dame_datos("select * from vista_lanzadores where idroster='".$lanzadorA."' limit 1");
						$nombre_eA=$datos_lanzador1['nombre_equipo'].' / '.$datos_lanzador1['nombre'];					
						$datos_lanzador2=dame_datos("select * from vista_lanzadores where idroster='".$lanzadorB."' limit 1");
						$nombre_eB=$datos_lanzador2['nombre_equipo'].' / '.$datos_lanzador2['nombre'];					
					else:
						$datos_equipoA=dame_datos("select * from vista_equipos where idequipo='".$equipoA."' limit 1");
						$nombre_eA=$datos_equipoA['nombre'];
						$datos_equipoB=dame_datos("select * from vista_equipos where idequipo='".$equipoB."' limit 1");						
						$nombre_eB=$datos_equipoB['nombre'];
					endif;
					?>
						<tr class="tr pag<?Php echo $npagl;?>" style="<?Php echo $ocultarfilas;?>">
                        	<td class="titulo_tablas columna_sola"><?php echo $varlistado['idlogro']; ?></td>
                            <td align=""  class="titulo_tablas columna_sola"><img src="imagenes/editar.png" width="16px" border="0" onClick="javascript:$('html, body').animate({ scrollTop: 0 }, 0);deshacer(cadena_hiden);$('[name=\'guardar\']').val('Modificar');editar_datos('idlogro,fecha,hora,visitante,home,idlogro_equipoA,idlogro_equipoB,referenciaA,referenciaB','<?php echo $varlistado['idlogro'].','.$varlistado['fecha_logro'].','.$varlistado['hora'].','.$equipoA.','.$equipoB.','.$idlogroeA.','.$idlogroeB.','.$referenciaA.','.$referenciaB; ?>');editar_datos_apuestas('<?Php echo $cadenaids2;?>','<?php echo $valoresids;?>','idapuesta');$('#visitante').change();$('#home').change();editar_datos('lvisitante,lhome','<?php echo $lanzadorA.','.$lanzadorB;?>');editar_datos_radio('<?Php echo $cadenaids2;?>','<?php echo $valoresmult;?>','m');" /></td>
                            <td><?php echo $varlistado['fecha_logro']; ?></td><td><?php echo $varlistado['hora']; ?></td>
                            <td><?php echo $nombre_eA.' / '.$referenciaA; ?></td>
                            <td><?php echo $nombre_eB.' / '.$referenciaB; ?></td>
                            <td><?php echo ($varlistado['estatus']>0?'Activado':'Desactivado'); ?></td>
                            </tr>
					<?Php
					$c++;
				}
				?></table><br />
				<!--<div align="center"><input type="button" value="Imprimir logros" class="boton" onclick="window.open('imprimir_beisbol.php?fecha=<?Php echo $ano.'-'.$mes.'-'.$dia;?>&liga='+liga_sel);" /></div>-->
				<?Php
			}else{
				?><div align="center"><strong>No se han registro logros para la fecha <?Php echo $_REQUEST['fecha'];?></strong></div><?Php
			}
	?>