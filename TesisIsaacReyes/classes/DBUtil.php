<?php
include_once("DBConnection.php");

class DBUtil {
	private static $STORE_LOGS = false;
	
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
		$time0 = (int) time();
		$dbConObj = new DBConnection();
		
		try {
			$result = mysql_query($querySelect, $dbConObj->getConnection());
			if(!mysql_error()){
				while ($r = mysql_fetch_array($result)){
					$resultArray[] = $r;
				}
				
				DBUtil::insertIntoSystemLog($querySelect, print_r($resultArray, true), ((int) time() - $time0));
			} else {
				DBUtil::storeError($querySelect, mysql_error());
			}
		} catch (Exception $e) {
			die("Error ejecutando consulta en base de datos");
		}
		
		$dbConObj->closeConnection();
		
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
			} else {
				DBUtil::insertIntoSystemLog($query, "", time() - $time0);
			}
		} catch (Exception $e) {
			$result = false;
			die("Error ejecutando query(no select) en base de datos");
		}
	
		$dbConObj->closeConnection();
	
		return $result;
	}
	
	/**
	 * Query del tipo insert a ser ejecutado.
	 * 
	 * @param string $query
	 * @return int ultimo codigo autonumerico creado
	 */
	public static function executeQueryAndReturnLastId($query){
		$dbConObj = new DBConnection();
		$time0 = time();
		$lastId = 0;
		
		try {
			mysql_query($query, $dbConObj->getConnection());
			if(mysql_error()){
				$result = false;
				DBUtil::storeError($query, mysql_error());
			} else {
				$lastId = mysql_insert_id($dbConObj->getConnection());
				DBUtil::insertIntoSystemLog($query, "", time() - $time0);
			}
		} catch (Exception $e) {
			$lastId = 0;
			die("Error ejecutando insert en base de datos");
		}
		
		$dbConObj->closeConnection();
		
		return $lastId;
	}
	
	/**
	 * En base al query indicado como parametro obtenemos la cantidad de registros involucrados en el mismo (COUNT(*))
	 * 
	 * @param String $query
	 * @return cuenta de los registros involucrados
	 */
	public static function getRecordCountToQuery($query){
		$query = strtolower($query);
		$startPos = strpos($query, "from");
		
		$query = "SELECT COUNT(*) AS cuenta ".substr($query, $startPos, strlen($query) - $startPos);
		
		if(strpos($query, "order by") > 0){
			$query = substr($query, 0, strpos($query, "order by")); 
		}
		
		$count = -1;
		$result = DBUtil::executeSelect($query);
		$count = $result[0]["cuenta"];
		
		return $count;
	}
	
	/**
	 * Se obtiene el detalle de los registros de la pagina solicitada
	 * 
	 * @param unknown_type $query
	 * @param unknown_type $pageToGet
	 */
	public static function getRecordsByPage($query, $pageToGet, $maxRecordsPerPage = 50){
		//$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
		//$maxRecordsPerPage = $userDTO->getRegistrosPorPagina();
		//$maxRecordsPerPage = 50;
		
		$minIndex = (($pageToGet - 1) * $maxRecordsPerPage);
		
		$query .= " LIMIT ".$minIndex.", ".$maxRecordsPerPage;
		
		$pageRecords = DBUtil::executeSelect($query);
		
		return $pageRecords;
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
		if(DBUtil::$STORE_LOGS){
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
		if(DBUtil::$STORE_LOGS){
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
		} else {
			echo $result;
		}
	}
}
?>