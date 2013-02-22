<?php
include_once("includes/session.php");
include_once("classes/UsuarioDTO.php");

$login = $_POST["login"];
$clave = $_POST["clave"];

$usuarioDTO = new UsuarioDTO();

if($usuarioDTO->doLogin($login, $clave)){
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