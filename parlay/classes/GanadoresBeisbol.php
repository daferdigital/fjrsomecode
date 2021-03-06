<?php

include_once "DBUtil.php";
include_once "BitacoraDAO.php";
include_once "VentasDAO.php";

class GanadoresBeisbol{
	public static $BEISBOL_AGANAR_JC_A = 23;
	public static $BEISBOL_AGANAR_JC_B = 25;
	public static $BEISBOL_AGANAR_MJ_A = 24;
	public static $BEISBOL_AGANAR_MJ_B = 26;
	public static $BEISBOL_RLJC_A = 27;
	public static $BEISBOL_RLJC_B = 28;
	public static $BEISBOL_RLMJ_A = 29;
	public static $BEISBOL_RLMJ_B = 30;
	public static $BEISBOL_ALTAS_JC_A = 31;
	public static $BEISBOL_BAJAS_JC_A = 32;
	public static $BEISBOL_ALTAS_MJ_A = 33;
	public static $BEISBOL_BAJAS_MJ_A = 34;
	public static $BEISBOL_ANOTA_1RO_A = 37;
	public static $BEISBOL_ANOTA_1RO_B = 38;
	public static $BEISBOL_SI_PRIMER_INNING_A = 39;
	public static $BEISBOL_NO_PRIMER_INNING_A = 40;
	public static $BEISBOL_SUPERRUNLINE_A = 47;
	public static $BEISBOL_SUPERRUNLINE_B = 48;
	public static $BEISBOL_ALTAS_CHE_A = 71;
	public static $BEISBOL_BAJAS_CHE_A = 72;
	public static $BEISBOL_RLA_JC_A = 73;
	public static $BEISBOL_RLA_JC_B = 74;
	public static $BEISBOL_ALTAS_AL_6TO_A = 77;
	public static $BEISBOL_BAJAS_AL_6TO_A = 78;
	public static $BEISBOL_AGANAR_2DA_MITAD_A = 80;
	public static $BEISBOL_AGANAR_2DA_MITAD_B = 81;
	
	/**
	 * Metodo para verificar si determinada venta de una apuesta del tipo AGanar 2da Mitad en beisbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkAGanarBeisbol2DAMitad($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 9 OR lecr.idcategoria_resultado = 10)";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 9){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 10){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			/*
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
			*/
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_2DA_MITAD_A){
				//comparando apuesta de ganador el equipo A
				/*
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Apuesta equipoA ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoB
						." entonces es ganador");
				*/
				$compara= $resultadoEquipoA;
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." > ".$resultadoEquipoB." entonces es ganador");
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
				/*
				$compara= ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Apuesta equipoB ".$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoA
						." entonces es ganador");
				*/
				$compara= $resultadoEquipoB;
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoB." > ".$resultadoEquipoA." entonces es ganador");
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
	 * Metodo para verificar si determinada venta de una apuesta del tipo AGanar JuegoCompleto en beisbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkAGanarBeisbolJuegoCompleto($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 4 OR lecr.idcategoria_resultado = 5)";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 4){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 5){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_JC_A){
				//comparando apuesta de ganador el equipo A
				/*
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoA "
						.$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoB
						." entonces es ganador");
				*/
				$compara= $resultadoEquipoA;
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." > ".$resultadoEquipoB." entonces es ganador");
				
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
				/*
				$compara= ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoB "
						.$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoA
						." entonces es ganador");
				*/
				$compara= $resultadoEquipoB;
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoB." > ".$resultadoEquipoA." entonces es ganador");
				
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
	 * Metodo para verificar si determinada venta de una apuesta del tipo AGanar Medio Juego en beisbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkAGanarBeisbolMedioJuego($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 1 OR lecr.idcategoria_resultado = 2)";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 1){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 2){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_MJ_A){
				//comparando apuesta de ganador el equipo A
				/*
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoA "
						.$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoB
						." entonces es ganador");
				if($compara == $resultadoEquipoB){
					//quedo tabla con respecto al resultado final y su multiplicando
					//creo que debe incicarse simplemente como suspendido este detalle de venta
					$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
				}else if($compara > $resultadoEquipoB){
					//aposto al equipo A y su multiplicando lo da como ganador
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
				*/
				$compara= $resultadoEquipoA;
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." > ".$resultadoEquipoB." entonces es ganador");
				
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
				/*
				$compara= ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] Apuesta equipoB "
						.$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
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
				*/
				$compara= $resultadoEquipoB;
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoB." > ".$resultadoEquipoA." entonces es ganador");
				
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
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine JuegoCompleto en beisbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineBeisbolJuegoCompleto($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 4 OR lecr.idcategoria_resultado = 5)";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 4){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 5){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLJC_A){
				//comparando apuesta de ganador el equipo A
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Apuesta equipoA ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoB
						." entonces es ganador");
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
	 * Metodo para verificar si determinada venta de una apuesta del tipo SuperRunLine en beisbol (JuegoCompleto)
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkSuperRunLineBeisbol($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 4 OR lecr.idcategoria_resultado = 5)";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 4){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 5){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_SUPERRUNLINE_A){
				//comparando apuesta de ganador el equipo A
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Apuesta equipoA ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoB
						." entonces es ganador");
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
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine MedioJuego en beisbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineBeisbolMedioJuego($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 1 OR lecr.idcategoria_resultado = 2)";
			
		$result = DBUtil::executeSelect($query);
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 1){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 2){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLMJ_A){
				//comparando apuesta de ganador el equipo A
				$compara= ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Si ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." > ".$resultadoEquipoB
						." entonces es ganador");
					
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
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine Alternativo en beisbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineAlternativoBeisbol($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 4 OR lecr.idcategoria_resultado = 5)";
			
		$result = DBUtil::executeSelect($query);
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 4){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 5){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
	
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLA_JC_A){
				//comparando apuesta de ganador el equipo A
				$compara = ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Apuesta equipoA ".$resultadoEquipoA." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
					
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
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Apuesta equipoB ".$resultadoEquipoB." + ".$rowVistaVentasDetalles['multiplicando']." = ".$compara);
					
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
		."AND (lecr.idcategoria_resultado = 4 OR lecr.idcategoria_resultado = 5)";
			
		$result = DBUtil::executeSelect($query);

		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 4){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 5){
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
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ALTAS_JC_A){
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
		."AND (lecr.idcategoria_resultado = 1 OR lecr.idcategoria_resultado = 2)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 1){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 2){
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
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ALTAS_MJ_A){
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
	 * Calculo de ganadores para altas y bajas al 6to
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	private static function checkAltasBajasAl6to($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado final (completo) de este logro
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 9 OR lecr.idcategoria_resultado = 10)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 9){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 10){
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
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ALTAS_AL_6TO_A){
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
	 * Calculo de ganadores para altas y bajas CHE (carreras hits errores)
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	private static function checkAltasBajasCHE($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado final (completo) de este logro
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 4 OR lecr.idcategoria_resultado = 5 "
		."        OR lecr.idcategoria_resultado = 11 OR lecr.idcategoria_resultado = 12 "
		."        OR lecr.idcategoria_resultado = 13 OR lecr.idcategoria_resultado = 14 )";;
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$hitsEquipoA = 0;
			$erroresEquipoA = 0;
			$resultadoEquipoB = 0;
			$hitsEquipoB = 0;
			$erroresEquipoB = 0;
			
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 4){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 5){
					$resultadoEquipoB = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 11){
					$hitsEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 12){
					$hitsEquipoB = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 13){
					$erroresEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 14){
					$erroresEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado altas-bajas CHE medio juego (equipoA,hitsA,erroresA/equipoB,hitsB,erroresB) "
					. "(".$resultadoEquipoA.",".$hitsEquipoA.",".$erroresEquipoA."/".$resultadoEquipoB.",".$hitsEquipoB.",".$erroresEquipoB.") "
					."Mi multiplicando -> ".$rowVistaVentasDetalles['multiplicando']);
	
			//primero vemos si no es tabla
			if(($resultadoEquipoA + $resultadoEquipoB + $hitsEquipoA + $hitsEquipoB + $erroresEquipoA + $erroresEquipoB) == $rowVistaVentasDetalles["multiplicando"]){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, no gano ni perdio");
				$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
			} else {
				//vemos que tipo de apuesta tiene este ticket
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ALTAS_CHE_A){
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si (".$resultadoEquipoA." + ".$resultadoEquipoB." + ".$hitsEquipoA." + ".$hitsEquipoB." + ".$erroresEquipoA." + ".$erroresEquipoB
							.") > ".$rowVistaVentasDetalles['multiplicando']
							." soy ganador ");
					if(($resultadoEquipoA + $resultadoEquipoB + $hitsEquipoA + $hitsEquipoB + $erroresEquipoA + $erroresEquipoB) > $rowVistaVentasDetalles["multiplicando"]){
						//gano
						$codeReturn = VentasDAO::$RESULTADO_GANADOR;
					}
				} else {
					BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
							."Si ".$rowVistaVentasDetalles['multiplicando']." > "
							."(".$resultadoEquipoA." + ".$resultadoEquipoB." + ".$hitsEquipoA." + ".$hitsEquipoB." + ".$erroresEquipoA." + ".$erroresEquipoB.")"
							." soy ganador ");
					if($rowVistaVentasDetalles["multiplicando"] > ($resultadoEquipoA + $resultadoEquipoB + $hitsEquipoA + $hitsEquipoB + $erroresEquipoA + $erroresEquipoB)){
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
	 * Metodo para verificar si determinada venta de una apuesta del tipo AGanar 2da Mitad en beisbol
	* resulto ganadora o perdedora.
	*
	* @param $idventa, codigo del ticket (id de la venta en base de datos)
	*/
	private static function checkAnotaPrimero($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND lecr.idcategoria_resultado = 8";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultado = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 8){
					$resultado = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." el resultado del que anoto primero fue: (".$resultado.") y se aposto a: ".$rowVistaVentasDetalles["idlogro_equipo"]);
			/*
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
						." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
						."resultadoEquipoB[".$resultadoEquipoB."], "
						."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
			*/
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idlogro_equipo"] == $resultado){
				//aposto efectivamente al equipo que anotaba primero, lo verificamos
				$codeReturn = VentasDAO::$RESULTADO_GANADOR;
			}
		} else {
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."El query de busqueda de resultados no trajo valores, esto no debe pasar en este punto.");
			$codeReturn = VentasDAO::$RESULTADO_SOLO_VENDIDO;
		}
	
		return $codeReturn;
	}
	
	/**
	 * Metodo para verificar si determinada venta de una apuesta del tipo AGanar 2da Mitad en beisbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkAnotaPrimerInning($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND lecr.idcategoria_resultado = 7";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultado = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 7){
					$resultado = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." el resultado fue: (".$resultado.")");
			/*
			 BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."][".$rowVistaVentasDetalles["idventa_detalle"]."] "
			 		." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
			 		."resultadoEquipoB[".$resultadoEquipoB."], "
			 		."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
			*/
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_SI_PRIMER_INNING_A){
				//se aposto a que si habian carreras en el primer inning, vemos si fue verdad
				if("1" == $resultado){
					$codeReturn = VentasDAO::$RESULTADO_GANADOR;
				}
			} else {
				//se aposto a que si habian carreras en el primer inning, vemos si fue verdad
				if("0" == $resultado){
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
	 * Recibimos el registro del tipo vistas_ventas y verificamos si el mismo representa
	 * una apuesta ganadora o no.
	 * 
	 * @param unknown_type $rowVistaVentasDetalles
	 */
	public static function calcularGanador($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
		
		if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLJC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLJC_B){
			// es RUNLINE JUEGO COMPLETO de beisbol
			$codeReturn = GanadoresBeisbol::checkRunLineBeisbolJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_SUPERRUNLINE_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_SUPERRUNLINE_B){
			// es SUPER RUNLINE juego de beisbol
			$codeReturn = GanadoresBeisbol::checkSuperRunLineBeisbol($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLMJ_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLMJ_B){
			// es RUNLINE MEDIO juego de beisbol
			$codeReturn = GanadoresBeisbol::checkRunLineBeisbolMedioJuego($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLA_JC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_RLA_JC_B){
			// es RUNLINE ALTERNATIVO juego completo de beisbol
			$codeReturn = GanadoresBeisbol::checkRunLineAlternativoBeisbol($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ALTAS_JC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_BAJAS_JC_A){
			// es ALTAS y BAJAS JUEGO COMPLETO
			$codeReturn = GanadoresBeisbol::checkAltasBajasJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ALTAS_MJ_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_BAJAS_MJ_A){
			// es ALTAS y BAJAS MEDIO JUEGO
			$codeReturn = GanadoresBeisbol::checkAltasBajasMedioJuego($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ALTAS_AL_6TO_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_BAJAS_AL_6TO_A){
			// es ALTAS y BAJAS AL 6TO
			$codeReturn = GanadoresBeisbol::checkAltasBajasAl6to($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ALTAS_CHE_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_BAJAS_CHE_A){
			// es ALTAS y BAJAS CHE
			$codeReturn = GanadoresBeisbol::checkAltasBajasCHE($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_MJ_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_MJ_B){
			// es A GANAR MEDIO JUEGO
			$codeReturn = GanadoresBeisbol::checkAGanarBeisbolMedioJuego($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_JC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_JC_B){
			// es A GANAR JUEGO COMPLETO
			$codeReturn = GanadoresBeisbol::checkAGanarBeisbolJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_2DA_MITAD_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_AGANAR_2DA_MITAD_B){
			// es A GANAR 2DA MITAD
			$codeReturn = GanadoresBeisbol::checkAGanarBeisbol2DAMitad($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ANOTA_1RO_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_ANOTA_1RO_B){
			// es apuesta de Anota 1ro
			$codeReturn = GanadoresBeisbol::checkAnotaPrimero($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_SI_PRIMER_INNING_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresBeisbol::$BEISBOL_NO_PRIMER_INNING_A){
			// es apuesta de Anota 1ro
			$codeReturn = GanadoresBeisbol::checkAnotaPrimerInning($rowVistaVentasDetalles);
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