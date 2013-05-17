<?php
include_once '../sis/classes/DBUtil.php';
include_once '../sis/classes/BitacoraDAO.php';

$query = "UPDATE envios SET "
.", nombre_destinatario='".$_POST["destinatario"]."'"
.", cedula_destinatario='".$_POST["ciDestinatario"]."'"
.", direccion_destino='".$_POST["dir1"]."'"
.", ciudad_destino='".$_POST["ciudad"]."'"
.", estado_destino='".$_POST["estado"]."'"
.($_POST["celular"] == "" ? "" : ", tlf_celular_destinatario='".$_POST["codcel"]."-".$_POST["celular"])."'"
.($_POST["tlfLocalDestinatario"] == "" ? "" : ", tlf_local_destinatario='".$_POST["codLocalDestinatario"]."-".$_POST["tlfLocalDestinatario"])."'"
.", observaciones_envio='".$_POST["obs"]."'"
.", id_empresa_envio=".$_POST["envio"]
." WHERE id=".$_POST["id"];

$code=0;
if(! DBUtil::executeQuery($query)){
	$code=1;
}
?>
<script type="text/javascript">
	<?php if($code == 0) {?>
		alert("Su informacion fue actualizada de manera exitosa.");
	<?php } else {?>
		alert("Disculpe, hubo un problema procesando su solicitud, por favor intente mas tarde.");
	<?php }?>
	window.location = "index.php";
</script>