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
	public static $OPCION_LOGS_TRANSACCIONES = "transacciones";
	public static $OPCION_LOGS_SISTEMA = "sistema";
	public static $OPCION_ADMIN_PERMISOS = "permisos";
	public static $OPCION_ADMIN_CREAR_USUARIO = "crear_usuario";
	public static $OPCION_ADMIN_MODIFICAR_USUARIO = "modificar_usuario";
	public static $OPCION_ADMIN_ELIMINAR_USUARIO = "eliminar_usuario";
	public static $OPCION_PERFIL = "perfil";
	
	//constantes en session
	public static $KEY_USUARIO_DTO = "usuario";
	public static $KEY_MESSAGE_OPERATION = "messageOperation";
	public static $KEY_MESSAGE_ERROR = "messageError";
	
	//textos del sistema
	public static $TEXT_ACCESS_DENIED = "Disculpe, usted no tiene permiso para ingresar a este modulo.<br />En caso de necesitarlo, comuniquese con el administrador";
}
?>