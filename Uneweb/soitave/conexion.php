<?php
	$conexion = mysql_connect("localhost", "uneweb", "uneweb1006");
	mysql_select_db("uneweb", $conexion);
	
	if(mysql_error()){
		die("Error conectando a la base de datos: ".mysql_error());
	}
?>