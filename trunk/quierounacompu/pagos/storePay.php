<?php
include_once "../sis/classes/Constants.php";
include_once "../sis/classes/DBUtil.php";
include_once "../sis/classes/EnvioDAO.php";
include_once "../sis/classes/BitacoraDAO.php";
include_once "../sis/classes/SendEmail.php";

$medioMercadoPago = 5;
$response = -1;

$query = "SELECT * FROM envios"
." WHERE num_voucher='".$_POST["bauche"]."'";
if($_POST["medio"] != $medioMercadoPago){
	$query .= " AND id_banco=".$_POST["banco"];
}

$cuenta = DBUtil::getRecordCountToQuery($query);
if($cuenta > 0){
	$response = 2;
}

if(isset($_POST["terminos"]) && $cuenta == 0){
	//puedo proceder a guardar el pago
	$response = 0;
	
	//print_r($_POST);
	
	$query = "INSERT INTO envios
	(seudonimo_ml,
	nombre_completo,
	ci_rif,
	correo,
	tlf_cliente,
	tlf_local_cliente,
	detalle_compra,
	num_voucher,
	fecha_pago,
	fecha_registro,
	monto_pago,
	nombre_destinatario,
	cedula_destinatario,
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
	'".($_POST["tlfCelularCliente"] == "" ? "" : $_POST["codCelCliente"]."-".$_POST["tlfCelularCliente"])."',
	'".($_POST["tlfLocalCliente"] == "" ? "" : $_POST["codLocalCliente"]."-".$_POST["tlfLocalCliente"])."',
	'".$_POST["articulo"]."',
	'".$_POST["bauche"]."',
	'".$_POST["fechaPagoHidden"]."', "
	."NOW(), "
	.$_POST["monto"].",
	'".$_POST["destinatario"]."',
	'".$_POST["ciDest"]."-".$_POST["ciDestinatario"]."',
	'".$_POST["dir1"]."',
	'".$_POST["ciudad"]."',
	'".$_POST["estado"]."',
	'".($_POST["celular"] == "" ? "" : $_POST["codcel"]."-".$_POST["celular"])."',
	'".($_POST["tlfLocalDestinatario"] == "" ? "" : $_POST["codLocalDestinatario"]."-".$_POST["tlfLocalDestinatario"])."',
	'".$_POST["obs"]."',
	".$_POST["medio"].",
	".($_POST["medio"] == 5 ? 4 : $_POST["banco"]).",
	".$_POST["envio"].",
	".Constants::$STATUS_INICIAL_ENVIOS.")";

	$lastId = DBUtil::executeQueryAndReturnLastId($query);
	if($lastId > 0){
		//guardamos la posible imagen del comprobante de pago
		//print_r($_FILES);
		if(isset($_FILES["archivoTransferencia"])
				&& $_FILES["archivoTransferencia"]["error"] == "0"){
			//subio el archivo, lo copiamos entonces
			$dir = "../sis/comprobantes/".$lastId;
			mkdir($dir);
			copy($_FILES["archivoTransferencia"]["tmp_name"],
				$dir."/".$_FILES["archivoTransferencia"]["name"]);
		}
		
		//registro el primer comentario
		$query = "INSERT INTO envios_comentarios(fecha_comentario, comentario, id_status_envio, id_envio)"
				." VALUES(NOW(),'Comprador acaba de registrar esta compra',".EnvioDAO::$COD_STATUS_NOTIFICADO.",".$lastId.");";
		DBUtil::executeQuery($query);
		
		//enviamos el correo
		$message = file_get_contents("../sis/emailTemplates/templatePagoRegistrado.html");
		$message = str_replace("{0}", $_POST["nombre"]." (".$_POST["seudonimo"].")", $message);
		
		SendEmail::sendMail($_POST["email"], 
			SendEmail::$SUBJECT_PAGO_REGISTRADO, 
			$message);
	} else {
		$response = 1;
	}
}
?>
<script type="text/javascript">
	if(<?php echo $response;?> == 0){
		var msg = 'Gracias por completar la información, en breve le será enviado un email con todos los datos para su archivo.';
		alert(msg);
		window.location = "index.php";
	} else if(<?php echo $response;?> == -1){
		var msg = "Disculpe, necesitamos que acepte los terminos y condiciones";
		alert(msg);
		window.history.back();
	} else if(<?php echo $response;?> == 1){
		var msg = "Disculpe, la informacion suministrada no pudo ser almacenada. Por favor intente de nuevo";
		alert(msg);
		window.history.back();
	} else if(<?php echo $response;?> == 2){
		var msg = "Disculpe, ya tenemos registrado un pago con ese codigo de vauche, por favor verifique e intente de nuevo";
		alert(msg);
		window.history.back();
	}
</script>