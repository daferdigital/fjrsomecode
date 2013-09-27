<?php

include_once "DBUtil.php";
include_once "BitacoraDAO.php";
include_once "VentasDAO.php";

class GanadoresBasket{
	private static $BASKET_AGANAR_JC_A = 56; //resultado en 19
	private static $BASKET_AGANAR_JC_B = 58; //resultado en 20
	private static $BASKET_AGANAR_MJ_A = 57; //resultado en 17
	private static $BASKET_AGANAR_MJ_B = 59; //resultado en 18
	private static $BASKET_UNOMEDIOA_RLJC = 60; //resultado en 19
	private static $BASKET_UNOMEDIOB_RLJC = 61; //resultado en 20
	private static $BASKET_CEROMEDIOA_RLMJ = 62; //resultado en 17
	private static $BASKET_CEROMEDIOB_RLMJ = 63; //resultado en 18
	private static $BASKET_ALTA_JC_A = 64; //resultado en 19
	private static $BASKET_BAJA_JC_A = 65; //resultado en 20
	private static $BASKET_ALTA_MEDIOJUEGO_A = 66; //resultado en 17
	private static $BASKET_BAJA_MEDIOJUEGO_A = 67; //resultado en 18
	private static $BASKET_AGANAR_2DA_MITAD_A = 82; //resultado en 21
	private static $BASKET_AGANAR_2DA_MITAD_B = 83; //resultado en 22
	private static $BASKET_RUNLINE_ALTERNATIVO_A = 84; //resultado en 19
	private static $BASKET_RUNLINE_ALTERNATIVO_B = 85; //resultado en 20
	private static $BASKET_PRIMER_TIEMPO_A = 86; //resultado en 23
	private static $BASKET_PRIMER_TIEMPO_B = 87; //resultado en 24
	private static $BASKET_SEGUNDO_TIEMPO_A = 88; //resultado en 25
	private static $BASKET_SEGUNDO_TIEMPO_B = 89; //resultado en 26
	private static $BASKET_TERCER_TIEMPO_A = 90; //resultado en 27
	private static $BASKET_TERCER_TIEMPO_B = 91; //resultado en 28
	private static $BASKET_ALTA_SEXTO_A = 92; //resultado en 21
	private static $BASKET_BAJA_SEXTO_A = 93; //resultado en 22
	
	/**
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine JuegoCompleto en basket
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineBasketJuegoCompleto($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 19 OR lecr.idcategoria_resultado = 20)";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 19){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 20){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_UNOMEDIOA_RLJC){
				//comparando apuesta de ganador el equipo A
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoA"
						.$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
					
				if($compara == $resultadoEquipoB){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe incicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoB){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			} else {
				//comparando apuesta de ganador el equipo B
				$compara= ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoB"
						.$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
					
				if($compara == $resultadoEquipoA){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe incicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoA){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			}
		}
	
		return $codeReturn;
	}
	
	/**
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine MedioJuego en basket
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineBasketMedioJuego($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 17 OR lecr.idcategoria_resultado = 18)";
			
		$result = DBUtil::executeSelect($query);
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 17){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 18){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_CEROMEDIOA_RLMJ){
				//comparando apuesta de ganador el equipo A
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoA"
						.$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
					
				if($compara == $resultadoEquipoB){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe incicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoB){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			} else {
				//comparando apuesta de ganador el equipo B
				$compara= ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoB"
						.$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
					
				if($compara == $resultadoEquipoA){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe incicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoA){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			}
		}
	
		return $codeReturn;
	}
	
	/**
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine Alternativo en basket
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineAlternativoBasket($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 19 OR lecr.idcategoria_resultado = 20)";
			
		$result = DBUtil::executeSelect($query);
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 19){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 20){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_RUNLINE_ALTERNATIVO_A){
				//comparando apuesta de ganador el equipo A
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoA "
						.$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
					
				if($compara == $resultadoEquipoB){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe incicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoB){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			} else {
				//comparando apuesta de ganador el equipo B
				$compara= ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoB "
						.$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
					
				if($compara == $resultadoEquipoA){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe incicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoA){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			}
		}
	
		return $codeReturn;
	}
	
	/**
	 * Calculo de ganadores para altas y bajas juego completo
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	private static function checkAltasBajasJuegoCompleto($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
		
		//obtenemos el resultado final (completo) de este logro
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 19 OR lecr.idcategoria_resultado = 20)";
			
		$result = DBUtil::executeSelect($query);

		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 19){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 20){
					$resultadoEquipoB = $row["resultado"];
				}
			}
			
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado altas-bajas juego completo(equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") "
					."Mi multiplicando -> ".$rowVistaVentasDetalles['multiplicando']);
			
			//primero vemos si no es tabla
			if(($resultadoEquipoA + $resultadoEquipoB) == $rowVistaVentasDetalles["multiplicando"]){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, no gano ni perdio");
				$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
			} else {
				//vemos que tipo de apuesta tiene este ticket
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_ALTA_JC_A){
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si (".$resultadoEquipoA." + ".$resultadoEquipoB.") > ".$rowVistaVentasDetalles['multiplicando']
							." soy ganador ");
					if(($resultadoEquipoA + $resultadoEquipoB) > $rowVistaVentasDetalles["multiplicando"]){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				} else {
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si ".$rowVistaVentasDetalles['multiplicando']." > (".$resultadoEquipoA." + ".$resultadoEquipoB.") "
							."soy ganador ");
					if($rowVistaVentasDetalles["multiplicando"] > ($resultadoEquipoA + $resultadoEquipoB)){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				}
			}
			
			
		} else {
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."colocamos este resultado de altas-bajas juego completo como no mapeado "
					."porque no esta almacenado aun el resultado final de este juego.");
		}
		
		return $codeReturn;
	}
	
	/**
	 * Calculo de ganadores para altas y bajas medio juego
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	private static function checkAltasBajasMedioJuego($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado final (completo) de este logro
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 17 OR lecr.idcategoria_resultado = 18)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 17){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 18){
					$resultadoEquipoB = $row["resultado"];
				}
			}
				
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado altas-bajas medio juego (equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") "
					."Mi multiplicando -> ".$rowVistaVentasDetalles['multiplicando']);
				
			//primero vemos si no es tabla
			if(($resultadoEquipoA + $resultadoEquipoB) == $rowVistaVentasDetalles["multiplicando"]){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, no gano ni perdio");
				$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
			} else {
				//vemos que tipo de apuesta tiene este ticket
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_ALTA_MEDIOJUEGO_A){
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si (".$resultadoEquipoA." + ".$resultadoEquipoB.") > ".$rowVistaVentasDetalles['multiplicando']
							." soy ganador ");
					if(($resultadoEquipoA + $resultadoEquipoB) > $rowVistaVentasDetalles["multiplicando"]){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				} else {
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si ".$rowVistaVentasDetalles['multiplicando']." > (".$resultadoEquipoA." + ".$resultadoEquipoB.") "
							."soy ganador ");
					if($rowVistaVentasDetalles["multiplicando"] > ($resultadoEquipoA + $resultadoEquipoB)){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				}
			}
		} else {
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."colocamos este resultado de altas-bajas medio juego como no mapeado "
					."porque no esta almacenado aun el resultado final de este juego.");
		}
	
		return $codeReturn;
	}
	
	/**
	 * Recibimos el registro del tipo vistas_ventas y verificamos si el mismo representa
	 * una apuesta ganadora o no.
	 * 
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	public static function calcularGanador($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;

		private static $BASKET_UNOMEDIOA_RLJC = 60; //resultado en 19
		private static $BASKET_UNOMEDIOB_RLJC = 61; //resultado en 20
		private static $BASKET_CEROMEDIOA_RLMJ = 62; //resultado en 17
		private static $BASKET_CEROMEDIOB_RLMJ = 63; //resultado en 18
		private static $BASKET_ALTA_JC_A = 64; //resultado en 19
		private static $BASKET_BAJA_JC_A = 65; //resultado en 20
		private static $BASKET_ALTA_MEDIOJUEGO_A = 66; //resultado en 17
		private static $BASKET_BAJA_MEDIOJUEGO_A = 67; //resultado en 18
		private static $BASKET_AGANAR_2DA_MITAD_A = 82; //resultado en 21
		private static $BASKET_AGANAR_2DA_MITAD_B = 83; //resultado en 22
		private static $BASKET_RUNLINE_ALTERNATIVO_A = 84; //resultado en 19
		private static $BASKET_RUNLINE_ALTERNATIVO_B = 85; //resultado en 20
		private static $BASKET_PRIMER_TIEMPO_A = 86; //resultado en 23
		private static $BASKET_PRIMER_TIEMPO_B = 87; //resultado en 24
		private static $BASKET_SEGUNDO_TIEMPO_A = 88; //resultado en 25
		private static $BASKET_SEGUNDO_TIEMPO_B = 89; //resultado en 26
		private static $BASKET_TERCER_TIEMPO_A = 90; //resultado en 27
		private static $BASKET_TERCER_TIEMPO_B = 91; //resultado en 28
		private static $BASKET_ALTA_SEXTO_A = 92; //resultado en 21
		private static $BASKET_BAJA_SEXTO_A = 93; //resultado en 22
		
		
		if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_AGANAR_JC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket:: $BASKET_AGANAR_JC_B){
			// es A GANAR JUEGO COMPLETO de basket
			$codeReturn = GanadoresBasket::checkAGanarBasketJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_AGANAR_MJ_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket:: $BASKET_AGANAR_MJ_B){
			// es A GANAR MEDIO JUEGO de basket
			$codeReturn = GanadoresBasket::checkAGanarBasketMedioJuego($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_UNOMEDIOA_RLJC
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket:: $BASKET_UNOMEDIOB_RLJC){
			// es RUNLINE JUEGO COMPLETO de basket
			$codeReturn = GanadoresBasket::checkRunLineBasketJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_CEROMEDIOA_RLMJ
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket:: $BASKET_CEROMEDIOB_RLMJ){
			// es RUNLINE MEDIO JUEGO de basket
			$codeReturn = GanadoresBasket::checkRunLineBasketMedioJuego($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_RUNLINE_ALTERNATIVO_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket:: $BASKET_RUNLINE_ALTERNATIVO_B){
			// es RUNLINE MEDIO JUEGO de basket
			$codeReturn = GanadoresBasket::checkRunLineAlternativoBasket($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_ALTA_JC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket:: $BASKET_BAJA_JC_A){
			// es ALTAS BAJAS JUEGO COMPLETO de basket
			$codeReturn = GanadoresBasket::checkAltasBajasJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket::$BASKET_ALTA_MEDIOJUEGO_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBasket:: $BASKET_BAJA_MEDIOJUEGO_A){
			// es ALTAS BAJAS JUEGO COMPLETO de basket
			$codeReturn = GanadoresBasket::checkAltasBajasMedioJuego($rowVistaVentasDetalles);
		} else {
			//categoria de apuesta aun no mapeada, retornamos true por defecto.
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."idcategoria_apuesta[".$rowVistaVentasDetalles["idcategoria_apuesta"]."] "
					."aun no ha sido mapeada en VentasDAO.");
		}
		
		return $codeReturn;
	}
}