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
		$comentario .= ", Nombre del destinatario por: ".$envioModificado->getNombreDestinatario();
	}
	if($envioOriginal->getCedulaDestinatario() != $envioModificado->getCedulaDestinatario()){
		$comentario .= ", CI o RIF del destinatario por: ".$envioModificado->getCedulaDestinatario();
	}
	if($envioOriginal->getDireccionDestino() != $envioModificado->getDireccionDestino()){
		$comentario .= ", Direccion de envio por: ".$envioModificado->getDireccionDestino();
	}
	if($envioOriginal->getCiudadDestino() != $envioModificado->getCiudadDestino()){
		$comentario .= ", Ciudad de envio por: ".$envioModificado->getCiudadDestino();
	}
	if($envioOriginal->getEstadoDestino() != $envioModificado->getEstadoDestino()){
		$comentario .= ", Estado de envio por: ".$envioModificado->getEstadoDestino();
	}
	if($envioOriginal->getTlfCelularDestinatario() != $envioModificado->getTlfCelularDestinatario()){
		$comentario .= ", TlfCelular del destinatario por: ".$envioModificado->getTlfCelularDestinatario();
	}
	if($envioOriginal->getTlfLocalDestinatario()!= $envioModificado->getTlfLocalDestinatario()){
		$comentario .= ", TlfLocal del destinatario por: ".$envioModificado->getTlfLocalDestinatario();
	}
	if($envioOriginal->getObservacionesEnvio()!= $envioModificado->getObservacionesEnvio()){
		$comentario .= ", Observaciones del envio por: ".$envioModificado->getObservacionesEnvio();
	}
	if($envioOriginal->getDescEmpresaEnvio()!= $envioModificado->getDescEmpresaEnvio()){
		$comentario .= ", Empresa de envio por: ".$envioModificado->getDescEmpresaEnvio();
	}
	
	if($comentario == ""){
		$comentario = "Se actualizo el envio, pero sin modificar ninguno de sus valores";
	}else {
		$comentario = "Fueron cambiados los siguientes valores ".$comentario;
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