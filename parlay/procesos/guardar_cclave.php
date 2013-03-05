<?Php session_start();
		include("conexion.php");
	if($_REQUEST['cnueva']){
		mysql_query("update ".$_SESSION['nombre_tabla']." set clave='".$_REQUEST['cnueva']."' where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' limit 1");
		$_SESSION['datos']['clave']=$_REQUEST['cnueva'];
	}
?>