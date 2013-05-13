<style type="text/css">
	.tope{
		text-align:center;
		font-weight:bold;
		color:#FFF;
		background-color:#000;
	}
</style>
	<?Php include("../procesos/conexion.php");
		mysql_query("set 
						@cat_apuesta='25',
						@cat_apuesta_rl='28',
						@cat_apuesta_ab='32',
						@cat_apuesta_1m='26',
						@cat_apuesta_abmj='34',
						@cat_apuesta_rlmj='30',
						@cat_apuesta_1i='40',
						@cat_apuesta_ap='38',
						@cat_apuesta_che='72',
						@cat_apuesta_2m='81',
						@cat_apuesta_ab2m='78',
						@cat_apuesta_srl='48',
						@cat_apuesta_rla='74'
		");
		$fecha=date('Y-m-d');
		$select="
			select 
				*, 
			if(@cat_apuesta='25',@cat_apuesta:='23',@cat_apuesta:='25'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago,

			if(@cat_apuesta_rl='28',@cat_apuesta_rl:='27',@cat_apuesta_rl:='28'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_rl and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_rl,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_rl and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_rl,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_rl and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_rl,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_rl and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_rl,
				
			if(@cat_apuesta_ab='32',@cat_apuesta_ab:='31',@cat_apuesta_ab:='32'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_ab and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_ab,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_ab and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_ab,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_ab and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_ab,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_ab and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_ab,
				
			if(@cat_apuesta_1m='26',@cat_apuesta_1m:='24',@cat_apuesta_1m:='26'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_1m and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_1m,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_1m and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_1m,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_1m and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_1m,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_1m and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_1m,
				
			if(@cat_apuesta_abmj='34',@cat_apuesta_abmj:='33',@cat_apuesta_abmj:='34'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_abmj and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_abmj,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_abmj and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_abmj,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_abmj and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_abmj,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_abmj and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_abmj,
				
			if(@cat_apuesta_rlmj='30',@cat_apuesta_rlmj:='29',@cat_apuesta_rlmj:='30'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_rlmj and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_rlmj,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_rlmj and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_rlmj,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_rlmj and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_rlmj,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_rlmj and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_rlmj,
				
			if(@cat_apuesta_1i='40',@cat_apuesta_1i:='39',@cat_apuesta_1i:='40'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_1i and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_1i,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_1i and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_1i,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_1i and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_1i,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_1i and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_1i,
				
			if(@cat_apuesta_ap='38',@cat_apuesta_ap:='37',@cat_apuesta_ap:='38'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_ap and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_ap,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_ap and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_ap,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_ap and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_ap,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_ap and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_ap,
				
			if(@cat_apuesta_che='72',@cat_apuesta_che:='71',@cat_apuesta_che:='72'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_che and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_che,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_che and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_che,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_che and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_che,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_che and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_che,@cat_apuesta_che as cat_apuesta_che,
				
			if(@cat_apuesta_2m='81',@cat_apuesta_2m:='80',@cat_apuesta_2m:='81'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_2m and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_2m,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_2m and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_2m,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_2m and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_2m,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_2m and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_2m,
				
			if(@cat_apuesta_ab2m='78',@cat_apuesta_ab2m:='77',@cat_apuesta_ab2m:='78'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_ab2m and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_ab2m,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_ab2m and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_ab2m,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_ab2m and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_ab2m,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_ab2m and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_ab2m,
				
			if(@cat_apuesta_srl='48',@cat_apuesta_srl:='47',@cat_apuesta_srl:='48'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_srl and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_srl,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_srl and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_srl,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_srl and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_srl,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_srl and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_srl,
				
			if(@cat_apuesta_rla='74',@cat_apuesta_rla:='73',@cat_apuesta_rla:='74'),
				
				(select count(idcategoria_apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_rla and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as juego_completo_rla,
				(select sum(apuesta) from vista_ventas_detalles where idcategoria_apuesta=@cat_apuesta_rla and idequipo=vista_logros_equipos.idequipo and idlogro=vista_logros_equipos.idlogro and fecha_venta='".$fecha."' and cantidad_apuesta='1') as total_bs_rla,
				(select pago from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_rla and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as juego_completo_pago_rla,
				(select multiplicando from vista_logros_banqueros where idcategoria_apuesta=@cat_apuesta_rla and idlogro=vista_logros_equipos.idlogro and fecha='".$fecha."' limit 1) as multiplicando_rla
				
			from 
				vista_logros_equipos 
			where 
				estatus='1' and 
				fecha='".$fecha."'
			order by idlogro_equipo
			";
		$query=mysql_query($select);
			if(mysql_num_rows($query)>0){
				?><table width="100%" cellspacing="0" class="ventas_taquilla" cellpadding="3">
                <tr class="titulo_tablas" align="center"><td colspan="15">REPORTE DE APUESTAS MAS JUGADAS</td></tr>
                	<tr class="tope borde_bottom">
                    	<td>Hora / Código</td>
                        <td class="borde_left">Visitante / Local</td>
                        <td colspan="3" class="borde_left">A Ganar</td>
                        <td colspan="4" class="borde_left">Run Line</td>
                        
                        <td colspan="4" class="borde_left">Altas y Bajas</td>
                        <td colspan="2" class="borde_left"></td>
                    </tr>
					<tr align="center" class="titulo_tablas">
                    	<td></td>
                        <td class="borde_left"></td>
                    	<td class="borde_left">
                   	    JC</td>
                        <td>
               	        MJ</td>
                        <td>
                   	    2M</td>
                    	<td class="borde_left">
                   	    JC</td>
                        <td>
               	        MJ</td>
                        <td>
               	        AL</td>
                        <td>Super</td>
                   	    <td class="borde_left">
               	        JC</td>
                        <td>
               	        MJ</td>
                        <td>
               	        2M</td>                   	    
                   	    <td>C-H-E</td>
                   	    <td class="borde_left">Primer<br />Inning</td><td>Anota<br />Primero</td><!--<td>BoxScore<br />Al/Ba</td><td>BoxScore<br />Par/Impar</td><td>Empate</td>-->
                    </tr>
				<?Php $contador_l=1;
				while($var=mysql_fetch_assoc($query)){
					if($contador_l%2==0){ $hora='';$classs='borde_bottom';$bgcolor='#f4f4f4'; }else{ $hora=$var['hora'].'-';$classs='';$bgcolor='';}
					$contador_l++;
					?>
                    	<tr class="<?Php echo $classs;?>" bgcolor="<?Php echo $bgcolor;?>" valign="top" align="right">
                    	<td align="left"><?Php echo $hora.$var['idlogro_equipo'];?></td>
                        <td align="left"><?Php echo $var['nombre'].' ('.$var['referencia'].')';?><br>Total Tickets<br>Total en BsF.</td>
                        <td><?Php echo $var['juego_completo_pago'].'<br>'.$var['juego_completo'].'<br>'.($var['total_bs']!=''?$var['total_bs']:'0'); ?></td>
                        <td><?Php echo $var['juego_completo_pago_1m'].'<br>'.$var['juego_completo_1m'].'<br>'.($var['total_bs_1m']!=''?$var['total_bs_1m']:'0'); ?></td>
                        <td><?Php echo $var['juego_completo_pago_2m'].'<br>'.$var['juego_completo_2m'].'<br>'.($var['total_bs_2m']!=''?$var['total_bs_2m']:'0'); ?></td>
                        <td><?Php echo $var['multiplicando_rl'].'/'.$var['juego_completo_pago_rl'].'<br>'.$var['juego_completo_rl'].'<br>'.($var['total_bs_rl']!=''?$var['total_bs_rl']:'0'); ?></td>
                        <td><?Php echo $var['multiplicando_rlmj'].'/'.$var['juego_completo_pago_rlmj'].'<br>'.$var['juego_completo_rlmj'].'<br>'.($var['total_bs_rlmj']!=''?$var['total_bs_rlmj']:'0'); ?></td>
                        <td><?Php echo $var['multiplicando_rla'].'/'.$var['juego_completo_pago_rla'].'<br>'.$var['juego_completo_rla'].'<br>'.($var['total_bs_rla']!=''?$var['total_bs_rla']:'0'); ?></td>
                        <td><?Php echo $var['multiplicando_srl'].'/'.$var['juego_completo_pago_srl'].'<br>'.$var['juego_completo_srl'].'<br>'.($var['total_bs_srl']!=''?$var['total_bs_srl']:'0'); ?></td>
                        <td><?Php echo str_replace('.0','',$var['multiplicando_ab']).'/'.$var['juego_completo_pago_ab'].'<br>'.$var['juego_completo_ab'].'<br>'.($var['total_bs_ab']!=''?$var['total_bs_ab']:'0'); ?></td>
                        <td><?Php echo str_replace('.0','',$var['multiplicando_abmj']).'/'.$var['juego_completo_pago_abmj'].'<br>'.$var['juego_completo_abmj'].'<br>'.($var['total_bs_abmj']!=''?$var['total_bs_abmj']:'0'); ?></td>
                        <td><?Php echo str_replace('.0','',$var['multiplicando_ab2m']).'/'.$var['juego_completo_pago_ab2m'].'<br>'.$var['juego_completo_ab2m'].'<br>'.($var['total_bs_ab2m']!=''?$var['total_bs_ab2m']:'0'); ?></td>
                        <td><?Php echo str_replace('.0','',$var['multiplicando_che']).'/'.$var['juego_completo_pago_che'].'<br>'.$var['juego_completo_che'].'<br>'.($var['total_bs_che']!=''?$var['total_bs_che']:'0'); ?></td>
                        
                        
                        <td><?Php echo $var['juego_completo_pago_1i'].'<br>'.$var['juego_completo_1i'].'<br>'.($var['total_bs_1i']!=''?$var['total_bs_1i']:'0'); ?></td>
                        <td><?Php echo $var['juego_completo_pago_ap'].'<br>'.$var['juego_completo_ap'].'<br>'.($var['total_bs_ap']!=''?$var['total_bs_ap']:'0'); ?></td>
                        
                        <!--<td>BoxScore<br />Al/Ba</td><td>BoxScore<br />Par/Impar</td><td>Empate</td>-->
                    </tr>
                    <?Php
				}
				?></table><?Php
			}
	?>