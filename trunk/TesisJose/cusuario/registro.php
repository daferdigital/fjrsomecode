<?php
//conexión con la base de datos
$conexion=mysql_connect("localhost","root","");

//Selección de la base de datos.

mysql_select_db("registro1",$conexion);
//Recibimos lo que ingresó por teclado el usuario y lo asignamos a un variable para un mejor manejo
$login=$_POST["login2"];
$clave=$_POST["clave2"];
//Una vez recibidos el valor de cada campo, lo ingresaremos en la base de datos
mysql_query("insert into usuario(login,clave) values('$login','$clave')",$conexion) or die (mysql_error());
//Le mencionamos al usuario que se ha registrado correctamente.
echo 'Te has registrado con éxito.';
?>