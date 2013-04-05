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
		
		$query = "SELECT e.*, b.nombre AS nombreBanco, ev.nombre AS empresaEnvio, "
			." mdp.descripcion AS medioDePago, es.descripcion AS envioStatus, "
			." DATE_FORMAT(e.fecha_pago, '%d/%m/%Y') AS fechaPago, "
			." DATE_FORMAT(e.fecha_registro, '%d/%m/%Y') AS fechaRegistro"
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
		$envioDTO->setTlfCliente($result[0]["tlf_cliente"]);
		$envioDTO->setDescBanco($result[0]["nombreBanco"]);
		$envioDTO->setDescEmpresaEnvio($result[0]["empresaEnvio"]);
		$envioDTO->setDescStatusActual($result[0]["envioStatus"]);
		$envioDTO->setDescMedioPago($result[0]["medioDePago"]);
		$envioDTO->setDetalleCompra($result[0]["detalle_compra"]);
		$envioDTO->setDireccionDestino($result[0]["direccion_destino"]);
		$envioDTO->setEstadoDestino($result[0]["estado_destino"]);
		$envioDTO->setFechaPago($result[0]["fechaPago"]);
		$envioDTO->setFechaRegistro($result[0]["fechaRegistro"]);
		$envioDTO->setId($result[0]["id"]);
		$envioDTO->setIdBanco($result[0]["id_banco"]);
		$envioDTO->setIdEmpresaEnvio($result[0]["id_empresa_envio"]);
		$envioDTO->setIdMedioPago($result[0]["id_medio_pago"]);
		$envioDTO->setIdStatusActual($result[0]["id_status_actual"]);
		$envioDTO->setMontoPago($result[0]["monto_pago"]);
		$envioDTO->setNombreCompleto($result[0]["nombre_completo"]);
		$envioDTO->setNombreDestinatario($result[0]["nombre_destinatario"]);
		$envioDTO->setCedulaDestinatario($result[0]["cedula_destinatario"]);
		$envioDTO->setNumVoucher($result[0]["num_voucher"]);
		$envioDTO->setObservacionesEnvio($result[0]["observaciones_envio"]);
		$envioDTO->setSeudonimoML($result[0]["seudonimo_ml"]);
		$envioDTO->setTlfCelularDestinatario($result[0]["tlf_celular_destinatario"]);
		$envioDTO->setTlfLocalDestinatario($result[0]["tlf_local_destinatario"]);
		$envioDTO->setCodigoFactura($result[0]["codigo_factura"]);
		$envioDTO->setCodigoEnvio($result[0]["codigo_envio"]);
		
		return $envioDTO;
	}
	
	/**
	 * Retorna todos los status de los envios ordenados de manera alfabetica.
	 * 
	 */
	public static function getAllStatus(){
		$query = "SELECT id, descripcion FROM envios_status ORDER BY LOWER(descripcion)";
		
		$result = DBUtil::executeSelect($query);
		
		return $result;
	}
	
	/**
	 * Retorna todos los status siguientes a determinado estatus actual.
	 *
	 */
	public static function getAllSiguientesStatus($statusCode){
		$query = "SELECT destino.id, destino.descripcion "
		." FROM status_siguientes es, envios_status origen, envios_status destino "
		." WHERE es.id_status_inicial = origen.id "
		." AND es.id_siguiente_status = destino.id "
		." AND origen.id = ".$statusCode
		." ORDER BY LOWER(destino.descripcion)";
	
		$result = DBUtil::executeSelect($query);
	
		return $result;
	}
	
	/**
	 * Obtenemos todos los comentarios asociados a un envio
	 * @param int $idEnvio
	 */
	public static function getComentariosEnvio($idEnvio){
		$query = "SELECT u.nombre, u.apellido, es.descripcion, ec.comentario, DATE_FORMAT(ec.fecha_comentario, '%d/%m/%Y %h:%i %p') AS fecha_comentario"
		." FROM envios_status es, envios_comentarios ec LEFT JOIN usuarios u ON ec.id_usuario = u.id"
		." WHERE ec.id_status_envio = es.id"
		." AND ec.id_envio=".$idEnvio
		." ORDER BY ec.fecha_comentario";
		
		$result = DBUtil::executeSelect($query);
		
		return $result;
	}
	
	/**
	 * Agregamos un comentario a determinado envio
	 * @param unknown $idEnvio
	 * @param unknown $comentario
	 * @param unknown $idUsuario
	 * @param unknown $idStatusEnvio
	 * @return Ambigous <true, boolean>
	 */
	public static function addComment($idEnvio, $comentario, $idUsuario, $idStatusEnvio){
		$query = "INSERT INTO envios_comentarios (fecha_comentario, comentario, id_usuario, id_status_envio, id_envio)"
				." VALUES (NOW(), '".$comentario."', ".$idUsuario.", ".$idStatusEnvio.",".$idEnvio.")";
		
		return DBUtil::executeQuery($query);
	}

	/**
	 * 
	 * @param unknown $idEnvio
	 * @param unknown $newStatus
	 * @return Ambigous <true, boolean>
	 */
	public static function updateEnvioCurrentStatus($idEnvio, $newStatus){
		$query = "UPDATE envios SET id_status_actual = ".$newStatus." WHERE id = ".$idEnvio;
		
		return DBUtil::executeQuery($query);
	}
	
	/**
	 * 
	 * @param unknown $userDTO
	 * @param unknown $opcionDeEdicion
	 * @return boolean
	 */
	public static function checkIfUserCanEdit($userDTO, $opcionDeEdicion){
		$canEdit = false;
		
		if($userDTO->canAccessKeyModule($opcionDeEdicion)){
			$canEdit = true;
		}
		
		return $canEdit;
	}
}
?>