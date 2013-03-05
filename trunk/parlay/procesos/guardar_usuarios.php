<?Php session_start();
include("conexion.php");

$accion1=$_GET["accion"];
$idusuario1=$_GET["idu"];
$limpia1=$_POST["limpia"];
$agrega1=$_POST["B4"];
echo '<hr>'.$agrega1;
if($accion1=='ED'){	
	$sql=mysql_query("select * from usuario where idusuario=$idusuario1");
  	if ($row=mysql_fetch_array($sql)){
		do { 
			$nombre1=$row["nombre"];
			$telefono1=$row["telefono"];
			$direccion1=$row["direccion"];
			$email1=$row["email"];
			$clave1=$row["clave"];
			$usuario1=$row["usuario"];			
			$estatus1=$row["estatus"];
			$tipo1=$row["tipo"];			
		}while($row=mysql_fetch_array($sql));
	}
}
	else if($accion1=='ELM'){
		$sql=mysql_query("delete from usuario where idusuario=$idusuario1");
	}else{}

$usuario_insert=$_POST["id_usuario_insert"];
$nombreI=$_POST["nombres"];
$telefonoI=$_POST["telefono"];
$emailI=$_POST["email"];
$direccionI=$_POST["direccion"];
$usuarioI=$_POST["usuario"];
$claveI=$_POST["clave"];
$tipoI=$_POST["tipo"];
$idperfilI="1";
$estatusI=$_POST["estatus"];
$condificionI=$_POST["id"];


if($agrega1=="Editar Usuario" and $usuario_insert>="1"){
////es update	

		$sql="UPDATE usuario SET nombre='$nombreI', telefono='$telefonoI', email='$emailI', direccion='$direccionI', usuario='$usuarioI',
			clave='$claveI', tipo='$tipoI', idperfil='$idperfilI', estatus='$estatusI', condicion_esp='$condificionI' WHERE idusuario='$usuario_insert'";
			mysql_query($sql) or die("Error en consulta <br>MySQL dice: ".mysql_error());?>
			<script>alert("Acaba de editar un usuario de forma exitosa");</script><?

}else if($usuarioI!='' and $agrega1=='Agregar Usuario'){

////es insert	
	$query_revisa="select * from usuario where usuario='$usuarioI'";
	$query_revisa1 = mysql_query($query_revisa,$conexion);
	
	if($row2=mysql_fetch_array($query_revisa1)){?>
	    <script>alert("El Usuario que intenta ingresar ya Existe");</script><? 
	} else {
		$sql="insert into usuario (`nombre`, `telefono`, `email`, `direccion`, `usuario`, `clave`, `tipo`, `idperfil`, `estatus`, `condicion_esp`) 
		values ('$nombreI', '$telefonoI', '$emailI', '$direccionI', '$usuarioI', '$claveI', '$tipoI', '$idperfilI', '$estatusI', '$condificionI')";
		mysql_query($sql) or die("Error en consulta <br>MySQL dice: ".mysql_error());?>
	    <script>alert("Acaba de crear un usuario de forma exitosa");</script><?
	}

}else if($limpia1=='Limpiar Campos'){
			$nombre1='';
			$telefono1='';
			$direccion1='';
			$email1='';
			$clave1='';
			$usuario1='';			
			$estatus1='';
			$tipo1='';
			$usuario_insert='';
}else{}?>