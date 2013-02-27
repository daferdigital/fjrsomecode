<?php
include_once 'DBUtil.php';
include_once 'ModuloDTO.php';

class ModuloDAO {
	
	/**
	 * Obtenemos los modulos de determinado usuario.
	 * 
	 * @param int $idUser
	 * @return arreglo de objetos ModuloDTO indicando los modulos a los que el usuario tiene acceso
	 */
	public static function getModulosXUser($idUser){
		$dbUtilObj = new DBUtil();
		$query = "SELECT m.id, m.categoria, m.key_module, m.descripcion"
		." FROM modulos m, usuario_modulo um"
		." WHERE um.id_usuario=".$idUser
		." AND um.id_modulo = m.id";
		
		$modules = $dbUtilObj->executeSelect($query);
		$modulesDTO = NULL;
		
		if(count($modules)){
			//el usuario tiene modulos asociados
			$modulesDTO = array();
			foreach ($modules as $dtoObj){
				$modulesDTO[$dtoObj["categoria"]][$dtoObj["key_module"]] = new ModuloDTO($dtoObj["id"],
						$dtoObj["categoria"],
						$dtoObj["key_module"], 
						$dtoObj["descripcion"]);
			}
		}
		
		return $modulesDTO;
	}
}
?>