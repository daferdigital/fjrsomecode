<?php
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
		header("location: ../mainMenu.php");
	}
}else {
	$_SESSION[Constants::$KEY_MESSAGE_ERROR] = "Credenciales inv&aacute;lidas, favor intente de nuevo";
	unset ($_SESSION[Constants::$KEY_USUARIO_DTO]);
	header("location: ../index.php");
}
?>