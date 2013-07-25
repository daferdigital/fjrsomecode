<?php
class Constants {
	//constantes en session
	public static $KEY_USUARIO_DTO = "usuario";
	public static $KEY_MESSAGE_OPERATION = "messageOperation";
	public static $KEY_MESSAGE_ERROR = "messageError";
	public static $KEY_LAST_TIME_SESSION = "lastSessionTime";
	public static $KEY_USER_ID = "userId";
	public static $KEY_MODULE_TO_REDIRECT = "moduleToRedirect";
	
	//constantes en el POST
	public static $PAGE_NUMBER = "pageNumber";
	public static $SCRIPT_FUNCTION = "scriptFunction";
	
	//textos del sistema
	public static $TEXT_ACCESS_DENIED = "Disculpe, usted no tiene permiso para ingresar a este modulo.<br />En caso de necesitarlo, comuniquese con el administrador";
	public static $TEXT_MUST_BE_LOGGED = "Disculpe para realizar esta operaci&oacute;n primero debe loguearse en el sistema.";
	public static $TEXT_SESSION_EXPIRED = "Disculpe, su sesi&oacute;n ha expirado.<br/>Por favor ingrese de nuevo al sistema.";
	public static $TEXT_UNKNOWN_ACCESS = "Disculpe, modo de acceso desconocido.<br />Comuniquese con el Administrador.";
	public static $TEXT_NO_PAGE_RECORDS = "No se encontraron registros que coincidan con sus criterios de b&uacute;squeda";
}
?>