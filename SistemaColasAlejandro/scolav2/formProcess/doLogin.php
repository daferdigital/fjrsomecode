<?php
include_once("../classes/Constants.php");
include_once("../classes/BitacoraDAO.php");
include_once("../classes/UsuarioDAO.php");
include_once("../classes/UsuarioDTO.php");
include_once("../classes/PageAccess.php");
include_once("../includes/session.php");

$login = $_POST["login"];
$clave = $_POST["clave"];

$usuarioDTO = UsuarioDAO::getUserDoingLogin($login, $clave);

if($usuarioDTO != null){
	if($usuarioDTO->getActive() != "1"){
		$_SESSION[Constants::$KEY_MESSAGE_ERROR] = "Esta cuenta se encuentra inactiva.";
		
		BitacoraDAO::registrarComentario("Intento de login con cuenta [".$usuarioDTO->getLogin()."] que no se encuentra activa");
		header("location: ../index.php");
	} else {
		$_SESSION[Constants::$KEY_USUARIO_DTO] = $usuarioDTO;
		
		BitacoraDAO::registrarComentario("Ejecucion de login exitoso en el sistema para el usuario [".$usuarioDTO->getLogin()."]");
		//vemos si el usuario es del tipo terminal para enviarlo directo a esa pagina
		if(Constants::$TIPO_USUARIO_OPERADOR == $usuarioDTO->getTipoUsuario()){
			header("Location: ../taquillas.php", true);
		} elseif(Constants::$TIPO_USUARIO_TERMINAL == $usuarioDTO->getTipoUsuario()){
			header("Location: ../terminal.php", true);
		} else {
			header("Location: ../mainMenu.php");
		}
	}
}else {
	$_SESSION[Constants::$KEY_MESSAGE_ERROR] = "Credenciales inv&aacute;lidas, favor intente de nuevo";
	unset ($_SESSION[Constants::$KEY_USUARIO_DTO]);
	header("location: ../index.php");
}
?>