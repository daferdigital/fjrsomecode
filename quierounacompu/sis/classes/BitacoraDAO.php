<?php
	include_once 'DBUtil.php';
	include_once 'UsuarioDTO.php';
	include_once 'Constants.php';
	
	class BitacoraDAO{
		
		/**
		 * @param String $comentario: descripcion de la operacion realizada en el sistema
		 */
		public static function registrarComentario($comentario){
			$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
			$comentario = str_replace("'", "\'", $comentario);
			
			$query = "INSERT INTO bitacora (operacion, fecha, id_usuario)"
					." VALUES('".$comentario."', now(), ".$userDTO->getId().")";
			
			$dbUtilObj = new DBUtil();
			$dbUtilObj->executeQuery($query);
		}
	}
?>