<?php
    include ('dbConnection.php');
    
    /** PHPExcel */
    require_once 'Classes/PHPExcel.php';
    require_once 'Classes/PHPExcel/IOFactory.php';
    
    //vars to use in a global way
    $varEnter = "\r\n";
    
    function getErrorFileDir(){
    	return "resultados";
    }
    
    function getErrorFilePath(){
    	return getErrorFileDir()."/ErroresCarga.txt";
    }
    
    function getUploadedXLSFileToProcess(){
    	return getErrorFileDir()."/UploadedFile.xls";
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
     * Tomamos el query y vemos si trae registros en cuyo caso retornamos true
     * @param unknown_type $sql
     */
    function queryHasResults($sql){
    	$hasResults = false;
    	
    	$conn = getConnection();
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
     */
	function procesarArchivo($tipoArchivo){
		//$dbLink = getConnection();
		
		//ajustamos el maximo de tiempo de ejecucion a 10 minutos para la carga de los archivos
		ini_set("max_execution_time", 60 * 10);
		//limpiamos el archivo de errores para esta corrida
		initErrorFile();
		
		//leemos el archivo Excel en una estructura mas manejable
		$objPHPExcel = PHPExcel_IOFactory::load(getUploadedXLSFileToProcess());
		
		if ($tipoArchivo == 'clientes') {
			return insertarCliente($objPHPExcel);
		} else if ($tipoArchivo == 'lineasVentasPaquetes') {
			return insertarLineaVentasPaquetesCredito($objPHPExcel);
		} else if ($tipoArchivo == 'recibos') {
			return insertarRecibo($objPHPExcel);
		} else if ($tipoArchivo == 'ventasPaquetes') {
			return insertarVentasPaquetesCredito($objPHPExcel);
		}
		
		//cerramos la conexion a la base de datos
		//mysql_close($dbLink);
		
		//eliminamos el archivo temporal
		$objPHPExcel->disconnectWorksheets();
		$objPHPExcel = null;
		unlink(getUploadedXLSFileToProcess());
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
	
	/**
	 *
	 * @param string $monto
	 * @return string
	 */
	function fixMonto($monto){
		//en excel no aplica el fix monto
		//$monto = str_replace(".", "", $monto);
		//$monto = str_replace(",", ".", $monto);
		return $monto;
	}
	
	/**
	 * La tabla cliente en BD tiene 23 campos, por lo que la linea debe tener esa misma cantidad de campos
	 * 
	 * @param $objPHPExcel
	 * @return string
	 */
	function insertarCliente($objPHPExcel){
		$huboFalla = false;
		$numLinea = 2;
		$maxFields = 23;
		global $varEnter;
		
		$t0 = time();
		$dbLink = getConnection();
		mysql_query("SET autocommit = 0", $dbLink);
		
		// Podemos trabajar con todas las líneas:
		$objPHPExcel->setActiveSheetIndex(0);
		$tmpValueTipoCliente;
		
		while($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue() != ''){
			//$recordExists = queryHasResults("SELECT COUNT(*) FROM clientes WHERE id = ".($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue()));
			
			//if($recordExists){
				$sql = "DELETE FROM clientes WHERE id= ".($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue());
				mysql_query($sql, $dbLink);
			//}
			
			$tmpValueTipoCliente = strtoupper($objPHPExcel->getActiveSheet()->getCell("B".$numLinea)->getValue());
			if(($tmpValueTipoCliente != 'N') && ($tmpValueTipoCliente != 'S')){
				//colocamos N por defecto
				$tmpValueTipoCliente = 'N';
			}

			$sql = "INSERT INTO clientes VALUES (".
					$objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue()
					.", '".cleanSingleQuotes($tmpValueTipoCliente)
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("C".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("D".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("E".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("F".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("G".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("H".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("I".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("J".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("K".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("L".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("M".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("N".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("O".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("P".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("Q".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("R".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("S".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("T".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("U".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("V".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("W".$numLinea)->getValue())."')";
				
			mysql_query($sql, $dbLink);
				
			if(mysql_error()){
				//echo $sql."<br>";
				addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." presento problemas en sus valores".$varEnter
						."A pesar de que la misma si cumple con el formato fijado, es posible que el valor de algun campo presente algun problema".$varEnter
						."Se recomienda proporcionar este texto a los encargados del sistema:".$varEnter
						."    --> ".$sql.$varEnter
						."    --> Error SQL: ".mysql_error().$varEnter
						."Por favor ubique esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
						."-------------------------------------------------------------".$varEnter.$varEnter);
				$huboFalla = true;
			}
				
			//mysql_close($dbLink);
			
			$numLinea++;
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
	
	function insertarLineaVentasPaquetesCredito($objPHPExcel){
		$huboFalla = false;
		$numLinea = 2;
		$maxFields = 9;
		global $varEnter;
		
		$t0 = time();
		$dbLink = getConnection();
		mysql_query("SET autocommit = 0", $dbLink);
		
		// Podemos trabajar con todas las líneas:
		$objPHPExcel->setActiveSheetIndex(0);
		$tmpValueTipoCliente;
		
		while($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue() != ''){
			//$recordExists = queryHasResults("SELECT COUNT(*) FROM linea_ventas_paquetes_credito WHERE id = ".($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue()));
				
			//if($recordExists){
				$sql = "DELETE FROM linea_ventas_paquetes_credito WHERE id = ".($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue());
				mysql_query($sql, $dbLink);
			//}
			
			$sql = "INSERT INTO linea_ventas_paquetes_credito VALUES (".
					$objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue()
					.", ".nullIfEmpty($objPHPExcel->getActiveSheet()->getCell("B".$numLinea)->getValue())
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("C".$numLinea)->getValue())
					."', ".nullIfEmpty($objPHPExcel->getActiveSheet()->getCell("D".$numLinea)->getValue())
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("E".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("F".$numLinea)->getValue())
					."', ".nullIfEmpty(fixMonto($objPHPExcel->getActiveSheet()->getCell("G".$numLinea)->getValue()))
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("H".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("I".$numLinea)->getValue())."')";
				
			mysql_query($sql, $dbLink);
				
			if(mysql_error()){
				//echo $sql."<br>";
				addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." presento problemas en sus valores".$varEnter
						."A pesar de que la misma si cumple con el formato fijado, es posible que el valor de algun campo presente algun problema".$varEnter
						."Se recomienda proporcionar este texto a los encargados del sistema:".$varEnter
						."    --> ".$sql.$varEnter
						."    --> Error SQL: ".mysql_error().$varEnter
						."Por favor ubique esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
						."-------------------------------------------------------------".$varEnter.$varEnter);
				$huboFalla = true;
			}
				
			//mysql_close($dbLink);
			
			$numLinea++;
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
	
	function insertarRecibo($objPHPExcel){
		$huboFalla = false;
		$numLinea = 2;
		$maxFields = 16;
		global $varEnter;
		
		$t0 = time();
		$dbLink = getConnection();
		mysql_query("SET autocommit = 0", $dbLink);
		
		// Podemos trabajar con todas las líneas:
		$objPHPExcel->setActiveSheetIndex(0);
		$tmpValueTipoCliente;
		
		while($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue() != ''){
			//$recordExists = queryHasResults("SELECT COUNT(*) FROM recibos WHERE id = ".($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue()));
			
			//if($recordExists){
				$sql = "DELETE FROM recibos WHERE id = ".($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue());
				mysql_query($sql, $dbLink);
			//}
			/*
			echo ($objPHPExcel->getActiveSheet()->getCell("E".$numLinea)->getValue()).", ".
			($objPHPExcel->getActiveSheet()->getCell("K".$numLinea)->getValue()).", ".
			($objPHPExcel->getActiveSheet()->getCell("L".$numLinea)->getValue())."<br />";
			*/
			
			$sql = "INSERT INTO recibos VALUES (".
					$objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue()
					.", DATE_ADD('1900-01-01', INTERVAL ".($objPHPExcel->getActiveSheet()->getCell("B".$numLinea)->getValue() - 2)." DAY)"
					//.", STR_TO_DATE('".($objPHPExcel->getActiveSheet()->getCell("B".$numLinea)->getValue())."', '%Y-%m-%d %H:%i:%S')"
					.", ".$objPHPExcel->getActiveSheet()->getCell("C".$numLinea)->getValue()
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("D".$numLinea)->getValue())
					."', ".nullIfEmpty(fixMonto($objPHPExcel->getActiveSheet()->getCell("E".$numLinea)->getValue()))
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("F".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("G".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("H".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("I".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("J".$numLinea)->getValue())
					."', ".nullIfEmpty(fixMonto($objPHPExcel->getActiveSheet()->getCell("K".$numLinea)->getValue()))
					.", ".nullIfEmpty(fixMonto($objPHPExcel->getActiveSheet()->getCell("L".$numLinea)->getValue()))
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("M".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("N".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("O".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("P".$numLinea)->getValue())."')";
				
			mysql_query($sql, $dbLink);
				
			if(mysql_error()){
				//echo $sql."<br>";
				addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." presento problemas en sus valores".$varEnter
						."A pesar de que la misma si cumple con el formato fijado, es posible que el valor de algun campo presente algun problema".$varEnter
						."Se recomienda proporcionar este texto a los encargados del sistema:".$varEnter
						."    --> ".$sql.$varEnter
						."    --> Error SQL: ".mysql_error().$varEnter
						."Por favor ubique esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
						."-------------------------------------------------------------".$varEnter.$varEnter);
				$huboFalla = true;
			}
				
			//mysql_close($dbLink);
			
			$numLinea++;
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
	
	function insertarVentasPaquetesCredito($objPHPExcel){
		$huboFalla = false;
		$numLinea = 2;
		$maxFields = 23;
		global $varEnter;
		
		
		$t0 = time();
		$dbLink = getConnection();
		mysql_query("SET autocommit = 0", $dbLink);
		
		// Podemos trabajar con todas las líneas:
		$objPHPExcel->setActiveSheetIndex(0);
		$tmpValueTipoCliente;
		
		while($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue() != ''){
			//$recordExists = queryHasResults("SELECT COUNT(*) FROM ventas_paquetes_credito WHERE nro_inscripcion = ".($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue()));
				
			//if($recordExists){
				$sql = "DELETE FROM ventas_paquetes_credito WHERE nro_inscripcion = ".($objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue());
				mysql_query($sql, $dbLink);
			//}
			
			$sql = "INSERT INTO ventas_paquetes_credito VALUES (".
					$objPHPExcel->getActiveSheet()->getCell("A".$numLinea)->getValue()
					.", ".$objPHPExcel->getActiveSheet()->getCell("B".$numLinea)->getValue()
					.", DATE_ADD('1900-01-01', INTERVAL ".($objPHPExcel->getActiveSheet()->getCell("C".$numLinea)->getValue() - 2)." DAY)"
					//.", STR_TO_DATE('".($objPHPExcel->getActiveSheet()->getCell("C".$numLinea)->getValue())."', '%Y-%m-%d %H:%i:%S')"
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("D".$numLinea)->getValue())
					."', ".nullIfEmpty($objPHPExcel->getActiveSheet()->getCell("E".$numLinea)->getValue())
					.", ".nullIfEmpty($objPHPExcel->getActiveSheet()->getCell("F".$numLinea)->getValue())
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("G".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("H".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("I".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("J".$numLinea)->getValue())
					."', ".nullIfEmpty(fixMonto($objPHPExcel->getActiveSheet()->getCell("K".$numLinea)->getValue()))
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("L".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("M".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("N".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("O".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("P".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("Q".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("R".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("S".$numLinea)->getValue())
					."', '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("T".$numLinea)->getValue())
					."', DATE_ADD('1900-01-01', INTERVAL ".($objPHPExcel->getActiveSheet()->getCell("U".$numLinea)->getValue() - 2)." DAY)"
					//."', STR_TO_DATE('".($objPHPExcel->getActiveSheet()->getCell("U".$numLinea)->getFormattedValue())."', '%Y-%m-%d %H:%i:%S')"
					.", '".cleanSingleQuotes($objPHPExcel->getActiveSheet()->getCell("V".$numLinea)->getValue())
					."', ".nullIfEmpty($objPHPExcel->getActiveSheet()->getCell("W".$numLinea)->getValue()).")";
				
			mysql_query($sql, $dbLink);
				
			if(mysql_error()){
				//echo $sql."<br>";
				addLineInErrorFile("En el archivo que fue cargado, la linea ".$numLinea." presento problemas en sus valores".$varEnter
						."A pesar de que la misma si cumple con el formato fijado, es posible que el valor de algun campo presente algun problema".$varEnter
						."Se recomienda proporcionar este texto a los encargados del sistema:".$varEnter
						."    --> ".$sql.$varEnter
						."    --> Error SQL: ".mysql_error().$varEnter
						."Por favor ubique esta linea en el archivo original para tener un mejor contexto del problema".$varEnter
						."-------------------------------------------------------------".$varEnter.$varEnter);
				$huboFalla = true;
			}
				
			//mysql_close($dbLink);
			
			$numLinea++;
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
