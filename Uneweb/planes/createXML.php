<?php
	$baseDir = "./xml";
	
	if(! is_dir($baseDir)){
		mkdir($baseDir);
	}
	
	if(! is_dir("./img/")){
		mkdir("./img/");
	}
	
	$xmlFileName = "./xml/plan.xml";
			
	if(isset($_REQUEST['id'])){
		$xmlFileName = "./xml/plan".$_REQUEST['id'].".xml";
	}
	
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
			//es la seccion del itinerario
			//obtenemos el titulo de cabecera
			$tmpNode = $doc->createElement("titulo", $_POST["tituloSeccion1"]);
			$seccion->appendChild($tmpNode);
			
			//verificamos si existe imagen para la cabecera
			if($_FILES["imageSeccion1"]["error"] == 0){
				//tenemos imagen, la copiamos al directorio respectivo y almacenamos la referencia
				$tmpNode = $doc->createElement("img", $_FILES["imageSeccion1"]["name"]);
				move_uploaded_file($_FILES["imageSeccion1"]["tmp_name"], "./img/".$_FILES["imageSeccion1"]["name"]);
			}else {
				$tmpNode = $doc->createElement("img");
			}
			$seccion->appendChild($tmpNode);
			
			//recorremos la informacion de los días
			if(isset($_POST['dayTitle'])){
				$dayTitles = $_POST['dayTitle'];
				$dayActivities = $_POST['dayDesc'];
				$dayImgs = $_FILES["dayImage"]["name"];
				$dayTmps = $_FILES["dayImage"]["tmp_name"];
				reset($dayTitles);
					
				$subSeccionDias = $doc->createElement("dias");
				while($dayTitle = each($dayTitles)){
					//recorremos los dias para crear su info
					$dia = $doc->createElement("dia");
					$dia->appendChild($doc->createElement("title", $dayTitle['value']));
					$dia->appendChild($doc->createElement("actividades", $dayActivities[$dayTitle['key']]));
					$dia->appendChild($doc->createElement("img", $dayImgs[$dayTitle['key']]));
					move_uploaded_file($dayTmps[$dayTitle['key']], "./img/".$dayImgs[$dayTitle['key']]);
					
					$subSeccionDias->appendChild($dia);
				}
				$seccion->appendChild($subSeccionDias);
			}
		} else if($i == 1){
			//es la seccion de que incluye
			//obtenemos el titulo de cabecera
			$tmpNode = $doc->createElement("titulo", $_POST["tituloSeccion2"]);
			$seccion->appendChild($tmpNode);
			
			//verificamos si existe imagen para la cabecera
			if($_FILES["imageSeccion2"]["error"] == 0){
				//tenemos imagen, la copiamos al directorio respectivo y almacenamos la referencia
				$tmpNode = $doc->createElement("img", "img/".$_FILES["imageSeccion2"]["name"]);
				move_uploaded_file($_FILES["imageSeccion2"]["tmp_name"], "./img/".$_FILES["imageSeccion2"]["name"]);
			}else {
				$tmpNode = $doc->createElement("img");
			}
			$seccion->appendChild($tmpNode);
			
			//recorremos la informacion de lo que se incluye
			if(isset($_POST['opcionSeccion2'])){
				$items = $_POST['opcionSeccion2'];
				reset($items);
					
				$subSeccionQueIncluye = $doc->createElement("queincluye");
				while($item = each($items)){
					//recorremos los elementos a incluir para crear su info
					$tmpNode = $doc->createElement("item", $item['value']);
				
					$subSeccionQueIncluye->appendChild($tmpNode);
				}
				$seccion->appendChild($subSeccionQueIncluye);
			}
		} else if($i == 2){
			//es la seccion de condiciones
			//obtenemos el titulo de cabecera
			$tmpNode = $doc->createElement("titulo", $_POST["tituloSeccion3"]);
			$seccion->appendChild($tmpNode);
			
			//verificamos si existe imagen para la cabecera
			if($_FILES["imageSeccion3"]["error"] == 0){
				//tenemos imagen, la copiamos al directorio respectivo y almacenamos la referencia
				$tmpNode = $doc->createElement("img", "img/".$_FILES["imageSeccion3"]["name"]);
				move_uploaded_file($_FILES["imageSeccion3"]["tmp_name"], "./img/".$_FILES["imageSeccion3"]["name"]);
			}else {
				$tmpNode = $doc->createElement("img");
			}
			$seccion->appendChild($tmpNode);
			
			//recorremos la informacion de las condiciones
			if(isset($_POST['opcionSeccion3'])){
				$items = $_POST['opcionSeccion3'];
				reset($items);
					
				$subSeccionCondiciones = $doc->createElement("condiciones");
				while($item = each($items)){
					//recorremos las condiciones para crear su info
					$tmpNode = $doc->createElement("item", $item['value']);
				
					$subSeccionCondiciones->appendChild($tmpNode);
				}
				$seccion->appendChild($subSeccionCondiciones);
			}
			
			//recorremos la informacion de los gastos de anulacion
			if(isset($_POST['gastoSeccion3'])){
				$items = $_POST['gastoSeccion3'];
				reset($items);
					
				$subSeccionGastos = $doc->createElement("gastos");
				while($item = each($items)){
					//recorremos los gastos para crear su info
					$tmpNode = $doc->createElement("item", $item['value']);
			
					$subSeccionGastos->appendChild($tmpNode);
				}
				$seccion->appendChild($subSeccionGastos);
			}
		} else if($i == 3){
			//es la seccion de fotos
			//obtenemos el titulo de cabecera
			$tmpNode = $doc->createElement("titulo", $_POST["tituloSeccion4"]);
			$seccion->appendChild($tmpNode);
			
			//recorremos la informacion de las fotos
			if(isset($_FILES['fileSeccion4'])){
				$items = $_FILES['fileSeccion4']['name'];
				$tmpNames = $_FILES['fileSeccion4']['tmp_name'];
				reset($items);
					
				$subSeccionFotos = $doc->createElement("fotos");
				$index = 0;
				while($item = each($items)){
					//recorremos las fotos para crear su info
					$tmpNode = $doc->createElement("item", $item['value']);
					move_uploaded_file($tmpNames[$index++], "./img/".$item['value']);
					
					$subSeccionFotos->appendChild($tmpNode);
				}
				$seccion->appendChild($subSeccionFotos);
			}
		} else if($i == 4){
			//es la seccion de hoteles
			//obtenemos el titulo de cabecera
			$tmpNode = $doc->createElement("titulo", $_POST["tituloSeccion5"]);
			$seccion->appendChild($tmpNode);
			
			//verificamos si existe imagen para la cabecera
			if($_FILES["imageSeccion5"]["error"] == 0){
				//tenemos imagen, la copiamos al directorio respectivo y almacenamos la referencia
				$tmpNode = $doc->createElement("img", "img/".$_FILES["imageSeccion5"]["name"]);
				move_uploaded_file($_FILES["imageSeccion5"]["tmp_name"], "./img/".$_FILES["imageSeccion5"]["name"]);
			}else {
				$tmpNode = $doc->createElement("img");
			}
			$seccion->appendChild($tmpNode);
			
			//recorremos la informacion de las fotos
			if(isset($_POST['text1'])){
				$texto1 = $_POST['text1'];
				reset($texto1);
					
				$subSeccionFilas = $doc->createElement("filas");
				while($item = each($texto1)){
					//recorremos las filas para crear su info
					$fila = $doc->createElement("fila");
					$fila->appendChild($doc->createElement("ciudad", $item['value']));
					$fila->appendChild($doc->createElement("hotel", $_POST['text2'][$item['key']]));
					$fila->appendChild($doc->createElement("categoria", $_POST['text3'][$item['key']]));
					$subSeccionFilas->appendChild($fila);
				}
				$seccion->appendChild($subSeccionFilas);
			}
		}
		
		$rootNode->appendChild($seccion);
	}
	
	echo $doc->save($xmlFileName);
?>