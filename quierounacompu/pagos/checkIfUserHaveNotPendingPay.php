<?php
	//print_r($_POST);
	if(isset($_POST["ci"])){
		include_once '../sis/classes/DBConnection.php';
		include_once '../sis/classes/DBUtil.php';
		
		$query = "SELECT id_encriptado FROM envios WHERE ci_rif = '".$_POST["ci"] 
			."' AND id_status_actual=3 ORDER BY fecha_registro LIMIT 1";
		//echo $query;
		
		$results = DBUtil::executeSelect($query);
		if(count($results) > 0){
			echo "{\"envio\": \"" .$results[0]["id_encriptado"]."\"}";
		} else {
			echo "IS_OK";
		}
	}
?>