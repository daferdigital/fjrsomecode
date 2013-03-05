			<?

				if($que_muestro=='encabezado'):

					 if ($soloimp=='1'){?>

                     <div></div><? /// style="height:250px;"

					 }
					 
					 
					
					
					 ?>

					



					<table width="<? echo $ancho;?>" class="ventas_taquilla" border="1" cellspacing="0" cellpadding="3">

						<tr class="titulo_tablas"><td colspan="15" align="center">Logros de <b><?Php echo $nombre_liga;?></b> al <?Php list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']); echo "$dia/$mes/$ano";?></td></tr>

						<tr class="titulo_tablas_negro" align="center"><td width="36px"></td><td  width="160px">Equipos</td><td width="25px">Ref.</td>

						<td colspan="6">A Ganar</td>

                        <td colspan="3">RL</td>

                        <td colspan="3">Alta o Baja</td></tr>

						<tr class="titulo_tablas" align="center">

						  <td>&nbsp;</td>

						  <td>&nbsp;</td>

                          <td>&nbsp;</td>

						  

						  <td>JC</td>

						  <td>1H</td>

                          <td>2H</td>

						  <td>1T</td>

                          <td>2T</td>

						  <td>3T</td>

                          

                          <td>JC</td>						 

						  <td>1H</td>

                          <td>2H</td>

                          

                          <td>JC</td>

						  <td>1H</td>

						  <td>2H</td>

					  </tr>

				<?Php



				elseif($que_muestro=='impresion'):

					?>

                    	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">

                            <td colspan="15"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>

                            </td>

                        </tr>

                    	<tr align="center" class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">

                            <td align="left"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>                       

                            <td align="left"><?Php echo $equipoA; ?></td>

                            <td><?Php echo $refA; ?></td>

                            

                            <td align=""><?Php if($array_datos[56][1]):?><?php echo $array_datos[56][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[57][1]):?><?php echo $array_datos[57][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[82][1]):?><?php echo $array_datos[82][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[86][1]):?><?php echo $array_datos[86][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[88][1]):?><?php echo $array_datos[88][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[90][1]):?><?php echo $array_datos[90][1] ?><?php endif;?></td>

                            

                            <td align="center"><?Php if($array_datos[60][1]):?><?php echo ($array_datos[60][0]>0?'&nbsp;'.$array_datos[60][0]:$array_datos[60][0]).'  '.$array_datos[60][1]; ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[62][1]):?><?php echo ($array_datos[62][0]>0?'&nbsp;'.$array_datos[62][0]:$array_datos[62][0]).'  '.$array_datos[62][1] ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[84][1]):?><?php echo ($array_datos[84][0]>0?'&nbsp;'.$array_datos[84][0]:$array_datos[84][0]).'  '.$array_datos[84][1] ?><?php endif;?></td>

                            

                            <td rowspan="2" align="center"><?Php if($array_datos[64][1]):?><?php echo 'A '.$array_datos[64][1].'  ('.$array_datos[68][1].')';?><?php endif;?>

														   <?Php if($array_datos[65][1]):?><?Php echo '<br>B '.$array_datos[65][1].'  ('.$array_datos[68][1].')'; ?><?php endif;?></td>

                            <td rowspan="2" align="center"><?Php if($array_datos[66][1]):?><?php echo 'A '.$array_datos[66][1].'  ('.$array_datos[69][1].')';?><?php endif;?>

														   <?Php if($array_datos[67][1]):?><?Php echo '<br>B '.$array_datos[67][1].'  ('.$array_datos[69][1].')'; ?><?php endif;?></td>

                            <td rowspan="2" align="center"><?Php if($array_datos[92][1]):?><?php echo 'A '.$array_datos[92][1].'  ('.$array_datos[94][1].')';?><?php endif;?>

														   <?Php if($array_datos[93][1]):?><?Php echo '<br>B '.$array_datos[93][1].'  ('.$array_datos[94][1].')'; ?><?php endif;?></td>

                        </tr>

                        <tr class="borde_rigth_bottom" align="center" bgcolor="<?Php echo $color;?>">

                            <td align="left"><?php if(file_exists('imagenes/img_equipos/'.$imagenB)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenB.'">';}?></td>

                            <td align="left"><?Php echo $equipoB; ?></td>

                            <td><?Php echo $refB; ?></td>

                            

                            <td align=""><?Php if($array_datos[58][1]):?><?php echo $array_datos[58][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[59][1]):?><?php echo $array_datos[59][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[83][1]):?><?php echo $array_datos[83][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[87][1]):?><?php echo $array_datos[87][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[89][1]):?><?php echo $array_datos[89][1] ?><?php endif;?></td>

                            <td align=""><?Php if($array_datos[91][1]):?><?php echo $array_datos[91][1] ?><?php endif;?></td>

                            

                            <td align="center"><?Php if($array_datos[61][1]):?><?php echo ($array_datos[61][0]>0?'&nbsp;'.$array_datos[61][0]:$array_datos[61][0]).'  '.$array_datos[61][1]; ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[63][1]):?><?php echo ($array_datos[63][0]>0?'&nbsp;'.$array_datos[63][0]:$array_datos[63][0]).'  '.$array_datos[63][1]; ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[85][1]):?><?php echo ($array_datos[85][0]>0?'&nbsp;'.$array_datos[85][0]:$array_datos[85][0]).'  '.$array_datos[85][1]; ?><?php endif;?></td>

                        </tr>


                    <?php

				elseif($que_muestro=='ventas'):	

					?>

                    	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">

                            <td colspan="15"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>

                            </td>

                        </tr>

                    	<tr align="right" class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">

                            <td align="left"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>                       

                            <td align="left"><?Php echo $equipoA; ?></td>

                            <td><?Php echo $refA; ?></td>

                            

                            <td align=""><?Php if($array_datos[56][1]):?><?php echo $array_datos[56][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_56';?>" pago="<?php echo $array_datos[56][1] ?>" name="apuesta[]" value="<?php echo $array_datos[56][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[57][1]):?><?php echo $array_datos[57][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_57';?>" pago="<?php echo $array_datos[57][1] ?>" name="apuesta[]" value="<?php echo $array_datos[57][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[82][1]):?><?php echo $array_datos[82][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_82';?>" pago="<?php echo $array_datos[82][1] ?>" name="apuesta[]" value="<?php echo $array_datos[82][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[86][1]):?><?php echo $array_datos[86][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_86';?>" pago="<?php echo $array_datos[86][1] ?>" name="apuesta[]" value="<?php echo $array_datos[86][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[88][1]):?><?php echo $array_datos[88][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_88';?>" pago="<?php echo $array_datos[88][1] ?>" name="apuesta[]" value="<?php echo $array_datos[88][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[90][1]):?><?php echo $array_datos[90][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_90';?>" pago="<?php echo $array_datos[90][1] ?>" name="apuesta[]" value="<?php echo $array_datos[90][2] ?>" /><?Php endif;?></td>

                            

                            <td align="center"><?Php if($array_datos[60][1]):?><?php echo ($array_datos[60][0]>0?'&nbsp;'.$array_datos[60][0]:$array_datos[60][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_60" pago="'.$array_datos[60][1].'" name="apuesta[]" value="'.$array_datos[60][2].'" /> '.$array_datos[60][1]; ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[62][1]):?><?php echo ($array_datos[62][0]>0?'&nbsp;'.$array_datos[62][0]:$array_datos[62][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_62" pago="'.$array_datos[62][1].'" name="apuesta[]" value="'.$array_datos[62][2].'" /> '.$array_datos[62][1] ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[84][1]):?><?php echo ($array_datos[84][0]>0?'&nbsp;'.$array_datos[84][0]:$array_datos[84][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_84" pago="'.$array_datos[84][1].'" name="apuesta[]" value="'.$array_datos[84][2].'" /> '.$array_datos[84][1] ?><?php endif;?></td>

                            

                            <td rowspan="2" align="center"><?Php if($array_datos[64][1]):?><?php echo 'A '.$array_datos[64][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_64" pago="'.$array_datos[64][1].'" name="apuesta[]" value="'.$array_datos[64][2].'" /> ('.$array_datos[68][1].')';?><?php endif;?>

														   <?Php if($array_datos[65][1]):?><?Php echo '<br>B '.$array_datos[65][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_65" pago="'.$array_datos[65][1].'" name="apuesta[]" value="'.$array_datos[65][2].'" /> ('.$array_datos[68][1].')'; ?><?php endif;?></td>

                            <td rowspan="2" align="center"><?Php if($array_datos[66][1]):?><?php echo 'A '.$array_datos[66][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_66" pago="'.$array_datos[66][1].'" name="apuesta[]" value="'.$array_datos[66][2].'" /> ('.$array_datos[69][1].')';?><?php endif;?>

														   <?Php if($array_datos[67][1]):?><?Php echo '<br>B '.$array_datos[67][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_67" pago="'.$array_datos[67][1].'" name="apuesta[]" value="'.$array_datos[67][2].'" /> ('.$array_datos[69][1].')'; ?><?php endif;?></td>

                            <td rowspan="2" align="center"><?Php if($array_datos[92][1]):?><?php echo 'A '.$array_datos[92][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_92" pago="'.$array_datos[92][1].'" name="apuesta[]" value="'.$array_datos[92][2].'" /> ('.$array_datos[94][1].')';?><?php endif;?>

														   <?Php if($array_datos[93][1]):?><?Php echo '<br>B '.$array_datos[93][1].' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_93" pago="'.$array_datos[93][1].'" name="apuesta[]" value="'.$array_datos[93][2].'" /> ('.$array_datos[94][1].')'; ?><?php endif;?></td>

                        </tr>

                        <tr class="borde_rigth_bottom" align="right" bgcolor="<?Php echo $color;?>">

                            <td align="left"><?php if(file_exists('imagenes/img_equipos/'.$imagenB)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenB.'">';}?></td>

                            <td align="left"><?Php echo $equipoB; ?></td>

                            <td><?Php echo $refB; ?></td>

                            

                            <td align=""><?Php if($array_datos[58][1]):?><?php echo $array_datos[58][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_58';?>" pago="<?php echo $array_datos[58][1] ?>" name="apuesta[]" value="<?php echo $array_datos[58][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[59][1]):?><?php echo $array_datos[59][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_59';?>" pago="<?php echo $array_datos[59][1] ?>" name="apuesta[]" value="<?php echo $array_datos[59][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[83][1]):?><?php echo $array_datos[83][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_83';?>" pago="<?php echo $array_datos[83][1] ?>" name="apuesta[]" value="<?php echo $array_datos[83][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[87][1]):?><?php echo $array_datos[87][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_87';?>" pago="<?php echo $array_datos[87][1] ?>" name="apuesta[]" value="<?php echo $array_datos[87][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[89][1]):?><?php echo $array_datos[89][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_89';?>" pago="<?php echo $array_datos[89][1] ?>" name="apuesta[]" value="<?php echo $array_datos[89][2] ?>" /><?Php endif;?></td>

                            <td align=""><?Php if($array_datos[91][1]):?><?php echo $array_datos[91][1] ?><input type="checkbox" combinacion="l<?Php echo $varlogros['idlogro'].'_91';?>" pago="<?php echo $array_datos[91][1] ?>" name="apuesta[]" value="<?php echo $array_datos[91][2] ?>" /><?Php endif;?></td>

                            

                            <td align="center"><?Php if($array_datos[61][1]):?><?php echo ($array_datos[61][0]>0?'&nbsp;'.$array_datos[61][0]:$array_datos[61][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_61" pago="'.$array_datos[61][1].'" name="apuesta[]" value="'.$array_datos[61][2].'" /> '.$array_datos[61][1]; ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[63][1]):?><?php echo ($array_datos[63][0]>0?'&nbsp;'.$array_datos[63][0]:$array_datos[63][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_63" pago="'.$array_datos[63][1].'" name="apuesta[]" value="'.$array_datos[63][2].'" /> '.$array_datos[63][1]; ?><?php endif;?></td>

                            <td align="center"><?Php if($array_datos[85][1]):?><?php echo ($array_datos[85][0]>0?'&nbsp;'.$array_datos[85][0]:$array_datos[85][0]).' <input type="checkbox" combinacion="l'.$varlogros['idlogro'].'_85" pago="'.$array_datos[85][1].'" name="apuesta[]" value="'.$array_datos[85][2].'" /> '.$array_datos[85][1]; ?><?php endif;?></td>

                        </tr><? /*

						if($soloimp!='1'){ ?>

                        	<tr><td colspan="15"><? echo $soloimp;?></td></tr><? 

						}*/?>

                    <?Php

				elseif($que_muestro=='total_juegos'):

				?>

                	<tr><td colspan="15" align="right"><b>Total de juegos:</b> <?Php echo $cuenta_juego; $total_juegos=$total_juegos+$cuenta_juego;?></td></tr>                

				<?Php	

				elseif($que_muestro=='items_ventas'):	

						switch($varlogros['idcategoria_apuesta']){							

							//Basket

							case '56': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '57': $tp='1H';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '58': $tp='JC';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '59': $tp='1H';$equipo_apuesta=$varlogros['nombre_equipo'];							

							break;

							case '82': $tp='2H';$equipo_apuesta=$varlogros['nombre_equipo'];							

							break;

							case '83': $tp='2H';$equipo_apuesta=$varlogros['nombre_equipo'];							

							break;

							

							case '86': $tp='1T';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '87': $tp='1T';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '88': $tp='2T';$equipo_apuesta=$varlogros['nombre_equipo'];

							break;

							case '89': $tp='2T';$equipo_apuesta=$varlogros['nombre_equipo'];							

							break;

							case '90': $tp='3T';$equipo_apuesta=$varlogros['nombre_equipo'];							

							break;

							case '91': $tp='3T';$equipo_apuesta=$varlogros['nombre_equipo'];							

							break;

							

							case '60': $tp='RLJC';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '61': $tp='RLJC';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '62': $tp='RL1H';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '63': $tp='RL1H';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;							

							case '84': $tp='RL2H';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							case '85': $tp='RL2H';$equipo_apuesta=$varlogros['nombre_equipo']; $mult=$varlogros['multiplicando'];

							break;

							

							case '64': $tp='JC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '65': $tp='JC';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '66': $tp='1H';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '67': $tp='1H';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '92': $tp='2H';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='>'.str_replace(".0","",$varlogros['multiplicando']);

							break;

							case '93': $tp='2H';$equipo_apuesta=obtener_mini_contrincantes($varlogros['idlogro_equipo'])/*$varlogros['nombre_equipo']*/; $mult='<'.str_replace(".0","",$varlogros['multiplicando']);

							break;							

						}

							$valor_logro=$varlogros['pago'];

							?><tr id="apuestaitem_<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>" style="display:none; background-color:#FFF;" class="blanquear borde_bottom"><td><?Php echo $tp;?></td><td align="right"><?Php echo $mult;?></td><td><?Php echo $equipo_apuesta;?></td><td align="right"><?Php echo $valor_logro;?></td><td width="10px" align="right"><a href="javascript:ocultar_apuesta('<?Php echo $varlogros['idlogro_equipo_categoria_apuesta_banquero'];?>')"><img src="imagenes/eliminar.png" width="10px" border="0" /></a></td></tr><?Php

				endif;?>