<?php
//vemos el status del envio para saber
//a que pagina debemos cargar
include_once "../sis/classes/Constants.php";
include_once "../sis/classes/DBUtil.php";
include_once "../sis/classes/EnvioDAO.php";
include_once "../sis/classes/EnvioDTO.php";

$envioDTO = EnvioDAO::getEnvioInfo($_GET["id"], true);
if(EnvioDAO::$COD_STATUS_NOTIFICADO == $envioDTO->getIdStatusActual()
		|| EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO == $envioDTO->getIdStatusActual()){
	header("Location: actualizarNotifNoEnc.php?id=".$envioDTO->getIdEncriptado());
} else if(EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO == $envioDTO->getIdStatusActual()){
	header("Location: actualizarPagoConfirmado.php?id=".$envioDTO->getIdEncriptado());
} else if(EnvioDAO::$COD_STATUS_PRESUPUESTADO == $envioDTO->getIdStatusActual()
		|| EnvioDAO::$COD_STATUS_FACTURADO == $envioDTO->getIdEncriptado()){
	header("Location: actualizarPresupuestadoFacturado.php?id=".$envioDTO->getId());
} else {
?>
	<script>
		alert("Disculpe, la transaccion que desea actualizar ya fue completamente procesada");
		window.location = "index.php";
	</script>
<?php
}
?>