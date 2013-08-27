<?php
include_once ("DBUtil.php");
include_once ("BitacoraDAO.php");
include_once ("GanadoresBasket.php");
include_once ("GanadoresFutbol.php");
include_once ("GanadoresBeisbol.php");

class VentasDTO{
	private $idVenta;
	private $idVentaDetalle;
	private $montoApuesta;
	private $totalGanar;
	private $estadoFinal;
	private $pago;

	/**
	 * 
	 * @param unknown_type $idVenta
	 * @param unknown_type $idVentaDetalle
	 * @param unknown_type $montoApuesta
	 * @param unknown_type $totalGanar
	 * @param unknown_type $pago
	 * @param unknown_type $estadoFinal
	 */
	public function VentasDTO($idVenta, $idVentaDetalle, $montoApuesta,
			$totalGanar, $pago, $estadoFinal){
		$this->estadoFinal = $estadoFinal;
		$this->idVenta = $idVenta;
		$this->idVentaDetalle = $idVentaDetalle;
		$this->montoApuesta = $montoApuesta;
		$this->totalGanar = $totalGanar;
		$this->pago = $pago;
	}
	
	public function getIdVenta(){
		return $this->idVenta;
	}
	
	public function getIdVentaDetalle(){
		return $this->idVentaDetalle;
	}
	
	public function setEstadoFinal($estadoFinal){
		$this->estadoFinal = $estadoFinal;
	}
	
	public function getEstadoFinal(){
		return $this->estadoFinal;
	}
	
	public function getMontoApuesta(){
		return $this->montoApuesta;
	}
	
	public function getTotalGanar(){
		return $this->totalGanar;
	}
	
	public function getPago(){
		return $this->pago;
	}
	
	public function __toString(){
		"VentasDTO: estadoFinal='".$this->estadoFinal."', "
		."idVenta'".$this->idVenta."', "
		."idVentaDetalle'".$this->idVentaDetalle."', "
		."montoApuesta'".$this->montoApuesta."', "
		."totalGanar'".$this->totalGanar."', ";
	}
}

class VentasDAO {
	private static $RESULTADO_SUSPENDIDO = 4;
	private static $RESULTADO_SOLO_VENDIDO = 5;
	
	public static $RESULTADO_NO_MAPEADO_AUN = 0;
	public static $RESULTADO_EMPATADO_DEBE_SUSPENDER = 1;
	public static $RESULTADO_GANADOR = 2;
	public static $RESULTADO_PERDEDOR = 3;
	
	public static $CATEGORIA_FUTBOL = "1";
	public static $CATEGORIA_BEISBOL = "2";
	public static $CATEGORIA_BASKET = "3";
	
	/**
	 * Recibimos el id de la venta y verificamos si el tipo de apuesta realizada
	 * de verdad es ganadora o no.
	 * 
	 * @param string $idventa
	 * 
	 * @return $codeReturn; 1 para suspender, 2 como ganador y 3 como perdedor, 0 como categoria no mapeada aun
	 */
	public static function verificarSiEsGanador($idVentaDetalle){
		//vemos la categoria de la apuesta para hacer el calculo respectivo
		$codeReturn = VentasDAO::$RESULTADO_PERDEDOR;
		$result = DBUtil::executeSelect("SELECT * FROM vista_ventas_detalles WHERE idventa_detalle=".$idVentaDetalle);
		$rowVistaVentasDetalles = $result[0];
		
		if($rowVistaVentasDetalles["idcategoria"] == VentasDAO::$CATEGORIA_BASKET){
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."-".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Revisando ticket en categoria basket.");
			$codeReturn = GanadoresBasket::calcularGanador($rowVistaVentasDetalles);
		}else if($rowVistaVentasDetalles["idcategoria"] == VentasDAO::$CATEGORIA_BEISBOL){
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."-".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Revisando ticket en categoria beisbol.");
			$codeReturn = GanadoresBeisbol::calcularGanador($rowVistaVentasDetalles);
		} else if($rowVistaVentasDetalles["idcategoria"] == VentasDAO::$CATEGORIA_FUTBOL){
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."-".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."Revisando ticket en categoria futbol.");
			$codeReturn = GanadoresFutbol::calcularGanador($rowVistaVentasDetalles);
		} else {
			//categoria no mapeada aun
			$codeReturn = VentasDAO::$RESULTADO_NO_MAPEADO_AUN;
			BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."-".$rowVistaVentasDetalles["idventa_detalle"]."] "
					."idcategoria[".$rowVistaVentasDetalles["idcategoria"]."] "
					."nombrecategoria[".$rowVistaVentasDetalles["nombre_categoria"]."] "
					."aun no ha sido mapeada en VentasDAO.");
		}
		
		BitacoraDAO::registrarComentario("[".$rowVistaVentasDetalles["idventa"]."-".$rowVistaVentasDetalles["idventa_detalle"]."]"
				." Retorno desde VentasDAO el valor [".$codeReturn."] <br />");
	
		return $codeReturn;
	}
	
	/**
	 * Nueva gestion para los tickets ganadores
	 * 
	 * @param unknown $fecha
	 */
	public static function calcularTicketGanador($fecha){
		//obtenemos las ventas que no esten anuladas
		BitacoraDAO::registrarComentario("En VentasDAO::calcularTicketGanador");
		$sql="SELECT * FROM vista_ventas_detalles WHERE fecha_venta='".$fecha."' AND anulado = 0 ORDER BY idventa";
		
		$results = DBUtil::executeSelect($sql);
		$ventaDetalle = array();
		
		foreach ($results as $venta){
			
			$ventaObj = new VentasDTO($venta["idventa"], 
					$venta["idventa_detalle"], 
					$venta["apuesta"], 
					$venta["total_ganar"],
					$venta["pago"],
					NULL);
			
			if($venta["suspendido"] == 1){
				//el juego asociado a esta venta fue suspendido
				//no hacemos calculo de ganador ni nada
				BitacoraDAO::registrarComentario("La venta [".$venta["idventa"]
					."][".$venta["idventa_detalle"]."] esta suspendida, no calculamos nada");
				
				$ventaObj->setEstadoFinal(VentasDAO::$RESULTADO_SUSPENDIDO);
				$ventaDetalle[$venta["idventa"]][$venta["idventa_detalle"]] = $ventaObj;
			} else {
				//el juego no esta en suspendido
				//vemos si fue almacenado el resultado para el mismo
				$existe= DBUtil::executeSelect("select idlogro_equipo_categoria_resultado from logros_equipos_categorias_resultados where idlogro_equipo='".$venta["idlogro_equipo"]."' and estatus='1' limit 1");

				if($existe[0]["idlogro_equipo_categoria_resultado"] > 0){
					//si tenemos resultado
					//calculamos si es ganador, perdedor o tablas
					$codeReturn = VentasDAO::verificarSiEsGanador($venta["idventa_detalle"]);
					
					$ventaObj->setEstadoFinal($codeReturn);
					$ventaDetalle[$venta["idventa"]][$venta["idventa_detalle"]] = $ventaObj;
				}else{
					//no tenemos resultado, no podemos evaluar nada aun
					BitacoraDAO::registrarComentario("La venta [".$venta["idventa"]
						."][".$venta["idventa_detalle"]."] no tiene resultado guardado, lo dejamos como vendida");
					
					$ventaObj->setEstadoFinal(VentasDAO::$RESULTADO_SOLO_VENDIDO);
					$ventaDetalle[$venta["idventa"]][$venta["idventa_detalle"]] = $ventaObj;
				}
			}
		}
		
		//print_r($ventaDetalle);
		
		//ya con el resultado de cada transaccion
		//procedemos a colocar un estado a cada venta como tal
		//tomando en cuenta el estado interno de sus tickets
		foreach($ventaDetalle as $idVenta => $arrayVentaDetalle){
			//echo "idVenta=".$idVenta;
			//print_r($arrayVentaDetalle);
			//inicializamos contadores para la venta
			$numeroApuestasEnTicket = count($arrayVentaDetalle);
			$apuestasGanadoras = 0;
			$apuestasPerdedoras = 0;
			$apuestasSuspendidas = 0;
			$apuestasEmpatadas = 0;
			$factor = 1;
			
			reset($arrayVentaDetalle);
			
			//la venta tiene mas de una apuesta
			//debemos evaluar el conjunto para saber el resultado final
			foreach ($arrayVentaDetalle as $apuesta){
				if($apuesta->getEstadoFinal() == VentasDAO::$RESULTADO_GANADOR){
					$apuestasGanadoras++;
					
					//actualizamos el estado especifico de la apuesta dentro del ticket
					$query = "UPDATE ventas_detalles SET edo_venta_detalle=5 WHERE idventa_detalle = ".$apuesta->getIdVentaDetalle();
					DBUtil::executeQuery($query);
					
					//calculo el factor parlay de esta apuesta
					if($apuesta->getPago() < 0){
						$factor *= (1 + (100 / abs($apuesta->getPago())));
						BitacoraDAO::registrarComentario("[".$idVenta."-".$apuesta->getIdVentaDetalle()."] calculando factor=(1 + (100 / ".abs($apuesta->getPago())."))");
					} else {
						$factor *= (1 + ($apuesta->getPago()/ 100));
						BitacoraDAO::registrarComentario("[".$idVenta."-".$apuesta->getIdVentaDetalle()."] calculando factor=(1 + (".$apuesta->getPago()."/100))");
					}
					
					BitacoraDAO::registrarComentario("[".$idVenta."-".$apuesta->getIdVentaDetalle()."] actualizada a estado Ganador con factor".$factor);
				} else if($apuesta->getEstadoFinal() == VentasDAO::$RESULTADO_PERDEDOR){
					$apuestasPerdedoras++;
					//actualizamos el estado especifico de la apuesta dentro del ticket
					$query = "UPDATE ventas_detalles SET edo_venta_detalle=6 WHERE idventa_detalle = ".$apuesta->getIdVentaDetalle();
					DBUtil::executeQuery($query);
					
					$factor *= 0;
					
					BitacoraDAO::registrarComentario("[".$idVenta."-".$apuesta->getIdVentaDetalle()."] actualizada a estado Perdedor");
				} else if($apuesta->getEstadoFinal() == VentasDAO::$RESULTADO_SUSPENDIDO){
					$apuestasSuspendidas++;
					//actualizamos el estado especifico de la apuesta dentro del ticket
					$query = "UPDATE ventas_detalles SET edo_venta_detalle=1 WHERE idventa_detalle = ".$apuesta->getIdVentaDetalle();
					DBUtil::executeQuery($query);
					
					$factor *= 1;
					
					BitacoraDAO::registrarComentario("[".$idVenta."-".$apuesta->getIdVentaDetalle()."] actualizada a estado Suspendido");
				} else if ($apuesta->getEstadoFinal() == VentasDAO::$RESULTADO_EMPATADO_DEBE_SUSPENDER){
					$apuestasEmpatadas++;
					//actualizamos el estado especifico de la apuesta dentro del ticket
					$query = "UPDATE ventas_detalles SET edo_venta_detalle=4 WHERE idventa_detalle = ".$apuesta->getIdVentaDetalle();
					DBUtil::executeQuery($query);
					
					$factor *= 1;
					
					BitacoraDAO::registrarComentario("[".$idVenta."-".$apuesta->getIdVentaDetalle()."] actualizada a estado Reembolsar");
				}else{
					//no es ninguno de los casos esperados, lo dejo como solo vendido
					//aunque esto no deberia pasar
					BitacoraDAO::registrarComentario("[".$idVenta."-".$apuesta->getIdVentaDetalle()."] caso atipico con estado final de venta =".$ventaObj->getEstadoFinal());
				}
			} //fue procesado todo el detalle de un determinado ticket
			
			BitacoraDAO::registrarComentario("[".$idVenta."] tiene lo siguiente: "
					."numeroApuestasEnTicket=".$numeroApuestasEnTicket
					.", apuestasGanadoras=".$apuestasGanadoras
					.", apuestasPerdedoras=".$apuestasPerdedoras
					.", apuestasEmpatadas=".$apuestasEmpatadas
					.", apuestasSuspendidas=".$apuestasSuspendidas
					.", factor=".$factor);
			
			//verificamos si es perdedor
			if($apuestasPerdedoras > 0){
				//tiene al menos una apuesta del ticket perdiendo, por lo tanto, el ticket completo pierde
				$query = "UPDATE ventas SET perdedor='1', reembolsar=0, ganador=0, "
				." monto_real_pagar=0, recalculado='0' "
				." WHERE idventa='".$idVenta."' LIMIT 1";
				DBUtil::executeQuery($query);
				
				BitacoraDAO::registrarComentario("[".$idVenta."] actualizada a estado Perdedor");
			} else {
				//no es perdedor el ticket, vemos si es totalmente ganador
				if($apuestasGanadoras == $numeroApuestasEnTicket){
					//la persona gano todas sus apuestas
					$query = "UPDATE ventas SET perdedor=0, reembolsar=0, ganador='1', "
					." monto_real_pagar='".$ventaObj->getMontoApuesta()*$factor."',recalculado='0' "
					." WHERE idventa='".$idVenta."' LIMIT 1";
					DBUtil::executeQuery($query);
						
					BitacoraDAO::registrarComentario("[".$idVenta."] actualizada a estado Ganador");
				}else {
					//debe ser obligatoramiente un reembolso o un recalculo
					if($apuestasGanadoras > 0){
						//la persona gano al menos una, confirmo recalculo
						if($apuestasGanadoras + $apuestasEmpatadas + $apuestasSuspendidas == $numeroApuestasEnTicket){
							//es recalculo
							$query = "UPDATE ventas SET perdedor=0, recalculado=1, ganador=0, "
							." reembolsar='0', monto_real_pagar=".$ventaObj->getMontoApuesta()*$factor
							." WHERE idventa='".$idVenta."' LIMIT 1";
							DBUtil::executeQuery($query);
								
							BitacoraDAO::registrarComentario("[".$idVenta."] actualizada a estado Recalculado");
						} else {
							//caso extraño
						}
					} else {
						//no gano, aparentemente solo es reembolso
						if($apuestasEmpatadas + $apuestasSuspendidas == $numeroApuestasEnTicket){
							//debe ser un reembolso
							$query = "UPDATE ventas SET perdedor=0, recalculado=0, ganador=0, "
							." reembolsar='1', monto_real_pagar=apuesta "
							." WHERE idventa='".$idVenta."' LIMIT 1";
							DBUtil::executeQuery($query);
							
							BitacoraDAO::registrarComentario("[".$idVenta."] actualizada a estado Reembolsar");
						} else {
							//caso extraño
						}
					}
				}
			}
		}
	}
}
