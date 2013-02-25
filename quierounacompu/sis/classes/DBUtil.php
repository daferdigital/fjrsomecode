<?php
include_once("DBConnection.php");

class DBUtil {
	
	/**
	 * 
	 */
	function DBUtil(){
		/**/
	}
	
	/**
	 * 
	 * @param Sentencia select a ejecutar $querySelect
	 * @return php array con los valores arrojados por la consulta
	 */
	public function executeSelect($querySelect){
		$resultArray = array();
		
		$dbConObj = new DBConnection();
		try {
			$result = mysql_query($querySelect, $dbConObj->getConnection());
			if(!mysql_error()){
				while($row = mysql_fetch_array($result)){
					$resultArray[] = $row;
				}
			} else {
				$this->storeError($queryOperation, $result);
			}
		} catch (Exception $e) {
			die("Error ejecutando consulta en base de datos");
		}
		
		$dbConObj->closeConnection();
		
		$this->insertIntoSystemLog($querySelect, print_r($resultArray, true));
		
		return $resultArray;
	}
	
	private function insertIntoSystemLog($queryOperation, $result){
		$dbConObj = new DBConnection();
		$usuario = "NULL";
		
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"]->getId();
		}
		try {
			$query = "INSERT INTO system_log (fecha, query, result, id_usuario)"
			." VALUES(now(),'".str_replace("'","\\'", $queryOperation)."','".str_replace("'","\\'",$result)."',".$usuario.")";
			
			mysql_query($query, $dbConObj->getConnection());
			if(mysql_error()){
				$this->storeError($query, mysql_error());
			}
		} catch (Exception $e) {
			die("Error en insert de log del sistema ".$e->getMessage());
		}
		
		$dbConObj->closeConnection();
	}
	
	private function storeError($queryOperation, $result){
		$idUsuario = "NULL";
		
		if(isset($_SESSION["usuario"])){
			$idUsuario = $_SESSION["usuario"]->getId();
		}
		
		$query = "INSERT INTO system_log (fecha, query, result, was_error, id_usuario)"
		." VALUES(now(),'".str_replace("'","\\'", $queryOperation)."','".str_replace("'","\\'",$result)."','1',".$idUsuario.")";
		
		$dbConObj = new DBConnection();
		mysql_query($query, $dbConObj->getConnection());
		$dbConObj->closeConnection();	
	}
}
?>