<?php /*session_start();if($_SESSION["activo"]!= 1){	header("location: index.php");	exit();}*///verificamos si el xml existe o no, para cargarlo y mostrarlo.$xmlFileName = "./xml/plan".(isset($_REQUEST['id']) ? $_REQUEST['id'] : "").".xml";$doc = new DOMDocument();$secciones = null;if(is_file($xmlFileName)){	//leemos el xml que existe para este plan	$doc->load($xmlFileName);	$secciones = $doc->getElementsByTagName("seccion");}?><html><head>	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	<title>Editor Crucero</title>    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />    <link href="css/custom-theme/jquery-ui-1.8.18.custom.css" type="text/css" rel="stylesheet" />	<link href="css/dia1.css" type="text/css" rel="stylesheet" />	<script type="text/javascript" src="js/editor.js"></script>	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>    <script type="text/javascript" src="js/js/jquery-ui-1.8.18.custom.min.js"></script>    <script type="text/javascript" src="js/bootstrap.min.js"></script>    <script type="text/javascript" src="js/StickyScroller.js"></script>    <script type="text/javascript" src="js/GetSet.js"></script>	<script type="text/javascript" src="js/home.js"></script>		<style>		input {			font-size-adjust: none;		}	</style></head><body>	<div id="tabs">		<ul>			<li><a href="#tabs-1">Itinerario</a></li>			<li><a href="#tabs-2">Que incluye</a></li>			<li><a href="#tabs-3">Condiciones</a></li>			<li><a href="#tabs-4">Fotos</a></li>			<li><a href="#tabs-5">Destinos</a></li>        </ul>                <br />        <form action="createCruceroXML.php" method="post" enctype="multipart/form-data">            <input type="hidden" name="id" value="<?php echo isset($_REQUEST['id']) ? $_REQUEST['id'] : "";?>"/>	        <input style="margin-left: 100px" type="submit" value="Guardar Programa"/>	        	        <br />	        <b>Dejar en blanco el campo de la imagen que no desee modificar</b>	        	        <div id="tabs-1">				T&iacute;tulo de la secci&oacute;n: <input type="text" name="tituloSeccion5" value="<?php echo $secciones != null ? $secciones->item(0)->getElementsByTagName("titulo")->item(0)->nodeValue : "";?>"/>	            <br />				Imagen a mostrar (m&aacute;ximo 690x160): <input type="file" name="imageSeccionItinerario">				<input type="hidden" name="hiddenImageSeccionItinerario"value="<?php echo $secciones != null ? $secciones->item(0)->getElementsByTagName("img")->item(0)->nodeValue : "";?>"/>				<br />				<hr width="100%" size="2" />								<div id="seccionItinerarioCruceroInfo">				    <table id="tablaSeccion5" class="table table-bordered table-striped">				    	<thead>				    		<tr>				    			<th width="100px">D&iacute;a</th>                                <th width="180px">Puertos</th>                                <th width="180px">Llegada</th>                                <th width="180px">Salida</th>                                <th width="180px"></th>                            </tr>                        </thead>                        <?php                         if($secciones != null){                        	$filas = $secciones->item(0)->getElementsByTagName("fila");                        	if($filas->length > 0){                        		foreach ($filas as $fila){                        			echo "<script>addRowItinerarioCrucero('".$fila->getElementsByTagName("dia")->item(0)->nodeValue."','".$fila->getElementsByTagName("puerto")->item(0)->nodeValue."','".$fila->getElementsByTagName("llegada")->item(0)->nodeValue."','".$fila->getElementsByTagName("salida")->item(0)->nodeValue."')</script>";                        		}                        	}                        }                        ?>                    </table>				</div>								<input type="button" value="Agregar Fila" onclick="addRowItinerarioCrucero('','','','');"/>								<hr width="100%" size="2" />				Imagen Naviera (ancho maximo 300px): <input type="file" name="imageNavieraItinerario">				<input type="hidden" name="hiddenImageNavieraItinerario"value="<?php echo $secciones != null ? $secciones->item(0)->getElementsByTagName("imgNaviera")->item(0)->nodeValue : "";?>"/>			</div>				        <div id="tabs-2">	        	T&iacute;tulo de la secci&oacute;n: <input type="text" name="tituloSeccion2" value="<?php echo $secciones != null ? $secciones->item(1)->getElementsByTagName("titulo")->item(0)->nodeValue : "";?>"/>	            <br />                    				Imagen a mostrar (m&aacute;ximo 690x160): <input type="file" name="imageSeccion2">				<input type="hidden" name="hiddenImageSeccion2"value="<?php echo $secciones != null ? $secciones->item(1)->getElementsByTagName("img")->item(0)->nodeValue : "";?>"/>				<br />				<hr width="100%" size="2" />				
	            <div id="seccion2Info">	            	Indique el valor para las distintas opciones:	            	<br />	            	<?php                     	if($secciones != null){                    		//iteramos sobre la informacion de lo que se incluye
                    		$items = $secciones->item(1)->getElementsByTagName("item");
                    		foreach ($items as $item){
                    			echo "<script>addTextFieldSeccion2('".$item->nodeValue."')</script>";
                    		}                    	}                    ?>	            </div>	            	            <input type="button" value="Agregar Opcion" onclick="javascript:addTextFieldSeccion2('');"/>
	        </div>	        	        <div id="tabs-3">	        	T&iacute;tulo de la secci&oacute;n: <input type="text" name="tituloSeccion3" value="<?php echo $secciones != null ? $secciones->item(2)->getElementsByTagName("titulo")->item(0)->nodeValue : "";?>"/>	            <br />                    				Imagen a mostrar (m&aacute;ximo 690x160): <input type="file" name="imageSeccion3">				<input type="hidden" name="hiddenImageSeccion3"value="<?php echo $secciones != null ? $secciones->item(2)->getElementsByTagName("img")->item(0)->nodeValue : "";?>"/>				<br />				<hr width="100%" size="2" />					            <div id="seccion3Info">	            	Indique el valor para las distintas opciones:	            	<br />	            	<?php 	            	if($secciones != null){	            		$items = $secciones->item(2)->getElementsByTagName("condiciones");	            		if($items->length > 0){	            			$xpath = new DOMXPath($doc);
	            			$entries = $xpath->query("item", $items->item(0));
	            			
	            			foreach ($entries as $entry) {
	            				echo "<script>addTextFieldSeccion3('".$entry->nodeValue."')</script>";
	            			}	            		}	            	}	            	?>	            </div>	            	            <input type="button" value="Agregar Opcion" onclick="javascript:addTextFieldSeccion3('');"/>	            <hr width="100%" size="2" />	            	            <div id="seccion3Gasto">	            	Gastos de anulaci&oacute;n del Viaje	            	<br />	            	<?php 	            	if($secciones != null){	            		$items = $secciones->item(2)->getElementsByTagName("gastos");	            		if($items->length > 0){	            			$xpath = new DOMXPath($doc);	            			$entries = $xpath->query("item", $items->item(0));
	            			
	            			foreach ($entries as $entry) {
	            				echo "<script>addGastoSeccion3('".$entry->nodeValue."')</script>";
	            			}	            		}	            	}	            	?>	            </div>	            	            <input type="button" value="Agregar gasto" onclick="javascript:addGastoSeccion3('');"/>
	        </div>	        	        <div id="tabs-4">				T&iacute;tulo de la secci&oacute;n: <input type="text" name="tituloSeccion4" value="<?php echo $secciones != null ? $secciones->item(3)->getElementsByTagName("titulo")->item(0)->nodeValue : "";?>"/>	            <br />                    				<hr width="100%" size="2" />								<div id="seccion4Info">				    Listado de Fotos:				    <br />				    <?php 				    if($secciones != null){				    	$items = $secciones->item(3)->getElementsByTagName("item");
				    	foreach($items as $item ){
				    		echo "<script>addFileSeccion4('".$item->nodeValue."')</script>";
				    	}				    }				    ?>				</div>								<input type="button" value="Agregar Foto" onclick="javascript:addFileSeccion4('');"/>
            </div>                        <div id="tabs-5">				T&iacute;tulo de la secci&oacute;n: <input type="text" name="tituloSeccion1" value="<?php echo $secciones != null ? $secciones->item(4)->getElementsByTagName("titulo")->item(0)->nodeValue : "";?>"/>				<br />				Imagen a mostrar (m&aacute;ximo 690x160): <input type="file" name="imageSeccion1" />				<input type="hidden" name="hiddenImageSeccion1"value="<?php echo $secciones != null ? $secciones->item(4)->getElementsByTagName("img")->item(0)->nodeValue: ""; ?>"/>	            <br />	            <hr width="100%" size="2" />	            	            <div id="daysInfo">	            	<b>Informaci&oacute;n de los d&iacute;as del itinerario: </b>	            	<br />	            	<?php 	            		//vemos si tenemos d�as	            		if($secciones != null){		            		$dias = $secciones->item(4)->getElementsByTagName("dia");		            		foreach($dias as $dia ){		            			echo "<script>addDayInfoContainer('".$dia->getElementsByTagName("title")->item(0)->nodeValue."','".$dia->getElementsByTagName("actividades")->item(0)->nodeValue."','".$dia->getElementsByTagName("img")->item(0)->nodeValue."')</script>";		            		}	            		}	            	?>	            </div>	            	            <input type="button" value="Agregar Dia" onclick="javascript:addDayInfoContainer('','','');" />	        </div>		</form>
    </div></body>
</html>