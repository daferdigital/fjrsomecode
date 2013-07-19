<?php
//conexión con la base de datos.
$conexion=mysql_connect("localhost","root","");

//Selección de la base de datos.

mysql_select_db("registro1",$conexion);
//Recibimos lo que ingresó por teclado el usuario y lo asignamos a un variable para un mejor manejo
$login=$_POST["login"];
$clave=$_POST["clave"];
//Buscamos en la tabla si existe un usuario con ese login y esa clave
$registrado=mysql_query("select login,clave from usuario where login='$login' and clave='$clave'",$conexion) or die (mysql_error());
//Si existe un usuario con ese login y esa clave le damos una session 
if($usuario=mysql_fetch_array($registrado))
{
//Le damos una coockie que se guarda en su computadora que será igual al su nombre de nick.
setcookie("usuario",$usuario['login'],time()+7776000);
setcookie("contrasena",$usuario['clave'],time()+7776000);
//Le mencionamos al usuario que ha iniciado correctamente.
echo 'Has iniciado sesión con éxito.';
}
//Si no existe no existen esos datos en la tabla, le decimos que no son correctos
else
{
echo 'Los datos ingresados no son correctos.';
}
?>