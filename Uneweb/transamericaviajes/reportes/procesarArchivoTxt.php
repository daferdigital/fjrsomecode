<?php
    include ('dbConnection.php');
    
    $varEnter = "\r\n";
    
    function getErrorFileDir(){
    	return "resultados";
    }
    
    function getErrorFilePath(){
    	return getErrorFileDir()."/ErroresCarga.txt";
    }
    
    /**
     * 
     * @param unknown_type $line
     */
    function addLineInErrorFile($line){
    	$fileReference = fopen(getErrorFilePath(), "a");
    	fwrite($fileReference, $line);
    	fclose($fileReference);
    }
    
    /**
     * 
     */
    function initErrorFile(){
    	if(! is_dir(getErrorFileDir())){
    		mkdir(getErrorFileDir());
    	}
    	
    	$fileReference = fopen(getErrorFilePath(), "w");
    	fclose($fileReference);
    }
    
    /**
     * Revisamos los indices para las comillas dobles "
     * a fin de revisar si internamente  ella contienen el separador csv, en este caso ;
     *
     * @param String $linea
     *
     * @return un array de 2 pocisiones para saber indice inicial y final de las comillas o null si
     * entre las comillas no existe el separador csv.
     */
    function getIndexes($linea, $start){
    	$indexes = array();
    
    	if(strpos($linea, "\"", $start) === false){
    		$indexes = null;
    	}else{
    		$index = strpos($linea, "\"", $start);
    		$indexes[] = $index;
    
    		$index ++;
    
    		$index = strpos($linea, "\"", $index);
    		$indexes[] = $index;
    	}
    
    	return $indexes;
    }
    
    /**
     * 
     * @param string $linea
     * @return array
     */
    function fixLineValue($linea){
    	$array1 = explode("\"", $linea);
    	$fieldSeparator = ";";
    	
    	if(count($array1) % 2 == 1){
    		$line = $linea;
    		$index = 0;
    		$indexes = array();
    		$continuar = true;
    		$tmp = "";
    		
    		while($continuar == true){
    			$indexes = getIndexes($line, $index);
    			//print_r($indexes);
    				
    			if($indexes == null){
    				$continuar = false;
    			} else{
    				$index = $indexes[1] + 1;
    				$tmp = substr($line, $indexes[0] + 1, ($indexes[1] - $indexes[0]) - 1)."<br>";
    				$tmp = preg_replace("/;/", " ", $tmp);
    					
    				$line = substr($line, 0, $indexes[0]).$tmp.substr($line, $indexes[1] + 1);
    				//echo $line."<br><br><br>";
    			}
    		}
    			
    		$linea = explode($fieldSeparator, $line);
    	}
    	
    	return $linea;
    }
    
    /**
     * Tomamos el query y vemos si trae registros en cuyo caso retornamos true
     * @param unknown_type $sql
     */
    function queryHasResults($sql){
    	$hasResults = false;
    	
    	$conn = getConnection();
    	//echo $sql."<br>";
    	$consulta = mysql_query($sql, $conn);
    	
    	if(list($value) = mysql_fetch_array($consulta)) {
    		if($value > 0){
    			$hasResults = true;
    		}
    	}
    	
    	mysql_close($conn);
    	
    	return $hasResults;
    }
    
    /**
     * 
     * @param unknown_type $tipoArchivo
     * @param unknown_type $lineasArchivo
     */
	function procesarArchivo($tipoArchivo, $lineasArchivo){
		//$dbLink = getConnection();
		
		//ajustamos el maximo de tiempo de ejecucion a 10 minutos para la carga de los archivos
		ini_set("max_execution_time", 60 * 10);
		//limpiamos el archivo de errores para esta corrida
		initErrorFile();
		
		if ($tipoArchivo == 'clientes') {
			return insertarCliente($lineasArchivo);
		} else if ($tipoArchivo == 'lineasVentasPaquetes') {
			return insertarLineaVentasPaquetesCredito($lineasArchivo);
		} else if ($tipoArchivo == 'recibos') {
			return insertarRecibo($lineasArchivo);
		} else if ($tipoArchivo == 'ventasPaquetes') {
			return insertarVentasPaquetesCredito($lineasArchivo);
		}
		
		//cerramos la conexion a la base de datos
		//mysql_close($dbLink);
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
	 * @param string $texto
	 * @return string
	 */
	function nullIfEmpty($texto){
		if($texto == ""){
			$texto = "NULL";
		}
		
		return $texto;
	}
	
	/**
	 * 
	 * @param string $monto
	 * @return string
	 */
	function fixMonto($monto){
		$monto = str_replace(".", "", $monto);
		$monto = str_replace(",", ".", $monto);
		return $monto;
	}
	
	/**
	 * La tabla cliente en BD tiene 23 campos, por lo que la linea debe tener esa misma cantidad de campos
	 * al ser convertida en Array (usando explode)
	 * 
	 * @param String $lineasArchivo
	 * @return string
	 */
	function insertarCliente($lineasArchivo){
		$huboFalla = false;
		$numLinea = 0;
		$maxFields = 23;
		$prevLineValue = "";
		global $varEnter;
		$fieldSeparator = ";";
		
		$t0 = time();
		$dbLink = getConnection();
		mysql_query("SET autocommit = 0", $dbLink);
		
		// Podemos trabajar con todas las líneas:
		foreach ($lineasArchivo as $sLinea) {
			//echo $sLinea."<br>";
			$lineaAsArray = explode($fieldSeparator, $prevLineValue.$sLinea);
			$numLinea++;
			
			if(count($lineaAsArray) < $maxFields) {
				//seguimos leyendo hasta tener toda la linea completa
				$prevLineValue .= $sLinea;
				continue;
			} else {
				if(count($lineaAsArray) > $maxFields){
					$lineaAsArray = fixLineValue($prevLineValue.$sLinea);
				}
				
				//ya tenemos la linea completa, procedemos al insert
				$prevLineValue = "";
			}
			
			if(count($lineaAsArray) == $maxFields) {
				//$recordExists = queryHasResults("SELECT COUNT(*) FROM clientes WHERE id = ".$lineaAsArray[0]);
				
				//if($recordExists){
					$sql = "DELETE FROM clientes WHERE id= ".$lineaAsArray[0];
					mysql_query($sql, $dbLink);
				//}
				
				$tmpValueTipoCliente = strtoupper($lineaAsArray[1]);
				if(($tmpValueTipoCliente != 'N') && ($tmpValueTipoCliente != 'S')){
					//colocamos N por defecto
					$tmpValueTipoCliente = 'N';
				}
				
				$sql = "INSERT INTO clientes VALUES (".
						$lineaAsArray[0]
						.", '".$tmpValueTipoCliente //cleanSingleQuotes($lineaAsArray[1])
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
						."', '".cleanSingleQuotes(substr($lineaAsArray[22], 0, strlen($lineaAsArray[22]) -2))."')";
				
				mysql_query($sql, $dbLink);
				
				if(mysql_error()){
					//echo $sql."<br>";
					addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." presento problemas en sus valores".$varEnter
							."El contenido de la linea ".$numLinea." es: ".$sLinea
							."A pesar de que la misma si cumple con el formato fijado, es posible que el valor de algun campo presente algun problema".$varEnter
							."Se recomienda proporcionar este texto a los encargados del sistema:".$varEnter
							."    --> ".$sql.$varEnter
							."    --> Error SQL: ".mysql_error().$varEnter
							."Por favor ubique esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
							."-------------------------------------------------------------".$varEnter.$varEnter);
					$huboFalla = true;
				}
					
				//mysql_close($dbLink);
			} else {
				$huboFalla = true;
				
				addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." no cumple con el formato fijado".$varEnter
						."El contenido de la linea ".$numLinea." es: ".$sLinea
						.(count($lineaAsArray) > $maxFields ? "Probablemente en esta linea existan '".$fieldSeparator."' de mas, lo que ocasiona que se pierda el formato, las lineas de este formato deben tener solamente ".($maxFields - 1)." |" 
								: "Es probable que esta linea este incompleta y el resto este en las lineas siguientes o anteriores")
						.$varEnter."Se recomienda ubicar esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
						."-------------------------------------------------------------".$varEnter.$varEnter);
			}
		}
		
		mysql_query("commit", $dbLink);
		if(mysql_error($dbLink)){
			echo mysql_error($dbLink);
		}
		
		mysql_query("SET autocommit = 1", $dbLink);
		if(mysql_error($dbLink)){
			echo mysql_error($dbLink);
		}
		
		mysql_close($dbLink);
		
		//echo (time() - $t0)." segundos duro el proceso de $numLinea lineas<br>";
		
		return $huboFalla;
	}
	
	function insertarLineaVentasPaquetesCredito($lineasArchivo){
		$huboFalla = false;
		$numLinea = 0;
		$maxFields = 9;
		$prevLineValue = "";
		global $varEnter;
		$fieldSeparator = ";";
		
		$t0 = time();
		$dbLink = getConnection();
		mysql_query("SET autocommit = 0", $dbLink);
		
		// Podemos trabajar con todas las líneas:
		foreach ($lineasArchivo as $sLinea) {
			//echo $sLinea."<br>";
			$lineaAsArray = explode($fieldSeparator, $prevLineValue.$sLinea);
			$numLinea++;
			
			if(count($lineaAsArray) < $maxFields) {
				//seguimos leyendo hasta tener toda la linea completa
				$prevLineValue .= $sLinea;
				continue;
			} else {
				if(count($lineaAsArray) > $maxFields){
					$lineaAsArray = fixLineValue($prevLineValue.$sLinea);
				}
				
				//ya tenemos la linea completa, procedemos al insert
				$prevLineValue = "";
			}
			
			if(count($lineaAsArray) == $maxFields) {
				//$recordExists = queryHasResults("SELECT COUNT(*) FROM linea_ventas_paquetes_credito WHERE id = ".$lineaAsArray[0]);
					
				//if($recordExists){
					$sql = "DELETE FROM linea_ventas_paquetes_credito WHERE id = ".$lineaAsArray[0];
					mysql_query($sql, $dbLink);
				//}
				
				$sql = "INSERT INTO linea_ventas_paquetes_credito VALUES (".
						$lineaAsArray[0]
						.", ".nullIfEmpty($lineaAsArray[1])
						.", '".cleanSingleQuotes($lineaAsArray[2])
						."', ".nullIfEmpty($lineaAsArray[3])
						.", '".cleanSingleQuotes($lineaAsArray[4])
						."', '".cleanSingleQuotes($lineaAsArray[5])
						."', ".nullIfEmpty(fixMonto($lineaAsArray[6]))
						.", '".cleanSingleQuotes($lineaAsArray[7])
						."', '".cleanSingleQuotes(substr($lineaAsArray[8], 0, strlen($lineaAsArray[8]) -2))."')";
				
				mysql_query($sql, $dbLink);
					
				if(mysql_error()){
					//echo $sql."<br>";
					addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." presento problemas en sus valores".$varEnter
							."El contenido de la linea ".$numLinea." es: ".$sLinea
							."A pesar de que la misma si cumple con el formato fijado, es posible que el valor de algun campo presente algun problema".$varEnter
							."Se recomienda proporcionar este texto a los encargados del sistema:".$varEnter
							."    --> ".$sql.$varEnter
							."    --> Error SQL: ".mysql_error().$varEnter
							."Por favor ubique esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
							."-------------------------------------------------------------".$varEnter.$varEnter);
					$huboFalla = true;
				}
				
				//mysql_close($dbLink);
			} else {
				$huboFalla = true;
				
				addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." no cumple con el formato fijado".$varEnter
						."El contenido de la linea ".$numLinea." es: ".$sLinea
						.(count($lineaAsArray) > $maxFields ? "Probablemente en esta linea existan '".$fieldSeparator."' de mas, lo que ocasiona que se pierda el formato, las lineas de este formato deben tener solamente ".($maxFields - 1)." |" 
								: "Es probable que esta linea este incompleta y el resto este en las lineas siguientes o anteriores")
						.$varEnter."Se recomienda ubicar esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
						."-------------------------------------------------------------".$varEnter.$varEnter);
			}
		}
		
		mysql_query("commit", $dbLink);
		if(mysql_error($dbLink)){
			echo mysql_error($dbLink);
		}
		
		mysql_query("SET autocommit = 1", $dbLink);
		if(mysql_error($dbLink)){
			echo mysql_error($dbLink);
		}
		
		mysql_close($dbLink);
		
		//echo (time() - $t0)." segundos duro el proceso de $numLinea lineas<br>";
		
		return $huboFalla;
	}
	
	function insertarRecibo($lineasArchivo){
		$huboFalla = false;
		$numLinea = 0;
		$maxFields = 16;
		$prevLineValue = "";
		global $varEnter;
		$fieldSeparator = ";";
		
		$t0 = time();
		$dbLink = getConnection();
		mysql_query("SET autocommit = 0", $dbLink);
		
		// Podemos trabajar con todas las líneas:
		foreach ($lineasArchivo as $sLinea) {
			//echo $sLinea."<br>";
			$lineaAsArray = explode($fieldSeparator, $prevLineValue.$sLinea);
			$numLinea++;
			
			if(count($lineaAsArray) < $maxFields) {
				//seguimos leyendo hasta tener toda la linea completa
				$prevLineValue .= $sLinea;
				//echo $sLinea."<br>";
				continue;
			} else {
				$lineaAsArray = fixLineValue($prevLineValue.$sLinea);
				
				//ya tenemos la linea completa, procedemos al insert
				$prevLineValue = "";
			}
			
			if(count($lineaAsArray) == $maxFields) {
				//$recordExists = queryHasResults("SELECT COUNT(*) FROM recibos WHERE id = ".$lineaAsArray[0]);
				$recordExists = true;
				//$dbLink = getConnection();
					
				if($recordExists){
					$sql = "DELETE FROM recibos WHERE id= ".$lineaAsArray[0];
					mysql_query($sql, $dbLink);
				}
				
				$sql = "INSERT INTO recibos VALUES (".
						$lineaAsArray[0]
						.", STR_TO_DATE('".$lineaAsArray[1]."', '%d/%m/%Y %H:%i:%S')"
						.", ".$lineaAsArray[2]
						.", '".cleanSingleQuotes($lineaAsArray[3])
						."', ".nullIfEmpty(fixMonto($lineaAsArray[4]))
						.", '".cleanSingleQuotes($lineaAsArray[5])
						."', '".cleanSingleQuotes($lineaAsArray[6])
						."', '".cleanSingleQuotes($lineaAsArray[7])
						."', '".cleanSingleQuotes($lineaAsArray[8])
						."', '".cleanSingleQuotes($lineaAsArray[9])
						."', ".nullIfEmpty(fixMonto($lineaAsArray[10]))
						.", ".nullIfEmpty(fixMonto($lineaAsArray[11]))
						.", '".cleanSingleQuotes($lineaAsArray[12])
						."', '".cleanSingleQuotes($lineaAsArray[13])
						."', '".cleanSingleQuotes($lineaAsArray[14])
						."', '".cleanSingleQuotes(substr($lineaAsArray[15], 0, strlen($lineaAsArray[15]) -2))."')";
				
				mysql_query($sql, $dbLink);
				
				if(mysql_error()){
					//echo $sql."<br>";
					addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." presento problemas en sus valores".$varEnter
							."El contenido de la linea ".$numLinea." es: ".$sLinea
							."A pesar de que la misma si cumple con el formato fijado, es posible que el valor de algun campo presente algun problema".$varEnter
							."Se recomienda proporcionar este texto a los encargados del sistema:".$varEnter
							."    --> ".$sql.$varEnter
							."    --> Error SQL: ".mysql_error().$varEnter
							."Por favor ubique esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
							."-------------------------------------------------------------".$varEnter.$varEnter);
					$huboFalla = true;
				}
				
				//mysql_close($dbLink);
			} else {
				$huboFalla = true;
				
				addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." no cumple con el formato fijado".$varEnter
						."El contenido de la linea ".$numLinea." es: ".$sLinea
						.(count($lineaAsArray) > $maxFields ? "Probablemente en esta linea existan '".$fieldSeparator."' de mas, lo que ocasiona que se pierda el formato, las lineas de este formato deben tener solamente ".($maxFields - 1)." |" 
								: "Es probable que esta linea este incompleta y el resto este en las lineas siguientes o anteriores")
						.$varEnter."Se recomienda ubicar esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
						."-------------------------------------------------------------".$varEnter.$varEnter);
			}
		}
		
		mysql_query("commit", $dbLink);
		if(mysql_error($dbLink)){
			echo mysql_error($dbLink);
		}
		
		mysql_query("SET autocommit = 1", $dbLink);
		if(mysql_error($dbLink)){
			echo mysql_error($dbLink);
		}
		
		mysql_close($dbLink);
		
		//echo (time() - $t0)." segundos duro el proceso de $numLinea lineas<br>";
		
		return $huboFalla;
	}
	
	function insertarVentasPaquetesCredito($lineasArchivo){
		$huboFalla = false;
		$numLinea = 0;
		$maxFields = 23;
		$prevLineValue = "";
		global $varEnter;
		$fieldSeparator = ";";
		
		$t0 = time();
		$dbLink = getConnection();
		mysql_query("SET autocommit = 0", $dbLink);
		
		// Podemos trabajar con todas las líneas:
		foreach ($lineasArchivo as $sLinea) {
			//echo $sLinea."<br>";
			$lineaAsArray = explode($fieldSeparator, $prevLineValue.$sLinea);
			$numLinea++;
			
			if(count($lineaAsArray) < $maxFields) {
				//seguimos leyendo hasta tener toda la linea completa
				$prevLineValue .= $sLinea;
				continue;
			} else {
				$lineaAsArray = fixLineValue($prevLineValue.$sLinea);
				
				//ya tenemos la linea completa, procedemos al insert
				$prevLineValue = "";
			}
			
			if(count($lineaAsArray) == $maxFields) {
				//$recordExists = queryHasResults("SELECT COUNT(*) FROM ventas_paquetes_credito WHERE nro_inscripcion = ".$lineaAsArray[0]);
				
					
				//if($recordExists){
					$sql = "DELETE FROM ventas_paquetes_credito WHERE nro_inscripcion= ".$lineaAsArray[0];
					mysql_query($sql, $dbLink);
				//}
				
				$sql = "INSERT INTO ventas_paquetes_credito VALUES (".
						$lineaAsArray[0]
						.", ".$lineaAsArray[1]
						.", STR_TO_DATE('".$lineaAsArray[2]."', '%d/%m/%Y %H:%i:%S')"
						.", '".cleanSingleQuotes($lineaAsArray[3])
						."', ".nullIfEmpty($lineaAsArray[4])
						.", ".nullIfEmpty($lineaAsArray[5])
						.", '".cleanSingleQuotes($lineaAsArray[6])
						."', '".cleanSingleQuotes($lineaAsArray[7])
						."', '".cleanSingleQuotes($lineaAsArray[8])
						."', '".cleanSingleQuotes($lineaAsArray[9])
						."', ".nullIfEmpty(fixMonto($lineaAsArray[10]))
						.", '".cleanSingleQuotes($lineaAsArray[11])
						."', '".cleanSingleQuotes($lineaAsArray[12])
						."', '".cleanSingleQuotes($lineaAsArray[13])
						."', '".cleanSingleQuotes($lineaAsArray[14])
						."', '".cleanSingleQuotes($lineaAsArray[15])
						."', '".cleanSingleQuotes($lineaAsArray[16])
						."', '".cleanSingleQuotes($lineaAsArray[17])
						."', '".cleanSingleQuotes($lineaAsArray[18])
						."', '".cleanSingleQuotes($lineaAsArray[19])
						."', STR_TO_DATE('".$lineaAsArray[20]."', '%d/%m/%Y %H:%i:%S')"
						.", '".cleanSingleQuotes($lineaAsArray[21])
						."', ".nullIfEmpty(substr($lineaAsArray[22], 0, strlen($lineaAsArray[22]) -2)).")";
				
				mysql_query($sql, $dbLink);
				
				if(mysql_error()){
					//echo $sql."<br>";
					addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." presento problemas en sus valores".$varEnter
							."El contenido de la linea ".$numLinea." es: ".$sLinea
							."A pesar de que la misma si cumple con el formato fijado, es posible que el valor de algun campo presente algun problema".$varEnter
							."Se recomienda proporcionar este texto a los encargados del sistema:".$varEnter
							."    --> ".$sql.$varEnter
							."    --> Error SQL: ".mysql_error().$varEnter
							."Por favor ubique esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
							."-------------------------------------------------------------".$varEnter.$varEnter);
					$huboFalla = true;
				}
				
				//mysql_close();
			} else {
				$huboFalla = true;
				
				addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." no cumple con el formato fijado".$varEnter
						."El contenido de la linea ".$numLinea." es: ".$sLinea
						.(count($lineaAsArray) > $maxFields ? "Probablemente en esta linea existan '".$fieldSeparator."' de mas, lo que ocasiona que se pierda el formato, las lineas de este formato deben tener solamente ".($maxFields - 1)." |" 
								: "Es probable que esta linea este incompleta y el resto este en las lineas siguientes o anteriores")
						.$varEnter."Se recomienda ubicar esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
						."-------------------------------------------------------------".$varEnter.$varEnter);
			}
		}
		
		mysql_query("commit", $dbLink);
		if(mysql_error($dbLink)){
			echo mysql_error($dbLink);
		}
		
		mysql_query("SET autocommit = 1", $dbLink);
		if(mysql_error($dbLink)){
			echo mysql_error($dbLink);
		}
		
		mysql_close($dbLink);
		
		//echo (time() - $t0)." segundos duro el proceso de $numLinea lineas<br>";
		
		return $huboFalla;
	}
?>
