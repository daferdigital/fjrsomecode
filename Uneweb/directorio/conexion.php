<?php
	mysql_connect("localhost", "uneweb", "uneweb1006");
	$conexion = mysql_select_db("uneweb");
	if(mysql_error()){
		die("Error conectando a la base de datos: ".mysql_error());
	}
?>