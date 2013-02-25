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
	public function getUserDoingLogin($login, $pwd){
		$usuarioDTO = NULL;
		$dbUtilObj = new DBUtil();
		
		try {
			$query = "SELECT u.id, u.nombre, u.apellido, u.correo, u.tiempo_sesion "
			."FROM usuarios u "
			."WHERE u.login='".$login."' "
			."AND u.clave=MD5('".$pwd."') ";
				
			$arrayResult = $dbUtilObj->executeSelect($query);
				
			if(count($arrayResult) > 0){
				//credenciales validas
				$row = $arrayResult[0];
				$usuarioDTO = new UsuarioDTO($row["id"], 
						$row["nombre"], 
						$row["apellido"], 
						$login, 
						$row["correo"], 
						$row["tiempo_sesion"]);
				
				$moduloDAO = new ModuloDAO();
				$usuarioDTO->setModulesAllowed($moduloDAO->getModulosXUser($row["id"]));
			}
		} catch (Exception $e) {
			die("Error verificando login");
		}
	
		return $usuarioDTO;
	}
	
	public function getAllUsers(){
		$usuariosDTO = NULL;
		$dbUtilObj = new DBUtil();
		
		$query = "SELECT u.id, u.login, u.nombre, u.apellido, u.correo, u.tiempo_sesion "
			."FROM usuarios u "
			."ORDER BY LOWER(u.nombre), LOWER(u.apellido) ";
		
		$arrayResult = $dbUtilObj->executeSelect($query);
		
		if(count($arrayResult) > 0){
			$usuariosDTO = array();
			
			foreach ($arrayResult as $row){
				$usuariosDTO[] = new UsuarioDTO($row["id"],
						$row["nombre"],
						$row["apellido"],
						$row["login"],
						$row["correo"],
						$row["tiempo_sesion"]);
			}
		}
		
		return $usuariosDTO;
	}
}
?>