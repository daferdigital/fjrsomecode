<?php
	class DBConexion {
		private $server = "localhost";
		private $dataBase = "franamar";
		private $dbUser = "franamar";
		private $dbPwd = "Fr4n4m4r123";
		
		private $conexion;
		
		/**
		 * Funcion para obtener la conexion a la base de datos.
		 * 
		 * @return conexion
		 */
		private function getConexion(){
			$this->conexion = mysql_connect($this->server, $this->dbUser, $this->dbPwd);
			
			if(mysql_error()){
				echo "No se pudo obtener la conexion con la base de datos, el error fue: ".mysql_error();
				die();
			} else {
				mysql_select_db($this->dataBase, $this->conexion);
				if(mysql_error()){
					echo "No se pudo accesar a la base de datos requerida, el error fue: ".mysql_error();
					die();
				} else {
					return $this->conexion;
				}
			}
		}
		
		/**
		 * Funcion para cerra la conexion asociada a este objeto.
		 * 
		 */
		function closeConnection(){
			mysql_close($this->conexion);
		}
	}
?>
