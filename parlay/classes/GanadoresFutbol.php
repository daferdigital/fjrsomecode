<?php

include_once "DBUtil.php";
include_once "BitacoraDAO.php";
include_once "VentasDAO.php";

class GanadoresFutbol {
	public static $FUTBOL_RLJC_A = 16;
	public static $FUTBOL_RLJC_B = 17;
	public static $FUTBOL_ALTAS_JC_A = 41;
	public static $FUTBOL_BAJAS_JC_A = 42;
	public static $FUTBOL_ALTAS_MJ_A = 43;
	public static $FUTBOL_BAJAS_MJ_A = 44;
	
	/**
	 * Metodo para verificar si determinada venta de una apuesta del tipo RunLine JuegoCompleto en futbol
	 * resulto ganadora o perdedora.
	 *
	 * @param $idventa, codigo del ticket (id de la venta en base de datos)
	 */
	private static function checkRunLineFutbolJuegoCompleto($rowVistaVentasDetalles){
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
	
		//obtenemos el resultado del equipo a y equipo b para verificar que la metrica apostada implica que el apostador gano o no
		$query = "SELECT le.idlogro_equipo, lecr.idcategoria_resultado, lecr.resultado "
		."FROM logros_equipos le, logros_equipos_categorias_resultados lecr "
		."WHERE le.idlogro = ".$rowVistaVentasDetalles["idlogro"]
		." AND le.idlogro_equipo = lecr.idlogro_equipo "
		."AND (lecr.idcategoria_resultado = 15 OR lecr.idcategoria_resultado = 16)";
			
		$result = DBUtil::executeSelect($query);
	
		//en base al logro, obtenemos los codigos del logro de equipo,
		//para sacar resultado final A y B
		if(count($result) > 0){
			//sacamos el resultado en base a la categoria de la apuesta
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 15){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 16){
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
			if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_RLJC_A){
				//comparando apuesta de ganador el equipo A
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
			} else {
				//comparando apuesta de ganador el equipo B
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
		."AND (lecr.idcategoria_resultado = 15 OR lecr.idcategoria_resultado = 16)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 15){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 16){
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
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_ALTAS_JC_A){
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
		."AND (lecr.idcategoria_resultado = 11 OR lecr.idcategoria_resultado = 12)";
			
		$result = DBUtil::executeSelect($query);
	
		if(count($result) > 0){
			//obtenemos el resultado final de cada equipo
			$resultadoEquipoA = 0;
			$resultadoEquipoB = 0;
			foreach ($result as $row){
				if($row["idcategoria_resultado"] == 11){
					$resultadoEquipoA = $row["resultado"];
				}
				if($row["idcategoria_resultado"] == 12){
					$resultadoEquipoB = $row["resultado"];
				}
			}
	
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."-".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Resultado altas-bajas medio juego (equipoA/equipoB) (".$resultadoEquipoA."/".$resultadoEquipoB.") "
					."Mi multiplicando -> ".$rowVistaVentasDetalles['multiplicando']);
	
			//primero vemos si no es tabla
			if(($resultadoEquipoA + $resultadoEquipoB) == $rowVistaVentasDetalles["multiplicando"]){
				BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa_detalle"]."] "
						."Resultados iguales, no gano ni perdio");
				$codeReturn = VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER;
			} else {
				//vemos que tipo de apuesta tiene este ticket
				if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_ALTAS_MJ_A){
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
	
		if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_RLJC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_RLJC_B){
			// es RUNLINE JUEGO COMPLETO de futbol
			$codeReturn = GanadoresFutbol::checkRunLineFutbolJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_ALTAS_JC_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_BAJAS_JC_A){
			// es ALTAS y BAJAS JUEGO COMPLETO FUTBOL
			$codeReturn = GanadoresFutbol::checkAltasBajasJuegoCompleto($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_ALTAS_MJ_A
				|| $rowVistaVentasDetalles["idcategoria_apuesta"] == GanadoresFutbol::$FUTBOL_BAJAS_MJ_A){
			// es ALTAS y BAJAS MEDIO JUEGO FUTBOL
			$codeReturn = GanadoresFutbol::checkAltasBajasMedioJuego($rowVistaVentasDetalles);
		} else {
			//categoria de apuesta aun no mapeada, retornamos true por defecto.
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."-".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."idcategoria_apuesta[".$rowVistaVentasDetalles["idcategoria_apuesta"]."] "
					."aun no ha sido mapeada en VentasDAO.");
		}
	
		return $codeReturn;
	}
}
?>