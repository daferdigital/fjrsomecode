<?Php include("../procesos/conexion.php");?>
<div class="titulo">Resultados del día</div>
<form name="form1" method="post" action="procesos/guardar_resultados.php">
<table width="100%">
	<tr class="titulo_tablas"><td colspan="11" align="center">Cargar resultados para el Día <?Php echo $_GET['fecha'];?></td></tr>
	<tr class="titulo_tablas" align="center"><td>Hora</td><td>Equipos</td>
	<td>Medio juego</td>
	<td>Suspendido</td>
    <td>2da Mitad</td>	
	<td>Suspendido</td>
    <td>1er Inning</td>
    <td>Anota 1ro</td>
    <td>Final</td>
	<td>Hit</td>
	<td>Errores</td></tr>
	<?Php
		list($dia,$mes,$ano)=explode("/",$_REQUEST['fecha']);
		$selectlogros="select * from vista_logros where fecha='".$ano.'-'.$mes.'-'.$dia."' and idliga='".$_REQUEST['liga']."' ORDER BY idlogro,que_equipo ASC, nombre_tipo_apuesta ASC";
		//echo $selectlogros;
		$querylogros=mysql_query($selectlogros);
			if(mysql_num_rows($querylogros)>0){
				$equipoA='';$equipoB='';$bandera='';
					while($varlogros=mysql_fetch_assoc($querylogros)){
						
						if($bandera==''){
							$bandera=$varlogros['idlogro'];
						}elseif($bandera!=$varlogros['idlogro']){
							if($color=='') $color="#ebebeb"; else $color='';
							$resA=dame_resultados("select idcategoria_resultado,resultado from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogro_equipoA."'");
							$resB=dame_resultados("select idcategoria_resultado,resultado from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogro_equipoB."'");
							
							//obtengo datos de los pitchers
							$pitcherA=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterA."' limit 1");
							$pitcherB=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterB."' limit 1");
							//print_r($resA);
							?>
								<tr class="" bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2"><?php echo $hora; ?></td>
                                <td><?php echo $equipoA.'<br>Lanzador: '.$pitcherA['nombre'].$referenciaA; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][1]" value="<?Php echo $resA[1];?>" size="2" maxlength="2"></td><td align="center" rowspan="2"><select name="resultado[<?Php echo $idlogro_equipoA;?>][3]"><option value="">Opcional</option><option <?Php echo($resA[3]==1?'selected="selected"':'');?> value="1">Suspendido</option></select></td><td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][9]" value="<?Php echo $resA[9];?>" size="2" maxlength="2"></td><td rowspan="2" align="center">
                                <select name="resultado[<?Php echo $idlogro_equipoA;?>][6]"><option value="0">Opcional</option><option <?Php echo($resA[6]==1?'selected="selected"':'');?> value="1">Suspendido</option></select></td><td rowspan="2" align="center">
                                <select name="resultado[<?Php echo $idlogro_equipoA;?>][7]">
                                  <option value="0">Seleccione</option>
                                  <option <?Php echo($resA[7]==1?'selected="selected"':'');?> value="1">Si</option>
                                  <option <?Php echo($resA[7]==0?'selected="selected"':'');?> value="0">No</option>                             
                                </select></td>
                                <td rowspan="2" align="left">
                                <select name="resultado[<?Php echo $idlogro_equipoA;?>][8]">
                                  <option value="">Seleccione</option>
                                  <option <?Php echo($resA[8]==$idlogro_equipoA?'selected="selected"':'');?> value="<?php echo $idlogro_equipoA; ?>"><?php echo $equipoA; ?></option>
                                  <option <?Php echo($resA[8]==$idlogro_equipoB?'selected="selected"':'');?> value="<?php echo $idlogro_equipoB; ?>"><?php echo $equipoB; ?></option>
                                </select></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][4]" value="<?Php echo $resA[4];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][11]" value="<?Php echo $resA[11];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][13]" value="<?Php echo $resA[13];?>" size="2" maxlength="2"></td>
                                </tr>
                                <tr class="" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB.'<br>Lanzador: '.$pitcherB['nombre'].$referenciaB; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][2]" value="<?Php echo $resB[2];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][10]" value="<?Php echo $resB[10];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][5]" value="<?Php echo $resB[5];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][12]" value="<?Php echo $resB[12];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][14]" value="<?Php echo $resB[14];?>" size="2" maxlength="2"></td>
                                </tr>
                                <tr><td colspan="11"><hr /></td></tr>
							<?Php
							$bandera='';
							$equipoA='';
							$equipoB='';
							$idlogro_equipoA='';
							$idlogro_equipoB='';
						}
						
						if($equipoA==''){
							$equipoA='<b>'.$varlogros['nombre_equipo'].'</b>';
							$referenciaA=' <b><br>(Ref. '.$varlogros['referencia'].')</b>';
							$idlogro_equipoA=$varlogros['idlogro_equipo'];
							$hora=$varlogros['hora'];
							$idRosterA=$varlogros['idroster'];
						}elseif($equipoA!=$varlogros['nombre_equipo']){
							$equipoB='<b>'.$varlogros['nombre_equipo'].'</b>';
							$referenciaB=' <b><br>(Ref. '.$varlogros['referencia'].')</b>';
							$idlogro_equipoB=$varlogros['idlogro_equipo'];
							$idRosterB=$varlogros['idroster'];
						}
							
						$array_datos[$varlogros['idcategoria_apuesta']]=array($varlogros['multiplicando'],$varlogros['pago']);
						/*print_r($array_datos[$varlogros['idcategoria_apuesta']]);
						exit;*/
					}
					if($color=='') $color="#ebebeb"; else $color='';
							$resA=dame_resultados("select idcategoria_resultado,resultado from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogro_equipoA."'");
							$resB=dame_resultados("select idcategoria_resultado,resultado from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogro_equipoB."'");
							
							//obtengo datos de los pitchers
							$pitcherA=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterA."' limit 1");
							$pitcherB=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterB."' limit 1");
					?>
                    <tr class="" bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2"><?php echo $hora; ?></td>
                                <td><?php echo $equipoA.'<br>'.$pitcherA['nombre'].' ('.$pitcherA['lado'].')'.$referenciaA; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][1]" value="<?Php echo $resA[1];?>" size="2" maxlength="2"></td><td align="center" rowspan="2"><select name="resultado[<?Php echo $idlogro_equipoA;?>][3]"><option value="">Opcional</option><option <?Php echo($resA[3]==1?'selected="selected"':'');?> value="1">Suspendido</option></select></td><td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][9]" value="<?Php echo $resA[9];?>" size="2" maxlength="2"></td><td rowspan="2" align="center">
                                <select name="resultado[<?Php echo $idlogro_equipoA;?>][6]"><option value="0">Opcional</option><option <?Php echo($resA[6]==1?'selected="selected"':'');?> value="1">Suspendido</option></select></td><td rowspan="2" align="center">
                                <select name="resultado[<?Php echo $idlogro_equipoA;?>][7]">
                                  <option value="0">Seleccione</option>
                                  <option <?Php echo($resA[7]==1?'selected="selected"':'');?> value="1">Si</option>
                                  <option <?Php echo($resA[7]==0?'selected="selected"':'');?> value="0">No</option>                             
                                </select></td><td rowspan="2" align="left">
                                <select name="resultado[<?Php echo $idlogro_equipoA;?>][8]">
                                  <option value="">Seleccione</option>
                                  <option <?Php echo($resA[8]==$idlogro_equipoA?'selected="selected"':'');?> value="<?php echo $idlogro_equipoA; ?>"><?php echo $equipoA; ?></option>
                                  <option <?Php echo($resA[8]==$idlogro_equipoB?'selected="selected"':'');?> value="<?php echo $idlogro_equipoB; ?>"><?php echo $equipoB; ?></option>
                                </select></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][4]" value="<?Php echo $resA[4];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][11]" value="<?Php echo $resA[11];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][13]" value="<?Php echo $resA[13];?>" size="2" maxlength="2"></td>
                                </tr>
                                <tr class="" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB.'<br>'.$pitcherB['nombre'].' ('.$pitcherB['lado'].')'.$referenciaB; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][2]" value="<?Php echo $resB[2];?>" size="2" maxlength="2"></td><td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][10]" value="<?Php echo $resB[10];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][5]" value="<?Php echo $resB[5];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][12]" value="<?Php echo $resB[12];?>" size="2" maxlength="2"></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][14]" value="<?Php echo $resB[14];?>" size="2" maxlength="2"></td>
                                </tr>
                                <tr><td colspan="11"><hr /></td></tr>
                    <?Php
			}
	?>
</table>
<div align="center"><input type="button" name="guardar" value="Guardar" class="boton" onclick="javascript: comentario='cualquiera'; nolistado='no'; noreset='no'; validar(document.form1,'resultados.php');" /></div>
<input type="hidden" name="resultado_categoria" value="beisbol" />
</form>
<script language="javascript">
categoria_sel="<?php echo $_REQUEST['categoria']; ?>";
liga_sel="<?php echo $_REQUEST['liga']; ?>";
comentario='';
nolistado='';
	function ver_obj(){
		for(i=0;i<jQuery("form :text,form select").length;i++){
			alert(jQuery("form :text,form select")[i].name);
		}
	}
	
	$(".numeric").numeric();
	
</script>