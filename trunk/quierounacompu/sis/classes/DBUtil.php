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
	 * Metodo que recibe una consulta del tipo SELECT y retorna un arreglo php
	 * con las filas retornadas por dicha consulta.
	 * 
	 * @param Sentencia select a ejecutar $querySelect
	 * @return php array con los valores arrojados por la consulta
	 */
	public function executeSelect($querySelect){
		$resultArray = array();
		$time0 = microtime(TRUE);
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
		
		$this->insertIntoSystemLog($querySelect, print_r($resultArray, true), (microtime(TRUE) - $time0));
		
		return $resultArray;
	}
	
	/**
	 * Metodo que recibe una consulta de cualquier tipo menos SELECT para ejecutarla.
	 *
	 * @param Query a ejecutar (no SELECT) $querySelect
	 */
	public function executeQuery($query){
		$dbConObj = new DBConnection();
		$time0 = time();
		
		try {
			mysql_query($querySelect, $dbConObj->getConnection());
			if(mysql_error()){
				$this->storeError($queryOperation, $result);
			}
		} catch (Exception $e) {
			die("Error ejecutando query(no select) en base de datos");
		}
	
		$dbConObj->closeConnection();
	
		$this->insertIntoSystemLog($query, print_r($resultArray, true), time() - $time0);
	}
	
	/**
	 * funcion para almacenar una determinada consulta junto con su resultado en la base de datos
	 * a modo de auditoria.
	 * 
	 * @param string $queryOperation
	 * @param string $result
	 * @param int $timeExecution
	 */
	private function insertIntoSystemLog($queryOperation, $result, $timeExecution){
		$dbConObj = new DBConnection();
		$usuario = "NULL";
		
		if(isset($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"]->getId();
		}
		try {
			$query = "INSERT INTO system_log (fecha, query, result, query_time, id_usuario)"
			." VALUES(now(),'".str_replace("'","\\'", $queryOperation)."','".str_replace("'","\\'",$result)."',".$timeExecution.",".$usuario.")";
			
			mysql_query($query, $dbConObj->getConnection());
			if(mysql_error()){
				$this->storeError($query, mysql_error());
			}
		} catch (Exception $e) {
			die("Error en insert de log del sistema ".$e->getMessage());
		}
		
		$dbConObj->closeConnection();
	}
	
	/**
	 * Metodo para almacenar la informacion de los errores en los querys ejecutados.
	 * 
	 * @param string $queryOperation
	 * @param string $result
	 */
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