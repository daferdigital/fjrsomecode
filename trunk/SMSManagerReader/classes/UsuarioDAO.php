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
		$query = "SELECT * FROM usuarios WHERE login = '".$login."'";
		$count = DBUtil::getRecordCountToQuery($query);
		
		if($count > 0){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * @param String $login
	 * 
	 * @return boolean true if login exits and user is active false otherwhise
	 * 
	 */
	public static function checkIfUserIsActive($login){
		$query = "SELECT * FROM usuarios WHERE login = '".$login."'";
		$result = DBUtil::executeSelect($query);
		
		if(count($result) > 0){
			$result = $result[0];
			
			if($result["activo"] == "1"){
				return true;
			} else {
				return false;
			}
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
		$query = "SELECT * FROM usuarios WHERE login = '".$login."' AND clave = MD5('".$pwd."')";
		$result = DBUtil::executeSelect($query);
		
		if(count($result) > 0){
			return new UsuarioDTO($result[0]["id"],
					$result[0]["nombre"],
					$result[0]["apellido"],
					$result[0]["login"],
					$result[0]["clave"],
					$result[0]["clave"],
					$result[0]["timeout"],
					$result[0]["activo"],
					$result[0]["max_records_paging"],
					$result[0]["hora_minima_lectura"],
					$result[0]["hora_maxima_lectura"]);
		} else {
			return null;
		}
	}
}