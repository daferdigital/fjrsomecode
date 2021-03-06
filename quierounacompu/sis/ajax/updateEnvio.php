<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/PageAccess.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/ModuloDAO.php';
include_once '../classes/EnvioDAO.php';
include_once '../classes/EnvioDTO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../classes/SendEmail.php';
include_once '../includes/session.php';

$idEnvio = $_POST["idEnvio"];
$newComment = $_POST["newComment"];
$newStatusText = "";
$oldStatusText;

$canEdit = false;
$envioDTO = EnvioDAO::getEnvioInfo($idEnvio);
$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
$currentIdStatus = $envioDTO->getIdStatusActual();

$newStatus = -1;
if(isset($_POST["newStatus"])){
	$newStatus = $_POST["newStatus"];
}

BitacoraDAO::registrarComentario("Ingreso en pagina ajax para actualizar envio[".$idEnvio."]");

//vemos el tipo de envio que se desea buscar o si se viene de busqueda avanzada
//venimos de las opciones especificas por cada tipo de envio
//verificamos el permiso
if(EnvioDAO::$COD_STATUS_NOTIFICADO == $currentIdStatus){
	$oldStatusText = "Notificado";
	
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_NOTIFICADOS)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO == $currentIdStatus){
	$oldStatusText = "Pago Confirmado";
	
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_PAGOS_CONFIRMADOS)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO == $currentIdStatus){
	$oldStatusText = "Pago no Encontrado";
	
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_PAGOS_NO_ENCONTRADOS)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_FACTURADO == $currentIdStatus){
	$oldStatusText = "Facturado";
	
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_FACTURADO)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_PRESUPUESTADO == $currentIdStatus){
	$oldStatusText = "Presupuestado";
	
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_PRESUPUESTADO)){
		$canEdit = true;
	}
} else if(EnvioDAO::$COD_STATUS_ENVIADO == $currentIdStatus){
	$oldStatusText = "Enviado";
	
	if($userDTO->canAccessKeyModule(Constants::$OPCION_EDICION_ENVIADO)){
		$canEdit = true;
	}
} else if($currentIdStatus == -1){
	//solo quiero comentar
	$canEdit = true;
}

BitacoraDAO::registrarComentario("El usuario ".($canEdit ? "" : "NO")." puede editar el envio[".$idEnvio."]");

if($newStatus != -1){
	if(EnvioDAO::$COD_STATUS_NOTIFICADO == $newStatus){
		$newStatusText = "Notificado";
	} else if(EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO == $newStatus){
		$newStatusText = "Pago Confirmado";
	} else if(EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO == $newStatus){
		$newStatusText = "Pago no Encontrado";
	} else if(EnvioDAO::$COD_STATUS_FACTURADO == $newStatus){
		$newStatusText = "Facturado";
	} else if(EnvioDAO::$COD_STATUS_PRESUPUESTADO == $newStatus){
		$newStatusText = "Presupuestado";
	} else if(EnvioDAO::$COD_STATUS_ENVIADO == $newStatus){
		$newStatusText = "Enviado";
	} else if(EnvioDAO::$COD_STATUS_ERRADOS == $newStatus){
		$newStatusText = "Errado";
	} else if(EnvioDAO::$COD_STATUS_PAGO_DEVUELTO == $newStatus){
		$newStatusText = "Pago Devuelto";
	}
}

if($canEdit){
	//agregamos el comentario nuevo
	$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
	$idUsuario = "NULL";
	
	if($userDTO === NULL){
		$idUsuario = "NULL";
	} else {
		$idUsuario = $userDTO->getId();
	}
	
	//si el nuevo estado es FACTURADO, quiere decir que me debio llegar el codigo de factura interno
	if($newStatus == EnvioDAO::$COD_STATUS_FACTURADO){
		//reviso el codigo de factura para guardarlo y almacenar el comentario respectivo
		if(isset($_POST["codFactura"])){
			$query = "UPDATE envios SET codigo_factura='".$_POST["codFactura"]."' WHERE id=".$envioDTO->getId();
			DBUtil::executeQuery($query);
			
			EnvioDAO::addComment($idEnvio, 
				"Asignado numero de factura ".$_POST["codFactura"], 
				$idUsuario, 
				$newStatus);
		}else{
			EnvioDAO::addComment($idEnvio,
				"Se almaceno un nuevo envio Facturado sin codigo de factura, esto no debio pasar",
				$idUsuario,
				$newStatus);
		}
	}
	
	//si el nuevo estado es ENVIADO, quiere decir que tengo que actualizar la informacion 
	//de codigo de envio y empresa que envia
	//reviso el codigo de factura para guardarlo y almacenar el comentario respectivo
	if($newStatus == EnvioDAO::$COD_STATUS_ENVIADO){
		if(isset($_POST["codEnvio"])){
			$query = "UPDATE envios SET codigo_envio='".$_POST["codEnvio"]."' WHERE id=".$envioDTO->getId();
			DBUtil::executeQuery($query);
				
			EnvioDAO::addComment($idEnvio,
			"Asignado numero de envio ".$_POST["codEnvio"],
			$idUsuario,
			$newStatus);
		}else{
			EnvioDAO::addComment($idEnvio,
			"Se almaceno un nuevo envio con estado Enviado sin codigo de envio, esto no debio pasar",
			$idUsuario,
			$newStatus);
		}
		if(isset($_POST["ciaEnvio"])){
			$query = "UPDATE envios SET id_empresa_envio='".$_POST["ciaEnvio"]."' WHERE id=".$envioDTO->getId();
			DBUtil::executeQuery($query);
				
			$query = "SELECT nombre FROM empresa_envio WHERE id=".$_POST["ciaEnvio"];
			$result = DBUtil::executeSelect($query);
			
			EnvioDAO::addComment($idEnvio,
			"Actualizado valor de empresa de envio a ".$result[0]["nombre"],
			$idUsuario,
			$newStatus);
		}else{
			EnvioDAO::addComment($idEnvio,
			"Se almaceno un nuevo envio con estado Enviado sin indicar empresa de envio, esto no debio pasar",
			$idUsuario,
			$newStatus);
		}
		
		//obtenemos de nuevo el envio, para tomar la informacion actual
		$envioDTO = EnvioDAO::getEnvioInfo($idEnvio);
		
		$message = file_get_contents("../emailTemplates/templateProductoEnviado.html");
		$message = str_replace("{0}", $envioDTO->getNombreCompleto()." (".$envioDTO->getSeudonimoML().")", $message);
		$message = str_replace("{1}", $envioDTO->getCodigoFactura(), $message);
		$message = str_replace("{2}", $envioDTO->getDescEmpresaEnvio(), $message);
		$message = str_replace("{3}", $envioDTO->getCiudadDestino(), $message);
		$message = str_replace("{4}", $envioDTO->getDireccionDestino(), $message);
		$message = str_replace("{5}", $envioDTO->getCodigoEnvio(), $message);
		$message = str_replace("{6}", $envioDTO->getNombreDestinatario(), $message);
		
		SendEmail::sendMail($envioDTO->getCorreo(),
			SendEmail::$SUBJECT_PEDIDO_ENVIADO,
			$message);
	}
	
	
	if($newStatus == EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO){
		$message = file_get_contents("../emailTemplates/templatePagoNoEncontrado.html");
		$message = str_replace("{0}", $envioDTO->getNombreCompleto()." (".$envioDTO->getSeudonimoML().")", $message);
		$message = str_replace("{1}", $envioDTO->getDescBanco(), $message);
		$message = str_replace("{2}", $envioDTO->getDescMedioPago(), $message);
		$message = str_replace("{3}", $envioDTO->getNumVoucher(), $message);
		$message = str_replace("{4}", $envioDTO->getMontoPago(), $message);
		$message = str_replace("{5}", "http://www.quierounacompu.com/pagos/actualizarEnvio.php?id=".$envioDTO->getIdEncriptado(), $message);
		//$message = str_replace("{5}", "http://www.quierounacompu.com/pagos/updatePedido.php?id=".$envioDTO->getId(), $message);
		
		SendEmail::sendMail($envioDTO->getCorreo(),
			SendEmail::$SUBJECT_PAGO_NO_ENCONTRADO,
			$message);
	}
	
	$result = true;
	//vemos si fue enviado un comentario personalizado a este envio
	if($newComment != ""){
		$result = EnvioDAO::addComment($envioDTO->getId(), 
				$newComment, 
				$idUsuario, 
				$newStatus == -1 ? $envioDTO->getIdStatusActual() : $newStatus);
	}
	
	if($result && $newStatus != -1){
		$result = EnvioDAO::addComment($envioDTO->getId(), 
			"Cambio de status a ".$newStatusText, 
			$idUsuario, 
			$newStatus);
		
		if($result){
			//modifico el status actual del envio con el indicado por el usuario que esta actualizando
			$result = EnvioDAO::updateEnvioCurrentStatus($envioDTO->getId(), $newStatus);
		} 
	} 
	
	if(!$result) {
		echo "Ocurrio un error actualizando el envio";
	} else {
		echo "Los cambios fueron realizados";
	}
} else {
	echo "Disculpe, usted no tiene permiso para editar registros del tipo '".$envioDTO->getDescStatusActual()."'";
}
?>