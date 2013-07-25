<?php
class UsuarioDAO {
	
	/**
	 * 
	 * @param String $login
	 * 
	 * @return boolean true if login exits false otherwhise
	 * 
	 */
	public static function checkIfLoginExits($login){
		$query = "SELECT * FROM usuario WHERE login = '".$login."'";
		$count = DBUtil::getRecordCountToQuery($query);
		
		if($count > 0){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * @param unknown_type $login
	 * @param unknown_type $pwd
	 * 
	 * @return UsuarioDTO if login and pwd are valid, false otherwise
	 */
	public static function validateUserLoginAndPwd($login, $pwd){
		$query = "SELECT * FROM usuario WHERE login = '".$login."' AND clave = MD5('".$pwd."')";
		$result = DBUtil::executeSelect($query);
		
		if(count($result) > 0){
			return new UsuarioDTO($result[0]["id"],
					$result[0]["nombre"],
					$result[0]["apellido"],
					$result[0]["login"],
					$result[0]["clave"],
					"",
					"20",
					"1",
					"50");
		} else {
			return null;
		}
		
	}
}