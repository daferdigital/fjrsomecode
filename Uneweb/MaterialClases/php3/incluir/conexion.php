<?php
//conexion a la Base de Datos
$link = @mysql_connect("localhost","root","root1006") or
die("Error al tratar de conectar: ".mysql_error());	
//seleccion de la Base de Datos
@mysql_select_db("carrito_compra") or
die("Error al tratar de seleccionar la BD: ".mysql_error());

?>
