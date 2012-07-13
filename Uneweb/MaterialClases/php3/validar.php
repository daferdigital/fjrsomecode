<?php
session_start();
include("incluir/conexion.php");

switch($_POST['id']) {
	//// VALIDAR USUARIOS
	case 1:
		if ($_POST['correo'] && $_POST['clave']) {
			$query=mysql_query("SELECT * FROM usuario WHERE correo='".$_POST['correo']."'", $link);
			$row=mysql_fetch_array($query);
			if($_POST['correo']==$row['correo'] && md5($_POST['clave'])==$row['clave']) {
				$_SESSION['activo']=1;
				$_SESSION['id_usuario']=$row['id_usuario'];
				$_SESSION['nombre']=$row['nombre_apellido'];
				$_SESSION['correo']=$row['correo'];
				$_SESSION['cedula']=$row['cedula'];
				$_SESSION['tipo_usuario']=$row['tipo_usuario'];
				if($_SESSION['tipo_usuario']=="Administrador") {
					echo "<script>alert('Bienvenido !!!'); self.location='menu.php';</script>";
				} else {
					echo "<script>alert('Gracias por Ingresar !!!'); self.location='carrito.php';</script>";
				}
			} else { 
				echo "<script>alert('Datos Incorrectos !!!'); self.location='login.php';</script>";
			}
		} else { 
			echo "<script>alert('Debe llenar los campos !!!'); self.location='login.php';</script>";
		}
		
		break;
}
?>