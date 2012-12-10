<?php
	class DBConexion {
		private $server = "localhost";
		private $dataBase = "franamar";
		private $dbUser = "franamar";
		private $dbPwd = "Fr4n4m4r123";
		
		public $conexion;
		
		function DBConexion(){
			$this->setConnection();
		}
		
		/**
		 * Funcion para iniciar la conexion a la base de datos.
		 * 
		 * @return conexion
		 */
		private function setConnection(){
			$this->conexion = mysqli_connect($this->server, $this->dbUser, $this->dbPwd, $this->dataBase);
			
			if(mysqli_connect_error()){
				echo "No se pudo obtener la conexion con la base de datos, el error fue: ".mysql_error();
				die();
			}
		}
		
		function getConnection(){
			return $this->conexion;
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
