<?php
	include_once 'DBUtil.php';
	include_once 'UsuarioDTO.php';
	include_once 'Constants.php';
	
	class BitacoraDAO{
		
		/**
		 * @param String $comentario: descripcion de la operacion realizada en el sistema
		 */
		public static function registrarComentario($comentario){
			$userId = "NULL";
			
			if(isset($_SESSION[Constants::$KEY_USUARIO_DTO])){
				$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
				$userId = $userDTO->getId();
			}
			
			$comentario = str_replace("'", "\'", $comentario);
			
			$query = "INSERT INTO bitacora (operacion, fecha, id_usuario)"
					." VALUES('".$comentario."', now(), ".$userId.")";
			
			DBUtil::executeQuery($query);
		}
	}
?>