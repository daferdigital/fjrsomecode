<?php
	include_once 'DBUtil.php';
	include_once 'Constants.php';
	
class BitacoraDAO{
		
		/**
		 * @param String $comentario: descripcion de la operacion realizada en el sistema
		 */
		public static function registrarComentario($comentario){
			$comentario = str_replace("'", "\'", $comentario);
			$userId = "NULL";
			
			if(isset($_SESSION["usuario_id"])){
				$userId = $_SESSION["usuario_id"];
			}
			
			$query = "INSERT INTO bitacora (operacion, fecha, id_usuario)"
					." VALUES('".$comentario."', now(), ".$userId.")";
			
			DBUtil::executeQuery($query);
		}
	}
?>