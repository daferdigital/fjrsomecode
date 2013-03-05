<?Php
	include_once('conexion.php');
	$fecha_desde=formato_sql($_GET['fdesde'],'/');
	$fecha_hasta= formato_sql($_GET['fhasta'],'/');
	//$sql_ventas="select *,date_format(fecha_venta,'%d/%m/%Y') as fecha_venta,date_format(fecha_prorroga,'%d/%m/%Y') as fecha_prorroga from vista_ventas_detalles where fecha_venta>=DATE_SUB(CURDATE(), INTERVAL 1 DAY) and estatus_ventas='1' group by idventa order by fecha_venta desc,idventa";
	$sql_ventas="select *,date_format(fecha_venta,'%d/%m/%Y') as fecha_venta,date_format(fecha_prorroga,'%d/%m/%Y') as fecha_prorroga from vista_ventas_detalles where fecha_venta>='$fecha_desde' and fecha_venta<='$fecha_hasta' and estatus_ventas='1' group by idventa order by fecha_venta desc,idventa";
	
	$query_ventas=mysql_query($sql_ventas);
		if(mysql_num_rows($query_ventas)>0){ $contador=1;
			?>
				<table align="center" width="95%" cellspacing="0">
                	<tr align="center" class="titulo_tablas"><td>ID</td><td>TICKET</td><td>EMITIDO</td><td>EXPIRA</td><td>MONTO APUESTA</td><td>MONTO A PAGAR</td><td>MONTO PAGADO</td><td>ESTADO</td><td>TAQUILLA</td></tr>
                    
			<?Php
			while($var_sql=mysql_fetch_assoc($query_ventas)){
				if($color=='') $color="#ebebeb"; else $color='';				
			?>
            	<tr class=""><td colspan="9" style="height:3px;"></td></tr>
            	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>"><td align="center" class="borde_left"><?Php echo $contador;?></td><td align="center" style="font-weight:bold;"><?Php echo str_pad($var_sql['codigo_ticket'],8,'0',STR_PAD_LEFT);/*echo 'T'.str_pad($var_sql['codigo_ticket'],8,'0',STR_PAD_LEFT).' - C'.$var_sql['codigo_cliente'];*/?></td><td><?Php echo $var_sql['fecha_venta'].' - '.$var_sql['hora'];?></td><td><?Php echo $var_sql['fecha_prorroga'];?></td><td align="right"><?Php echo $var_sql['apuesta'];?> BsF.</td><td align="right"><?Php echo $var_sql['total_ganar'];?> BsF.</td><td align="right">0 BsF.</td><td>
                	<?Php
						if($var_sql['anulado']):
							echo "<label class='estatus_venta'>Anulado</label>";
						elseif($var_sql['vencido']):
							echo "<label class='estatus_venta'>Vencido</label>";
						elseif($var_sql['pagado']):
							echo "<label class='estatus_venta'>Pagado</label>";
						elseif($var_sql['ganador']):
							echo "<label class='estatus_venta'>Ganador</label>";
						elseif($var_sql['perdedor']):	
							echo "<label class='estatus_venta'>Perdedor</label>";
						else:
							echo "<label class='estatus_venta'>En espera</label>";	
						endif;
					?>
                </td><td><?Php echo $var_sql['nombre_taquillla'];?></td></tr>
            <?Php
				$contador++;
			}
			?>
				</table>
			<?Php
		}
?>