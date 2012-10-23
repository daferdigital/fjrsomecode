<?php

/**
 * @author David Antunes
 * @project 3WEditable - 2009
 */

session_start();

include "conexion.php";
extract($_REQUEST);

/*Determinacion de botones*/
$linkp= "";
			
if(isset($_REQUEST[b])){
	$linkp= "&b=$_REQUEST[b]&mira=$mira";				
}else if(isset($_REQUEST[s])){
	$linkp= "&s=$_REQUEST[s]&mira=$mira";
}

$pass=md5($_REQUEST[clave]);

$sql="select id,login,nombre,apellido,cedula, telefono from clientes 
	  where login='$_REQUEST[login]' and clave='$pass' and status='1'";
$consulta=mysql_query($sql,$conexion);

if($fila=mysql_fetch_array($consulta)) {
	
	$_SESSION[codigo]=$fila[0];
	$_SESSION[nombre]=$fila[2];
	$_SESSION[tnombre]=$fila[2]." ".$fila[3];
	$_SESSION[cedula]=$fila[4];
	$_SESSION[usuario]=1315;
	$_SESSION[tel]=$fila[5];
	$_SESSION[login]= 1;
	
	if($op==3){
		header("location:formulario3.php?$linkp");
	}else{
		header("location:formulario3.php?$linkp");
	}

}else { 
	header("location:formulario2.php?op=$op&error=1$linkp#Mlogin");
}
?>