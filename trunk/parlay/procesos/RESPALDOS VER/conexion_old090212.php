<?php
	//$servidor="127.0.0.1";
	$servidor="localhost";
	//$usuario="root";
	$usuario="granparl_sistema";
	//$usuario="ingenier_parGol";
	$clave="enrony+2010";
	$clave="sistema+-11";
	//$clave="KrqV-aVP9{=9";
	//$base="parley_gold"; //mejorada
	//$base="sistema_parley";
	$base="granparl_sistema";
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
		  if(mysql_num_rows($query)>0){
			  while($var=mysql_fetch_row($query)){
				  if($ids!='') $ids.=',';
				   $ids.=$var[0];
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
		  $idsmediojuego=dameids("select idlogro_equipo_categoria_apuesta_banquero from logros_equipos_categorias_apuestas_banqueros where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'");
			$idsmediojuego=explode(",",$idsmediojuego);
				for($f=0;$f<count($idsmediojuego);$f++){
					$existe=dame_datos("select idlogro_equipo_categoria_apuesta_banquero_acierto from logros_equipos_categorias_apuestas_banqueros_aciertos where idlogro_equipo_categoria_apuesta_banquero='".$idsmediojuego[$f]."' limit 1");
					if(!$existe)
						mysql_query("insert into logros_equipos_categorias_apuestas_banqueros_aciertos() values('','".$idsmediojuego[$f]."','1')");
					else
						mysql_query("update logros_equipos_categorias_apuestas_banqueros_aciertos set estatus='1' where idlogro_equipo_categoria_apuesta_banquero='".$idsmediojuego[$f]."' limit 1");	
				}
	  }
	  
	  function setea_tickets($equipoA,$equipoB){
		  mysql_query("update vista_ventas_detalles set ganador=0, perdedor=0 where idlogro_equipo='".$equipoA."' or idlogro_equipo='".$equipoB."'"); //SETEA LOS VALORES DE GANADOR Y PERDEDOR		  
	  }
	  
	
	  
	  function calcula_ticket_ganador($fecha){
		  $sql="select * from vista_ventas_detalles where fecha_venta='".$fecha."' order by idventa";
		  $query=mysql_query($sql);
		  	if(mysql_num_rows($query)>0){
				$apuestas=$aciertos=0;$idventa='';
				while($var=mysql_fetch_assoc($query)){
					//if($idventa!=$var['idventa']){
						if($idventa!=$var['idventa']){
							
							if($apuestas==$aciertos && $idventa!=''):
								mysql_query("update ventas set ganador='1' where idventa='".$idventa."' limit 1");
							elseif($idventa!=''):
								mysql_query("update ventas set perdedor='1' where idventa='".$idventa."' limit 1");
							endif;
							$idventa=$var['idventa'];
							$apuestas=$aciertos=0;
						}
						
						$existe=dame_datos("select idlogro_equipo_categoria_apuesta_banquero_acierto from logros_equipos_categorias_apuestas_banqueros_aciertos where idlogro_equipo_categoria_apuesta_banquero='".$var['idlogro_equipo_categoria_apuesta_banquero']."' and estatus='1' limit 1");
						if($existe){
							$aciertos++;
						}
							$apuestas++;
					//}
				}
				
				if($apuestas==$aciertos && $idventa!=''):
					mysql_query("update ventas set ganador='1' where idventa='".$idventa."' limit 1");
				elseif($idventa!=''):
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
					$acum=$acum+$var['total_ganar'];
				}
			}
		return $acum;
	}
	
	function siparley($idventa){
		$sql="select * from ventas_detalles where idventa=$idventa";
		$query=mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($query);
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
						$acum=$acum+$var['total_ganar'];
					}else{ //para venta derecho
						if($cantidad_lineas==1)
						$acum=$acum+$var['total_ganar'];
					}
				}
			}
		return $acum;
	}	  
		  
?>