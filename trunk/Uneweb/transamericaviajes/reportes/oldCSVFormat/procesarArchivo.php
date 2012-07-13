<?php
    function getConnection(){
    	// archivo de conexion a la DB
    	$hostname_web = "localhost";
    	$database_web = "transviajes";
    	//$username_web = "transviajes_user";
    	//$password_web = "#m1.cl4v3.d4t4#";
    	$username_web = "root";
    	$password_web = "root1006";
    	
    	$dbLink = mysql_connect($hostname_web, $username_web, $password_web) or die(mysql_error());
    	mysql_select_db($database_web, $dbLink);
    	
    	return $dbLink;
    }
    
	function procesarArchivo($tipoArchivo, $lineasArchivo){
		$dbLink = getConnection();
		
		if ($tipoArchivo == 'clientes') {
			return insertarCliente($lineasArchivo, $dbLink);
		} else if ($tipoArchivo == 'lineasVentasPaquetes') {
			return insertarLineaVentasPaquetesCredito($lineasArchivo, $dbLink);
		} else if ($tipoArchivo == 'recibos') {
			return insertarRecibo($lineasArchivo, $dbLink);
		} else if ($tipoArchivo == 'ventasPaquetes') {
			return insertarVentasPaquetesCredito($lineasArchivo, $dbLink);
		}
		
		//cerramos la conexion a la base de datos
		mysql_close($dbLink);
	}
	
	/**
	 * 
	 * @param unknown_type $texto
	 * @return mixed
	 */
	function cleanSingleQuotes($texto){
		return str_replace("'", "''", $texto);
	}
	
	/**
	 * 
	 * @param unknown_type $texto
	 * @return string
	 */
	function nullIfEmpty($texto){
		if($texto == ""){
			$texto = "NULL";
		}
		
		return $texto;
	}
	
	function insertarCliente($lineasArchivo, $dbLink){
		$fallidos = 0;
		// Podemos trabajar con todas las líneas:
		foreach ($lineasArchivo as $sLinea) {
			//echo $sLinea."<br>";
			$lineaAsArray = explode('|', $sLinea);
			$sql = "INSERT INTO clientes VALUES (".
					$lineaAsArray[0]
					.", '".cleanSingleQuotes($lineaAsArray[1])
					."', '".cleanSingleQuotes($lineaAsArray[2])
					."', '".cleanSingleQuotes($lineaAsArray[3])
					."', '".cleanSingleQuotes($lineaAsArray[4])
					."', '".cleanSingleQuotes($lineaAsArray[5])
					."', '".cleanSingleQuotes($lineaAsArray[6])
					."', '".cleanSingleQuotes($lineaAsArray[7])
					."', '".cleanSingleQuotes($lineaAsArray[8])
					."', '".cleanSingleQuotes($lineaAsArray[9])
					."', '".cleanSingleQuotes($lineaAsArray[10])
					."', '".cleanSingleQuotes($lineaAsArray[11])
					."', '".cleanSingleQuotes($lineaAsArray[12])
					."', '".cleanSingleQuotes($lineaAsArray[13])
					."', '".cleanSingleQuotes($lineaAsArray[14])
					."', '".cleanSingleQuotes($lineaAsArray[15])
					."', '".cleanSingleQuotes($lineaAsArray[16])
					."', '".cleanSingleQuotes($lineaAsArray[17])
					."', '".cleanSingleQuotes($lineaAsArray[18])
					."', '".cleanSingleQuotes($lineaAsArray[19])
					."', '".cleanSingleQuotes($lineaAsArray[20])
					."', '".cleanSingleQuotes($lineaAsArray[21])
					."', '".cleanSingleQuotes($lineaAsArray[22])."')";
			
			mysql_query($sql, $dbLink);
			if(mysql_error()){
				//echo $sql."<br>";
				$fallidos++;
			}
		}
		
		if($fallidos == 0){
			return "Se registraron exitosamente todos los ".count($lineasArchivo)." registros del archivo";
		} else {
			return "Fallo la creacion de ".$fallidos." registros del archivo";
		}
	}
	
	function insertarLineaVentasPaquetesCredito($lineasArchivo, $dbLink){
		$fallidos = 0;
		// Podemos trabajar con todas las líneas:
		foreach ($lineasArchivo as $sLinea) {
			//echo $sLinea."<br>";
			$lineaAsArray = explode('|', $sLinea);
			$sql = "INSERT INTO linea_ventas_paquetes_credito VALUES (".
					$lineaAsArray[0]
					.", ".nullIfEmpty($lineaAsArray[1])
					.", '".cleanSingleQuotes($lineaAsArray[2])
					."', ".nullIfEmpty($lineaAsArray[3])
					.", '".cleanSingleQuotes($lineaAsArray[4])
					."', '".cleanSingleQuotes($lineaAsArray[5])
					."', ".nullIfEmpty($lineaAsArray[6])
					.", '".cleanSingleQuotes($lineaAsArray[7])
					."', '".cleanSingleQuotes($lineaAsArray[8])
					."', '".cleanSingleQuotes($lineaAsArray[9])."')";
				
			mysql_query($sql, $dbLink);
			if(mysql_error()){
				//echo $sql."<br>";
			$fallidos++;
			}
		}
		
		if($fallidos == 0){
			return "Se registraron exitosamente todos los ".count($lineasArchivo)." registros del archivo";
		} else {
			return "Fallo la creacion de ".$fallidos." registros del archivo";
		}
	}
	
	function insertarRecibo($lineasArchivo, $dbLink){
		$fallidos = 0;
		// Podemos trabajar con todas las líneas:
		foreach ($lineasArchivo as $sLinea) {
			//echo $sLinea."<br>";
			$lineaAsArray = explode('|', $sLinea);
			$sql = "INSERT INTO recibos VALUES (".
					$lineaAsArray[0]
					.", STR_TO_DATE('".$lineaAsArray[1]."', '%d/%m/%Y %H:%i')"
					.", ".$lineaAsArray[2]
					.", '".cleanSingleQuotes($lineaAsArray[3])
					."', ".nullIfEmpty($lineaAsArray[4])
					.", '".cleanSingleQuotes($lineaAsArray[5])
					."', '".cleanSingleQuotes($lineaAsArray[6])
					."', '".cleanSingleQuotes($lineaAsArray[7])
					."', '".cleanSingleQuotes($lineaAsArray[8])
					."', '".cleanSingleQuotes($lineaAsArray[9])
					."', ".nullIfEmpty($lineaAsArray[10])
					.", ".nullIfEmpty($lineaAsArray[11])
					.", '".cleanSingleQuotes($lineaAsArray[12])
					."', '".cleanSingleQuotes($lineaAsArray[13])
					."', '".cleanSingleQuotes($lineaAsArray[14])
					."', '".cleanSingleQuotes($lineaAsArray[15])."')";
				
			mysql_query($sql, $dbLink);
			if(mysql_error()){
				//echo $sql."<br>";
				$fallidos++;
			}
		}
		
		if($fallidos == 0){
			return "Se registraron exitosamente todos los ".count($lineasArchivo)." registros del archivo";
		} else {
			return "Fallo la creacion de ".$fallidos." registros del archivo";
		}
	}
	
	function insertarVentasPaquetesCredito($lineasArchivo, $dbLink){
		$fallidos = 0;
		// Podemos trabajar con todas las líneas:
		foreach ($lineasArchivo as $sLinea) {
			//echo $sLinea."<br>";
			$lineaAsArray = explode('|', $sLinea);
			$sql = "INSERT INTO ventas_paquetes_credito VALUES (".
					$lineaAsArray[0]
					.", ".$lineaAsArray[1]
					.", STR_TO_DATE('".$lineaAsArray[2]."', '%d/%m/%Y %H:%i')"
					.", '".cleanSingleQuotes($lineaAsArray[3])
					."', ".nullIfEmpty($lineaAsArray[4])
					.", ".nullIfEmpty($lineaAsArray[5])
					.", '".cleanSingleQuotes($lineaAsArray[6])
					."', '".cleanSingleQuotes($lineaAsArray[7])
					."', '".cleanSingleQuotes($lineaAsArray[8])
					."', '".cleanSingleQuotes($lineaAsArray[9])
					."', ".nullIfEmpty($lineaAsArray[10])
					.", '".cleanSingleQuotes($lineaAsArray[11])
					."', '".cleanSingleQuotes($lineaAsArray[12])
					."', '".cleanSingleQuotes($lineaAsArray[13])
					."', '".cleanSingleQuotes($lineaAsArray[14])
					."', '".cleanSingleQuotes($lineaAsArray[15])
					."', '".cleanSingleQuotes($lineaAsArray[16])
					."', '".cleanSingleQuotes($lineaAsArray[17])
					."', '".cleanSingleQuotes($lineaAsArray[18])
					."', '".cleanSingleQuotes($lineaAsArray[19])
					."', STR_TO_DATE('".$lineaAsArray[20]."', '%d/%m/%Y %H:%i')"
					.", '".cleanSingleQuotes($lineaAsArray[21])
					."', ".nullIfEmpty($lineaAsArray[22]).")";
				
			mysql_query($sql, $dbLink);
			if(mysql_error()){
				//echo $sql."<br>";
				$fallidos++;
			}
		}
		
		if($fallidos == 0){
			return "Se registraron exitosamente todos los ".count($lineasArchivo)." registros del archivo";
		} else {
			return "Fallo la creacion de ".$fallidos." registros del archivo";
		}
	}
?>
