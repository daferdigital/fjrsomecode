<?php
include_once '../sis/classes/DBUtil.php';
include_once '../sis/classes/BitacoraDAO.php';
include_once '../sis/classes/EnvioDAO.php';
include_once '../sis/classes/EnvioDTO.php';

//obtenemos el registro de envio, antes de actualizarlo
$idEnvio = $_POST["id"];
$envioOriginal = EnvioDAO::getEnvioInfo($idEnvio);

$query = "UPDATE envios SET "
.", nombre_destinatario='".$_POST["destinatario"]."'"
.", cedula_destinatario='".$_POST["ciDest"]."-".$_POST["ciDestinatario"]."'"
.", direccion_destino='".$_POST["dir1"]."'"
.", ciudad_destino='".$_POST["ciudad"]."'"
.", estado_destino='".$_POST["estado"]."'"
.($_POST["celular"] == "" ? "" : ", tlf_celular_destinatario='".$_POST["codcel"]."-".$_POST["celular"]."'")
.($_POST["tlfLocalDestinatario"] == "" ? "" : ", tlf_local_destinatario='".$_POST["codLocalDestinatario"]."-".$_POST["tlfLocalDestinatario"]."'")
.", observaciones_envio='".$_POST["obs"]."'"
.", id_empresa_envio=".$_POST["envio"]
." WHERE id=".$idEnvio;

$code=0;
if(! DBUtil::executeQuery($query)){
	$code=1;
} else {
	//la actualizacion fue exitosa, agregamos como comentario
	//el detalle de los campos modificados
	//comparamos los campos para saber cuales fueron modificados
	$envioModificado = EnvioDAO::getEnvioInfo($idEnvio);
	$comentario = "";
	
	if($envioOriginal->getNombreDestinatario() != $envioModificado->getNombreDestinatario()){
		$comentario .= "<li> Nombre del destinatario de: ".$envioOriginal->getNombreDestinatario()." a: ".$envioModificado->getNombreDestinatario()."</li>";
	}
	if($envioOriginal->getCedulaDestinatario() != $envioModificado->getCedulaDestinatario()){
		$comentario .= "<li> CI o RIF del destinatario de: ".$envioOriginal->getCedulaDestinatario()." a: ".$envioModificado->getCedulaDestinatario()."</li>";
	}
	if($envioOriginal->getDireccionDestino() != $envioModificado->getDireccionDestino()){
		$comentario .= "<li> Direccion de envio de: ".$envioOriginal->getDireccionDestino()." a: ".$envioModificado->getDireccionDestino()."</li>";
	}
	if($envioOriginal->getCiudadDestino() != $envioModificado->getCiudadDestino()){
		$comentario .= "<li> Ciudad de envio de: ".$envioOriginal->getCiudadDestino()." a: ".$envioModificado->getCiudadDestino()."</li>";
	}
	if($envioOriginal->getEstadoDestino() != $envioModificado->getEstadoDestino()){
		$comentario .= "<li> Estado de envio de: ".$envioOriginal->getEstadoDestino()." a: ".$envioModificado->getEstadoDestino()."</li>";
	}
	if($envioOriginal->getTlfCelularDestinatario() != $envioModificado->getTlfCelularDestinatario()){
		$comentario .= "<li> TlfCelular del destinatario de: ".$envioOriginal->getTlfCelularDestinatario()." a: ".$envioModificado->getTlfCelularDestinatario()."</li>";
	}
	if($envioOriginal->getTlfLocalDestinatario()!= $envioModificado->getTlfLocalDestinatario()){
		$comentario .= "<li> TlfLocal del destinatario de: ".$envioOriginal->getTlfLocalDestinatario()." a: ".$envioModificado->getTlfLocalDestinatario()."</li>";
	}
	if($envioOriginal->getObservacionesEnvio()!= $envioModificado->getObservacionesEnvio()){
		$comentario .= "<li> Observaciones del envio de: ".$envioOriginal->getObservacionesEnvio()." a: ".$envioModificado->getObservacionesEnvio()."</li>";
	}
	if($envioOriginal->getDescEmpresaEnvio()!= $envioModificado->getDescEmpresaEnvio()){
		$comentario .= "<li> Empresa de envio de: ".$envioOriginal->getDescEmpresaEnvio()." a: ".$envioModificado->getDescEmpresaEnvio()."</li>";
	}
	
	if($comentario == ""){
		$comentario = "Se actualizo el envio, pero sin modificar ninguno de sus valores";
	}else {
		$comentario = "Fueron cambiados los siguientes valores <ul>".$comentario." </ul>";
	}
	
	EnvioDAO::addComment($idEnvio,
		$comentario,
		"null",
		$envioModificado->getIdStatusActual());
}
?>
<script type="text/javascript">
	<?php if($code == 0) {?>
		alert("Su informacion fue actualizada de manera exitosa.");
		window.location = "index.php";
	<?php } else {?>
		alert("Disculpe, hubo un problema procesando su solicitud, por favor intente mas tarde.");
		window.history.back();
	<?php }?>
</script>