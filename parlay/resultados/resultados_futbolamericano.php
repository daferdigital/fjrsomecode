<?Php include("../procesos/conexion.php");
 session_start();?>
<div class="titulo">Resultados del día</div>
<form name="form1" method="post" action="procesos/guardar_resultados.php">
<table width="100%">
	<tr class="titulo_tablas"><td height="30" colspan="8" align="center">Cargar resultados para el Día <?Php echo $_GET['fecha'];?></td></tr>

	<?Php
		list($dia,$mes,$ano)=explode("/",$_REQUEST['fecha']);
		?>
        	<input type="hidden" name="fecha_res" value="<?Php echo $ano.'-'.$mes.'-'.$dia;?>" />
        <?Php
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
							
							$checked='';
							$estatus=dame_datos("select estatus from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogro_equipoA."' limit 1");
								if($estatus['estatus']) $checked='checked';							
							//echo '<hr>'.$estatus['estatus'];
							
							//obtengo datos de los pitchers
							$pitcherA=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterA."' limit 1");
							$pitcherB=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterB."' limit 1");
							//print_r($resA);
							?>	<tr class="titulo_tablas" align="center">
	  <td>&nbsp;</td>
      <td width="200px">&nbsp;</td>
	  <td colspan="2" bgcolor="#009900">Juego Completo</td>
	  <td colspan="2" bgcolor="#0033FF">Primer tiempo</td>
    </tr>
	<tr class="titulo_tablas" align="center"><td>Hora</td><td>Equipos</td>
	<td>Final</td>
	
	<!--<td>Errores</td>
	<td>2da Mitad</td>-->
	<td>Suspendido</td>
	<td>Medio juego</td>
    <!--<td>1er Inning</td>
    <td>Anota 1ro</td>-->
    <td>Suspendido</td>
	</tr>
								<tr class="" bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2"><?php echo $hora; ?><br /><?
                                if ($_SESSION["tipo_usr"]=='2'){$desaparece="style='display:none;'";}else{$desaparece='';}?>
                                <div <? echo $desaparece;?>>
                                <input type="checkbox" <?Php echo $checked;?> name="estatus_<?Php echo $idlogro_equipoA;?>" value="1" title="Publicar resultados" onclick="javascript:if(this.checked){document.form1.estatus_<?Php echo $idlogro_equipoB;?>.value='1';}else{document.form1.estatus_<?Php echo $idlogro_equipoB;?>.value='0';}" /></div>
                                <input type="hidden" value="<?Php echo $estatus['estatus'];?>" name="estatus_<?Php echo $idlogro_equipoB;?>" />
                                </td>
                                <td><?php echo $equipoA.$referenciaA; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][33]2" value="<?Php echo $resA[33];?>" size="2" maxlength="2" /></td>
                                
                                <!--<td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][31]2" value="<?Php echo $resA[31];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][9]2" value="<?Php echo $resA[9];?>" size="2" maxlength="2" /></td>-->
                                <td rowspan="2" align="center"><select name="resultado[<?Php echo $idlogro_equipoA;?>][32]2">
                                  <option value="0">Opcional</option>
                                  <option <?Php echo($resA[32]==1?'selected="selected"':'');?> value="1">Suspendido</option>
                                </select></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][29]2" value="<?Php echo $resA[29];?>" size="2" maxlength="2" /></td>
                                <!--<td rowspan="2" align="center">
                                <select name="resultado[<?Php echo $idlogro_equipoA;?>][7]">
                                  <option value="0">Seleccione</option>
                                  <option <?Php echo($resA[7]==1?'selected="selected"':'');?> value="1">Si</option>
                                  <option <?Php echo($resA[7]==0?'selected="selected"':'');?> value="0">No</option>                             
                                </select></td>
                                <td rowspan="2" align="left">
                                  <div align="center">
                                    <select name="resultado[<?Php echo $idlogro_equipoA;?>][8]">
                                      <option value="">Seleccione</option>
                                      <option <?Php echo($resA[8]==$idlogro_equipoA?'selected="selected"':'');?> value="<?php echo $idlogro_equipoA; ?>"><?php echo $equipoA; ?></option>
                                      <option <?Php echo($resA[8]==$idlogro_equipoB?'selected="selected"':'');?> value="<?php echo $idlogro_equipoB; ?>"><?php echo $equipoB; ?></option>
                                    </select>
                                  </div></td>-->
                                <td rowspan="2" align="center"><select name="resultado[<?Php echo $idlogro_equipoA;?>][31]">
                                  <option value="">Opcional</option>
                                  <option <?Php echo($resA[31]==1?'selected="selected"':'');?> value="1">Suspendido</option>
                                </select></td>
                                </tr>
                                <tr class="" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB.$referenciaB; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][34]2" value="<?Php echo $resB[34];?>" size="2" maxlength="2" /></td>
                                
                                <!--<td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][32]2" value="<?Php echo $resB[32];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][10]2" value="<?Php echo $resB[10];?>" size="2" maxlength="2" /></td>-->
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][30]2" value="<?Php echo $resB[30];?>" size="2" maxlength="2" /></td>
                                </tr>
                                <tr><td colspan="6"><hr /></td></tr>
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
							
							$checked='';
							$estatus=dame_datos("select estatus from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogro_equipoA."' limit 1");
								if($estatus['estatus']) $checked='checked';
							//echo '<hr>'.$estatus['estatus'];
							
							//obtengo datos de los pitchers
							$pitcherA=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterA."' limit 1");
							$pitcherB=dame_datos("select nombre,lado from vista_lanzadores where idroster='".$idRosterB."' limit 1");
					?>
                    <tr class="titulo_tablas" align="center">
	  <td>&nbsp;</td>
      <td width="200px">&nbsp;</td>
	  <td colspan="2" bgcolor="#009900">Juego Completo</td>
	  <td colspan="2" bgcolor="#0033FF">Primer tiempo</td>
    </tr>
	<tr class="titulo_tablas" align="center"><td>Hora</td><td>Equipos</td>
	<td>Final</td>
	
	<!--<td>Errores</td>
	<td>2da Mitad</td>-->
	<td>Suspendido</td>
	<td>Medio juego</td>
    <!--<td>1er Inning</td>
    <td>Anota 1ro</td>-->
    <td>Suspendido</td>
	</tr>
								<tr class="" bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2"><?php echo $hora; ?><br />
                                <div <? echo $desaparece;?>>
                                <input type="checkbox" <?Php echo $checked;?> name="estatus_<?Php echo $idlogro_equipoA;?>" value="1" title="Publicar resultados" onclick="javascript:if(this.checked){document.form1.estatus_<?Php echo $idlogro_equipoB;?>.value='1';}else{document.form1.estatus_<?Php echo $idlogro_equipoB;?>.value='0';}" /></div>
                                <input type="hidden" value="<?Php echo $estatus['estatus'];?>" name="estatus_<?Php echo $idlogro_equipoB;?>" />
                                </td>
                                <td><?php echo $equipoA.$referenciaA; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][33]2" value="<?Php echo $resA[33];?>" size="2" maxlength="2" /></td>
                                
                                <!--<td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][31]2" value="<?Php echo $resA[31];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][9]2" value="<?Php echo $resA[9];?>" size="2" maxlength="2" /></td>-->
                                <td rowspan="2" align="center"><select name="resultado[<?Php echo $idlogro_equipoA;?>][32]2">
                                  <option value="0">Opcional</option>
                                  <option <?Php echo($resA[32]==1?'selected="selected"':'');?> value="1">Suspendido</option>
                                </select></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][29]2" value="<?Php echo $resA[29];?>" size="2" maxlength="2" /></td>
                                <!--<td rowspan="2" align="center">
                                <select name="resultado[<?Php echo $idlogro_equipoA;?>][7]">
                                  <option value="0">Seleccione</option>
                                  <option <?Php echo($resA[7]==1?'selected="selected"':'');?> value="1">Si</option>
                                  <option <?Php echo($resA[7]==0?'selected="selected"':'');?> value="0">No</option>                             
                                </select></td>
                                <td rowspan="2" align="left">
                                  <div align="center">
                                    <select name="resultado[<?Php echo $idlogro_equipoA;?>][8]">
                                      <option value="">Seleccione</option>
                                      <option <?Php echo($resA[8]==$idlogro_equipoA?'selected="selected"':'');?> value="<?php echo $idlogro_equipoA; ?>"><?php echo $equipoA; ?></option>
                                      <option <?Php echo($resA[8]==$idlogro_equipoB?'selected="selected"':'');?> value="<?php echo $idlogro_equipoB; ?>"><?php echo $equipoB; ?></option>
                                    </select>
                                  </div></td>-->
                                <td rowspan="2" align="center"><select name="resultado[<?Php echo $idlogro_equipoA;?>][31]">
                                  <option value="">Opcional</option>
                                  <option <?Php echo($resA[31]==1?'selected="selected"':'');?> value="1">Suspendido</option>
                                </select></td>
                                </tr>
                                <tr class="" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB.$referenciaB; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][34]2" value="<?Php echo $resB[34];?>" size="2" maxlength="2" /></td>
                                
                                <!--<td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][32]2" value="<?Php echo $resB[32];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][10]2" value="<?Php echo $resB[10];?>" size="2" maxlength="2" /></td>-->
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][30]2" value="<?Php echo $resB[30];?>" size="2" maxlength="2" /></td>
                                </tr>
                                <tr><td colspan="6"><hr /></td></tr>
                    <?Php
			}
	?>
</table>
<div align="center"><input type="button" name="guardar" value="Guardar" class="boton" onclick="javascript: form_resultados='futbolamericano.php';comentario='cualquiera'; nolistado='no'; noreset='no'; validar(document.form1,'resultados.php');" /></div>
<input type="hidden" name="resultado_categoria" value="futbolamericano" />
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