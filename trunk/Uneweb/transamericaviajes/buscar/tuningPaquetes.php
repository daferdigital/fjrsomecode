<?php
include_once("conexion.php");

//declaramos los arreglos que contendran los distintos criterios de busqueda
$arregloComboPaquete;
$keysComboPaquete;

$arregloComboPuerto;
$keysComboPuerto;

$arregloComboNaviera;
$keysComboNaviera;

$arregloComboFecha;
$keysComboFecha;
$keysComboFechaPart2;

$arregloComboDestino;
$keysComboDestino;

$arregloComboPrecio;
$keysComboPrecio;

$arregloComboDuracion;
$keysComboDuracion;

$arregloComboItinerario;
$keysComboItinerario;

$divDiasInfo;

/**
 * Toma un elemento del campo salidas de la tabla programas y lo convierte en su equivalente de año y mes pero numerico.
 * 
 * @param string $dateValue, fecha con formato "Mes(en nombre)-Año"
 * @return string formateado con la estructura yyyy-mm (valores numericos)
 */
function convertDateValue($dateValue){
	$dateValue = strtolower($dateValue);
	$monthValue;
	$anioValue;
	
	$values = explode("-", $dateValue);
	$anioValue = $values[1];
	
	switch ($values[0]) {
		case "enero":
			$monthValue = "01";
			 break;
		case "febrero":
			$monthValue = "02";
			break;
		case "marzo":
			$monthValue = "03";
			break;
		case "abril":
			$monthValue = "04";
			break;
		case "mayo":
			$monthValue = "05";
			break;
		case "junio":
			$monthValue = "06";
			break;
		case "julio":
			$monthValue = "07";
			break;
		case "agosto":
			$monthValue = "08";
			break;
		case "septiembre":
			$monthValue = "09";
			break;
		case "octubre":
			$monthValue = "10";
			break;
		case "noviembre":
			$monthValue = "11";
			break;
		case "diciembre":
			$monthValue = "12";
			break;
	}
	
	return $anioValue."-".$monthValue;
}

/**
 * Tomamos la descripcion asociada a determinado elemento de viaje
 * y la limpiamos de tags HTML entre otras cosas.
 * 
 * @param string $descripcionPaquete
 * @return string, cadena de descripcion ya procesada
 */
function limpiarTextoDescripcion($descripcionPaquete){
	$descripcionPaquete = ereg_replace("(<[[:alnum:]]+>)", "", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(</[[:alnum:]]+>)", "", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(<br />)", "", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(&aacute;)", "a", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(&eacute;)", "e", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(&iacute;)", "i", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(&oacute;)", "o", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(&uacute;)", "u", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(&ntilde;)", "n", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(á)", "a", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(é)", "a", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(í)", "i", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(ó)", "o", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(ú)", "u", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(ñ)", "n", $descripcionPaquete);
	$descripcionPaquete = ereg_replace("(&nbsp;)", " ", $descripcionPaquete);
	
	return $descripcionPaquete;
}

/**
 * Guardamos para el arreglo de paquetes, los respectivos valores que tendra
 * ademas de los ids (keys) de ese paquete en base de datos.
 * 
 * @param int $id
 * @param title $titulo
 */
function populatePaqueteArray($id, $titulo){
	global $arregloComboPaquete;
	global $keysComboPaquete;
	
	//agregamos la info del paquete
	if(isset($arregloComboPaquete["$titulo"])){
		$arregloComboPaquete["$titulo"] = $arregloComboPaquete["$titulo"]."||".$id;
	} else {
		$arregloComboPaquete["$titulo"] = $id;
		$keysComboPaquete[] = $titulo;
	}
}

/**
 * Tomamos el precio base de ese paquete y lo ubicamos en el rango de precios que le corresponda,
 * los rangos tienen una amplitud de 500 en 500.
 * Luego de obtener dicho rango, se asocia el id del paquete a dicho rango.
 * 
 * @param int $id
 * @param string $precio
 */
function populatePrecioArray($id, $precio){
	global $arregloComboPrecio;
	global $keysComboPrecio;
	
	$anchoRango = 500;
	
	//agregamos la info del precio
	$cociente500 = (int) ($precio / $anchoRango);
	$resto500 = $precio % $anchoRango;
	$rangoPrecio = "";
	if($resto500 == 0){
		$rangoPrecio = "".(($anchoRango * ($cociente500 - 1)) + 1)." - ".($anchoRango * $cociente500);
	} else {
		$rangoPrecio = "".(($anchoRango * $cociente500) + 1)." - ".($anchoRango * ($cociente500 + 1));
	}
	
	if(isset($arregloComboPrecio["$rangoPrecio"])){
		$arregloComboPrecio["$rangoPrecio"] = $arregloComboPrecio["$rangoPrecio"]."||".$id;
	} else {
		$arregloComboPrecio["$rangoPrecio"] = $id;
		$keysComboPrecio[] = trim(substr($rangoPrecio, 0, strpos($rangoPrecio, " -")));
	}
}

/**
 * Tomamos los insumos de base de datos asociados a los circuitos de viaje
 * y obtenemos de sus descripciones los elementos que serán usados para los
 * filtros de busqueda en esta modalidad.
 * 
 * @param int $id
 * @param string $titulo
 * @param string $descripcionPaquete
 * @param int or float $precio
 * @param string $salidas
 */
function llenarCombosCircuitos($id, $titulo, $descripcionPaquete, $precio, $salidas){
	global $arregloComboDuracion;
	global $keysComboDuracion;
	global $arregloComboItinerario;
	global $keysComboItinerario;
	
	$descripcionPaquete = limpiarTextoDescripcion($descripcionPaquete);
	$descripcionAsArray = explode(chr(10), $descripcionPaquete);
	reset($descripcionAsArray);
	
	populatePaqueteArray($id, $titulo);
	populatePrecioArray($id, $precio);
	
	do {
		$linea = current($descripcionAsArray);
		$lineaLower = strtolower($linea);
	
		//revisamos las lineas destino
		if(strpos($lineaLower, "duracion") > -1) {
			//procesamos el campo destino
			$valor = explode(":", $lineaLower);
			$valor = trim($valor[1]);
			$valor = ereg_replace("(\.)", "", $valor);
			
			if(isset($arregloComboDuracion["$valor"])){
				$arregloComboDuracion["$valor"] = $arregloComboDuracion["$valor"]."||".$id;
			} else {
				$arregloComboDuracion["$valor"] = $id;
				$keysComboDuracion[] = $valor;
			}
		} else if(strpos($lineaLower, "itinerario") > -1) {
			//procesamos el campo destino
			$valor = explode(":", $linea);
			$valor = trim($valor[1]);
	
			if(isset($arregloComboItinerario["$valor"])){
				$arregloComboItinerario["$valor"] = $arregloComboItinerario["$valor"]."||".$id;
			} else {
				$arregloComboItinerario["$valor"] = $id;
				$keysComboItinerario[] = $valor;
			}
		}
	} while (next($descripcionAsArray));
}

/**
 * Tomamos los insumos de base de datos asociados a los cruceros de viaje
 * y obtenemos de sus descripciones los elementos que serán usados para los
 * filtros de busqueda en esta modalidad.
 * 
 * @param int $id
 * @param string $titulo
 * @param string $descripcionPaquete
 * @param int or float $precio
 * @param string $salidas
 */
function llenarCombosCruceros($id, $titulo, $descripcionPaquete, $precio, $salidas){
	global $arregloComboPuerto;
	global $keysComboPuerto;
	global $arregloComboNaviera;
	global $keysComboNaviera;
	global $arregloComboFecha;
	global $keysComboFecha;
	global $keysComboFechaPart2;
	global $arregloComboDestino;
	global $keysComboDestino;
	
	$descripcionPaquete = limpiarTextoDescripcion($descripcionPaquete);
	$descripcionAsArray = explode(chr(10), $descripcionPaquete);
	reset($descripcionAsArray);
	
	populatePaqueteArray($id, $titulo);
	populatePrecioArray($id, $precio);
	
	//tomamos la informacion de las fechas
	$fechas = explode(",", $salidas);
	foreach ($fechas as $diaSalida){
		if(trim($diaSalida) != ""){
			if(isset($arregloComboFecha["$diaSalida"])){
				$arregloComboFecha["$diaSalida"] = $arregloComboFecha["$diaSalida"]."||".$id;
			} else {
				$arregloComboFecha["$diaSalida"] = $id;
				//$keyVal = convertDateValue($diaSalida);
				$keyVal = $diaSalida;
				$keysComboFecha["$keyVal"] = $diaSalida;
				$keysComboFechaPart2[] = $keyVal;
			}
		}
	}
	
	do {
		$linea = current($descripcionAsArray);
		$lineaLower = strtolower($linea);
		
		//revisamos las lineas destino
		if(strpos($lineaLower, "puerto de salida") > -1){
			//procesamos el campo destino
			$valor = explode(":", $linea);
			$valor = trim($valor[1]);
			
			//el puerto de salida puede estar concatenado con ' - ' o ' y ' o solamente ser el nombre del puerto.
			//vemos que caso tenemos
			if(strpos($valor, " - ") > 0){
				$valor = explode(" - ", $valor);
			} else if(strpos($valor, " y ") > 0){
				$valor = explode(" y ", $valor);
			} else {
				$valor = array($valor);
			}
			
			foreach ($valor as $puerto){
				$puerto = trim($puerto);
				if(isset($arregloComboPuerto["$puerto"])){
					$arregloComboPuerto["$puerto"] = $arregloComboPuerto["$puerto"]."||".$id;
				} else {
					$arregloComboPuerto["$puerto"] = $id;
					$keysComboPuerto[] = $puerto;
				}
			}			
		} else if(strpos($lineaLower, "destino") > -1) {
			//procesamos el campo destino
			$valor = explode(":", $linea);
			$valor = trim($valor[1]);
			
			if(isset($arregloComboDestino["$valor"])){
				$arregloComboDestino["$valor"] = $arregloComboDestino["$valor"]."||".$id;
			} else {
				$arregloComboDestino["$valor"] = $id;
				$keysComboDestino[] = $valor;
			}
		} else if(strpos($lineaLower, "naviera") > -1) {
			//procesamos el campo destino
			$valor = explode(":", $linea);
			$valor = trim($valor[1]);
				
			if(isset($arregloComboNaviera["$valor"])){
				$arregloComboNaviera["$valor"] = $arregloComboNaviera["$valor"]."||".$id;
			} else {
				$arregloComboNaviera["$valor"] = $id;
				$keysComboNaviera[] = $valor;
			}
		}
	} while (next($descripcionAsArray));
}

/**
 * Basandonos en el parametro recibido, ubicamos la info del mismo en base de datos
 * y la procesamos para generar los arreglos respectivos a ser usados luego para la busqueda
 * individual o combinada de criterios.
 * 
 * @param string $mira
 */
function obtenerInformacion($mira){
	//$conexion = getConnection();
	global $conexion;
	
	$sql = "SELECT id, titulo, descripcion, precio, salidas 
	FROM programas 
	WHERE seccion = $mira 
	AND status='1'
	ORDER by id";
	$consulta = mysql_query($sql, $conexion);
	
	
	while(list($id, $titulo, $desc, $precio, $salidas) = mysql_fetch_array($consulta)){
		if($mira == 70){
			llenarCombosCircuitos($id, $titulo, $desc, $precio, $salidas);
		}else if ($mira == 53){
			llenarCombosCruceros($id, $titulo, $desc, $precio, $salidas);
		}
	}
	
	global $keysComboPaquete;
	global $keysComboPrecio;
	
	sort($keysComboPaquete);
	sort($keysComboPrecio, SORT_NUMERIC);
	
	if($mira == 70){
		global $keysComboDuracion;
		global $keysComboItinerario;
		
		sort($keysComboDuracion, SORT_STRING);
		sort($keysComboItinerario);
	}else if ($mira == 53){
		global $keysComboDestino;
		global $keysComboNaviera;
		global $keysComboPuerto;
		global $keysComboFecha;
		global $arregloComboFecha;
		global $keysComboFechaPart2;
		
		$keysComboFechaTmp = array();
		
		sort($keysComboDestino);
		sort($keysComboNaviera);
		sort($keysComboPuerto);
		//sort($keysComboFecha);
		sort($keysComboFechaPart2);
		while($values = each($keysComboFechaPart2)){
			$keysComboFechaTmp[] = $keysComboFecha[$values[1]];
		}
		
		$keysComboFecha = null;
		$keysComboFecha = $keysComboFechaTmp;
		//print_r($keysComboFecha);
		getDivDiasInfo($keysComboFecha, $arregloComboFecha);
	}
	
	mysql_close($conexion);
}

$monthName = "";
function getDaysPerMonth($iMonth, $iYear){
	global $monthName;
	
	switch ($iMonth){
		case 1: $monthName = "ENE"; return 31; break;
		case 2:
			$monthName = "FEB";
			if ($iYear % 4 == 0){
				if ($iYear % 400 == 0){
					return 29;
				} else {
					if ($iYear % 100 == 0){
						return 28;
					} else {
						return 29;
					}
				}
			} else {
				return 28;
			};
			break;
		case 3: $monthName = "MAR"; return 31; break;
		case 4: $monthName = "ABR"; return 30; break;
		case 5: $monthName = "MAY"; return 31; break;
		case 6: $monthName = "JUN"; return 30; break;
		case 7: $monthName = "JUL"; return 31; break;
		case 8: $monthName = "AGO"; return 31; break;
		case 9: $monthName = "SEP"; return 30; break;
		case 10: $monthName = "OCT"; return 31; break;
		case 11: $monthName = "NOV"; return 30; break;
		case 12: $monthName = "DIC"; return 31; break;
	}
}

/**
 * 
 * @param array $keysComboFecha
 * @param array $arregloComboFecha
 */
function getDivDiasInfo($keysComboFecha, $arregloComboFecha){
	global $divDiasInfo;
	global $monthName;
	
	$arrayMonths = array();
	$nodoDiv = 0;
	$fechaActual = date("Y-m");
	$iYear = "";
	$iMonth = "";
	$iDaysPerMonth;
	
	//obtenemos el año-mes menor y el año-mes mayor
	if(count($keysComboFecha) == 0){
		//no tengo fechas cargadas en el sistema
	} else {
		//revisamos los meses a imprimir
		foreach ($keysComboFecha as $key){
			$iMonth = substr($key, 5, 2);
			$iYear = substr($key, 0, 4);
			
			$arrayMonths[$iYear."-".$iMonth] = $iYear."-".$iMonth;
		}
		
		$divDiasInfo = "<div id=\"dateOptions\" class=\"clearfix\">";
		foreach ($arrayMonths as $key){
			if(strcmp($fechaActual, substr($key, 0, 7)) <= 0){
				//debo generar este mes
				$iMonth = substr($key, 5, 2);
				$iYear = substr($key, 0, 4);
				$iDaysPerMonth = getDaysPerMonth($iMonth, $iYear);
				//echo $iYear." - ".$iMonth.": ".getDaysPerMonth($iMonth, $iYear)."<br>";
				$wValue = date("w", mktime(0,0,0,$iMonth,1,$iYear));
				$visualStyle;
				if($nodoDiv < 2){
					$visualStyle = "style=\"display: block\"";
				} else {
					$visualStyle = "style=\"display: none\"";
				}
				
				$divDiasInfo .= "<div class=\"yearBox\" id=\"$nodoDiv\" $visualStyle>
							<h4>
								<cufon style=\"width: 33px; height: 13px;\" alt=\"$iYear-$monthName\" class=\"cufon cufon-canvas\">
									<canvas style=\"width: 40px; height: 15px; top: -2px; left: -1px;\" height=\"15\" width=\"40\"></canvas>
									<cufontext>$monthName - $iYear</cufontext>
								</cufon>
							</h4>
							<ul>
								<li>
										Do
									</li>
									<li>
										Lu
									</li>
									<li>
										Ma
									</li>
									<li>
										Mi
									</li>
									<li>
										Ju
									</li>
									<li>
										Vi
									</li>
									<li>
										Sa
									</li>";
				
				//ajustamos el primer dia del mes
				for($i = 0; $i < $wValue; $i++){
					$divDiasInfo .=  "<li></li>";
				}
				
				//mostramos el mes correspondiente
				for($i = 1; $i <= $iDaysPerMonth; $i++){
					if($i < 10){
						$i = "0".$i;
					}
					$key1 = $iYear."-".$iMonth."-".$i;
					
					if(!isset($arregloComboFecha[$key1])){
						$divDiasInfo .=  "<li>
						<label class=\"disabled\">
						$i
						</label>
						</li>";
					}else{
						$divDiasInfo .=  "<li>".
						"<label class=\"\" id=\"$key1\">".
						"<input id=\"dateHID$key1\" value=\"$arregloComboFecha[$key1]\" type=\"hidden\" />".
						//como cambiamos de checkbox a a-href, usaremos el atributo class del elemento a para saber si tiene el foco del click o no
						//y el title para su valor.
						"<a name=\"date\" title=\"$key1\" href=\"#dateHID$key1\" onclick=\"javascript:doLabelClick(this, '".$key1."'); return false;\">$i</a>".
						"<span id=\"span$key1\" style=\"display: none;\">$i</span>".
						//"<input name=\"date\" value=\"$key1\" type=\"checkbox\" onclick=doLabelClick(this) />".
						"</label>
						</li>";
					}
					
				}
				
				$divDiasInfo .="				
							</ul>
						</div>";
				
				$nodoDiv ++;
			}
		}
		
		$divDiasInfo .= "</div>";
	}
}
?>
