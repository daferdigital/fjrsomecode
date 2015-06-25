<?php
include_once 'Constants.php';

class DBConnection {
	
	private $dbConnection;
	
	/**
	 * 
	 */
	public function DBConnection(){
		/**/
		/*
		$this->dbConnection = mysql_connect(Constants::$DB_SERVIDOR, 
				Constants::$DB_USUARIO, Constants::$DB_USER_PWD, true);
		if(mysql_error()){
			die("Error conectando al servidor de base de datos. ".mysql_error());
		}
		
		mysql_select_db(Constants::$DB_SCHEMA, $this->dbConnection);
		if(mysql_error()){
			die("Error seleccionando la base de datos. ".mysql_error());
		}
		*/
	}
	
	public function getConnection(){
		global $conexion;
		
		return $conexion;
		//return $this->dbConnection;
	}
	
	public function getConnectionV2(){
		$this->dbConnection = mysql_connect(Constants::$DB_SERVIDOR,
		 		Constants::$DB_USUARIO, Constants::$DB_USER_PWD, true);
		if(mysql_error()){
			die("Error conectando al servidor de base de datos. ".mysql_error());
		}
		
		mysql_select_db(Constants::$DB_SCHEMA, $this->dbConnection);
		if(mysql_error()){
			die("Error seleccionando la base de datos. ".mysql_error());
		}
		
		return $this->dbConnection;
	}
	
	public function closeConnection(){
		//mysql_close($this->dbConnection);
	}
}
?>