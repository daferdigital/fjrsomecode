<?php
	include("DBConexion.php");
	
	class QueryUtil extends DBConexion{
		
		/**
		 * 
		 * @param String $query
		 * @param Array $arrayParameters
		 */
		function getPHPArray($query, $arrayParameters){
			$stmt = mysqli_prepare($this->getConnection(), $query);
			
			if(count($arrayParameters) > 0){
				//tenemos parametros para setear
				foreach ($arrayParameters as $item) {
					//echo $item["type"]."-".$item["value"]."<br />";
					$stmt->bind_param($item["type"], $item["value"]);
				}
			}
			
			$stmt->execute();
			$stmt->bind_result($name, $code);
		}
	}
	
	$query = "SELECT * FROM idiomas WHERE active = ?";
	$arrayParameters = array();
	$arrayParameters[] = array("type" => "i", "value" => 1);
	
	$queryUtil = new QueryUtil();
	$queryUtil->getPHPArray($query, $arrayParameters);
?>
