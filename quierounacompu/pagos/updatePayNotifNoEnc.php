<?php
include_once '../sis/classes/DBUtil.php';
include_once '../sis/classes/BitacoraDAO.php';
include_once '../sis/classes/EnvioDAO.php';
include_once '../sis/classes/EnvioDTO.php';

$fixedMonto = str_replace(".", "", $_POST["monto"]);
$fixedMonto = str_replace(",", ".", $fixedMonto);

//obtenemos el registro de envio, antes de actualizarlo
$code = 1;
$msgError = "Disculpe, hubo un problema procesando su solicitud, por favor intente mas tarde.";

$idEnvio = $_POST["id"];
$envioOriginal = EnvioDAO::getEnvioInfo($idEnvio);

//verificamos si el numero de bauche no se repite en otro envio;
$query = "SELECT * FROM envios WHERE id <> ".$idEnvio." AND num_voucher='".$_POST["bauche"]."'";
$cuenta = DBUtil::getRecordCountToQuery($query);

if($cuenta > 0){
	//no podemos actualizar ya que se indico un vaucher de otro envio
	$code = 1;
	$msgError = "Disculpe, el numero de vauche de pago indicado existe en otro pedido.";
	$msgError .= "Verifique e intente de nuevo.";
}else {
	//numero de vaucher valido, proseguimos
	$query = "UPDATE envios SET "
	."seudonimo_ml='".$_POST["seudonimo"]."'"
	.", nombre_completo='".$_POST["nombre"]."'"
	.", ci_rif='".$_POST["ci"]."-".$_POST["cii"]."'"
	.", correo='".$_POST["email"]."'"
	.($_POST["tlfCelularCliente"] == "" ? "" : ", tlf_cliente='".$_POST["codCelCliente"]."-".$_POST["tlfCelularCliente"]."'")
	.($_POST["tlfLocalCliente"] == "" ? "" : ", tlf_local_cliente='".$_POST["codLocalCliente"]."-".$_POST["tlfLocalCliente"]."'")
	.", detalle_compra='".str_replace("'", "''", $_POST["articulo"])."'"
	.", num_voucher='".$_POST["bauche"]."'"
	.", fecha_pago='".$_POST["fechaPagoHidden"]."'"
	.",	monto_pago=".$fixedMonto
	.", nombre_destinatario='".$_POST["destinatario"]."'"
	.", cedula_destinatario='".$_POST["ciDest"]."-".$_POST["ciDestinatario"]."'"
	.", direccion_destino='".$_POST["dir1"]."'"
	.", ciudad_destino='".$_POST["ciudad"]."'"
	.", estado_destino='".$_POST["estado"]."'"
	.($_POST["celular"] == "" ? "" : ", tlf_celular_destinatario='".$_POST["codcel"]."-".$_POST["celular"]."'")
	.($_POST["tlfLocalDestinatario"] == "" ? "" : ", tlf_local_destinatario='".$_POST["codLocalDestinatario"]."-".$_POST["tlfLocalDestinatario"]."'")
	.", observaciones_envio='".$_POST["obs"]."'"
	.", id_medio_pago=".$_POST["medio"]
	.", id_banco=".($_POST["medio"] == 5 ? 4 : $_POST["banco"])
	.", id_banco_origen=".($_POST["medio"] == 6 ? $_POST["bancoOrigen"] : 4)
	.", id_empresa_envio=".$_POST["envio"]
	.", id_status_actual=".Constants::$STATUS_INICIAL_ENVIOS
	." WHERE id=".$_POST["id"];
	
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
			$comentario .= "<li> Seudonimo MercadoLibre de: ".$envioOriginal->getSeudonimoML()." a: ".$envioModificado->getSeudonimoML()." </li>";
		}
		if($envioOriginal->getNombreCompleto() != $envioModificado->getNombreCompleto()){
			$comentario .= "<li> Nombre del comprador de: ".$envioOriginal->getNombreCompleto()." a: ".$envioModificado->getNombreCompleto()." </li>";
		}
		if($envioOriginal->getCiRIF() != $envioModificado->getCiRIF()){
			$comentario .= "<li> CI o  RIF de: ".$envioOriginal->getCiRIF()." a: ".$envioModificado->getCiRIF()." </li>";
		}
		if($envioOriginal->getCorreo() != $envioModificado->getCorreo()){
			$comentario .= "<li> Correo de: ".$envioOriginal->getCorreo()." a: ".$envioModificado->getCorreo()." </li>";
		}
		if($envioOriginal->getTlfCliente() != $envioModificado->getTlfCliente()){
			$comentario .= "<li> TlfCelular del cliente de: ".$envioOriginal->getTlfCliente()." a: ".$envioModificado->getTlfCliente()." </li>";
		}
		if($envioOriginal->getTlfLocalCliente() != $envioModificado->getTlfLocalCliente()){
			$comentario .= "<li> TlfLocal del cliente de: ".$envioOriginal->getTlfLocalCliente()." a: ".$envioModificado->getTlfLocalCliente()." </li>";
		}
		if($envioOriginal->getNumVoucher() != $envioModificado->getNumVoucher()){
			$comentario .= "<li> Numero del vauche de: ".$envioOriginal->getNumVoucher()." a: ".$envioModificado->getNumVoucher()." </li>";
		}
		if($envioOriginal->getFechaPago() != $envioModificado->getFechaPago()){
			$comentario .= "<li> Fecha del pago de: ".$envioOriginal->getFechaPago()." a: ".$envioModificado->getFechaPago()." </li>";
		}
		if($envioOriginal->getMontoPago() != $envioModificado->getMontoPago()){
			$comentario .= "<li> Monto del pago de: ".$envioOriginal->getMontoPago()." a: ".$envioModificado->getMontoPago()." </li>";
		}
		if($envioOriginal->getNombreDestinatario() != $envioModificado->getNombreDestinatario()){
			$comentario .= "<li> Nombre del destinatario de: ".$envioOriginal->getNombreDestinatario()." a: ".$envioModificado->getNombreDestinatario()." </li>";
		}
		if($envioOriginal->getCedulaDestinatario() != $envioModificado->getCedulaDestinatario()){
			$comentario .= "<li> CI o RIF del destinatario de: ".$envioOriginal->getCedulaDestinatario()." a: ".$envioModificado->getCedulaDestinatario()." </li>";
		}
		if($envioOriginal->getDireccionDestino() != $envioModificado->getDireccionDestino()){
			$comentario .= "<li> Direccion de envio de: ".$envioOriginal->getDireccionDestino()." a: ".$envioModificado->getDireccionDestino()." </li>";
		}
		if($envioOriginal->getCiudadDestino() != $envioModificado->getCiudadDestino()){
			$comentario .= "<li> Ciudad de envio de: ".$envioOriginal->getCiudadDestino()." a: ".$envioModificado->getCiudadDestino()." </li>";
		}
		if($envioOriginal->getEstadoDestino() != $envioModificado->getEstadoDestino()){
			$comentario .= "<li> Estado de envio de: ".$envioOriginal->getEstadoDestino()." a: ".$envioModificado->getEstadoDestino()." </li>";
		}
		if($envioOriginal->getTlfCelularDestinatario() != $envioModificado->getTlfCelularDestinatario()){
			$comentario .= "<li> TlfCelular del destinatario de: ".$envioOriginal->getTlfCelularDestinatario()." a: ".$envioModificado->getTlfCelularDestinatario()." </li>";
		}
		if($envioOriginal->getTlfLocalDestinatario()!= $envioModificado->getTlfLocalDestinatario()){
			$comentario .= "<li> TlfLocal del destinatario de: ".$envioOriginal->getTlfLocalDestinatario()." a: ".$envioModificado->getTlfLocalDestinatario()." </li>";
		}
		if($envioOriginal->getObservacionesEnvio()!= $envioModificado->getObservacionesEnvio()){
			$comentario .= "<li> Observaciones del envio de: ".$envioOriginal->getObservacionesEnvio()." a: ".$envioModificado->getObservacionesEnvio()." </li>";
		}
		
		if($comentario == ""){
			$comentario = "Se actualizo el envio, pero sin modificar ninguno de sus valores";
		}else {
			$comentario = "Fueron cambiados los siguientes valores <ul>".$comentario." </ul>";
		}
		
		EnvioDAO::addComment($idEnvio,
			 $comentario,
			 "null",
			 Constants::$STATUS_INICIAL_ENVIOS);
	}
}
?>
<script type="text/javascript">
	<?php if($code == 0) {?>
		alert("Su informacion fue actualizada de manera exitosa.");
		window.location = "index.php";
	<?php } else {?>
		alert("<?php echo $msgError;?>");
		window.history.back();
	<?php }?>
</script>