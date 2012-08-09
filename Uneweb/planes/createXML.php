<?php
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	
	//recorremos el contenido que viene en el POST para crear el documento XML resultante
	$rootNode = $doc->createElement("secciones");
	$doc->appendChild($rootNode);
	
	$numeroSecciones = 5;
	for ($i = 0; $i < $numeroSecciones; $i++) {
		//creamos el nodo de la seccion
		$seccion = $doc->createElement("seccion");
		
		if($i == 0){
			
		}
		
		$rootNode->appendChild($seccion);
	}
	
	echo $doc->saveXML();
?>