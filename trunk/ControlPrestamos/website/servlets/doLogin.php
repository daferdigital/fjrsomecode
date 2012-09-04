<?php
	if(isset($_POST['user']) && isset($_POST['password'])){
		//tenemos login y pwd
		include_once "../includes/dbConnection.php";
		include_once '../includes/sessionOperations.php';
		
		$login = $_POST['user'];
		$pwd = $_POST['password'];
		
		$sqlCheckLogin = "SELECT COUNT(*) FROM users WHERE login='".$login."'";
		$sqlCheckLoginPwd = "SELECT rol FROM users WHERE login='".$login."' AND password='".$pwd."'";
		$conexion = getConnection();
		
		$consulta = mysql_query($sqlCheckLogin, $conexion);
		list($count) = mysql_fetch_array($consulta);
		if($count == 1){
			$consulta = mysql_query($sqlCheckLoginPwd, $conexion);
			list($rol) = mysql_fetch_array($consulta);
		
			if($rol){
				//login valido
				putLoggedUserInSession($login, $rol);
				header( 'Location: ../afterLogin.php') ;
			} else {
				header( 'Location: ../index.php?message=E-0002') ;
			}
		}else {
			header( 'Location: ../index.php?message=E-0001') ;
		}
		
		mysql_close($conexion);
	} else {
		header( 'Location: ../index.php?message=E-0003') ;
	}
?>
