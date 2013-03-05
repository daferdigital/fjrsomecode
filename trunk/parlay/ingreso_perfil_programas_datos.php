<?
include_once("procesos/conexion.php");

$id_perfil_programa1=$_POST["id_perfil_programa"];
$mod_padre=$_POST["modulo_padre"];
$programa_nom=$_POST["nombre_programa"];
$programa_archivo=$_POST["archivo"];
$orden=$_POST["orden"];
$btnAccion=$_POST["accion"];

// DESARROLLAR LA LOGICA DE LOS BOTONES
  switch($btnAccion){
    case 'Agregar':
		$query_revisa="select * from perfil_programas where programa_archivo='$programa_archivo'";
		$query_revisa1 = mysql_query($query_revisa,$conexion);
		
		if($row2=mysql_fetch_array($query_revisa1)){?>
			<script>alert("El Programa que ingresar ya Existe");</script><? 
		} else {	
			$sql="insert into perfil_programas (`id_perfil_padre`, `nombre_programa`, `programa_archivo`, `orden`) 
			values ('$mod_padre', '$programa_nom', '$programa_archivo', '$orden')";
			mysql_query($sql) or die("Error en consulta <br>MySQL dice: ".mysql_error());
			echo ("<center>Acaba de agregar un nuevo programa</center>");
		}
		break;
    case 'Editar':
		$sql="UPDATE perfil_programas SET id_perfil_padre='$mod_padre', nombre_programa='$programa_nom', programa_archivo='$programa_archivo', 
		orden='$orden'
		WHERE id_perfil_programa='$id_perfil_programa1'";
		mysql_query($sql) or die("Error en consulta <br>MySQL dice: ".mysql_error());
		echo "<center>Acaba de Editar un Programa</center>";

	break;
	/*
    case 'Limpiar':
			$nombre1='';
			$telefono1='';
			$direccion1='';
			$email1='';
			$clave1='';
			$usuario1='';		
	break;	*/
  }
  ?><script languaje='javascript'>location.href='ingreso_perfil_programas.php';</script>