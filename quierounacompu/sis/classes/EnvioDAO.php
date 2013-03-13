<?php
class EnvioDAO {
	private static $COD_STATUS_NOTIFICADO = 1;
	private static $COD_STATUS_PAGO_CONFIRMADO = 2;
	private static $COD_STATUS_PAGO_NO_ENCONTRADO = 3;
	private static $COD_STATUS_PRESUPUESTADO = 4;
	private static $COD_STATUS_FACTURADO = 5;
	private static $COD_STATUS_ENVIADO = 6;
	
	/**
	 * 
	 * @param unknown $numVaucher
	 * @param unknown $seudonimoML
	 * @param unknown $ciRif
	 * @param unknown $fechaDesde
	 * @param unknown $fechaHasta
	 */
	public static function getQueryEnviosNotificados($numVaucher, $seudonimoML, 
			$ciRif, $fechaDesde, $fechaHasta){
		
		return EnvioDAO::getEnviosByType(EnvioDAO::$COD_STATUS_NOTIFICADO, 
				$numVaucher,
				$seudonimoML, 
				$ciRif,
				$fechaDesde,
				$fechaHasta);
	}
	
	/**
	 * 
	 * @param unknown $statusEnvio
	 * @param unknown $numVaucher
	 * @param unknown $seudonimoML
	 * @param unknown $ciRif
	 * @param unknown $fechaDesde
	 * @param unknown $fechaHasta
	 */
	private static function getQueryEnviosByType($statusEnvio, $numVaucher,
			$seudonimoML, $ciRif, $fechaDesde, $fechaHasta){
		
		$query = "SELECT "
			." FROM bancos b, empresa_envio ev, medios_de_pago mdp, envios_status es, envios e"
			." WHERE e.id_status_actual = es.id"
			." AND e.banco = b.id"
			." AND e.medio_pago = ev.id"
			." AND e.id_empresa_envio = mdp.id"
			." AND e.id_status_actual = ".$statusEnvio;
		
		//colocamos los filtros
		if($numVaucher != ""){
			$query .= " AND e.num_voucher = '".$numVaucher."'";
		}
		if($seudonimoML != ""){
			$query .= " AND e.seudonimo_ml = '".$seudonimoML."'";
		}
		if($ciRif != ""){
			$query .= " AND e.ci_rif = '".$ciRif."'";
		}
		if($fechaDesde != ""){
			$query .= " AND e.fecha_pago >= '".$fechaDesde."'";
		}
		if($fechaHasta != ""){
			$query .= " AND e.fecha_pago <= '".$fechaHasta."'";
		}
		
		return $query;
	}
}
?>