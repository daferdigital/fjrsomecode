<?php

include_once "DBUtil.php";
include_once "BitacoraDAO.php";
include_once "VentasDAO.php";

class GanadoresFutbolAmericano {
	public static $FUTBOL_AMERICANO_RLJC_A = 95; // RunLine JC A //resultado en 33
	public static $FUTBOL_AMERICANO_RLJC_B = 96; // RunLine JC B //resultado en 34
	public static $FUTBOL_AMERICANO_AGANAR_MJ_A = 101; // AGANAR MJ A //resultado en 29
	public static $FUTBOL_AMERICANO_AGANAR_MJ_B = 99; // AGANAR MJ B //resultado en 30
	public static $FUTBOL_AMERICANO_AGANAR_JC_A = 100; // AGANAR JC A //resultado en 33
	public static $FUTBOL_AMERICANO_AGANAR_JC_B = 111; // AGANAR JC B //resultado en 34
	public static $FUTBOL_AMERICANO_ALTA_JC_A = 102; // ALTA JC A //resultado en 33
	public static $FUTBOL_AMERICANO_BAJA_JC_A = 103; // BAJA JC A //resultado en 34
	public static $FUTBOL_AMERICANO_ALTA_MJ_A = 104; // ALTA MJ A //resultado en 29
	public static $FUTBOL_AMERICANO_BAJA_MJ_A = 105; // BAJA MJ A //resultado en 30
	public static $FUTBOL_AMERICANO_EMPATE_JC_A = 106; // EMPATE JC A //resultado en 33 y 34
	public static $FUTBOL_AMERICANO_EMPATE_MJ_A = 107; // EMPATE MJ A //resultado en 29 y 30
	
	/**
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine JuegoCompleto en futbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineJuegoCompleto($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 33 OR lecr.idcategoria_resultado = 34)";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 33){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 34){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."],"
					." resultadoEquipoB[".$resultadoEquipoB."],"
					." multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_RLJC_A){
				//comparando apuesta de ganador el equipo A
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Apuesta equipoA ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoB
						." entonces es ganador");
				if($compara == $resultadoEquipoB){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe indicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoB){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			} else {
				//comparando apuesta de ganador el equipo B
				$compara= ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Apuesta equipoB ".$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoA
						." entonces es ganador");
	
				if($compara == $resultadoEquipoA){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe incicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoA){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			}
		} else {
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."El query de busqueda de resultados no trajo valores, esto no debe pasar en este punto.");
			$codeReturn = VentasDAO::$RESULTADO_SOLO_VENDIDO;
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
		."AND (lecr.idcategoria_resultado = 33 OR lecr.idcategoria_resultado = 34)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 33){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 34){
					$resultadoEquipoB = $row["resultado"];
				}
			}
				
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado altas-bajas juego completo(equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") "
					."Mi multiplicando -> ".$rowVistaVentasDetalles['multiplicando']);
				
			//primero vemos si no es tabla
			if(($resultadoEquipoA + $resultadoEquipoB) == $rowVistaVentasDetalles["multiplicando"]){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, no gano ni perdio");
				$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
			} else {
				//vemos que tipo de apuesta tiene este ticket
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_ALTA_JC_A){
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si (".$resultadoEquipoA." + ".$resultadoEquipoB.") > ".$rowVistaVentasDetalles['multiplicando']
							." soy ganador ");
					if(($resultadoEquipoA + $resultadoEquipoB) > $rowVistaVentasDetalles["multiplicando"]){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				} else {
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
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
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
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
		."AND (lecr.idcategoria_resultado = 29 OR lecr.idcategoria_resultado = 30)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 29){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 30){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado altas-bajas medio juego (equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") "
					."Mi multiplicando -> ".$rowVistaVentasDetalles['multiplicando']);
	
			//primero vemos si no es tabla
			if(($resultadoEquipoA + $resultadoEquipoB) == $rowVistaVentasDetalles["multiplicando"]){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, no gano ni perdio");
				$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
			} else {
				//vemos que tipo de apuesta tiene este ticket
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_ALTA_MJ_A){
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si (".$resultadoEquipoA." + ".$resultadoEquipoB.") > ".$rowVistaVentasDetalles['multiplicando']
							." soy ganador ");
					if(($resultadoEquipoA + $resultadoEquipoB) > $rowVistaVentasDetalles["multiplicando"]){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				} else {
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
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
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."colocamos este resultado de altas-bajas medio juego como no mapeado "
					."porque no esta almacenado aun el resultado final de este juego.");
		}
	
		return $codeReturn;
	}
	
	
	/**
	 * Calculo de ganadores para la modalidad A Ganar Juego Completo
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	private static function checkAGanarJuegoCompleto($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado final (completo) de este logro
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 33 OR lecr.idcategoria_resultado = 34)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 33){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 34){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado AGanarJuegoCompleto (equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") ");
	
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_AGANAR_JC_A){
				//aposto a ganador para el equipoA, vemos si efectivamente gano
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si (".$resultadoEquipoA." > ".$resultadoEquipoB.") soy ganador");
				if($resultadoEquipoA > $resultadoEquipoB){
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				} else {
					$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
				}
			} else {
				//aposto a ganador para el equipoB, vemos si efectivamente gano
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si (".$resultadoEquipoB." > ".$resultadoEquipoA.") soy ganador");
				if($resultadoEquipoB > $resultadoEquipoA){
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				} else {
					$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
				}
			}
		} else {
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."colocamos este resultado de altas-bajas medio juego como no mapeado "
					."porque no esta almacenado aun el resultado final de este juego.");
		}
		
		return $codeReturn;
	}
	
	
	/**
	 * Calculo de ganadores para la modalidad A Ganar Medio Juego
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	private static function checkAGanarMedioJuego($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado final (completo) de este logro
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 29 OR lecr.idcategoria_resultado = 30)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 29){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 30){
					$resultadoEquipoB = $row["resultado"];
				}
			}
			
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado AGanarMedioJuego (equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") "
					."Mi multiplicando -> ".$rowVistaVentasDetalles['multiplicando']);
			
			//primero vemos si no es tabla
			if($resultadoEquipoA == $resultadoEquipoB){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, no gano ni perdio");
				$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
			} else {
				//vemos que tipo de apuesta tiene este ticket
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_AGANAR_MJ_A){
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si (".$resultadoEquipoA." > ".$resultadoEquipoB.") soy ganador");
					if($resultadoEquipoA > $resultadoEquipoB){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				} else {
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si ".$resultadoEquipoB." > ".$resultadoEquipoA." soy ganador");
					if($resultadoEquipoB > $resultadoEquipoA){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				}
			}
		} else {
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."colocamos este resultado de altas-bajas medio juego como no mapeado "
					."porque no esta almacenado aun el resultado final de este juego.");
		}
		
		return $codeReturn;
	}
	
	/**
	 * Calculo de ganadores para la Empate Medio Juego
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	private static function checkEmpateMedioJuego($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado final (completo) de este logro
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 29 OR lecr.idcategoria_resultado = 30)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 29){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 30){
					$resultadoEquipoB = $row["resultado"];
				}
			}
				
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado EmpateMedioJuego (equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") ");
				
			//primero vemos si no es tabla
			if($resultadoEquipoA == $resultadoEquipoB){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, entonces gano");
				$codeReturn = VentasDAO::$RESULTADO_GANADOR;
			}
		} else {
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."colocamos este resultado de empate medio juego como no mapeado "
					."porque no esta almacenado aun el resultado final de este juego.");
		}
	
		return $codeReturn;
	}
	
	/**
	 * Calculo de ganadores para la Empate Juego Completo
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	private static function checkEmpateJuegoCompleto($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado final (completo) de este logro
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 33 OR lecr.idcategoria_resultado = 34)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 33){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 34){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado EmpateJuegoCompleto (equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") ");
	
			//primero vemos si no es tabla
			if($resultadoEquipoA == $resultadoEquipoB){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, entonces gano");
				$codeReturn = VentasDAO::$RESULTADO_GANADOR;
			}
		} else {
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."colocamos este resultado de empate juego completo como no mapeado "
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
		
		if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_RLJC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_RLJC_B){
			// es RUNLINE JUEGO COMPLETO de futbol
			$codeReturn = GanadoresFutbolAmericano::checkRunLineJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_AGANAR_MJ_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_AGANAR_MJ_B){
			// es RUNLINE JUEGO COMPLETO de futbol
			$codeReturn = GanadoresFutbolAmericano::checkAGanarMedioJuego($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_AGANAR_JC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_AGANAR_JC_B){
			// es RUNLINE JUEGO COMPLETO de futbol
			$codeReturn = GanadoresFutbolAmericano::checkAGanarJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_ALTA_JC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_BAJA_JC_A){
			// es ALTAS y BAJAS JUEGO COMPLETO FUTBOL
			$codeReturn = GanadoresFutbolAmericano::checkAltasBajasJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_ALTA_MJ_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_BAJA_MJ_A){
			// es ALTAS y BAJAS MEDIO JUEGO FUTBOL
			$codeReturn = GanadoresFutbolAmericano::checkAltasBajasMedioJuego($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_EMPATE_MJ_A){
			// es EMPATE MEDIO JUEGO FUTBOL
			$codeReturn = GanadoresFutbolAmericano::checkEmpateMedioJuego($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbolAmericano::$FUTBOL_AMERICANO_EMPATE_JC_A){
			// es EMPATE JUEGO COMPLETO FUTBOL
			$codeReturn = GanadoresFutbolAmericano::checkEmpateJuegoCompleto($rowVistaVentasDetalles);
		} else {
			//categoria de apuesta aun no mapeada, retornamos true por defecto.
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."idcategoria_apuesta[".$rowVistaVentasDetalles["idcategoria_apuesta"]."] "
					."aun no ha sido mapeada en VentasDAO.");
		}
	
		return $codeReturn;
	}
}
?>