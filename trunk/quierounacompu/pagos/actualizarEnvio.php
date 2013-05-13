<?php
//vemos el status del envio para saber
//a que pagina debemos cargar
include_once "../sis/classes/Constants.php";
include_once "../sis/classes/DBUtil.php";
include_once "../sis/classes/EnvioDAO.php";
include_once "../sis/classes/EnvioDTO.php";

$envioDTO = EnvioDAO::getEnvioInfo($_GET["id"]);
if(EnvioDAO::$COD_STATUS_NOTIFICADO == $envioDTO->getIdStatusActual()
		|| EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO == $envioDTO->getIdStatusActual()){
	header("Location: index.php?id=".$envioDTO->getId());
} else if(EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO == $envioDTO->getIdStatusActual()){
	header("Location: actualizarPagoConfirmado.php?id=".$envioDTO->getId());
} else if(EnvioDAO::$COD_STATUS_PRESUPUESTADO == $envioDTO->getIdStatusActual()){
	header("Location: actualizarPresupuestado.php?id=".$envioDTO->getId());
} else if(EnvioDAO::$COD_STATUS_FACTURADO == $envioDTO->getIdStatusActual()){
	header("Location: actualizarFacturado.php?id=".$envioDTO->getId());
}
?>