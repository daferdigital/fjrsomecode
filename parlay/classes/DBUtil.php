<?php
include_once("DBConnection.php");

class DBUtil {
	private static $audit = false;
	
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
	public static function executeSelect($querySelect){
		$resultArray = array();
		$time0 = time();
		$dbConObj = new DBConnection();
		
		try {
			$result = mysql_query($querySelect, $dbConObj->getConnection());
			if(!mysql_error()){
				$resultArray = mysql_fetch_assoc($result);
			} else {
				DBUtil::storeError($queryOperation, $result);
			}
		} catch (Exception $e) {
			die("Error ejecutando consulta en base de datos");
		}
		
		$dbConObj->closeConnection();
		
		DBUtil::insertIntoSystemLog($querySelect, print_r($resultArray, true), (time() - $time0));
		
		return $resultArray;
	}
	
	/**
	 * Metodo que recibe una consulta de cualquier tipo menos SELECT para ejecutarla.
	 *
	 * @param Query a ejecutar (no SELECT) $querySelect
	 * 
	 * @return true en caso de exito ejecutando el query, false en cualquier otro escenario
	 * 
	 */
	public static function executeQuery($query){
		$dbConObj = new DBConnection();
		$time0 = time();
		$result = true;
		
		try {
			mysql_query($query, $dbConObj->getConnection());
			if(mysql_error()){
				$result = false;
				DBUtil::storeError($query, mysql_error());
			}
		} catch (Exception $e) {
			$result = false;
			die("Error ejecutando query(no select) en base de datos");
		}
	
		$dbConObj->closeConnection();
	
		DBUtil::insertIntoSystemLog($query, "", time() - $time0);
		
		return $result;
	}
	
	/**
	 * funcion para almacenar una determinada consulta junto con su resultado en la base de datos
	 * a modo de auditoria.
	 * 
	 * @param string $queryOperation
	 * @param string $result
	 * @param int $timeExecution
	 */
	private static function insertIntoSystemLog($queryOperation, $result, $timeExecution){
		if(DBUtil::$audit == true){
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
					DBUtil::storeError($query, mysql_error());
				}
			} catch (Exception $e) {
				die("Error en insert de log del sistema ".$e->getMessage());
			}
			
			$dbConObj->closeConnection();
		}
	}
	
	/**
	 * Metodo para almacenar la informacion de los errores en los querys ejecutados.
	 * 
	 * @param string $queryOperation
	 * @param string $result
	 */
	private static function storeError($queryOperation, $result){
		if(DBUtil::$audit == true){
			$idUsuario = "NULL";
			$time0 = time();
			
			if(isset($_SESSION["usuario"])){
				$idUsuario = $_SESSION["usuario"]->getId();
			}
			
			$query = "INSERT INTO system_log (fecha, query, result, was_error, query_time, id_usuario)"
					." VALUES(now(),'".str_replace("'","\\'", $queryOperation)."','".str_replace("'","\\'",$result)."','1',".(time() - $time0).",".$idUsuario.")";
			
			$dbConObj = new DBConnection();
			mysql_query($query, $dbConObj->getConnection());
			$dbConObj->closeConnection();
		}
	}
}
?>