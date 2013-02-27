<?php
include_once 'Constants.php';
include_once 'BitacoraDAO.php';
include_once 'UsuarioDTO.php';

class PageAccess {
	
	/**
	 * 
	 * @return boolean
	 */
	public static function userIsLogged(){
		if(isset($_SESSION[Constants::$KEY_USUARIO_DTO])){
			return true;
		}
		
		return false;
	}
	
	/**
	 * Funcion para validar si determinado acceso a alguna pagina es permitido o no,
	 * basandonos en la propia permisologia de modulos del usuario.
	 * En caso de ser invalida la peticion de acceso, el usuario sera redirigido a la pagina que aplique.
	 * 
	 * @param String $keyModule
	 * 
	 */
	public static function validateAccess($keyModule){
		$access = false;
		
		if(PageAccess::userIsLogged()){
			
			$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
			
			if($userDTO->canAccessKeyModule($keyModule)){
				$access = true;	
			}
		}
		
		if(! $access){
			//no tengo permiso para ingresar aqui
			$_SESSION[Constants::$KEY_MESSAGE_ERROR] = Constants::$TEXT_ACCESS_DENIED;
		
			//vemos a que pagina debemos redirigir al usuario
			if(PageAccess::userIsLogged()){
				BitacoraDAO::registrarComentario("Intento de acceso no autorizado a la opcion [".$keyModule."]");
				header("Location: mainMenu.php");
			} else {
				header("Location: index.php");
			}
		}
	}
}
?>