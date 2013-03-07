<?php
include "../sis/classes/DBUtil.php";
include "../sis/classes/Constants.php";

if(isset($_POST["terminos"])){
	//puedo proceder a guardar el pago
	
	$query = "INSERT INTO envios
(seudonimo_ml,
nombre_completo,
ci_rif,
correo,
detalle_compra,
num_voucher,
fecha_pago,
monto_pago,
nombre_destinatario,
direccion_destino,
ciudad_destino,
estado_destino,
tlf_celular_destinatario,
tlf_local_destinatario,
observaciones_envio,
id_medio_pago,
id_banco,
id_empresa_envio,
id_status_actual)
VALUES
('".$_POST["seudonimo"]."',
'".$_POST["nombre"]."',
'".$_POST["ci"]."-".$_POST["cii"]."',
'".$_POST["email"]."',
'".$_POST["articulo"]."',
'".$_POST["bauche"]."',
'".$_POST["fechaPago"]."',
".$_POST["monto"].",
'".$_POST["destinatario"]."',
'".$_POST["dir1"]."',
'".$_POST["ciudad"]."',
'".$_POST["estado"]."',
'".($_POST["celular"] == "" ? "" : $_POST["codcel"]."-".$_POST["celular"])."',
'".($_POST["fono"] == "" ? "" : $_POST["codfono"]."-".$_POST["fono"])."',
'".$_POST["obs"]."',
".$_POST["medio"].",
".$_POST["banco"].",
".$_POST["envio"].",
".Constants::$STATUS_INICIAL_ENVIOS.")";
	
	if(DBUtil::executeQuery($query)){
		//enviamos el correo
		$from = "pagos@quierounacompu.com";
		
		$headers = "From: " . $from . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		
		$message = file_get_contents("emailTemplate.html");
		
		mail($_POST["email"], 
			"Pago notificado",
			$message,
			$headers);
		
		header("Location: index.php?e=0000");
	} else {
		header("Location: index.php?e=0001");
	}
}
?>