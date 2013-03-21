<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/PageAccess.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/ModuloDAO.php';
include_once '../classes/EnvioDAO.php';
include_once '../classes/EnvioDTO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../includes/session.php';

$recordId = $_POST["idEnvio"];
$newStatus = $_POST["newStatus"];
$newComment = $_POST["newComment"];
$newStatusText = "";

$canEdit = false;
$envioDTO = EnvioDAO::getEnvioInfo($recordId);

BitacoraDAO::registrarComentario("Ingreso en pagina ajax para actualizar envio[".$recordId."]");

//vemos el tipo de envio que se desea buscar o si se viene de busqueda avanzada
//venimos de las opciones especificas por cada tipo de envio
//verificamos el permiso
if(EnvioDAO::$COD_STATUS_NOTIFICADO == $newStatus){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_NOTIFICADOS);
	$newStatusText = "Notificado";
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO == $newStatus){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_PAGOS_CONFIRMADOS);
	$newStatusText = "Pago Confirmado";
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO == $newStatus){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_PAGOS_NO_ENCONTRADOS);
	$newStatusText = "Pago no Encontrado";
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_FACTURADO == $newStatus){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_FACTURADO);
	$newStatusText = "Facturado";
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_PRESUPUESTADO == $newStatus){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_PRESUPUESTADO);
	$newStatusText = "Presupuestado";
	$canEdit = true;
} else if(EnvioDAO::$COD_STATUS_ENVIADO == $newStatus){
	PageAccess::validateAccess(Constants::$OPCION_EDICION_ENVIADO);
	$newStatusText = "Enviado";
	$canEdit = true;
}

BitacoraDAO::registrarComentario("El usuario ".($canEdit ? "" : "NO")." puede editar el envio[".$recordId."]");

if($canEdit){
	//agregamos el comentario nuevo
	$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
	$idUsuario = "NULL";
	
	if($userDTO === NULL){
		$idUsuario = "NULL";
	} else {
		$idUsuario = $userDTO->getId();
	}
	
	$result = EnvioDAO::addComment($envioDTO->getId(), $newComment, $idUsuario, $newStatus);
	if($result){
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
	echo "Disculpe, usted no tiene permiso para editar registros del tipo '" + $envioDTO->getDescStatusActual() + "'";
}
?>