<?php
include_once ("DBUtil.php");
include_once ("BitacoraDAO.php");

class VentasDAO {
	public static $RESULTADO_NO_MAPEADO_AUN = 0;
	public static $RESULTADO_EMPATADO_DEBE_SUSPENDER = 1;
	public static $RESULTADO_GANADOR = 2;
	public static $RESULTADO_PERDEDOR = 3;
	
	private static $BASKET_UNOMEDIOA_RLJC = 60;
	private static $BASKET_UNOMEDIOB_RLJC = 61;
	private static $BASKET_CEROMEDIOA_RLMJ = 62;
	private static $BASKET_CEROMEDIOB_RLMJ = 63;
	private static $BASKET_SEGUNDA_MITAD_A_RL2M = 84;
	private static $BASKET_SEGUNDA_MITAD_B_RL2M = 85;
	
	/**
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine JuegoCompleto en basket
	 * resulto ganadora o perdedora.
	 * 
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineBasketJuegoCompleto($idventa){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
		
		$result = DBUtil::executeSelect("SELECT * FROM vista_ventas_detalles WHERE idventa=".$idventa);
		$rowVistaVentasDetalles = $result[0];
		
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
		
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
		
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == VentasDAO::$BASKET_UNOMEDIOA_RLJC){
				//comparando apuesta de ganador el equipo A
				$compara= (int) ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] Apuesta equipoA"
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
				$compara= (int) ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] Apuesta equipoB"
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
	private static function checkRunLineBasketMedioJuego($idventa){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
		
		$result = DBUtil::executeSelect("SELECT * FROM vista_ventas_detalles WHERE idventa=".$idventa);
		$rowVistaVentasDetalles = $result[0];
		
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
		
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
		
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == VentasDAO::$BASKET_CEROMEDIOA_RLMJ){
				//comparando apuesta de ganador el equipo A
				$compara= (int) ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] Apuesta equipoA"
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
				$compara= (int) ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] Apuesta equipoB"
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
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine SegundaMitad en basket
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineBasketSegundaMitad($idventa){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
		
		$result = DBUtil::executeSelect("SELECT * FROM vista_ventas_detalles WHERE idventa=".$idventa);
		$rowVistaVentasDetalles = $result[0];
		
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 21 OR lecr.idcategoria_resultado = 22)";
			
		$result = DBUtil::executeSelect($query);
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 21){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 22){
					$resultadoEquipoB = $row["resultado"];
				}
			}
		
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] "
					." Para la categoria_apuesta de juego [".$rowVistaVentasDetalles["idcategoria_apuesta"]."]"
					." de nombre[".$rowVistaVentasDetalles["nombre_apuesta"]."]"
					." los resultados de equipoA/equipoB fueron: (".$resultadoEquipoA."/".$resultadoEquipoB.")");
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] "
					." Valores a relacionar: resultadoEquipoA[".$resultadoEquipoA."], "
					."resultadoEquipoB[".$resultadoEquipoB."], "
					."multiplicando[".$rowVistaVentasDetalles['multiplicando']."]");
		
			//tengo el resultado del equipo, veo en base a la categoria de la apuesta si se gano o no
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == VentasDAO::$BASKET_CEROMEDIOA_RLMJ){
				//comparando apuesta de ganador el equipo A
				$compara= (int) ($resultadoEquipoA + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] Apuesta equipoA"
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
				$compara= (int) ($resultadoEquipoB + $rowVistaVentasDetalles['multiplicando']);
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."] Apuesta equipoB"
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
	 * Recibimos el id de la venta y verificamos si el tipo de apuesta realizad
	 * de verdad es ganadora o no.
	 * 
	 * @param string $idventa
	 * 
	 * @return $codeReturn; 1 para suspender, 2 como ganador y 3 como perdedor, 0 como categoria no mapeada aun
	 */
	public static function verificarSiEsGanador($idventa){
		//vemos la categoria de la apuesta para hacer el calculo respectivo
		$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
		
		BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."]"
				." Retorno desde VentasDAO el valor [".$codeReturn."] <br />");
	
		return $codeReturn;
	}
}