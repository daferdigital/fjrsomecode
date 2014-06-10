<?php
include ("classes/Constants.php");

session_start();
session_unset();
session_destroy();

$_SESSION[Constants::$KEY_MESSAGE_OPERATION]="Gracias por utilizar el sistema";

header("Location: index.php");
?>