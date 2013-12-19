<?Php
	error_reporting(0);
	date_default_timezone_set('America/Caracas');
	
	/**
	 * Revisamos si el archivo indicado existe desde el path que desea incluirse.
	 * En caso de existir se incluye sino, se retorna false.
	 * 
	 * @param unknown_type $filename
	 * @return boolean
	 */
	function checkIfCanInclude($filename) {
		if (is_file($filename)) {
			include_once $filename;
		}
		
		return false;
	}
	
	checkIfCanInclude("./classes/Constants.php");
	checkIfCanInclude("./classes/DBConnection.php");
	checkIfCanInclude("./classes/DBUtil.php");
	checkIfCanInclude("./classes/VentasDAO.php");
	checkIfCanInclude("./classes/BitacoraDAO.php");
	checkIfCanInclude("./classes/GanadoresFutbol.php");
	checkIfCanInclude("./classes/GanadoresFutbolAmericano.php");
	checkIfCanInclude("./classes/GanadoresBasket.php");
	checkIfCanInclude("./classes/GanadoresBeisbol.php");
	checkIfCanInclude("../classes/Constants.php");
	checkIfCanInclude("../classes/DBConnection.php");
	checkIfCanInclude("../classes/DBUtil.php");
	checkIfCanInclude("../classes/VentasDAO.php");
	checkIfCanInclude("../classes/BitacoraDAO.php");
	checkIfCanInclude("../classes/GanadoresFutbol.php");
	checkIfCanInclude("../classes/GanadoresFutbolAmericano.php");
	checkIfCanInclude("../classes/GanadoresBasket.php");
	checkIfCanInclude("../classes/GanadoresBeisbol.php");
	
	$conexion = null;
	function prepareConnection(){
		global $conexion;
		$servidor=Constants::$DB_SERVIDOR;
		$usuario=Constants::$DB_USUARIO;
		$clave=Constants::$DB_USER_PWD;
		$base=Constants::$DB_SCHEMA;
		
		$conexion=mysql_connect($servidor,$usuario,$clave) or die(mysql_error());
		mysql_select_db($base) or die (mysql_error()."Problema");
	}
	prepareConnection();

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

	function mysql_debug_query($query){
		echo "\n<br>Query: $query";
		$ret = mysql_query($query);
		if(mysql_error()) 
			echo " - Error: ".mysql_error();
		return $ret;
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
		  $ids = "";
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
		  $removeSuspendido = false;
	  	  if(! isset($_SESSION['suspendido'])){
	  	  	$removeSuspendido = true;
	  	  	$_SESSION['suspendido'] = 0;
		  }
		  
		  echo 'epa -> '.$_SESSION['suspendido']; //exit;

		  if($_SESSION['suspendido']>0):

		  	//echo "update logros_equipos_categorias_apuestas set suspendido=1 where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'"; exit;

		  	mysql_query("update logros_equipos_categorias_apuestas set suspendido=1 where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'");

		  else:

		  	mysql_query("update logros_equipos_categorias_apuestas set suspendido=0 where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'");
		
		  $idsmediojuego=dameids("select idlogro_equipo_categoria_apuesta_banquero from logros_equipos_categorias_apuestas_banqueros where idcategoria_apuesta='".$idcategoria_apuesta."' and idlogro_equipo='".$idlogro_equipo."'");
			echo "\nidsmediojuego= ";
			print_r($idsmediojuego);
			echo "\n";
			$idsmediojuego=explode(",",$idsmediojuego);

				for($f=0;$f<count($idsmediojuego);$f++){

					$existe=dame_datos("select idlogro_equipo_categoria_apuesta_banquero_acierto from logros_equipos_categorias_apuestas_banqueros_aciertos where idlogro_equipo_categoria_apuesta_banquero='".$idsmediojuego[$f]."' limit 1");

					if(!$existe)

						mysql_query("insert into logros_equipos_categorias_apuestas_banqueros_aciertos() values('','".$idsmediojuego[$f]."','1')");

					else

						mysql_query("update logros_equipos_categorias_apuestas_banqueros_aciertos set estatus='1' where idlogro_equipo_categoria_apuesta_banquero='".$idsmediojuego[$f]."' limit 1");	
				}

		  endif;	
		  
		  if($removeSuspendido){
		  	unset($_SESSION["suspendido"]);
		  }
	  }

	  

	  function setea_tickets($equipoA,$equipoB){

			//echo "equipos: ".$equipoA." - ".$equipoB."\n\n<br><br>";

		 mysql_debug_query("update vista_ventas_detalles set monto_real_pagar=0, ganador=0, perdedor=0, reembolsar=0, recalculado=0 where (idlogro_equipo='".$equipoA."' or idlogro_equipo='".$equipoB."') and reembolsado='0' and pagado='0' and anulado='0' and vencido='0'"); //SETEA LOS VALORES DE GANADOR Y PERDEDOR		  

		  //mysql_debug_query("update ventas set monto_real_pagar=0, ganador=0, perdedor=0, reembolsar=0, recalculado=0 where idventa IN (select idventa from ventas_detalles where idlogro_equipo_categoria_apuesta_banquero='".$equipoA."' or idlogro_equipo_categoria_apuesta_banquero='".$equipoB."')"); //SETEA LOS VALORES DE GANADOR Y PERDEDOR  

		  //echo ("update ventas set monto_real_pagar=0, ganador=0, perdedor=0, reembolsar=0, recalculado=0 where idventa IN (select idventa from ventas_detalles where idlogro_equipo_categoria_apuesta_banquero='".$equipoA."' or idlogro_equipo_categoria_apuesta_banquero='".$equipoB."')"); //SETEA LOS VALORES DE GANADOR Y PERDEDOR  

		  echo mysql_error();

	  }

	

	  

	  function calcula_ticket_ganador($fecha, $arregloLogrosGuardados=null){
		
	  	VentasDAO::calcularTicketGanador($fecha, $arregloLogrosGuardados);
	  	
	  	return;
	  	
		//echo "fecha: ".$fecha."\n\n<br><br>";

		//  return false;
		
		  $sql="select * from vista_ventas_detalles where fecha_venta='".$fecha."' order by idventa";

		  $query=mysql_debug_query($sql);

		  	if(mysql_num_rows($query)>0){

				$apuestas=$aciertos=0;$idventa=$evaluar_parley='';//La variable $evaluar_parley me permite saber si ejecutar el claculo de ticket ganador para un determinado parley jugado

				while($var=mysql_fetch_assoc($query)){
				
					if($idventa!=$var['idventa']){

						if($idventa!='' && $evaluar_parley=='') {
						
							if($apuestas==$aciertos):
								if($acerto==1){//si acerto al menos una apuesta
									//mysql_debug_query("update ventas set monto_real_pagar=0, perdedor=0, reembolsar=0, ganador='1', monto_real_pagar='".$acum."',recalculado='".$recalculado."' where idventa='".$idventa."' limit 1");
									$codeReturn = VentasDAO::verificarSiEsGanador($var["idventa_detalle"]);
									echo "<br /> codeReturn para ".$idventa." fue: ".$codeReturn."<br />";
									
									if($codeReturn == VentasDAO::$RESULTADO_GANADOR || $codeReturn == VentasDAO::$RESULTADO_NO_MAPEADO_AUN){
										mysql_debug_query("update ventas set monto_real_pagar=0, perdedor=0, reembolsar=0, ganador='1', monto_real_pagar='".$acum."',recalculado='".$recalculado."' where idventa='".$idventa."' limit 1");
									} else if($codeReturn == VentasDAO::$RESULTADO_PERDEDOR){
										mysql_debug_query("update ventas set monto_real_pagar=0, reembolsar=0, recalculado=0, ganador=0, perdedor='1' where idventa='".$idventa."' limit 1");
									} else if($codeReturn == VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER){
										mysql_debug_query("update ventas set perdedor=0, recalculado=0, ganador=0, reembolsar='1',monto_real_pagar=apuesta where idventa='".$idventa."' limit 1");
									}
								}else{
									mysql_debug_query("update ventas set perdedor=0, recalculado=0, ganador=0, reembolsar='1',monto_real_pagar=apuesta where idventa='".$idventa."' limit 1");
								}
							else:
								mysql_debug_query("update ventas set monto_real_pagar=0, reembolsar=0, recalculado=0, ganador=0, perdedor='1' where idventa='".$idventa."' limit 1");
							endif;
						}

						$idventa=$var['idventa'];

						$acerto=$recalculado=$acum=$apuestas=$aciertos=0;

						$nocalcular=$evaluar_parley=$idlogroequipoventa='';
						
						$acum=$var['apuesta'];
						
					}

					echo "\n<br>id_venta: {$var['idventa']} - logro {$var['idlogro_equipo']} - ";

					echo "\n<br>ini: {$var['idventa']} - ";

					$nocalcular='';
					
					if($var['suspendido']!=1) {
						if($idlogroequipoventa!=$var['idlogro_equipo'] && $evaluar_parley==''){

							$idlogroequipoventa=$var['idlogro_equipo'];

							$existe=dame_datos("select idlogro_equipo_categoria_resultado from logros_equipos_categorias_resultados where idlogro_equipo='".$idlogroequipoventa."' and estatus='1' limit 1");
							
							if(!$existe){
							
								echo "evaluar_parley NO!!";
								
								$evaluar_parley='no';
								
							}

						}

						if($evaluar_parley==''): //ejecuto esto si es posible el calculo del parley

							$existe=dame_datos("select idlogro_equipo_categoria_apuesta_banquero_acierto from logros_equipos_categorias_apuestas_banqueros_aciertos where idlogro_equipo_categoria_apuesta_banquero='".$var['idlogro_equipo_categoria_apuesta_banquero']."' and estatus='1' limit 1");
							if($existe){

								$aciertos++;

								$acerto=1;
								
								
								echo "\n<br>Acert\n";
								print_r($existe);

							}else { 
							
								//FJR
								//$nocalcular='no';
								$nocalcular='';
								$acerto=1;
								$aciertos++;
								//END FJR
								echo "\n<br>No Acerto! idlogro_equipo_categoria_apuesta_banquero='".$var['idlogro_equipo_categoria_apuesta_banquero']."' and estatus='1'";

							}
							
							$apuestas++;

						endif;

					}else{

						echo "\n<br>Suspendido";
						
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

					echo "\n<br>end: {$var['idventa']} - ";
				}		

				if($apuestas==$aciertos && $idventa!='' && $evaluar_parley==''):

					if($acerto==1){//si acerto al menos una apuesta
						//mysql_debug_query("update ventas set monto_real_pagar=0, perdedor=0, reembolsar=0, ganador='1', monto_real_pagar='".$acum."',recalculado='".$recalculado."' where idventa='".$idventa."' limit 1");
						$codeReturn = VentasDAO::verificarSiEsGanador($var["idventa_detalle"]);
						echo "<br /> codeReturn para ".$idventa." fue: ".$codeReturn."<br />";
									
						if($codeReturn == VentasDAO::$RESULTADO_GANADOR || $codeReturn == VentasDAO::$RESULTADO_NO_MAPEADO_AUN){
							mysql_debug_query("update ventas set monto_real_pagar=0, perdedor=0, reembolsar=0, ganador='1', monto_real_pagar='".$acum."',recalculado='".$recalculado."' where idventa='".$idventa."' limit 1");
						} else if($codeReturn == VentasDAO::$RESULTADO_PERDEDOR){
							mysql_debug_query("update ventas set monto_real_pagar=0, reembolsar=0, recalculado=0, ganador=0, perdedor='1' where idventa='".$idventa."' limit 1");
						} else if($codeReturn == VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER){
							mysql_debug_query("update ventas set perdedor=0, recalculado=0, ganador=0, reembolsar='1',monto_real_pagar=apuesta where idventa='".$idventa."' limit 1");
						}
					}else{
						mysql_debug_query("update ventas set perdedor=0, recalculado=0, ganador=0, reembolsar='1',monto_real_pagar=apuesta where idventa='".$idventa."' limit 1");
					}
				elseif($idventa!='' && $evaluar_parley==''):

					mysql_debug_query("update ventas set monto_real_pagar=0, reembolsar=0, recalculado=0, ganador=0, perdedor='1' where idventa='".$idventa."' limit 1");

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

		global $array_datos,$idliga,$equipoA,$equipoB,$hora,$color,$cuenta_juego,$varlogros,$imagenA,$imagenB,$total_juegos,$refA,$refB,$pitcherA,$pitcherB,$ancho,$soloimp,$nombre_liga;

		if($ancho=='')$ancho='100%';

		///switch($idliga){

			if($idliga=='4' or $idliga=='5' or $idliga=='7' or ($idliga>=12 && $idliga<=15) or $idliga=='17' or ($idliga>=20 && $idliga<=28) or ($idliga>=30 && $idliga<=43)  or $idliga=='48' or $idliga=='49' or $idliga=='50' or $idliga=='51'){
				///Futbol ///padre=1

				include ("deportes_est/futbol.php");
				
			}else if($idliga=='2' or $idliga=='16' or $idliga=='18' or $idliga=='47'){ //Basket ///padre=3
				include ("deportes_est/basket.php");
			}

			else if($idliga=='11' or $idliga=='3' or $idliga=='1' or $idliga=='44' or $idliga=='45' or $idliga=='52'){ //Beisbol ///padre=2
				include ("deportes_est/beisbol.php");
			}

			else if($idliga=='10' or $idliga=='46'){ //Futbol AMERICANO ///padre=6
				include ("deportes_est/famericano.php");
			}

	//	}

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