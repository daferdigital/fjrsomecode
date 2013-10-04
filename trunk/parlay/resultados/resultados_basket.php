<?Php include("../procesos/conexion.php");
 session_start();?>
<div class="titulo">Resultados del día</div>
<form name="form1" method="post" action="procesos/guardar_resultados.php">
<table width="100%">
	<tr class="titulo_tablas"><td height="30" colspan="10" align="center">Cargar resultados para el Día <?Php echo $_GET['fecha'];?></td></tr>

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
	  <td colspan="6" bgcolor="#009900">Juego Completo</td>
	  
    </tr>
	<tr class="titulo_tablas" align="center"><td>Hora</td><td>Equipos</td>
	<td>Final</td><td>1H</td>
	<!--
	<td>2H</td>
	<td>Errores</td>
	<td>2da Mitad</td>
	<td>1T</td>
    <td>2T</td>
    <td>3T</td>
    -->
	
	</tr>
								<tr class="" bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2"><?php echo $hora; ?><br /><?
                                if ($_SESSION["tipo_usr"]=='2'){$desaparece="style='display:none;'";}else{$desaparece='';}?>
                                <div <? echo $desaparece;?>>
                                <input type="checkbox" <?Php echo $checked;?> name="estatus_<?Php echo $idlogro_equipoA;?>" value="1" title="Publicar resultados" onclick="javascript:if(this.checked){document.form1.estatus_<?Php echo $idlogro_equipoB;?>.value='1';}else{document.form1.estatus_<?Php echo $idlogro_equipoB;?>.value='0';}" /></div>
                                <input type="hidden" value="<?Php echo $estatus['estatus'];?>" name="estatus_<?Php echo $idlogro_equipoB;?>" />
                                </td>
                                <td><?php echo $equipoA.$referenciaA; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][19]2" value="<?Php echo $resA[19];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][17]2" value="<?Php echo $resA[17];?>" size="2" maxlength="3" /></td>
                                <!--
								<td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][21]2" value="<?Php echo $resA[21];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][13]2" value="<?Php echo $resA[13];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][9]2" value="<?Php echo $resA[9];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][23]2" value="<?Php echo $resA[23];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][25]2" value="<?Php echo $resA[25];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][27]2" value="<?Php echo $resA[27];?>" size="2" maxlength="3" /></td>
                                -->
                                
                                </tr>
                                <tr class="" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB.$referenciaB; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][20]2" value="<?Php echo $resB[20];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][18]2" value="<?Php echo $resB[18];?>" size="2" maxlength="3" /></td>
                                <!--
								<td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][22]2" value="<?Php echo $resB[22];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][24]2" value="<?Php echo $resB[24];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][26]2" value="<?Php echo $resB[26];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][28]2" value="<?Php echo $resB[28];?>" size="2" maxlength="3" /></td>
                                
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][14]2" value="<?Php echo $resB[14];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][10]2" value="<?Php echo $resB[10];?>" size="2" maxlength="2" /></td>
                                -->
                                </tr>
                                <tr><td colspan="10"><hr /></td></tr>
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
	  <td colspan="6" bgcolor="#009900">Juego Completo</td>
	  
    </tr>
	<tr class="titulo_tablas" align="center"><td>Hora</td><td>Equipos</td>
	<td>Final</td><td>1H</td>
	<!--
	<td>2H</td>
	<td>Errores</td>
	<td>2da Mitad</td>
	<td>1T</td>
    <td>2T</td>
    <td>3T</td>
    -->
	</tr>
								<tr class="" bgcolor="<?Php echo $color;?>">
                            	<td rowspan="2"><?php echo $hora; ?><br />
                                <div <? echo $desaparece;?>>
                                <input type="checkbox" <?Php echo $checked;?> name="estatus_<?Php echo $idlogro_equipoA;?>" value="1" title="Publicar resultados" onclick="javascript:if(this.checked){document.form1.estatus_<?Php echo $idlogro_equipoB;?>.value='1';}else{document.form1.estatus_<?Php echo $idlogro_equipoB;?>.value='0';}" />
                                </div>
                                <input type="hidden" value="<?Php echo $estatus['estatus'];?>" name="estatus_<?Php echo $idlogro_equipoB;?>" />
                                </td>
                                <td><?php echo $equipoA.$referenciaA; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][19]2" value="<?Php echo $resA[19];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][17]2" value="<?Php echo $resA[17];?>" size="2" maxlength="3" /></td>
                                <!--
								<td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][21]2" value="<?Php echo $resA[21];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][13]2" value="<?Php echo $resA[13];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][9]2" value="<?Php echo $resA[9];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][23]2" value="<?Php echo $resA[23];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][25]2" value="<?Php echo $resA[25];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoA;?>][27]2" value="<?Php echo $resA[27];?>" size="2" maxlength="3" /></td>
                                -->
                                </tr>
                                <tr class="" bgcolor="<?Php echo $color;?>">
                            	
                                <td><?php echo $equipoB.$referenciaB; ?></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][20]2" value="<?Php echo $resB[20];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][18]2" value="<?Php echo $resB[18];?>" size="2" maxlength="3" /></td>
                                <!--
								<td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][22]2" value="<?Php echo $resB[22];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][24]2" value="<?Php echo $resB[24];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][26]2" value="<?Php echo $resB[26];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][28]2" value="<?Php echo $resB[28];?>" size="2" maxlength="3" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][14]2" value="<?Php echo $resB[14];?>" size="2" maxlength="2" /></td>
                                <td align="center"><input class="numeric" type="text" name="resultado[<?Php echo $idlogro_equipoB;?>][10]2" value="<?Php echo $resB[10];?>" size="2" maxlength="2" /></td>
								-->
                                </tr>
                                <tr><td colspan="10"><hr /></td></tr>
                    <?Php
			}
	?>
</table>
<div align="center"><input type="button" name="guardar" value="Guardar" class="boton" onclick="javascript: form_resultados='basket.php';comentario='cualquiera'; nolistado='no'; noreset='no'; validar(document.form1,'resultados.php');" /></div>
<input type="hidden" name="resultado_categoria" value="basket" />
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