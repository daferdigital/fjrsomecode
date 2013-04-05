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

$idEnvio = $_POST["idEnvio"];
$newComment = $_POST["newComment"];

$envioDTO = EnvioDAO::getEnvioInfo($idEnvio);
$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
$currentIdStatus = $envioDTO->getIdStatusActual();

BitacoraDAO::registrarComentario("Ingreso en pagina ajax para agregar comentario a envio[".$idEnvio."]");

//no hay restricciones para agregar comentarios
BitacoraDAO::registrarComentario("El usuario puede agregar comentarios al envio[".$idEnvio."]");

//agregamos el comentario nuevo
$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
$idUsuario = "NULL";
	
if($userDTO === NULL){
	$idUsuario = "NULL";
} else {
	$idUsuario = $userDTO->getId();
}
	
//si el nuevo estado es FACTURADO, quiere decir que me debio llegar el codigo de factura interno
if($newComment != ""){
	$result = EnvioDAO::addComment($envioDTO->getId(), 
			$newComment, 
			$idUsuario, 
			$currentIdStatus);
}
	
if(!$result) {
	echo "Ocurrio un error actualizando el envio";
} else {
	echo "Los cambios fueron realizados";
}
?>