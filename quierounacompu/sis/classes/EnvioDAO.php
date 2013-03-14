<?php
include_once "DBUtil.php";

class EnvioDAO {
	public static $COD_STATUS_NOTIFICADO = 1;
	public static $COD_STATUS_PAGO_CONFIRMADO = 2;
	public static $COD_STATUS_PAGO_NO_ENCONTRADO = 3;
	public static $COD_STATUS_PRESUPUESTADO = 4;
	public static $COD_STATUS_FACTURADO = 5;
	public static $COD_STATUS_ENVIADO = 6;
	
	/**
	 * 
	 * @param unknown_type $idEnvio
	 * @return type EnvioDTO
	 */
	public static function getEnvioInfo($idEnvio){
		
		$query = "SELECT e.*, b.nombre AS nombreBanco, ev.nombre AS empresaEnvio, mdp.descripcion AS medioDePago, es.descripcion AS envioStatus"
			." FROM bancos b, empresa_envio ev, medios_de_pago mdp, envios_status es, envios e"
			." WHERE e.id_status_actual = es.id"
			." AND e.id_banco = b.id"
			." AND e.id_medio_pago = mdp.id"
			." AND e.id_empresa_envio = ev.id"
			." AND e.id = ".$idEnvio;
		
		$result = DBUtil::executeSelect($query);
		$envioDTO = new EnvioDTO();
		
		$envioDTO->setCiRIF($result[0]["ci_rif"]);
		$envioDTO->setCiudadDestino($result[0]["ciudad_destino"]);
		$envioDTO->setCorreo($result[0]["correo"]);
		$envioDTO->setDescBanco($result[0]["nombreBanco"]);
		$envioDTO->setDescEmpresaEnvio($result[0]["empresaEnvio"]);
		$envioDTO->setDescStatusActual($result[0]["envioStatus"]);
		$envioDTO->setDescMedioPago($result[0]["medioDePago"]);
		$envioDTO->setDetalleCompra($result[0]["detalle_compra"]);
		$envioDTO->setDireccionDestino($result[0]["direccion_destino"]);
		$envioDTO->setEstadoDestino($result[0]["estado_destino"]);
		$envioDTO->setFechaPago($result[0]["fecha_pago"]);
		$envioDTO->setId($result[0]["id"]);
		$envioDTO->setIdBanco($result[0]["id_banco"]);
		$envioDTO->setIdEmpresaEnvio($result[0]["id_empresa_envio"]);
		$envioDTO->setIdMedioPago($result[0]["id_medio_pago"]);
		$envioDTO->setIdStatusActual($result[0]["id_status_actual"]);
		$envioDTO->setMontoPago($result[0]["monto_pago"]);
		$envioDTO->setNombreCompleto($result[0]["nombre_completo"]);
		$envioDTO->setNombreDestinatario($result[0]["nombre_destinatario"]);
		$envioDTO->setNumVoucher($result[0]["num_voucher"]);
		$envioDTO->setObservacionesEnvio($result[0]["observaciones_envio"]);
		$envioDTO->setSeudonimoML($result[0]["seudonimo_ml"]);
		$envioDTO->setTlfCelularDestinatario($result[0]["tlf_celular_destinatario"]);
		$envioDTO->setTlfLocalDestinatario($result[0]["tlf_local_destinatario"]);
		
		
		return $envioDTO;
	}
}
?>