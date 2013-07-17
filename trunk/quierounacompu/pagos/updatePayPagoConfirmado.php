<?php
include_once '../sis/classes/DBUtil.php';
include_once '../sis/classes/BitacoraDAO.php';
include_once '../sis/classes/EnvioDAO.php';
include_once '../sis/classes/EnvioDTO.php';

$idEnvio = $_POST["id"];
$envioOriginal = EnvioDAO::getEnvioInfo($idEnvio);

$query = "UPDATE envios SET "
."seudonimo_ml='".$_POST["seudonimo"]."'"
.", nombre_completo='".$_POST["nombre"]."'"
.", ci_rif='".$_POST["ci"]."-".$_POST["cii"]."'"
.", correo='".$_POST["email"]."'"
.($_POST["tlfCelularCliente"] == "" ? "" : ", tlf_cliente='".$_POST["codCelCliente"]."-".$_POST["tlfCelularCliente"]."'")
.($_POST["tlfLocalCliente"] == "" ? "" : ", tlf_local_cliente='".$_POST["codLocalCliente"]."-".$_POST["tlfLocalCliente"]."'")
.", detalle_compra='".str_replace("'", "''", $_POST["articulo"])."'"
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
	
	if($envioOriginal->getSeudonimoML() != $envioModificado->getSeudonimoML()){
		$comentario .= ", Seudonimo MercadoLibre por: ".$envioModificado->getSeudonimoML();
	}
	if($envioOriginal->getNombreCompleto() != $envioModificado->getNombreCompleto()){
		$comentario .= ", Nombre del comprador por: ".$envioModificado->getNombreCompleto();
	}
	if($envioOriginal->getCiRIF() != $envioModificado->getCiRIF()){
		$comentario .= ", CI o  RIF por: ".$envioModificado->getCiRIF();
	}
	if($envioOriginal->getCorreo() != $envioModificado->getCorreo()){
		$comentario .= ", Correo por: ".$envioModificado->getCorreo();
	}
	if($envioOriginal->getTlfCliente() != $envioModificado->getTlfCliente()){
		$comentario .= ", TlfCelular del cliente por: ".$envioModificado->getTlfCliente();
	}
	if($envioOriginal->getTlfLocalCliente() != $envioModificado->getTlfLocalCliente()){
		$comentario .= ", TlfLocal del cliente por: ".$envioModificado->getTlfLocalCliente();
	}
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