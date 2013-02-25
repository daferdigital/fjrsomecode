<?php
include_once("includes/session.php");
include_once("classes/UsuarioDAO.php");

$login = $_POST["login"];
$clave = $_POST["clave"];

$usuarioDAO = new UsuarioDAO();
$usuarioDTO = $usuarioDAO->getUserDoingLogin($login, $clave);

if($usuarioDTO != null){
	$_SESSION["isLogged"] = true;
	$_SESSION["usuario"] = $usuarioDTO;
	header("location: mainMenu.php");
}else {
	$_SESSION["messageError"] = "Credenciales inv&aacute;lidas, favor intente de nuevo";
	unset ($_SESSION["usuario"]);
	$_SESSION["isLogged"] = false;
	header("location: index.php");
}
?>