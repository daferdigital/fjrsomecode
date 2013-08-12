<?php
class SessionUtil {
	public static $KEY_USER_LOGGED = "userIsLogged";
	public static $KEY_LAST_USER_ACTIVITY = "userInactivity";
	
	/**
	 * return boolean (true if user is logged, false otherwise)
	 */
	public static function checkIfUserIsLogged(){
		if(isset($_SESSION[SessionUtil::$KEY_USER_LOGGED])){
			return $_SESSION[SessionUtil::$KEY_USER_LOGGED];
		}
		
		return false;
	}
	
	/**
	 * 
	 * @param int $userTimeout tiempo maximo de inactividad permitido en minutos
	 */
	public static function userReachInactivity(){
		$userReachInactivity = false;
		
		if(isset($_SESSION[SessionUtil::$KEY_LAST_USER_ACTIVITY])){
			$time0 = $_SESSION[SessionUtil::$KEY_LAST_USER_ACTIVITY];
			$maxTime = $_SESSION[Constants::$KEY_USUARIO_DTO]->getTiempoSesion() * 60;
			
			if((time() - $time0) > $maxTime) {
				//tengo inactivo mas tiempo del permitido, limpio la sesion
				session_unset();
				$userReachInactivity = true;
				$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = Constants::$TEXT_SESSION_EXPIRED;
			}
		}
		
		$_SESSION[SessionUtil::$KEY_LAST_USER_ACTIVITY] = time();
		
		return $userReachInactivity;
	}
}
?>