<?php
	/**
	 * Funcion para revisar si existe informacion de login para este usuario
	 * Solo se revisara la sesion si estamos accesando a una pagina distinta de index.php
	 * 
	 * @return boolean
	 */
	function checkSessionInfo(){
		session_start();
		$requestedPage = strrchr($_SERVER["SCRIPT_NAME"], "/");
		//vemos si estamos solicitando la pagina index.php
		//en ese caso, no revisamos sesion ya que el usuario se va a loguear
		
		if($requestedPage != '/index.php'){
			if(! sessionEnd()){
				if(! isset($_SESSION["loggedUser"])){
					header( 'Location: ./index.php?message=E-0004');
				}
			} else {
				header( 'Location: ./index.php?message=E-0005');
			}
		}
	}
	
	/**
	 * Verifica que el periodo de inactividad para la sesion no haya sido
	 * alcanzado, en caso de ser alcanzado la sesion ya termino.
	 * 
	 * @return boolean: true si la sesion termino, false en caso contrario
	 */
	function sessionEnd(){
		$sessionEnd = false;
		
		if(isset($_SESSION['timeout'])){
			// 10 mins in seconds
			$inactive = 600;
			$session_life = time() - $_SESSION['timeout'];
			
			if($session_life > $inactive) {
				session_destroy();
				$sessionEnd = true;
			}
		}
		
		if(! $sessionEnd){
			$_SESSION['timeout'] = time();
		}
		
		return $sessionEnd;
		
	}
	
	/**
	 * 
	 * @param string $login
	 * @param string $rol
	 */
	function putLoggedUserInSession($login, $rol){
		session_start();
		$_SESSION["loggedUser"] = array("login" => $login,
				"rol" => $rol);
	}
?>