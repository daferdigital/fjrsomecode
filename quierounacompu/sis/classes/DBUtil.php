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
			while($row = mysql_fetch_array($result)){
				$resultArray[] = $row;
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
		try {
			$query = "INSERT INTO system_log VALUES(null, now(),'".str_replace("'","\\'", $queryOperation)."','".str_replace("'","\\'",$result)."')";
			
			mysql_query($query, $dbConObj->getConnection());
		} catch (Exception $e) {
			die("Error ejecutando consulta en base de datos ".$e->getMessage());
		}
		
		$dbConObj->closeConnection();
	}
}
?>