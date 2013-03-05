<?Php include("procesos/sesiones.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.:Parley:.</title>
<link rel="stylesheet" type="text/css" href="css/estilos_parley.css"/>
<script src="js/jquery-1.6.4.min.js" language="javascript"></script>
<script src="js/funciones.js" language="javascript"></script>
</head>

<body>
<div id="general">
<div class="titulo">Logros del día</div>

	<?Php
		//$selectlogros="select * from vista_logros where fecha='".$_REQUEST['fecha']."' and idliga='".$_REQUEST['liga']."' ORDER BY idlogro,que_equipo ASC, nombre_tipo_apuesta ASC";
		$selectlogros="select * from vista_logros where fecha='".$_REQUEST['fecha']."' ORDER BY idcategoria,idlogro,que_equipo ASC, nombre_tipo_apuesta ASC";
		$querylogros=mysql_query($selectlogros);
			if(mysql_num_rows($querylogros)>0){
				$equipoA='';$equipoB='';$bandera='';$categoria='';
					while($varlogros=mysql_fetch_assoc($querylogros)){
						
						
						
						if($bandera==''){
							$bandera=$varlogros['idlogro'];
						}elseif($bandera!=$varlogros['idlogro']){
							if($color=='') $color="#ebebeb"; else $color='';
							switch($categoria){
								case '1':
								?>
                                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2" class="borde_left"><?php echo '<b>'.$hora.'</b>'; ?></td>
                                <td><?php echo $equipoA; ?></td>
                                <td align="right"><?php echo $array_datos[19][1] ?></td><td align="left"><?php echo $array_datos[20][1] ?></td><td align="center"><?php echo ($array_datos[16][0]>0?'&nbsp;'.$array_datos[16][0]:$array_datos[16][0]).'  '.$array_datos[16][1]; ?></td><td align="center"><?php echo ($array_datos[18][0]>0?'&nbsp;'.$array_datos[18][0]:$array_datos[18][0]).'  '.$array_datos[18][1] ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[41][1].'  ('.$array_datos[52][1].')<br>< '.$array_datos[42][1].'  ('.$array_datos[52][1].')'; ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[43][1].'  ('.$array_datos[53][1].')<br>< '.$array_datos[44][1].'  ('.$array_datos[53][1].')'; ?></td><td rowspan="2" align="right"><?php echo $array_datos[49][1].' (JC)<br>'.$array_datos[50][1].' (MJ)' ?></td></tr>
                                <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB; ?></td>
                                <td align="right"><?php echo $array_datos[21][1] ?></td><td align="left"><?php echo $array_datos[22][1] ?></td><td align="center"><?php echo ($array_datos[17][0]>0?'&nbsp;'.$array_datos[17][0]:$array_datos[17][0]).'  '.$array_datos[17][1]; ?></td><td align="center"><?php echo ($array_datos[51][0]>0?'&nbsp;'.$array_datos[51][0]:$array_datos[51][0]).'  '.$array_datos[51][1]; ?></td></tr>
                                <tr><td colspan="9">&nbsp;</td></tr>
                                <?Php
								break;
								case '2':
							?>
								<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2" class="borde_left"><?php echo '<b>'.$hora.'</b>'; ?></td>
                                <td><?php echo $equipoA; ?></td>
                                <td align="right"><?php echo $array_datos[23][1] ?></td><td align="left"><?php echo $array_datos[24][1] ?></td><td align="center"><?php echo ($array_datos[27][0]>0?'&nbsp;'.$array_datos[27][0]:$array_datos[27][0]).'  '.$array_datos[27][1]; ?></td><td align="center"><?php echo ($array_datos[29][0]>0?'&nbsp;'.$array_datos[29][0]:$array_datos[29][0]).'  '.$array_datos[29][1] ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[31][1].'  ('.$array_datos[35][1].')<br>< '.$array_datos[32][1].'  ('.$array_datos[35][1].')'; ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[33][1].'  ('.$array_datos[36][1].')<br>< '.$array_datos[34][1].'  ('.$array_datos[36][1].')'; ?></td><td rowspan="2" align="right"><?php echo $array_datos[39][1].'(SI)<br>'.$array_datos[40][1].'(NO)' ?></td><td align="right"><?php echo $array_datos[37][1] ?></td></tr>
                                <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB; ?></td>
                                <td align="right"><?php echo $array_datos[25][1] ?></td><td align="left"><?php echo $array_datos[26][1] ?></td><td align="center"><?php echo ($array_datos[28][0]>0?'&nbsp;'.$array_datos[28][0]:$array_datos[28][0]).'  '.$array_datos[28][1]; ?></td><td align="center"><?php echo ($array_datos[30][0]>0?'&nbsp;'.$array_datos[30][0]:$array_datos[30][0]).'  '.$array_datos[30][1]; ?></td><td align="right"><?php echo $array_datos[38][1] ?></td></tr>
                                <tr><td colspan="10">&nbsp;</td></tr>
							<?Php
							break;
							}
							$bandera='';
							$equipoA='';
							$equipoB='';
						}
						
						//GENERO ENCABEZADOS
						if($categoria!=$varlogros['idcategoria']){
							if($categoria!='') echo '</table>';
							$categoria=$varlogros['idcategoria'];
							switch($varlogros['idcategoria']){
								case '1':
									?>
                                    	<table width="100%" cellspacing="0" cellpadding="3">
                                            <tr class="titulo_tablas"><td colspan="9" align="center">Logros del Día <b><?Php echo $varlogros['nombre_categoria'];?></b> <?Php list($ano,$mes,$dia)=explode("-",$_GET['fecha']); echo "$dia/$mes/$ano";?></td></tr>
                                            <tr class="titulo_tablas_negro" align="center"><td>Hora</td><td>Equipos</td>
                                            <td colspan="2">A Ganar</td><td colspan="2">Run line</td><td colspan="2">Alta o Baja</td><td>Empate</td></tr>
                                            <tr class="titulo_tablas" align="center">
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                              
                                              <td>J. Completo</td>
                                              <td>1er Tiempo</td><td>J. Completo</td>
                                              <td>1er Tiempo</td>
                                              <td>J. Completo</td>
                                              <td>1er Tiempo</td>
                                              <td>&nbsp;</td>
                                          </tr>
                                          <tr><td colspan="9">&nbsp;</td></tr>
                                    <?Php
								break;
								case '2':
									?>
                                    	<table width="100%" cellspacing="0" cellpadding="3">
                                            <tr class="titulo_tablas"><td colspan="10" align="center">Logros del Día <b><?Php echo $varlogros['nombre_categoria'];?></b> <?Php list($ano,$mes,$dia)=explode("-",$_GET['fecha']); echo "$dia/$mes/$ano";?></td></tr>
                                            <tr class="titulo_tablas_negro" align="center"><td>Hora</td><td>Equipos</td>
                                            <td colspan="2">A Ganar</td><td colspan="2">Run line</td><td colspan="2">Alta o Baja</td><td>Si y No</td><td>Anota 1ro</td></tr>
                                            <tr class="titulo_tablas" align="center">
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                              
                                              <td>9 inning</td>
                                              <td>5 inning</td><td>9 inning</td>
                                              <td>5 inning</td>
                                              <td>9 inning</td>
                                              <td>5 inning</td>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                          </tr>
                                          <tr><td colspan="10">&nbsp;</td></tr>
                                    <?Php
								break;
							}
						}
						
						if($equipoA==''){
							$equipoA=$varlogros['nombre_equipo'].' <b>(Ref. '.$varlogros['referencia'].')</b>';
							$hora=$varlogros['hora'];
						}elseif($equipoA!=$varlogros['nombre_equipo']){
							$equipoB=$varlogros['nombre_equipo'].' <b>(Ref. '.$varlogros['referencia'].')</b>';
						}
							
						$array_datos[$varlogros['idcategoria_apuesta']]=array($varlogros['multiplicando'],$varlogros['pago']);
						/*print_r($array_datos[$varlogros['idcategoria_apuesta']]);
						exit;*/
					}
					if($color=='') $color="#ebebeb"; else $color='';
					switch($categoria){
								case '1':
								?>
                                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2" class="borde_left"><?php echo '<b>'.$hora.'</b>'; ?></td>
                                <td><?php echo $equipoA; ?></td>
                                <td align="right"><?php echo $array_datos[19][1] ?></td><td align="left"><?php echo $array_datos[20][1] ?></td><td align="center"><?php echo ($array_datos[16][0]>0?'&nbsp;'.$array_datos[16][0]:$array_datos[16][0]).'  '.$array_datos[16][1]; ?></td><td align="center"><?php echo ($array_datos[18][0]>0?'&nbsp;'.$array_datos[18][0]:$array_datos[18][0]).'  '.$array_datos[18][1] ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[41][1].'  ('.$array_datos[52][1].')<br>< '.$array_datos[42][1].'  ('.$array_datos[52][1].')'; ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[43][1].'  ('.$array_datos[53][1].')<br>< '.$array_datos[44][1].'  ('.$array_datos[53][1].')'; ?></td><td rowspan="2" align="right"><?php echo $array_datos[49][1].' (JC)<br>'.$array_datos[50][1].' (MJ)' ?></td></tr>
                                <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB; ?></td>
                                <td align="right"><?php echo $array_datos[21][1] ?></td><td align="left"><?php echo $array_datos[22][1] ?></td><td align="center"><?php echo ($array_datos[17][0]>0?'&nbsp;'.$array_datos[17][0]:$array_datos[17][0]).'  '.$array_datos[17][1]; ?></td><td align="center"><?php echo ($array_datos[51][0]>0?'&nbsp;'.$array_datos[51][0]:$array_datos[51][0]).'  '.$array_datos[51][1]; ?></td></tr>
                                <tr><td colspan="9">&nbsp;</td></tr>
                                <?Php
								break;
								case '2':
							?>
								<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2" class="borde_left"><?php echo '<b>'.$hora.'</b>'; ?></td>
                                <td><?php echo $equipoA; ?></td>
                                <td align="right"><?php echo $array_datos[23][1] ?></td><td align="left"><?php echo $array_datos[24][1] ?></td><td align="center"><?php echo ($array_datos[27][0]>0?'&nbsp;'.$array_datos[27][0]:$array_datos[27][0]).'  '.$array_datos[27][1]; ?></td><td align="center"><?php echo ($array_datos[29][0]>0?'&nbsp;'.$array_datos[29][0]:$array_datos[29][0]).'  '.$array_datos[29][1] ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[31][1].'  ('.$array_datos[35][1].')<br>< '.$array_datos[32][1].'  ('.$array_datos[35][1].')'; ?></td><td rowspan="2" align="center"><?php echo '> '.$array_datos[33][1].'  ('.$array_datos[36][1].')<br>< '.$array_datos[34][1].'  ('.$array_datos[36][1].')'; ?></td><td rowspan="2" align="right"><?php echo $array_datos[39][1].'(SI)<br>'.$array_datos[40][1].'(NO)' ?></td><td align="right"><?php echo $array_datos[37][1] ?></td></tr>
                                <tr class="borde_rigth_bottom" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB; ?></td>
                                <td align="right"><?php echo $array_datos[25][1] ?></td><td align="left"><?php echo $array_datos[26][1] ?></td><td align="center"><?php echo ($array_datos[28][0]>0?'&nbsp;'.$array_datos[28][0]:$array_datos[28][0]).'  '.$array_datos[28][1]; ?></td><td align="center"><?php echo ($array_datos[30][0]>0?'&nbsp;'.$array_datos[30][0]:$array_datos[30][0]).'  '.$array_datos[30][1]; ?></td><td align="right"><?php echo $array_datos[38][1] ?></td></tr>
                                <tr><td colspan="10">&nbsp;</td></tr>
							<?Php
							break;
							}
			}
	?>
</table>
</div>

</body>
</html>