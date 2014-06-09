<?php
	session_start();
	
	if(PageAccess::userIsLogged()){
		if(isset($_SESSION[Constants::$KEY_LAST_TIME_SESSION])){
			//tenemos un tiempo registrado para nuestra ultima accion en el sitio
			//vemos si no nos excedimos de nuestra maxima inactividad configurada
			$time0 = $_SESSION[Constants::$KEY_LAST_TIME_SESSION];
			$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
			//el tiempo esta almacenado en minutos, lo llevamos a segundos
			$maxTime = $userDTO->getTiempoSesion() * 60; 
			
			if((time() - $time0) > $maxTime) {
				//tengo inactivo mas tiempo del permitido, limpio la sesion
				session_unset();
				$_SESSION[Constants::$KEY_MESSAGE_ERROR] = Constants::$TEXT_SESSION_EXPIRED;
				header("Location: index.php");
				exit();
			}
		}
	}
	
	$_SESSION[Constants::$KEY_LAST_TIME_SESSION] = time();
?>