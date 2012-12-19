<?php
	session_start();
	$_SESSION["activo"] = 1;
	$_SESSION["usuario"] = 1315;
	
	echo "Valores en session <br />";
	print_r($_SESSION);
?>