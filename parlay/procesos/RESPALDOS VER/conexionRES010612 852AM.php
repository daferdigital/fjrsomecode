<?Php
	date_default_timezone_set('America/Caracas');
	//$servidor="127.0.0.1";
	$servidor="localhost";
///	$servidor="10.8.0.1";
	
	$usuario="root";
//	$usuario="ingenier_root";
	$usuario="ingenier_Ugparla";

	//$usuario="granparl_sistema";
	//$usuario="ingenier_parGol";
	$clave="enrony+2010";	
	$clave="pruebas98001";
	//$clave="parlay0912";
	//$clave="sistema+-11";
	//$clave="KrqV-aVP9{=9";
	//$base="parley_gold"; //mejorada
	$base="sistema_parley";
	$base="ingenier_parlay2";
	//$base="ingenier_parley_gold";
	$conexion=mysql_connect($servidor,$usuario,$clave) or die(mysql_error());
	mysql_select_db($base) or die (mysql_error()."Problema");
	mysql_query ("SET NAMES 'utf-8'");
	if(!function_exists('control_logueo')){
		function control_logueo($login){
			mysql_query("insert into control_logueo() values('','".$login."','".date('Y-m-d')."','".date('H:i:s')."')");
		}
	}
	function genera_select($select,$atributos,$selected=''){
		$query=mysql_query($select);
			if(mysql_num_rows($query)>0){
				?><select <?php echo $atributos; ?>><option value="">Seleccione</option><?Php
				while($var=mysql_fetch_row($query)){
					$sel=''; if($selected==$var[0]) $sel='selected="selected"';
					?><option <?php echo $sel; ?> value="<?php echo $var[0]; ?>"><?php echo $var[1]; ?></option><?Php
				}
				?></select><?Php
			}else{
				return 'no se encontro resultado';
			}
	}
	
	function dame_array_js($select,$numcampos,$sepcampos,$sepregistros){
		$query=mysql_query($select);
			if(mysql_num_rows($query)>0){
				$cadena='';
					while($var=mysql_fetch_row($query)){
						if($cadena) $cadena=$cadena.$sepregistros;
						for($i=0;$i<$numcampos;$i++){
							if($i==($numcampos-1)){
								$cadena.=$var[$i];
							}else{
								$cadena.=$var[$i].$sepcampos;
							}
						}
					}
					return $cadena;
			}else{
				return 'no se encontro resultado';
			}
	}
	
	function dame_datos($select){
		$query=mysql_query($select);
			if(mysql_num_rows($query)>0){
				$var=mysql_fetch_assoc($query);
				return $var;
			}else{
				return '';
			}
	}
	
	function verifica_disponibilidad_usuario($select){
		 $query=mysql_query($select);
			if(mysql_num_rows($query)>0){				
				return 'no';
			}else{
				return '';
			}
	}
	
	function decodeUTF8($array) {
 
        foreach ($array as $k => $postTmp) {
                if (is_array($postTmp)) {
                        $array[$k]= decodeUTF8($postTmp);
                }else{
                        $array[$k] = utf8_decode($postTmp);
                }
        }
 
        return $array;
	}
	
	function convertArrayKeysToUtf8(array $array) { 
		$convertedArray = array(); 
		foreach($array as $key => $value) { 
		  if(!mb_check_encoding($key, 'UTF-8')) $key = utf8_encode($key); 
		  if(is_array($value)) $value = $this->convertArrayKeysToUtf8($value); 
	
		  $convertedArray[$key] = $value; 
		} 
		return $convertedArray; 
	  } 
	function convertArrayKeysToUtf82(array $array) { 
	return $array;
		$convertedArray = array(); 
		foreach($array as $key => $value) { 
		  if(mb_check_encoding($key, 'UTF-8')) $key = utf8_decode($key); 
		  if(is_array($value)) $value = $this->convertArrayKeysToUtf8($value); 
	
		  $convertedArray[$key] = $value; 
		} 
		return $convertedArray; 
	  } 
	  
	  function dameids($select){
		  //return $select;
		  $query=mysql_query($select);
		  if(mysql_num_rows($query)>0){ $contador=0;
			  while($var=mysql_fetch_row($query)){
				  if($contador>0) $ids.=',';
				   $ids.=$var[0];
				   $contador++;
			  }
			  return $ids;
		  }else{
			  return '';
		  }
	  }
	  
	  function dame_resultados($select){
		  $res='';
		  $query=mysql_query($select);
		  if(mysql_num_rows($query)>0){
			  while($var=mysql_fetch_row($query)){				  
				   $res[$var[0]]=$var[1];
			  }
			  return $res;
		  }else{
			  return '';
		  }
	  }
	  
	  function obtener_mini_contrincantes($idlogro_equipoA){ //Utilizado principalmente en la calculadora para obtener un estatus como este:
	  //Leon Vs. Cari
	  	$idlogro_equipoB=$idlogro_equipoA+1; //aplico esto ya que siempre en equipo A es impar y el equipo B es par
		$select="select nombre_equipo from vista_logros_banqueros where idlogro_equipo='".$idlogro_equipoA."' or idlogro_equipo='".$idlogro_equipoB."'  group by idlogro_equipo order by idlogro_equipo limit 2";
		$query=mysql_query($select);
			if(mysql_num_rows($query)>0){ $contrincantes='';
				while($var=mysql_fetch_assoc($query)){
					if($contrincantes) $contrincantes.=' Vs. ';
						$contrincantes.=substr($var['nombre_equipo'],0,4);
				}
			}
		return 	$contrincantes;
	  }
	  
	  function genera_aciertos($idcategoria_apuesta,$idlogro_equipo){
		  echo 'epa -> '.$_SESSION['suspendido']; //exit;
		  if($_SESSION['suspendido']>0):
		  	//echo "update logros_equipos_categorias_apuestas set suspendido=1 where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'"; exit;
		  	mysql_query("update logros_equipos_categorias_apuestas set suspendido=1 where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'");
		  else:
		  	mysql_query("update logros_equipos_categorias_apuestas set suspendido=0 where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'");
			
		  $idsmediojuego=dameids("select idlogro_equipo_categoria_apuesta_banquero from logros_equipos_categorias_apuestas_banqueros where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'");
			$idsmediojuego=explode(",",$idsmediojuego);
				for($f=0;$f<count($idsmediojuego);$f++){
					$existe=dame_datos("select idlogro_equipo_categoria_apuesta_banquero_acierto from logros_equipos_categorias_apuestas_banqueros_aciertos where idlogro_equipo_categoria_apuesta_banquero='".$idsmediojuego[$f]."' limit 1");
					if(!$existe)
						mysql_query("insert into logros_equipos_categorias_apuestas_banqueros_aciertos() values('','".$idsmediojuego[$f]."','1')");
					else
						mysql_query("update logros_equipos_categorias_apuestas_banqueros_aciertos set estatus='1' where idlogro_equipo_categoria_apuesta_banquero='".$idsmediojuego[$f]."' limit 1");	
				}
		  endif;	
	  }
	  
	  function setea_tickets($equipoA,$equipoB){
		  mysql_query("update vista_ventas_detalles set ganador=0, perdedor=0, reembolsar=0, recalculado=0 where (idlogro_equipo='".$equipoA."' or idlogro_equipo='".$equipoB."') and reembolsado='0' and pagado='0' and anulado='0' and vencido='0'"); //SETEA LOS VALORES DE GANADOR Y PERDEDOR		  
	  }
	  
	
	  
	  function calcula_ticket_ganador($fecha){
		//  return false;
		  $sql="select * from vista_ventas_detalles where fecha_venta='".$fecha."' order by idventa";
		  $query=mysql_query($sql);
		  	if(mysql_num_rows($query)>0){
				$apuestas=$aciertos=0;$idventa=$evaluar_parley='';//La variable $evaluar_parley me permite saber si ejecutar el claculo de ticket ganador para un determinado parley jugado
				while($var=mysql_fetch_assoc($query)){
					//if($idventa!=$var['idventa']){
						if($idventa!=$var['idventa']){
							
							if($apuestas==$aciertos && $idventa!='' && $evaluar_parley==''):
								if($acerto==1)://si acerto al menos una apuesta
									mysql_query("update ventas set ganador='1',monto_real_pagar='".$acum."',recalculado='".$recalculado."' where idventa='".$idventa."' limit 1");
								else:
									mysql_query("update ventas set reembolsar='1',monto_real_pagar=apuesta where idventa='".$idventa."' limit 1");
								endif;
							elseif($idventa!='' && $evaluar_parley==''):
								mysql_query("update ventas set perdedor='1' where idventa='".$idventa."' limit 1");
							endif;
							$idventa=$var['idventa'];
							$acerto=$recalculado=$acum=$apuestas=$aciertos=0;
							$nocalcular=$evaluar_parley=$idlogroequipoventa='';
						}
						if($acum==0) $acum=$var['apuesta'];
						$nocalcular='';
						if($var['suspendido']!=1){
							if($idlogroequipoventa!=$var['idlogro_equipo'] && $evaluar_parley==''){
								$idlogroequipoventa=$var['idlogro_equipo'];
									$existe=dame_datos("select idlogro_equipo_categoria_resultado from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogroequipoventa."' and estatus='1' limit 1");
										if($existe){
											
										}else{
											$evaluar_parley='no';
										}
							}
							if($evaluar_parley==''): //ejecuto esto si es posible el calculo del parley
								$existe=dame_datos("select idlogro_equipo_categoria_apuesta_banquero_acierto from logros_equipos_categorias_apuestas_banqueros_aciertos where idlogro_equipo_categoria_apuesta_banquero='".$var['idlogro_equipo_categoria_apuesta_banquero']."' and estatus='1' limit 1");
								if($existe){
									$aciertos++;
									$acerto=1;
								}else $nocalcular='no';
									$apuestas++;
							endif;
						}else{
							$aciertos++;
							$apuestas++;
							$nocalcular='no';
							$recalculado=1;
						}
						if($nocalcular==''){
								if($var['pago']>0){
									//acum=acum*parseFloat(1+parseFloat(sep_logro_apuestas_[j])/100);
									$acum=(float)($acum*((float)(1+(float)($var['pago']/100))));
								}elseif($var['pago']<0){
									//acum=acum*parseFloat(1+100/(parseFloat(sep_logro_apuestas_[j])*-1));
									$acum=(float)((float)($acum*((float)(1+((float)(100/((float)($var['pago']*-1))))))));
								}
						}
					//}
				}
				
				if($apuestas==$aciertos && $idventa!='' && $evaluar_parley==''):
					if($acerto==1):
						mysql_query("update ventas set ganador='1',monto_real_pagar='".$acum."',recalculado='".$recalculado."' where idventa='".$idventa."' limit 1");
					else:
						mysql_query("update ventas set reembolsar='1' where idventa='".$idventa."' limit 1");
					endif;
				elseif($idventa!='' && $evaluar_parley==''):
					mysql_query("update ventas set perdedor='1' where idventa='".$idventa."' limit 1");
				endif;
				
			}
	  }	  
	  	  
	function formato_sql($fecha,$sep){
		list($dia,$mes,$ano)=explode($sep,$fecha);
		return $ano.'-'.$mes.'-'.$dia;
	}
	
	function suma_ventas($sql){
		//$sql="select total_ganar from vista_ventas where $condicionids idbanquero=$idb and fecha_venta>='$fechad' and fecha_venta<='$fechah' and anulado='0' group by idventa";
		$query=mysql_query($sql);
		$acum=0;
			if(mysql_num_rows($query)>0){ 
				while($var=mysql_fetch_assoc($query)){
					$acum=$acum+$var['apuesta'];
				}
			}
		return $acum;
	}
	
	function siparley($idventa){
		$sql="select * from ventas_detalles where idventa=$idventa";
		$query=mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($query);
	}
	
	function numero_registros($sql){
		$query=mysql_query($sql) or die(mysql_error());
		$res=mysql_fetch_assoc($query);
			//return mysql_num_rows($query);
			return $res['acum'];
			
	}
	
	function suma_registros($sql){
		$query=mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($query)>0){
				$var=mysql_fetch_assoc($query);
				return $var['acum'];
			}else{return '0';}
	}
	
	//funcion que calcula la cantidad de jugadas por logro 1,2,3,4,5,6,7,8,9,10 para una determinada taquilla
	//y cupos diarios
	function jugadas_cantidad(){
		//$_SESSION['cmapd']=numero_registros("select idventa from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and cantidad_apuesta='1'");
		$_SESSION['cmapd']=numero_registros("select sum(total_ganar) as acum from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and cantidad_apuesta='1'");
		
		//calculo para logros a partir de dos hasta diez
		for($r=2;$r<11;$r++){
			//$_SESSION['cma'.$r]=numero_registros("select idventa from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and cantidad_apuesta='".$r."'");
			$_SESSION['cma'.$r]=numero_registros("select sum(total_ganar) as acum from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and cantidad_apuesta='".$r."'");
		}
		/*$_SESSION['cdpp']=numero_registros("select idventa from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and cantidad_apuesta>'1'");
		$_SESSION['cdpd']=numero_registros("select idventa from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and cantidad_apuesta='1'");*/
		
		$_SESSION['cdpp']=suma_registros("select sum(apuesta) as acum from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and cantidad_apuesta>'1'");
		$_SESSION['cdpd']=suma_registros("select sum(apuesta) as acum from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and cantidad_apuesta='1'");
		
	}
	
	function suma_parley($sql,$cond){
		//$sql="select total_ganar,idventa from vista_ventas where $condicionids idbanquero=$idb and fecha_venta>='$fechad' and fecha_venta<='$fechah' and anulado='0' group by idventa";
		$query=mysql_query($sql);
		$acum=0;
			if(mysql_num_rows($query)>0){ 
				while($var=mysql_fetch_assoc($query)){
					$cantidad_lineas=siparley($var['idventa']);
					if($cond=='parley'){//para venta parley
						if($cantidad_lineas>1)
						$acum=$acum+$var['apuesta'];
					}else{ //para venta derecho
						if($cantidad_lineas==1)
						$acum=$acum+$var['apuesta'];
					}
				}
			}
		return $acum;
	}	  
	
	
	function genera_encabezado($que_muestro,$categoria,$deporte=''){
		global $array_datos,$equipoA,$equipoB,$hora,$color,$cuenta_juego,$varlogros,$imagenA,$imagenB,$total_juegos,$refA,$refB,$pitcherA,$pitcherB,$ancho;
		if($ancho=='')$ancho='100%';
		switch($categoria){
			case '1': //Futbol
				if($que_muestro=='encabezado'):
				?>
					<table width="<? echo $ancho;?>" class="ventas_taquilla" border="1" cellspacing="0" cellpadding="3">
						<tr class="titulo_tablas"><td colspan="9" align="center">Logros de <b><?Php echo $deporte;?></b> al <?Php list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']); echo "$dia/$mes/$ano";?></td></tr>
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
					  <tr><td colspan="9">&nbsp;</td></tr>
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
                        <tr><td colspan="9">&nbsp;</td></tr>
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
                            <tr><td colspan="9">&nbsp;</td></tr>
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
				endif;
			break;
			case '3': //Basket
				if($que_muestro=='encabezado'):
				?>
					<table width="<? echo $ancho;?>" class="ventas_taquilla" border="1" cellspacing="0" cellpadding="3">
						<tr class="titulo_tablas"><td colspan="15" align="center">Logros de <b><?Php echo $deporte;?></b> al <?Php list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']); echo "$dia/$mes/$ano";?></td></tr>
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
					  <tr><td colspan="15">&nbsp;</td></tr>
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
                        <tr><td colspan="15">&nbsp;</td></tr>
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
                        </tr>
                        <tr><td colspan="15">&nbsp;</td></tr>
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
				endif;
			break;
			case '2': //Beisbol
				if($que_muestro=='encabezado'):
				?>
					<table width="<? echo $ancho;?>" class="ventas_taquilla" border="1" cellspacing="0" cellpadding="3">
						<tr class="titulo_tablas"><td colspan="16" align="center">Logros de <b><?Php echo $deporte;?></b> al <?Php list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']); echo "$dia/$mes/$ano";?></td></tr>
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
					  <tr><td colspan="16" height="5">&nbsp;</td></tr>
				<?Php
					elseif($que_muestro=='impresion'):
				?>
                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                    	<td colspan="16"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>
                        </td>
                    </tr>
                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">                        
                        <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>
                        <td><?php echo $equipoA.'<br>'.$pitcherA['nombre'].' ('.ucfirst($pitcherA['lado']).')'; ?></td>
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
                        <td><?php  echo $equipoB.'<br>'.$pitcherB['nombre'].' ('.ucfirst($pitcherB['lado']).')'; ?></td>
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
                        <tr><td colspan="17">&nbsp;</td></tr>
                <?Php	
					elseif($que_muestro=='ventas'):	
				?>
                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">
                    	<td colspan="16"><label class="hora_venta"><?php echo '<b>'.$hora.'</b>'; ?></label>
                        </td>
                    </tr>
                	<tr class="borde_rigth_bottom_top"  bgcolor="<?Php echo $color;?>">                            	
                                <td width="36px"><?php if(file_exists('imagenes/img_equipos/'.$imagenA)){echo '<img align="absmiddle" src="imagenes/img_equipos/'.$imagenA.'">';}?></td>
                                <td> <?Php echo $equipoA.'<br>'.$pitcherA['nombre'].' ('.ucfirst($pitcherA['lado']).')'; ?></td>
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
                                <td><?Php echo $equipoB.'<br>'.$pitcherB['nombre'].' ('.ucfirst($pitcherB['lado']).')'; ?></td>
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
                	<tr><td colspan="16" align="right"><b>Total de juegos:</b> <?Php echo $cuenta_juego; $total_juegos=$total_juegos+$cuenta_juego;?></td></tr>
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
				endif;
			break;
		}
	}
	
	function agregar_logros_banqueros($fecha,$idb){
		$sqllo="select * from vista_logros where fecha='".$fecha."' and estatus='1'";
		$querylo=mysql_query($sqllo);
			if(mysql_num_rows($querylo)>0){
				while($var=mysql_fetch_assoc($querylo)){
					mysql_query("insert into logros_equipos_categorias_apuestas_banqueros() values('','".$var['idlogro_equipo_categoria_apuesta']."','".$var['idlogro_equipo']."','".$var['idcategoria_apuesta']."','".$var['multiplicando']."','".$var['pago']."','".$idb."','1')");
				}
			}
	}
	
	function calcula_ticket_vencidos($fecha){
		mysql_query("update ventas set vencido='1' where fecha_prorroga < '".$fecha."' and perdedor=0 and pagado=0 and anulado=0");
	}
		  
?>