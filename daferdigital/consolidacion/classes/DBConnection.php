<?php
class DBConnection {
	private $server = "localhost";
	private $username = "daferdig_conso";
	private $password = "Conso1006_";
	private $dbSchema = "daferdig_consolidacion";
	
	private $dbConnection;
	
	/**
	 * 
	 */
	public function DBConnection(){
		/**/
		$this->dbConnection = mysql_connect($this->server, $this->username, $this->password, true);
		if(mysql_error()){
			die("Error conectando al servidor de base de datos. ".mysql_error());
		}
		
		mysql_select_db($this->dbSchema, $this->dbConnection);
		if(mysql_error()){
			die("Error seleccionando la base de datos. ".mysql_error());
		}
	}
	
	public function getConnection(){
		return $this->dbConnection;
	}
	
	public function closeConnection(){
		mysql_close($this->dbConnection);
	}
}
?>