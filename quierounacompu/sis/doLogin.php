<?php
include_once("classes/BitacoraDAO.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/UsuarioDTO.php");
include_once("includes/session.php");

$login = $_POST["login"];
$clave = $_POST["clave"];

$usuarioDAO = new UsuarioDAO();
$usuarioDTO = $usuarioDAO->getUserDoingLogin($login, $clave);

if($usuarioDTO != null){
	$_SESSION["isLogged"] = true;
	$_SESSION["usuario"] = $usuarioDTO;
	
	BitacoraDAO::registrarComentario("Ejecucion de login exitoso en el sistema para el usuario [".$usuarioDTO->getLogin()."]");
	header("location: mainMenu.php");
}else {
	$_SESSION["messageError"] = "Credenciales inv&aacute;lidas, favor intente de nuevo";
	unset ($_SESSION["usuario"]);
	$_SESSION["isLogged"] = false;
	header("location: index.php");
}
?>