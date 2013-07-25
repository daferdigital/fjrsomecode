<?php
class SessionUtil {
	public static $KEY_USER_LOGGED = "userIsLogged";
	
	/**
	 * return boolean (true if user is logged, false otherwise)
	 */
	public static function checkIfUserIsLogged(){
		if(isset($_SESSION[SessionUtil::$KEY_USER_LOGGED])){
			return $_SESSION[SessionUtil::$KEY_USER_LOGGED];
		}
		
		return false;
	}
}
?>