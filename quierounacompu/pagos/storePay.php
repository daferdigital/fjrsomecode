<?php
include_once "../sis/classes/Constants.php";
include_once "../sis/classes/DBUtil.php";
include_once "../sis/classes/EnvioDAO.php";
include_once "../sis/classes/BitacoraDAO.php";
include_once "../sis/classes/SendEmail.php";

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
fecha_registro,
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
'".$_POST["fechaPago"]."', "
."NOW(), "
.$_POST["monto"].",
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

	$lastId = DBUtil::executeQueryAndReturnLastId($query);
	if($lastId > 0){
		//registro el primer comentario
		$query = "INSERT INTO envios_comentarios(fecha_comentario, comentario, id_status_envio, id_envio)"
				." VALUES(NOW(),'Comprador acaba de registrar esta compra',".EnvioDAO::$COD_STATUS_NOTIFICADO.",".$lastId.");";
		DBUtil::executeQuery($query);
		
		//enviamos el correo
		$from = "pagos@quierounacompu.com";
		
		$headers = "From: " . $from . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		
		$message = file_get_contents("../sis/emailTemplates/templatePagoRegistrado.html");
		$message = str_replace("{0}", $_POST["nombre"]." (".$_POST["seudonimo"].")", $message);
		
		SendEmail::sendMail($_POST["email"], 
			SendEmail::$SUBJECT_PAGO_REGISTRADO, 
			$message);
		
		header("Location: index.php?e=0000");
	} else {
		header("Location: index.php?e=0001");
	}
}
?>