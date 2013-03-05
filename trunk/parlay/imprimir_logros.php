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
	$_REQUEST['fecha']=$_GET['fecha']=date('Y-m-d');
	$_REQUEST['liga']='1';
?>
<table width="100%">
	<tr class="titulo_tablas"><td colspan="10" align="center">Logros del Día <?Php list($ano,$mes,$dia)=explode("-",$_GET['fecha']); echo "$dia/$mes/$ano";?></td></tr>
	<tr class="titulo_tablas" align="center"><td>Hora</td><td>Equipos</td><td colspan="2">Money Line</td><td colspan="2">Run line</td><td colspan="2">Alta o Baja</td><td>Si y No</td><td>Anota 1ro</td></tr>
	<?Php
		$selectlogros="select * from vista_logros where fecha='".$_REQUEST['fecha']."' and idliga='".$_REQUEST['liga']."' ORDER BY idlogro,que_equipo ASC, nombre_tipo_apuesta ASC";
		$querylogros=mysql_query($selectlogros);
			if(mysql_num_rows($querylogros)>0){
				$equipoA='';$equipoB='';$bandera='';
					while($varlogros=mysql_fetch_assoc($querylogros)){
						
						if($bandera==''){
							$bandera=$varlogros['idlogro'];
						}elseif($bandera!=$varlogros['idlogro']){
							if($color=='') $color="#ebebeb"; else $color='';
							?>
								<tr class=""  bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2"><?php echo $hora; ?></td>
                                <td><?php echo $equipoA; ?></td>
                                <td align="right"><?php echo $array_datos[23][1] ?></td><td align="right"><?php echo $array_datos[24][1] ?></td><td align="right"><?php echo $array_datos[27][0].' '.$array_datos[27][1]; ?></td><td align="right"><?php echo $array_datos[29][0].' '.$array_datos[29][1] ?></td><td rowspan="2" align="right"><?php echo '> '.$array_datos[31][1].' ('.$array_datos[35][1].')<br>< '.$array_datos[32][1].' ('.$array_datos[35][1].')'; ?></td><td rowspan="2" align="right"><?php echo '> '.$array_datos[33][1].' ('.$array_datos[36][1].')<br>< '.$array_datos[34][1].' ('.$array_datos[36][1].')'; ?></td><td rowspan="2" align="right"><?php echo $array_datos[39][1].'<br>'.$array_datos[40][1] ?></td><td align="right"><?php echo $array_datos[37][1] ?></td></tr>
                                <tr class="" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB; ?></td>
                                <td align="right"><?php echo $array_datos[25][1] ?></td><td align="right"><?php echo $array_datos[26][1] ?></td><td align="right"><?php echo $array_datos[28][0].' '.$array_datos[28][1]; ?></td><td align="right"><?php echo $array_datos[30][0].' '.$array_datos[30][1]; ?></td><td align="right"><?php echo $array_datos[38][1] ?></td></tr>
                                <tr><td colspan="10"><hr /></td></tr>
							<?Php
							$bandera='';
							$equipoA='';
							$equipoB='';
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
					?>
                    <tr class=""  bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2"><?php echo $hora; ?></td>
                                <td><?php echo $equipoA; ?></td>
                                <td align="right"><?php echo $array_datos[23][1] ?></td><td align="right"><?php echo $array_datos[24][1] ?></td><td align="right"><?php echo $array_datos[27][0].' '.$array_datos[27][1]; ?></td><td align="right"><?php echo $array_datos[29][0].' '.$array_datos[29][1] ?></td><td rowspan="2" align="right"><?php echo '> '.$array_datos[31][1].' ('.$array_datos[35][1].')<br>< '.$array_datos[32][1].' ('.$array_datos[35][1].')'; ?></td><td rowspan="2" align="right"><?php echo '> '.$array_datos[33][1].' ('.$array_datos[36][1].')<br>< '.$array_datos[34][1].' ('.$array_datos[36][1].')'; ?></td><td rowspan="2" align="right"><?php echo $array_datos[39][1].'<br>'.$array_datos[40][1] ?></td><td align="right"><?php echo $array_datos[37][1] ?></td></tr>
                                <tr class="" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB; ?></td>
                                <td align="right"><?php echo $array_datos[25][1] ?></td><td align="right"><?php echo $array_datos[26][1] ?></td><td align="right"><?php echo $array_datos[28][0].' '.$array_datos[28][1]; ?></td><td align="right"><?php echo $array_datos[30][0].' '.$array_datos[30][1]; ?></td><td align="right"><?php echo $array_datos[38][1] ?></td></tr>
                    <?Php
			}
	?>
</table>
</div>

</body>
</html>