<?php
class Constants {
	public static $CATEGORIA_BUSQUEDA = "busqueda";
	public static $CATEGORIA_ADMINISTRACION = "administracion";
	public static $CATEGORIA_LOGS = "logs";
	
	public static $OPCION_BUSQUEDA_NOTIFICADOS = "notificados";
	public static $OPCION_BUSQUEDA_PAGOS_CONFIRMADOS = "pago_confirmado";
	public static $OPCION_BUSQUEDA_PAGOS_NO_ENCONTRADOS = "pago_no_encontrado";
	public static $OPCION_BUSQUEDA_PRESUPUESTADO = "presupuestado";
	public static $OPCION_BUSQUEDA_FACTURADO = "facturado";
	public static $OPCION_BUSQUEDA_ENVIADO = "enviado";
	public static $OPCION_BUSQUEDA_AVANZADA = "busqueda_avanzada";
	public static $OPCION_EDICION_NOTIFICADOS = "edicion_notificados";
	public static $OPCION_EDICION_PAGOS_CONFIRMADOS = "edicion_pago_confirmado";
	public static $OPCION_EDICION_PAGOS_NO_ENCONTRADOS = "edicion_pago_noencontrado";
	public static $OPCION_EDICION_PRESUPUESTADO = "edicion_presupuestado";
	public static $OPCION_EDICION_FACTURADO = "edicion_facturado";
	public static $OPCION_EDICION_ENVIADO = "edicion_enviado";
	public static $OPCION_LOGS_TRANSACCIONES = "transacciones";
	public static $OPCION_LOGS_SISTEMA = "sistema";
	public static $OPCION_ADMIN_PERMISOS = "permisos";
	public static $OPCION_ADMIN_CREAR_USUARIO = "crear_usuario";
	public static $OPCION_ADMIN_MODIFICAR_USUARIO = "modificar_usuario";
	public static $OPCION_ADMIN_REACTIVAR_USUARIO = "reactivar_usuario";
	public static $OPCION_ADMIN_ELIMINAR_USUARIO = "eliminar_usuario";
	public static $OPCION_PERFIL = "perfil";
	
	public static $STATUS_INICIAL_ENVIOS = "1";
	
	//constantes en session
	public static $KEY_USUARIO_DTO = "usuario";
	public static $KEY_MESSAGE_OPERATION = "messageOperation";
	public static $KEY_MESSAGE_ERROR = "messageError";
	public static $KEY_LAST_TIME_SESSION = "lastSessionTime";
	public static $KEY_USER_ID = "userId";
	public static $KEY_MODULE_TO_REDIRECT = "moduleToRedirect";
	
	//constantes para tipos de usuario
	public static $TIPO_USUARIO_ADMIN = 1;
	public static $TIPO_USUARIO_TERMINAL = 2;
	public static $TIPO_USUARIO_OPERADOR = 3;
	
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