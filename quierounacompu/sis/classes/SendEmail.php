<?php
class SendEmail{
	public static $SUBJECT_PAGO_REGISTRADO = "Hemos recibido la información de tu pago";
	public static $SUBJECT_PAGO_NO_ENCONTRADO = "Por favor, necesitamos que revises la información de tu pago";
	public static $SUBJECT_PEDIDO_ENVIADO = "Hemos enviado tu pedido";
	
	private static $emailFrom = "ventas@quierounacompu.com";
	
	private function SendEmail(){
		
	}
	
	/**
	 * 
	 * @param unknown $mailTo
	 * @param unknown $subject
	 * @param unknown $message
	 * @return boolean
	 */
	public static function sendMail($mailTo, $subject, $message){
		$wasSent = false;
		
		$headers = "From: ".strip_tags(SendEmail::$emailFrom) ."\r\n";
                $headers .= "Cc: ".strip_tags(SendEmail::$emailFrom)."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$subject = "=?ISO-8859-1?B?".base64_encode($subject)."=?=";
		
		$wasSent = mail($mailTo, $subject, $message, $headers);
		
		BitacoraDAO::registrarComentario("Enviado email [".$subject."] a la cuenta ".$mailTo
			." con resultado ".$wasSent);
		
		return $wasSent;
	}
}
?>