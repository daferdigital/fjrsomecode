<?Php session_start();
	include('conexion.php');
		foreach($_POST['taq'] as $key=>$valor){
			mysql_query("update taquillas set generar_cookie='".$valor."' where idtaquilla='".$key."' limit 1");
		}
?>
