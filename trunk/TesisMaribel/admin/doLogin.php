<?php
session_start();

include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';

$query = "SELECT nombre FROM usuario WHERE login='".$_POST["login"]."' AND clave='".$_POST["clave"]."'";
$result = DBUtil::executeSelect($query);

if($result[0]["nombre"] == null || $result[0]["nombre"] == ""){
	//el usuario no existe para esas credenciales
	unset($_SESSION["nombre"]);
	$_SESSION["invalidLogin"] = true;
	header("Location: index.php");
}else{
	$_SESSION["nombre"] = $result[0]["nombre"];
	unset($_SESSION["invalidLogin"]);
	header("Location: logged.php");
}
?>