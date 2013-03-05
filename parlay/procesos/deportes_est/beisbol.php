<?
if($que_muestro=='encabezado'):

                

                if ($soloimp=='1'){ /*?>

				<div style="height:800px;"><? */

				}?>

					<table width="<? echo $ancho;?>" class="ventas_taquilla" border="1" cellspacing="0" cellpadding="3">

						<tr class="titulo_tablas"><td colspan="16" align="center">Logros de <b><?Php echo $nombre_liga;?></b> al <?Php list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']); echo "$dia/$mes/$ano";?></td></tr>

						<tr class="titulo_tablas_negro" align="center"><td></td><td width="160px">Equipos</td><td width="25px">Ref.</td>

						<td colspan="3">A Ganar</td><td colspan="2">RL</td><td>RLA</td><td>Super RL</td><td colspan="3">Alta o Baja</td><td>Si y No</td><td>Anota 1ro</td><td>CHE</td></tr>

						<tr class="titulo_tablas" align="center">

						  

                          <td>&nbsp;</td>

						  <td>&nbsp;</td>

                          <td>&nbsp;</td>

                          

						  

						  <td>9 inning</td>

						  <td>5 inning</td>                          

                          <td>2da mitad</td>

                          

                          <td>9 inning</td>

                          <td>5 inning</td>

                          

                          <td>9 inning</td>                          

                          

						  <td>9 inning</td>

						  

						  <td>9 inning</td>

						  <td>5 inning</td>

                          <td>2da mitad</td>

                          

						  <td>&nbsp;</td>

						  <td>&nbsp;</td><td>&nbsp;</td>

					  </tr>

					  <? /*<tr><td colspan="16" height="5">&nbsp;</td></tr>*/?>

				<?Php

					elseif($que_muestro=='impresion'):

				?>

                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">

                    	<td colspan="16"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>

                        </td>

                    </tr>

                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">                        

                        <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>

                        <td><?php 

						$lanzaA=$pitcherA['lado']; 

						echo $equipoA.'<br>'.$pitcherA['nombre'].' ('.$pitcherA['ganados'].'-'.$pitcherA['perdidos'].', '.$pitcherA['efectividad'].') - '.ucfirst($lanzaA[0]); ?></td>

                        <td><?Php echo $refA; ?></td>

                        <td align="right"><?Php if($array_datos[23][1]):?><?php echo $array_datos[23][1] ?><?php endif;?></td>

                        <td align="left"><?Php if($array_datos[24][1]):?><?php echo $array_datos[24][1] ?><?php endif;?></td>

                        <td align="left"><?Php if($array_datos[80][1]):?><?php echo $array_datos[80][1] ?><?php endif;?></td>

                        <td align="center"><?Php if($array_datos[27][1]):?><?php echo ($array_datos[27][0]>0?'&nbsp;'.$array_datos[27][0]:$array_datos[27][0]).'  '.$array_datos[27][1]; ?><?php endif;?></td>

                        <td align="center"><?Php if($array_datos[29][1]):?><?php echo ($array_datos[29][0]>0?'&nbsp;'.$array_datos[29][0]:$array_datos[29][0]).'  '.$array_datos[29][1] ?><?php endif;?></td>

                        <!--RLA-->

                        <td align="center"><?Php if($array_datos[73][1]):?><?php echo ($array_datos[73][0]>0?'&nbsp;'.$array_datos[73][0]:$array_datos[73][0]).'  '.$array_datos[73][1]; ?><?php endif;?></td>

                        <!--<td align="center"><?php echo ($array_datos[75][0]>0?'&nbsp;'.$array_datos[75][0]:$array_datos[75][0]).'  '.$array_datos[75][1] ?></td>-->

                        

                        <td align="center"><?Php if($array_datos[47][1]):?><?php echo ($array_datos[47][0]>0?'&nbsp;'.$array_datos[47][0]:$array_datos[47][0]).'  '.$array_datos[47][1]; ?><?php endif;?></td>

                        <td rowspan="2" align="center"><?Php if($array_datos[31][1]):?><?php echo 'A '.$array_datos[31][1].'  ('.$array_datos[35][1].')';?> <?php endif;?>

													   <?Php if($array_datos[32][1]):?><?Php echo '<br>B '.$array_datos[32][1].'  ('.$array_datos[35][1].')'; ?><?php endif;?></td>

                        <td rowspan="2" align="center"><?Php if($array_datos[33][1]):?><?php echo 'A '.$array_datos[33][1].'  ('.$array_datos[36][1].')';?><?php endif;?>

													   <?Php if($array_datos[34][1]):?><?Php echo '<br>B '.$array_datos[34][1].'  ('.$array_datos[36][1].')'; ?><?php endif;?></td>

                        <td rowspan="2" align="center"><?Php if($array_datos[77][1]):?><?php echo 'A '.$array_datos[77][1].'  ('.$array_datos[79][1].')';?><?php endif;?>

													   <?Php if($array_datos[78][1]):?><?Php echo '<br>B '.$array_datos[78][1].'  ('.$array_datos[79][1].')'; ?><?php endif;?></td>

                        <td rowspan="2" align="right"><?Php if($array_datos[39][1]):?><?php echo $array_datos[39][1].'(SI)';?><?php endif;?>

													  <?Php if($array_datos[40][1]):?> <?Php echo '<br>'.$array_datos[40][1].'(NO)' ?><?php endif;?></td>

                        <td align="right"><?Php if($array_datos[37][1]):?><?php echo $array_datos[37][1] ?><?php endif;?></td>

                        <td rowspan="2"><?Php if($array_datos[71][1]):?><?php echo 'A '.$array_datos[71][1].'  ('.$array_datos[70][1].')';?><?php endif;?>

										<?Php if($array_datos[72][1]):?><?Php echo '<br>B '.$array_datos[72][1].'  ('.$array_datos[70][1].')'; ?><?php endif;?></td>

                        </tr>

                        <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">

                        <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenB)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenB.'">';}?></td>

                        <td><?php  $lanzaB=$pitcherB['lado'];

						echo $equipoB.'<br>'.$pitcherB['nombre'].' ('.$pitcherB['ganados'].'-'.$pitcherB['perdidos'].', '.$pitcherB['efectividad'].') '.' - '.ucfirst($lanzaB[0]);?></td>

                        <td><?Php echo $refB; ?></td>

                        <td align="right"><?Php if($array_datos[25][1]):?><?php echo $array_datos[25][1] ?><?php endif;?></td>

                        <td align="left"><?Php if($array_datos[26][1]):?><?php echo $array_datos[26][1] ?><?php endif;?></td>

                        

                        <td align="left"><?Php if($array_datos[81][1]):?><?php echo $array_datos[81][1] ?><?php endif;?></td>

                        <td align="center"><?Php if($array_datos[28][1]):?><?php echo ($array_datos[28][0]>0?'&nbsp;'.$array_datos[28][0]:$array_datos[28][0]).'  '.$array_datos[28][1]; ?><?Php endif;?></td>

                        <td align="center"><?Php if($array_datos[30][1]):?><?php echo ($array_datos[30][0]>0?'&nbsp;'.$array_datos[30][0]:$array_datos[30][0]).'  '.$array_datos[30][1]; ?><?Php endif;?></td>

                        <!--RLA-->

                        <td align="center"><?Php if($array_datos[74][1]):?><?php echo ($array_datos[74][0]>0?'&nbsp;'.$array_datos[74][0]:$array_datos[74][0]).'  '.$array_datos[74][1]; ?><?Php endif;?></td>

                        <!--<td align="center"><?php echo ($array_datos[76][0]>0?'&nbsp;'.$array_datos[76][0]:$array_datos[76][0]).'  '.$array_datos[76][1] ?></td>-->

                        

                        <td align="center"><?Php if($array_datos[48][1]):?><?php echo ($array_datos[48][0]>0?'&nbsp;'.$array_datos[48][0]:$array_datos[48][0]).'  '.$array_datos[48][1]; ?><?Php endif;?></td>

                        <td align="right"><?Php if($array_datos[38][1]):?><?php echo $array_datos[38][1] ?><?Php endif;?></td></tr>

                       <? /* $soloimp <tr><td colspan="17">&nbsp;</td></tr>*/?>

                <?Php	

					elseif($que_muestro=='ventas'):	

				?>

                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">


                    	<td colspan="16"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>

                        </td>

                    </tr>

                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">                            	

                                <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>

                                <td><?php $lanzaA=$pitcherA['lado']; 

						echo $equipoA.'<br>'.$pitcherA['nombre'].' ('.$pitcherA['ganados'].'-'.$pitcherA['perdidos'].', '.$pitcherA['efectividad'].') - '.ucfirst($lanzaA[0]); ?></td>

                                <td><?Php echo $refA; ?></td>

                                

                                <td align="right"><?Php if($array_datos[23][1]):?><?php echo $array_datos[23][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_23';?>" pago="<?php echo $array_datos[23][1] ?>" name="apuesta[]" value="<?php echo $array_datos[23][2] ?>" /><?Php endif;?></td>

                                <td align="left"><?Php if($array_datos[24][1]):?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_24';?>" pago="<?php echo $array_datos[24][1] ?>" name="apuesta[]" value="<?php echo $array_datos[24][2] ?>" /><?php echo $array_datos[24][1] ?><?Php endif;?></td>

                                <td align="left"><?Php if($array_datos[80][1]):?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_80';?>" pago="<?php echo $array_datos[80][1] ?>" name="apuesta[]" value="<?php echo $array_datos[80][2] ?>" /><?php echo $array_datos[80][1] ?><?Php endif;?></td>

                                <td align="center"><?Php if($array_datos[27][1]):?><?php echo ($array_datos[27][0]>0?'&nbsp;'.$array_datos[27][0]:$array_datos[27][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_27" pago="'.$array_datos[27][1].'" name="apuesta[]" value="'.$array_datos[27][2].'" /> '.$array_datos[27][1]; ?><?Php endif;?></td>

                                <td align="center"><?Php if($array_datos[29][1]):?><?php echo ($array_datos[29][0]>0?'&nbsp;'.$array_datos[29][0]:$array_datos[29][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_29" pago="'.$array_datos[29][1].'" name="apuesta[]" value="'.$array_datos[29][2].'" /> '.$array_datos[29][1] ?><?Php endif;?></td>

                                <!--RLA-->

                                <td align="center"><?Php if($array_datos[73][1]):?><?php echo ($array_datos[73][0]>0?'&nbsp;'.$array_datos[73][0]:$array_datos[73][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_73" pago="'.$array_datos[73][1].'" name="apuesta[]" value="'.$array_datos[73][2].'" /> '.$array_datos[73][1]; ?><?Php endif;?></td>

                                <!--<td align="center"><?php echo ($array_datos[75][0]>0?'&nbsp;'.$array_datos[75][0]:$array_datos[75][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_75" pago="'.$array_datos[75][1].'" name="apuesta[]" value="'.$array_datos[75][2].'" /> '.$array_datos[75][1] ?></td>-->

                                

                                <td align="center"><?Php if($array_datos[47][1]):?><?php echo ($array_datos[47][0]>0?'&nbsp;'.$array_datos[47][0]:$array_datos[47][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_47" pago="'.$array_datos[47][1].'" name="apuesta[]" value="'.$array_datos[47][2].'" /> '.$array_datos[47][1]; ?><?Php endif;?></td>

                                <td rowspan="2" align="center"><?Php if($array_datos[31][1]):?><?php echo 'A '.$array_datos[31][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_31" pago="'.$array_datos[31][1].'" name="apuesta[]" value="'.$array_datos[31][2].'" /> ('.$array_datos[35][1].')'; endif; if($array_datos[32][1]):echo '<br>B '.$array_datos[32][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_32" pago="'.$array_datos[32][1].'" name="apuesta[]" value="'.$array_datos[32][2].'" /> ('.$array_datos[35][1].')'; endif;?></td>

                                <td rowspan="2" align="center"><?Php if($array_datos[33][1]):?><?php echo 'A '.$array_datos[33][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_33" pago="'.$array_datos[33][1].'" name="apuesta[]" value="'.$array_datos[33][2].'" /> ('.$array_datos[36][1].')<br>B '.$array_datos[34][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_34" pago="'.$array_datos[34][1].'" name="apuesta[]" value="'.$array_datos[34][2].'" /> ('.$array_datos[36][1].')'; endif;?></td>

                                <td rowspan="2" align="center"><?Php if($array_datos[77][1]):?><?php echo 'A '.$array_datos[77][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_77" pago="'.$array_datos[77][1].'" name="apuesta[]" value="'.$array_datos[77][2].'" /> ('.$array_datos[79][1].')';endif; if($array_datos[78][1]):echo '<br>B '.$array_datos[78][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_78" pago="'.$array_datos[78][1].'" name="apuesta[]" value="'.$array_datos[78][2].'" /> ('.$array_datos[79][1].')'; endif;?></td>

                                <td rowspan="2" align="right"><?Php if($array_datos[39][1]):?><?php echo $array_datos[39][1].'<input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_39" pago="'.$array_datos[39][1].'" name="apuesta[]" value="'.$array_datos[39][2].'" />(SI)';endif; if($array_datos[40][1]):echo '<br>'.$array_datos[40][1].'<input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_40" pago="'.$array_datos[40][1].'" name="apuesta[]" value="'.$array_datos[40][2].'" />(NO)'; endif; ?></td>

                                <td align="right"><?Php if($array_datos[37][1]):?><?php echo $array_datos[37][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_37';?>" pago="<?php echo $array_datos[37][1]; ?>" name="apuesta[]" value="<?php echo $array_datos[37][2]; ?>" /><?Php endif;?></td>

                                <td rowspan="2"><?Php if($array_datos[71][1]):?><?php echo 'A '.$array_datos[71][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_71" pago="'.$array_datos[71][1].'" name="apuesta[]" value="'.$array_datos[71][2].'" /> ('.$array_datos[70][1].')'; endif; if($array_datos[72][1]):echo '<br>B '.$array_datos[72][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_72" pago="'.$array_datos[72][1].'" name="apuesta[]" value="'.$array_datos[72][2].'" /> ('.$array_datos[70][1].')'; endif;?></td></tr>

                                

                                <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>"> 

                                <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenB)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenB.'">';}?></td>                           	

                                <td><?Php $lanzaB=$pitcherB['lado'];

			echo $equipoB.'<br>'.$pitcherB['nombre'].' ('.$pitcherB['ganados'].'-'.$pitcherB['perdidos'].', '.$pitcherB['efectividad'].') '.' - '.ucfirst($lanzaB[0]); ?></td>

                                <td><?Php echo $refB; ?></td>

                                <td align="right"><?Php if($array_datos[25][1]):?><?php echo $array_datos[25][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_25';?>" pago="<?php echo $array_datos[25][1] ?>" name="apuesta[]" value="<?php echo $array_datos[25][2] ?>" /><?Php endif;?></td>

                                <td align="left"><?Php if($array_datos[26][1]):?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_26';?>" pago="<?php echo $array_datos[26][1] ?>" name="apuesta[]" value="<?php echo $array_datos[26][2] ?>" /><?php echo $array_datos[26][1] ?><?Php endif;?></td>

                                <td align="left"><?Php if($array_datos[81][1]):?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_81';?>" pago="<?php echo $array_datos[81][1] ?>" name="apuesta[]" value="<?php echo $array_datos[81][2] ?>" /><?php echo $array_datos[81][1] ?><?Php endif;?></td>

                                <td align="center"><?Php if($array_datos[28][1]):?><?php echo ($array_datos[28][0]>0?'&nbsp;'.$array_datos[28][0]:$array_datos[28][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_28" pago="'.$array_datos[28][1].'" name="apuesta[]" value="'.$array_datos[28][2].'" /> '.$array_datos[28][1]; ?><?Php endif;?></td>

                                <td align="center"><?Php if($array_datos[30][1]):?><?php echo ($array_datos[30][0]>0?'&nbsp;'.$array_datos[30][0]:$array_datos[30][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_30" pago="'.$array_datos[30][1].'" name="apuesta[]" value="'.$array_datos[30][2].'" /> '.$array_datos[30][1]; ?><?Php endif;?></td>

                                <!--RLA-->

                                <td align="center"><?Php if($array_datos[74][1]):?><?php echo ($array_datos[74][0]>0?'&nbsp;'.$array_datos[74][0]:$array_datos[74][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_74" pago="'.$array_datos[74][1].'" name="apuesta[]" value="'.$array_datos[74][2].'" /> '.$array_datos[74][1]; ?><?Php endif;?></td>

                                <!--<td align="center"><?php echo ($array_datos[76][0]>0?'&nbsp;'.$array_datos[76][0]:$array_datos[76][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_76" pago="'.$array_datos[76][1].'" name="apuesta[]" value="'.$array_datos[76][2].'" /> '.$array_datos[76][1]; ?></td>-->

                                

                                <td align="center"><?Php if($array_datos[48][1]):?><?php echo ($array_datos[48][0]>0?'&nbsp;'.$array_datos[48][0]:$array_datos[48][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_48" pago="'.$array_datos[48][1].'" name="apuesta[]" value="'.$array_datos[48][2].'" /> '.$array_datos[48][1]; ?><?Php endif;?></td>

                                <td align="right"><?Php if($array_datos[38][1]):?><?php echo $array_datos[38][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_38';?>" pago="<?php echo $array_datos[38][1] ?>" name="apuesta[]" value="<?php echo $array_datos[38][2]; ?>" /><?Php endif;?></td></tr>

                                <tr><td colspan="17">&nbsp;</td></tr>

                <?Php	

					elseif($que_muestro=='total_juegos'):

				?>

                	<tr><td  align="right"><b>Total de juegos:</b> <?Php echo $cuenta_juego; $total_juegos=$total_juegos+$cuenta_juego;?></td></tr>

                <?Php	

					elseif($que_muestro=='items_ventas'):	

						switch($varlogros['idcategoria_apuesta']){							

							//BÉISBOL

							case '24': $tp='MJ';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '26': $tp='MJ';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '23': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '25': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '80': $tp='2da';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '81': $tp='2da';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '27': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '28': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '29': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '30': $tp='RL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '73': $tp='RLA';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '74': $tp='RLA';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '75': $tp='RLA';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '76': $tp='RLA';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '47': $tp='SRL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '48': $tp='SRL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '54': $tp='SRL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '55': $tp='SRL';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '71': $tp='CJC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='A'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '72': $tp='CMJ';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='B'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '31': $tp='AJC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='A'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '32': $tp='BJC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='B'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '33': $tp='AMJ';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='A'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '34': $tp='BMJ';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='B'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							

							case '77': $tp='A2da';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '78': $tp='B2da';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							

							case '39': $tp='Si';$equipo_apuesta= obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/;

							break;

							case '40': $tp='No';$equipo_apuesta= obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/;

							break;

							case '37': $tp='AP';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '38': $tp='AP';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

						}

							$valor_logro=$varlogros['pago'];

							?><tr id="apuestaitem_<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>" style="display:none; background-color:#FFF;" class="blanquear borde_bottom"><td><?Php echo $tp;?></td><td align="right"><?Php echo $mult;?></td><td><?Php echo $equipo_apuesta;?></td><td align="right"><?Php echo $valor_logro;?></td><td width="10px" align="right"><a href="javascript:ocultar_apuesta('<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>','<?Php echo $valor_logro;?>')"><img src="imagenes/eliminar.png" width="10px" border="0" /></a></td></tr><?Php

				endif;?>