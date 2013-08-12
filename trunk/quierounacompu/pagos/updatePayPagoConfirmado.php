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
		$comentario .= "<ul> Seudonimo MercadoLibre de: ".$envioOriginal->getSeudonimoML()." a: ".$envioModificado->getSeudonimoML()." </ul>";
	}
	if($envioOriginal->getNombreCompleto() != $envioModificado->getNombreCompleto()){
		$comentario .= "<ul> Nombre del comprador de: ".$envioOriginal->getNombreCompleto()." a: ".$envioModificado->getNombreCompleto()." </ul>";
	}
	if($envioOriginal->getCiRIF() != $envioModificado->getCiRIF()){
		$comentario .= "<ul> CI o  RIF de: ".$envioOriginal->getCiRIF()." a: ".$envioModificado->getCiRIF()." </ul>";
	}
	if($envioOriginal->getCorreo() != $envioModificado->getCorreo()){
		$comentario .= "<ul> Correo de: ".$envioOriginal->getCorreo()." a: ".$envioModificado->getCorreo()." </ul>";
	}
	if($envioOriginal->getTlfCliente() != $envioModificado->getTlfCliente()){
		$comentario .= "<ul> TlfCelular del cliente de: ".$envioOriginal->getTlfCliente()." a: ".$envioModificado->getTlfCliente()." </ul>";
	}
	if($envioOriginal->getTlfLocalCliente() != $envioModificado->getTlfLocalCliente()){
		$comentario .= "<ul> TlfLocal del cliente de: ".$envioOriginal->getTlfLocalCliente()." a: ".$envioModificado->getTlfLocalCliente()." </ul>";
	}
	if($envioOriginal->getNombreDestinatario() != $envioModificado->getNombreDestinatario()){
		$comentario .= "<ul> Nombre del destinatario de: ".$envioOriginal->getNombreDestinatario()." a: ".$envioModificado->getNombreDestinatario()." </ul>";
	}
	if($envioOriginal->getCedulaDestinatario() != $envioModificado->getCedulaDestinatario()){
		$comentario .= "<ul> CI o RIF del destinatario de: ".$envioOriginal->getCedulaDestinatario()." a: ".$envioModificado->getCedulaDestinatario()." </ul>";
	}
	if($envioOriginal->getDireccionDestino() != $envioModificado->getDireccionDestino()){
		$comentario .= "<ul> Direccion de envio de: ".$envioOriginal->getDireccionDestino()." a: ".$envioModificado->getDireccionDestino()." </ul>";
	}
	if($envioOriginal->getCiudadDestino() != $envioModificado->getCiudadDestino()){
		$comentario .= "<ul> Ciudad de envio de: ".$envioOriginal->getCiudadDestino()." a: ".$envioModificado->getCiudadDestino()." </ul>";
	}
	if($envioOriginal->getEstadoDestino() != $envioModificado->getEstadoDestino()){
		$comentario .= "<ul> Estado de envio de: ".$envioOriginal->getEstadoDestino()." a: ".$envioModificado->getEstadoDestino()." </ul>";
	}
	if($envioOriginal->getTlfCelularDestinatario() != $envioModificado->getTlfCelularDestinatario()){
		$comentario .= "<ul> TlfCelular del destinatario de: ".$envioOriginal->getTlfCelularDestinatario()." a: ".$envioModificado->getTlfCelularDestinatario()." </ul>";
	}
	if($envioOriginal->getTlfLocalDestinatario()!= $envioModificado->getTlfLocalDestinatario()){
		$comentario .= "<ul> TlfLocal del destinatario de: ".$envioOriginal->getTlfLocalDestinatario()." a: ".$envioModificado->getTlfLocalDestinatario()." </ul>";
	}
	if($envioOriginal->getObservacionesEnvio()!= $envioModificado->getObservacionesEnvio()){
		$comentario .= "<ul> Observaciones del envio de: ".$envioOriginal->getObservacionesEnvio()." a: ".$envioModificado->getObservacionesEnvio()." </ul>";
	}
	if($envioOriginal->getDescEmpresaEnvio()!= $envioModificado->getDescEmpresaEnvio()){
		$comentario .= "<ul> Empresa de envio de: ".$envioOriginal->getDescEmpresaEnvio()." a: ".$envioModificado->getDescEmpresaEnvio()." </ul>";
	}
	
	if($comentario == ""){
		$comentario = "Se actualizo el envio, pero sin modificar ninguno de sus valores";
	}else {
		$comentario = "Fueron cambiados los siguientes valores: <li>".$comentario." </li>";
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