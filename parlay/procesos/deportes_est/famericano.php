<?

				if($que_muestro=='encabezado'):

				?>

					<table width="<? echo $ancho;?>" class="ventas_taquilla" border="1" cellspacing="0" cellpadding="3">

						<tr class="titulo_tablas"><td colspan="10" align="center">Logros de <b><?Php echo $nombre_liga;?></b> al <?Php list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']); echo "$dia/$mes/$ano";?></td></tr>

						<tr class="titulo_tablas_negro" align="center">     

                        	<td></td>                   	

                            <td width="160px">Equipos</td>

                            <td width="25px">Ref.</td>

						<td colspan="2">A Ganar</td>

						<td colspan="1">RL</td>

						<td colspan="3">Alta o Baja</td>
                        </tr>

						<tr class="titulo_tablas" align="center">

						  <td></td>

						  <td>&nbsp;</td>

                          <td></td>

						  

						  <td>J. Completo</td>

						  <td>1er Tiempo</td>

						  <!--<td>J. Completo</td>-->

						  <td>J. Completo</td>

						  <td>J. Completo</td>

						  <td>1er Tiempo</td>

						  <td>&nbsp;</td>

					  </tr>



				<?Php 

				elseif($que_muestro=='impresion'): 

					?><tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">

                            <td colspan="9"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>

                            </td>

                        </tr>

                    	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>"> 

                        	<td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" width="36px" height="24px" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>                         

                            <td><?php echo $equipoA; ?></td>

                            <td><?Php echo $refA; ?></td>
							<? //logro a ganar JC?>
                        <td align="center"><?Php if($array_datos[100][1]):?><?php echo $array_datos[100][1] ?><?php endif;?></td>
							<? //logro a ganar - MJ?>
                        <td align="center"><?Php if($array_datos[101][1]):?><?php echo $array_datos[101][1] ?><?php endif;?></td>

                        <td align="center"><?Php if($array_datos[95][1]):?><?php echo "(".($array_datos[95][0]>0?'&nbsp;'.$array_datos[95][0]:$array_datos[95][0]).')  '.$array_datos[95][1]; ?><?php endif;?></td>

                        <!--<td align="center"><?php echo ($array_datos[97][0]>0?'&nbsp;'.$array_datos[97][0]:$array_datos[97][0]).'  '.$array_datos[97][1] ?></td>-->

                        <td rowspan="2" align="center"><?Php if($array_datos[102][1]):?><?php echo 'A '.$array_datos[102][1].'  ('.$array_datos[109][1].')';?><?php endif;?>

													   <?Php if($array_datos[103][1]):?><?Php echo '<br>B '.$array_datos[103][1].'  ('.$array_datos[109][1].')'; ?><?php endif;?></td>

                        <td rowspan="2" align="center"><?Php if($array_datos[104][1]):?><?php echo 'A '.$array_datos[104][1].'  ('.$array_datos[110][1].')';?><?php endif;?>

													   <?Php if($array_datos[105][1]):?><?Php echo '<br>B '.$array_datos[105][1].'  ('.$array_datos[110][1].')'; ?><?php endif;?></td>

                        <td rowspan="2" align="right"><?Php if($array_datos[106][1]):?><?php echo $array_datos[106][1].' (JC)';?><?php endif;?>

													  <?Php if($array_datos[107][1]):?><?Php echo '<br>'.$array_datos[107][1].' (MJ)' ?><?php endif;?></td></tr>

                        <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">

                            <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenB)){echo '<img align="absmiddle" width="36px" height="24px" src="imagenes/img_equipos/'.$imagenB.'">';}?></td>

                            <td><?php echo $equipoB; ?></td>

                            <td><?Php echo $refB; ?></td>
							<? ///valor logro JC equipo B?>
                            <td align="center"><?Php if($array_datos[111][1]):?><?php echo $array_datos[111][1] ?><?php endif;?></td>
							<? ///valor logro MJ equipo B?>
                            <td align="center"><?Php if($array_datos[99][1]):?><?php echo $array_datos[99][1] ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[96][1]):?><?php echo "(".($array_datos[96][0]>0?'&nbsp;'.$array_datos[96][0]:$array_datos[96][0]).')  '.$array_datos[96][1]; ?><?php endif;?></td>

                            <!--<td align="center"><?php echo ($array_datos[108][0]>0?'&nbsp;'.$array_datos[108][0]:$array_datos[108][0]).'  '.$array_datos[108][1]; ?></td>-->

                        </tr>

                        <tr><td colspan="9">&nbsp;</td></tr>

                    <?php 

				elseif($que_muestro=='ventas'):	

					?>

                    	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">

                            <td colspan="9"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>

                            </td>

                        </tr>

                    	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>"> 

                        	<td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" width="36px" height="24px" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>                         

                            <td><?php echo $equipoA; ?></td>

                            <td><?Php echo $refA; ?></td>

                            <td align="right"><?Php if($array_datos[100][1]):?><?php echo $array_datos[100][1]; ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_100';?>" pago="<?php echo $array_datos[100][1]; ?>" name="apuesta[]" value="<?php echo $array_datos[100][2] ?>" /><?php endif;?></td>

                            <td align="left"><?Php if($array_datos[101][1]):?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_101';?>" pago="<?php echo $array_datos[101][1] ?>" name="apuesta[]" value="<?php echo $array_datos[101][2] ?>" /><?php echo $array_datos[101][1] ?><?php endif;?></td>

							<td align="center"><?Php if($array_datos[95][1]):?><?php echo ($array_datos[95][0]>0?'&nbsp;'.$array_datos[95][0]:$array_datos[95][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_95" pago="'.$array_datos[95][1].'" name="apuesta[]" value="'.$array_datos[95][2].'" /> '.$array_datos[95][1]; ?><?php endif;?></td>
							<!--
							<td align="center"><?Php if($array_datos[97][1]):?><?php echo ($array_datos[97][0]>0?'&nbsp;'.$array_datos[97][0]:$array_datos[97][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_97" pago="'.$array_datos[97][1].'" name="apuesta[]" value="'.$array_datos[97][2].'" /> '.$array_datos[97][1]; ?><?php endif;?></td>
							-->
                            <td rowspan="2" align="center"><?Php if($array_datos[102][1]):?><?php echo 'A '.$array_datos[102][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_102" pago="'.$array_datos[102][1].'" name="apuesta[]" value="'.$array_datos[102][2].'" /> ('.$array_datos[109][1].')';?><?php endif;?>

														   <?Php if($array_datos[103][1]):?><?Php echo '<br>B '.$array_datos[103][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_103" pago="'.$array_datos[103][1].'" name="apuesta[]" value="'.$array_datos[103][2].'" /> ('.$array_datos[109][1].')'; ?><?php endif;?></td>

                            <td rowspan="2" align="center"><?Php if($array_datos[104][1]):?><?php echo 'A '.$array_datos[104][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_104" pago="'.$array_datos[104][1].'" name="apuesta[]" value="'.$array_datos[104][2].'" /> ('.$array_datos[110][1].')';?><?php endif;?>

														   <?Php if($array_datos[105][1]):?><?Php echo '<br>B '.$array_datos[105][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_105" pago="'.$array_datos[105][1].'" name="apuesta[]" value="'.$array_datos[105][2].'" /> ('.$array_datos[110][1].')'; ?><?php endif;?></td>

                            <td rowspan="2" align="right"><?Php if($array_datos[106][1]):?><?php echo $array_datos[106][1].' (JC) <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_106" pago="'.$array_datos[106][1].'" name="apuesta[]" value="'.$array_datos[106][2].'" />';?><?php endif;?>

														  <?Php if($array_datos[107][1]):?><?Php echo '<br>'.$array_datos[107][1].' (MJ) <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_107" pago="'.$array_datos[107][1].'" name="apuesta[]" value="'.$array_datos[107][2].'" />' ?><?php endif;?></td>

                        </tr>

                        <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">

                            <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenB)){echo '<img align="absmiddle" width="36px" height="24px" src="imagenes/img_equipos/'.$imagenB.'">';}?></td>

                            <td><?php echo $equipoB; ?></td>

                            <td><?Php echo $refB; ?></td>

                            <td align="right"><?Php if($array_datos[111][1]):?><?php echo $array_datos[111][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_111';?>" pago="<?php echo $array_datos[111][1] ?>" name="apuesta[]" value="<?php echo $array_datos[111][2] ?>" /><?php endif;?></td>

                            <td align="left"><?Php if($array_datos[99][1]):?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_99';?>" pago="<?php echo $array_datos[99][1] ?>" name="apuesta[]" value="<?php echo $array_datos[99][2] ?>" /><?php echo $array_datos[99][1] ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[96][1]):?><?php echo ($array_datos[96][0]>0?'&nbsp;'.$array_datos[96][0]:$array_datos[96][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_96" pago="'.$array_datos[96][1].'" name="apuesta[]" value="'.$array_datos[96][2].'" /> '.$array_datos[96][1]; ?><?php endif;?></td>
							<!--
							<td align="center"><?Php if($array_datos[108][1]):?><?php echo ($array_datos[108][0]>0?'&nbsp;'.$array_datos[108][0]:$array_datos[108][0]).' <input type="checkbox" combinacion="1'.$varlogros['idlogro'].'_108" pago="'.$array_datos[108][1].'" name="apuesta[]" value="'.$array_datos[108][2].'" /> '.$array_datos[108][1]; ?><?php endif;?></td>
							-->

                        </tr>

                            <tr><td colspan="10">&nbsp;</td></tr>

                    <?Php

				elseif($que_muestro=='total_juegos'):

				?>

                	<tr><td colspan="10" align="right"><b>Total de juegos:</b> <?Php echo $cuenta_juego; $total_juegos=$total_juegos+$cuenta_juego;?></td></tr>                

				<?Php	

				elseif($que_muestro=='items_ventas'):	

					switch($varlogros['idcategoria_apuesta']){							

							//FUTBOL

							case '100': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '101': $tp='MJ';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '111': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '99': $tp='MJ';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '95': $tp='RLJC';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '96': $tp='RLJC';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '97': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '108': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;
							
							case '102': 
								$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$varlogros['idlogro_equipo']."' and idcategoria_apuesta='109' limit 1");
								$tp='AJC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$multi_ale['pago']);

							break;

							case '103': 
								$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$varlogros['idlogro_equipo']."' and idcategoria_apuesta='109' limit 1");
								$tp='BJC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$multi_ale['pago']);

							break;

							case '104': 
								$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$varlogros['idlogro_equipo']."' and idcategoria_apuesta='110' limit 1");
								$tp='AMJ';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$multi_ale['pago']);

							break;

							case '105': 
								$multi_ale=dame_datos("select * from logros_equipos_categorias_apuestas where idlogro_equipo='".$varlogros['idlogro_equipo']."' and idcategoria_apuesta='110' limit 1");
								$tp='BMJ';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$multi_ale['pago']);

							break;

							case '106': $tp='EJC';$equipo_apuesta= obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/;



							break;

							case '107': $tp='EMJ';$equipo_apuesta= obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/;

							break;

						}

							$valor_logro=$varlogros['pago'];

							?><tr id="apuestaitem_<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>" style="display:none; background-color:#FFF;" class="blanquear borde_bottom"><td><?Php echo $tp;?></td><td align="right"><?Php echo $mult;?></td><td><?Php echo $equipo_apuesta;?></td><td align="right"><?Php echo $valor_logro;?></td><td width="10px" align="right"><a href="javascript:ocultar_apuesta('<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>')"><img src="imagenes/eliminar.png" width="10px" border="0" /></a></td></tr><?Php

				endif;?>
