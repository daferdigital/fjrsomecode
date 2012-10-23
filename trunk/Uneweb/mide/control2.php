<?php
session_start();

$_SESSION["usuario"]=1315;
$_SESSION["nombre"] = "Felipe";
$_SESSION["idCliente"] = 1;

header("location: formulario3.php");
?>