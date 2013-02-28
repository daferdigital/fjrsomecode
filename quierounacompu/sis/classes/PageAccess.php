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
		if(isset($_SESSION[Constants::$KEY_USUARIO_DTO]) && ($_SESSION[Constants::$KEY_USUARIO_DTO] != NULL)){
			return true;
		}
		
		return false;
	}
	
	/**
	 * Revisamos la inactividad actual de la sesion.
	 * 
	 */
	private static function checkInactivity(){
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
			}
		}
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
			PageAccess::checkInactivity();
			
			$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
			
			if($userDTO->canAccessKeyModule($keyModule)){
				$access = true;	
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
		} else {
			//user must start session
			$_SESSION[Constants::$KEY_MESSAGE_ERROR] = Constants::$TEXT_MUST_BE_LOGGED;
			header("Location: index.php");
		}
	}
}
?>