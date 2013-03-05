<?				if($que_muestro=='encabezado'):

					 if ($soloimp=='1'){?>

                     <div></div><? ///style="height:250px;"

					 }?>

					<table width="<? echo $ancho;?>" class="ventas_taquilla" border="1" cellspacing="0" cellpadding="3">

						<tr class="titulo_tablas"><td colspan="9" align="center">Logros de <b><?Php echo $nombre_liga;?></b> al <?Php list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']); echo "$dia/$mes/$ano";?></td></tr>

						<tr class="titulo_tablas_negro" align="center">     

                        	<td></td>                   	

                            <td width="160px">Equipos</td>

                            <td width="25px">Ref.</td>

						<td colspan="2">A Ganar</td><td>RL</td><td colspan="2">Alta o Baja</td><td>Empate</td></tr>

						<tr class="titulo_tablas" align="center">

						  <td></td>

						  <td>&nbsp;</td>

                          <td></td>

						  

						  <td>J. Completo</td>

						  <td>1er Tiempo</td><td>J. Completo</td>

						  

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

                        	<td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>                         

                            <td><?php echo $equipoA; ?></td>

                            <td><?Php echo $refA; ?></td>

                        <td align="right"><?Php if($array_datos[19][1]):?><?php echo $array_datos[19][1] ?><?php endif;?></td>

                        <td align="left"><?Php if($array_datos[20][1]):?><?php echo $array_datos[20][1] ?><?php endif;?></td>

                        <td align="center"><?Php if($array_datos[16][1]):?><?php echo ($array_datos[16][0]>0?'&nbsp;'.$array_datos[16][0]:$array_datos[16][0]).'  '.$array_datos[16][1]; ?><?php endif;?></td>

                        <!--<td align="center"><?php echo ($array_datos[18][0]>0?'&nbsp;'.$array_datos[18][0]:$array_datos[18][0]).'  '.$array_datos[18][1] ?></td>-->

                        <td rowspan="2" align="center"><?Php if($array_datos[41][1]):?><?php echo 'A '.$array_datos[41][1].'  ('.$array_datos[52][1].')';?><?php endif;?>

													   <?Php if($array_datos[42][1]):?><?Php echo '<br>B '.$array_datos[42][1].'  ('.$array_datos[52][1].')'; ?><?php endif;?></td>

                        <td rowspan="2" align="center"><?Php if($array_datos[43][1]):?><?php echo 'A '.$array_datos[43][1].'  ('.$array_datos[53][1].')';?><?php endif;?>

													   <?Php if($array_datos[44][1]):?><?Php echo '<br>B '.$array_datos[44][1].'  ('.$array_datos[53][1].')'; ?><?php endif;?></td>

                        <td rowspan="2" align="right"><?Php if($array_datos[49][1]):?><?php echo $array_datos[49][1].' (JC)';?><?php endif;?>

													  <?Php if($array_datos[50][1]):?><?Php echo '<br>'.$array_datos[50][1].' (MJ)' ?><?php endif;?></td></tr>

                        <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">

                            <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenB)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenB.'">';}?></td>

                            <td><?php echo $equipoB; ?></td>

                            <td><?Php echo $refB; ?></td>

                            <td align="right"><?Php if($array_datos[21][1]):?><?php echo $array_datos[21][1] ?><?php endif;?></td>

                            <td align="left"><?Php if($array_datos[22][1]):?><?php echo $array_datos[22][1] ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[17][1]):?><?php echo ($array_datos[17][0]>0?'&nbsp;'.$array_datos[17][0]:$array_datos[17][0]).'  '.$array_datos[17][1]; ?><?php endif;?></td>

                            <!--<td align="center"><?php echo ($array_datos[51][0]>0?'&nbsp;'.$array_datos[51][0]:$array_datos[51][0]).'  '.$array_datos[51][1]; ?></td>-->

                        </tr>

                      <? /*!--  <tr><td colspan="9">&nbsp;<!--parece basket--></td></tr>*/?>

                    <?php

				elseif($que_muestro=='ventas'):	

					?>

                    	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">

                            <td colspan="9"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>

                            </td>

                        </tr>

                    	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>"> 

                        	<td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>                         

                            <td><?php echo $equipoA; ?></td>

                            <td><?Php echo $refA; ?></td>

                            <td align="right"><?Php if($array_datos[19][1]):?><?php echo $array_datos[19][1]; ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_19';?>" pago="<?php echo $array_datos[19][1]; ?>" name="apuesta[]" value="<?php echo $array_datos[19][2] ?>" /><?php endif;?></td>

                            <td align="left"><?Php if($array_datos[20][1]):?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_20';?>" pago="<?php echo $array_datos[20][1] ?>" name="apuesta[]" value="<?php echo $array_datos[20][2] ?>" /><?php echo $array_datos[20][1] ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[16][1]):?><?php echo ($array_datos[16][0]>0?'&nbsp;'.$array_datos[16][0]:$array_datos[16][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_16" pago="'.$array_datos[16][1].'" name="apuesta[]" value="'.$array_datos[16][2].'" /> '.$array_datos[16][1]; ?><?php endif;?></td>

                            <!--<td align="center"><?php echo ($array_datos[18][0]>0?'&nbsp;'.$array_datos[18][0]:$array_datos[18][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_18" pago="'.$array_datos[18][1].'" name="apuesta[]" value="'.$array_datos[18][2].'" /> '.$array_datos[18][1] ?></td>-->

                            <td rowspan="2" align="center"><?Php if($array_datos[41][1]):?><?php echo 'A '.$array_datos[41][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_41" pago="'.$array_datos[41][1].'" name="apuesta[]" value="'.$array_datos[41][2].'" /> ('.$array_datos[52][1].')';?><?php endif;?>

														   <?Php if($array_datos[42][1]):?><?Php echo '<br>B '.$array_datos[42][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_42" pago="'.$array_datos[42][1].'" name="apuesta[]" value="'.$array_datos[42][2].'" /> ('.$array_datos[52][1].')'; ?><?php endif;?></td>

                            <td rowspan="2" align="center"><?Php if($array_datos[43][1]):?><?php echo 'A '.$array_datos[43][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_43" pago="'.$array_datos[43][1].'" name="apuesta[]" value="'.$array_datos[43][2].'" /> ('.$array_datos[53][1].')';?><?php endif;?>

														   <?Php if($array_datos[44][1]):?><?Php echo '<br>B '.$array_datos[44][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_44" pago="'.$array_datos[44][1].'" name="apuesta[]" value="'.$array_datos[44][2].'" /> ('.$array_datos[53][1].')'; ?><?php endif;?></td>

                            <td rowspan="2" align="right"><?Php if($array_datos[49][1]):?><?php echo $array_datos[49][1].' (JC) <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_49" pago="'.$array_datos[49][1].'" name="apuesta[]" value="'.$array_datos[49][2].'" />';?><?php endif;?>

														  <?Php if($array_datos[50][1]):?><?Php echo '<br>'.$array_datos[50][1].' (MJ) <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_50" pago="'.$array_datos[50][1].'" name="apuesta[]" value="'.$array_datos[50][2].'" />' ?><?php endif;?></td>

                        </tr>

                        <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">

                            <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenB)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenB.'">';}?></td>

                            <td><?php echo $equipoB; ?></td>

                            <td><?Php echo $refB; ?></td>

                            <td align="right"><?Php if($array_datos[21][1]):?><?php echo $array_datos[21][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_21';?>" pago="<?php echo $array_datos[21][1] ?>" name="apuesta[]" value="<?php echo $array_datos[21][2] ?>" /><?php endif;?></td>

                            <td align="left"><?Php if($array_datos[22][1]):?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_22';?>" pago="<?php echo $array_datos[22][1] ?>" name="apuesta[]" value="<?php echo $array_datos[22][2] ?>" /><?php echo $array_datos[22][1] ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[17][1]):?><?php echo ($array_datos[17][0]>0?'&nbsp;'.$array_datos[17][0]:$array_datos[17][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_17" pago="'.$array_datos[17][1].'" name="apuesta[]" value="'.$array_datos[17][2].'" /> '.$array_datos[17][1]; ?><?php endif;?></td><!--<td align="center"><?php echo ($array_datos[51][0]>0?'&nbsp;'.$array_datos[51][0]:$array_datos[51][0]).' <input type="checkbox" pago="'.$array_datos[51][1].'" name="apuesta[]" value="'.$array_datos[51][2].'" /> '.$array_datos[51][1]; ?></td>-->

                        </tr>

                            <tr><td colspan="9"><? //espacio futbol??></td></tr>

                    <?Php

				elseif($que_muestro=='total_juegos'):

				?>

                	<tr><td colspan="9" align="right"><b>Total de juegos:</b> <?Php echo $cuenta_juego; $total_juegos=$total_juegos+$cuenta_juego;?></td></tr>                

				<?Php	

				elseif($que_muestro=='items_ventas'):	

						switch($varlogros['idcategoria_apuesta']){							

							//FUTBOL

							case '19': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '20': $tp='MJ';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '21': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '22': $tp='MJ';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '16': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '17': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '18': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '51': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '41': $tp='AJC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '42': $tp='BJC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '43': $tp='AMJ';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '44': $tp='BMJ';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '49': $tp='EJC';$equipo_apuesta= obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/;

							break;

							case '50': $tp='EMJ';$equipo_apuesta= obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/;

							break;

						}

							$valor_logro=$varlogros['pago'];

							?><tr id="apuestaitem_<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>" style="display:none; background-color:#FFF;" class="blanquear borde_bottom"><td><?Php echo $tp;?></td><td align="right"><?Php echo $mult;?></td><td><?Php echo $equipo_apuesta;?></td><td align="right"><?Php echo $valor_logro;?></td><td width="10px" align="right"><a href="javascript:ocultar_apuesta('<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>')"><img src="imagenes/eliminar.png" width="10px" border="0" /></a></td></tr><?Php

				endif;?>