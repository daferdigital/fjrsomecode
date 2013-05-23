<?php

include_once 'DBUtil.php';
include_once 'ModuloDAO.php';
include_once 'UsuarioDTO.php';

class UsuarioDAO {
	public function UsuarioDAO(){
		
	}
	
	/**
	 * 
	 * @param string $login
	 * @param string $pwd
	 * @return DTO del usuario asociado a las credenciales si estas son validas, null en caso contrario
	 */
	public static function getUserDoingLogin($login, $pwd){
		$usuarioDTO = NULL;
		
		try {
			$query = "SELECT u.id, u.nombre, u.apellido, u.correo, u.tiempo_sesion, u.clave, u.active, u.registros_por_pagina "
			."FROM usuarios u "
			."WHERE u.login='".$login."' "
			."AND u.clave=MD5('".$pwd."') ";
				
			$arrayResult = DBUtil::executeSelect($query);
			
			if(count($arrayResult) > 0){
				//credenciales validas
				$row = $arrayResult[0];
				$usuarioDTO = new UsuarioDTO($row["id"], 
						$row["nombre"], 
						$row["apellido"], 
						$login, 
						$row["clave"],
						$row["correo"], 
						$row["tiempo_sesion"],
						$row["active"],
						$row["registros_por_pagina"]);
				
				$moduloDAO = new ModuloDAO();
				$usuarioDTO->setModulesAllowed($moduloDAO->getModulosXUser($row["id"]));
			}
		} catch (Exception $e) {
			die("Error verificando login");
		}
		
		return $usuarioDTO;
	}
	
	/**
	 * 
	 * @param unknown_type $idUser
	 */
	public static function getUserDTO($idUser){
		$usuarioDTO = NULL;
	
		try {
			$query = "SELECT u.id, u.nombre, u.apellido, u.correo, u.login, u.tiempo_sesion, u.clave, u.active, u.registros_por_pagina "
			."FROM usuarios u "
			."WHERE u.id=".$idUser;
	
			$arrayResult = DBUtil::executeSelect($query);
	
			if(count($arrayResult) > 0){
				//credenciales validas
				$row = $arrayResult[0];
				$usuarioDTO = new UsuarioDTO($row["id"],
						$row["nombre"],
						$row["apellido"],
						$row["login"],
						$row["clave"],
						$row["correo"],
						$row["tiempo_sesion"],
						$row["active"],
						$row["registros_por_pagina"]);
			}
		} catch (Exception $e) {
			die("Error verificando login");
		}
	
		return $usuarioDTO;
	}
	/**
	 * Metodo para obtener todas las cuentas de usuarios activos en el sistema.
	 * 
	 * @return multitype:UsuarioDTO
	 */
	public static function getAllActiveUsers(){
		return UsuarioDAO::getAllSystemUsers(TRUE);
	}
	
	/**
	 * Metodo para obtener todas las cuentas de usuarios no activos en el sistema.
	 * 
	 * @return multitype:UsuarioDTO
	 */
	public static function getAllInactiveUsers(){
		return UsuarioDAO::getAllSystemUsers(FALSE);
	}
	
	/**
	 * Metodo para obtener todas las cuentas de usuarios en el sistema.
	 * Sin importar si estan activos o no.
	 * 
	 * @return multitype:UsuarioDTO
	 */
	public static function getAllUsers(){
		return UsuarioDAO::getAllSystemUsers(NULL);
	}
	
	/**
	 * Obtenemos la lista que corresponda segun el parametro.
	 * 
	 * @param boolean $active (TRUE, FALSE or NULL)
	 * 
	 * @return multitype:UsuarioDTO
	 */
	private static function getAllSystemUsers($active){
		$usuariosDTO = NULL;
		
		$query = "SELECT u.id, u.login, u.nombre, u.apellido, u.correo, u.tiempo_sesion, u.active, u.registros_por_pagina "
			."FROM usuarios u ";
		
		if($active == TRUE){
			$query .= "WHERE u.active = '1' ";
		} else if($active == FALSE){
			$query .= "WHERE u.active != '1' ";
		} else {
			//no agrego filtro de activo o no activo
		}
			
		$query .= "ORDER BY LOWER(u.nombre), LOWER(u.apellido) ";
		
		$arrayResult = DBUtil::executeSelect($query);
		
		if(count($arrayResult) > 0){
			$usuariosDTO = array();
			
			foreach ($arrayResult as $row){
				$usuariosDTO[] = new UsuarioDTO($row["id"],
						$row["nombre"],
						$row["apellido"],
						$row["login"],
						"",
						$row["correo"],
						$row["tiempo_sesion"],
						$row["active"],
						$row["registros_por_pagina"]);
			}
		}
		
		return $usuariosDTO;
	}
}
?>