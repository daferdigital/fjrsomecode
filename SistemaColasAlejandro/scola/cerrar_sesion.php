<?Php
	if($_SESSION['datos']){
		?>
			<div align="right" style="margin:0 auto; width:800px;"><a style="color:#00F; font-size:14px;" href="index.php"><< Regresar al Men&uacute; Principal</a> <strong>| Usuario conectado:</strong> <?Php echo $_SESSION["login_user"];?> <a href="?salir=logout">cerrar sesión</a></div><br>
		<?Php
	}
?>