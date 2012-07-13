<?php
session_start();
error_reporting(0);
include("PHP/Clases/oDp_Tabla.php");
include("PHP/Funciones/funciones.php");
$con= new oDp_Tabla();

switch($_REQUEST['id'])
{
	case 1:
		$con->oInsert("cu_visitante");
		$con->oData_in("vis_nombre",$_REQUEST['nombre']);
		$con->oData_in("vis_cedula", $_REQUEST['cedula']);
		$con->oData_in("vis_correo", $_REQUEST['correo']);
		$con->oData_in("vis_telefonos", $_REQUEST['telefonos']);
		$con->oData_in("vis_clave", $_REQUEST['clave']);
		$con->oCommit();
		echo "<script>alert('Usuario Creado Exitosamente');self.location='index.php';</script>";
	break;
	case 2:
		$num=$con->oConsulta("cu_visitante", "vis_cedula='".$_REQUEST['cedula']."' AND vis_correo='".$_REQUEST['correo']."'");
		if(!$num[1])
		{
			echo "<script>alert('No existen datos relacionados con esa información en BD, intente de nuevo');self.location='otros.php?id=2';</script>";
		}
		else
		{
			$row=$con->oDatosarray();
			$con->oLimpiaconsulta();
			$envio=mail($row['vis_correo'], "Envio de Clave - Cupones", "Sr. ".$row['vis_nombre']." su clave secreta es: ".$row['vis_clave']);
			if($envio) echo "<script>alert('Clave enviada a su correo');self.location='index.php';</script>";
			else echo "<script>alert('Fallo al recuperar clave, intente de nuevo');self.location='otros.php?id=2';</script>";
		}
	break;
	case 3:
		if(!$_SESSION['VIS_logeo'])
		{
			echo "<script>alert('Debes Logearte, Para Imprimir un Cupon');self.location='cupon.php?id=".$_REQUEST['id']."';</script>";
		}
		$num=$con->oConsulta("cu_clickimp", "cli_idcup='".$_REQUEST['cup']."' AND cli_idvis='".$_SESSION['VIS_idusuario']."'");
		$con->oLimpiaconsulta();	
		if($num[1] < 4)
		{
			$con->oInsert("cu_clickimp");
			$con->oData_in("cli_fechahora", date("Y-m-d H:i:s"));
			$con->oData_in("cli_ip", $_SERVER['REMOTE_ADDR']);
			$con->oData_in("cli_idcup", $_REQUEST['cup']);
			$con->oData_in("cli_idvis", $_SESSION['VIS_idusuario']);
			$con->oData_in("cli_sessionid", session_id());
			$con->oCommit();
			echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Cupón</title>
			</head>
			<body>
				<img src="'.$_REQUEST['ruta'].'" />';
				echo "<script>window.print(); self.location='index.php';</script>";
			echo '</body>
			</html>';
		}
		else
		{
			echo "<script>alert('Sobre Pasa el Limite de Cupones por Usuario'); self.location='index.php';</script>";
		}
	break;
	case 4:
		$de="admincupones@uneweb.com";
		$para=$_SESSION['VIS_correo'].", ".$_REQUEST['correos'];
		$asunto="Solicitud o Pregunta de Cupones";
		/////MAIL DE CONTACTANOS
		if($_SESSION['VIS_logeo'])
		{
			$texto="Nombre: ".$_SESSION['VIS_nombre']."<br>";
			$texto.="Teléfonos: ".$_SESSION['VIS_telefono']."<br>";
			$texto.="Correo: ".$_SESSION['VIS_correo']."<br>";
			$texto.="Comentario: ".$_REQUEST['comentario'];
			if($_REQUEST['tipo']==1)
			{
				$var=$con->oConsulta("cu_solicitud", "sol_idcup='".$_REQUEST['cupon']."' AND sol_idvis='".$_SESSION['VIS_idusuario']."' AND ISNULL(sol_calificacion)");
				if($var[1])
				{
					$row=$con->oDatosarray();
					
					echo "<script>alert('Debe Calificar su ultima solicitud (Nro ".$row['sol_id'].") relacionada al cupon'); self.location='cupon.php?id=".$_REQUEST['cupon']."';</script>";
				}
				else
				{
					$con->oData_in("sol_fecha", date("Y-m-d H:i:s"));
					$con->oData_in("sol_idcup", $_REQUEST['cupon']);
					$con->oData_in("sol_idcli", $_REQUEST['id_cliente']);
					$con->oData_in("sol_idvis", $_SESSION['VIS_idusuario']);
					$con->oData_in("sol_comentario", $_REQUEST['comentario']);
					$con->oCommit();
					$numero_solicitud=$con->oUltimo();
					$mensaje="<b>SERVICIO</b><br>";
					$mensaje.="Nro Solicitud: ".$numero_solicitud."<br>";
					$mensaje.=$texto;
					///ENVIO
					form_mail($para, $asunto, $mensaje, $de, $archivo=NULL);
					echo "<script>alert('Solicitud Enviada y Almacenada, Por favor anote el Siguiente Nro: ".$numero_solicitud.", Gracias'); self.location='index.php';</script>";
				}
				
			}
			elseif($_REQUEST['tipo']==2)
			{
				$mensaje="<b>PREGUNTA</b><br>".$texto;
				form_mail($para, $asunto, $mensaje, $de, $archivo=NULL);
				echo "<script>alert('Pregunta Enviada, Pronto responderemos su interrogante, Gracias'); self.location='index.php';</script>";
			}
			else
			{
				echo "<script>alert('Flujo Incorrecto'); self.location='index.php';</script>";
			}
		}
		else
		{
			echo "<script>alert('Debe Logearse, Por Favor'); self.location='cupon.php?id=".$_REQUEST['cupon']."';</script>";
		}
	break;
	case 5:
		if(!$_SESSION['VIS_logeo'])
		{
			echo "<script>alert('Debes Logearte, Para Calificar un Cupon');self.location='cupon.php?id=".$_REQUEST['cup']."';</script>";
		}
		elseif($_REQUEST['cup'] &&  $_REQUEST['p'])
		{
			$var=$con->oConsulta("cu_solicitud", "sol_idcup='".$_REQUEST['cup']."' AND sol_idvis='".$_SESSION['VIS_idusuario']."' AND ISNULL(sol_calificacion)");
			if($var[1])
			{
				$con->oData_in("sol_calificacion", $_REQUEST['p']);
				$con->oCommit();
				echo "<script>alert('Calificacion Exitosa, Gracias'); self.location='cupon.php?id=".$_REQUEST['cup']."';</script>";
			}
			else
			{
				echo "<script>alert('Usted: No ha solicitado el cupon o ya califico'); self.location='cupon.php?id=".$_REQUEST['cup']."';</script>";
			}
		}
		else
		{
			echo "<script>alert('Problema con la Calificación, por favor intente de nuevo, Gracias'); self.location='cupon.php?id=".$_REQUEST['cup']."';</script>";
		}
	break;
	case 6:
		$con->oConsulta("cu_usuario", "usu_cedula='".comillas($_REQUEST['cedula'])."'");
		if($_REQUEST['clave']==$_REQUEST['re_clave'])
		{
			$con->oData_in('usu_nombre', $_REQUEST['nombre']);
			$con->oData_in('usu_cedula', $_REQUEST['cedula']);
			$con->oData_in('usu_direccion', $_REQUEST['direccion']);
			$con->oData_in('usu_correo', $_REQUEST['correo']);
			$con->oData_in('usu_telflocal', $_REQUEST['telf_local']);
			$con->oData_in('usu_telfcelular', $_REQUEST['telf_celular']);
			$con->oData_in('usu_idcliente', $_REQUEST['empresa']);
			$con->oData_in('usu_rif', $_REQUEST['rif']);
			$con->oData_in('usu_estado', $_REQUEST['estado']);
			$con->oData_in('usu_municipio', $_REQUEST['municipio']);
			$con->oData_in('usu_ciudad', $_REQUEST['ciudad']);
			$con->oData_in('usu_categoria', $_REQUEST['categoria']);
			$con->oData_in('usu_clave', md5($_REQUEST['clave']));
			$con->oData_in('usu_activo', 0);
			$con->oData_in('usu_admin', 2);
			$con->oCommit();
			echo "<script>alert('Operacion realizada de forma Correcta');self.location='index.php';</script>";
		}
		else
		{
			echo "<script>alert('Claves no coinciden');self.location='index.php';</script>";
		}
	break;
	default:
		echo "<script>alert('Flujo Incorrecto'); self.location='index.php';</script>";
	break;
}


?>