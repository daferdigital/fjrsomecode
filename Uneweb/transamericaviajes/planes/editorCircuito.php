<?php 
		            		foreach($dias as $dia ){
		            			echo "<script>addDayInfoContainer('".$dia->getElementsByTagName("title")->item(0)->nodeValue."','".$dia->getElementsByTagName("actividades")->item(0)->nodeValue."','".$dia->getElementsByTagName("img")->item(0)->nodeValue."')</script>";
		            		}
	            <div id="seccion2Info">
                    		$items = $secciones->item(1)->getElementsByTagName("item");
                    		foreach ($items as $item){
                    			echo "<script>addTextFieldSeccion2('".$item->nodeValue."')</script>";
                    		}
	        </div>
	            			$entries = $xpath->query("item", $items->item(0));
	            			
	            			foreach ($entries as $entry) {
	            				echo "<script>addTextFieldSeccion3('".$entry->nodeValue."')</script>";
	            			}
	            			
	            			foreach ($entries as $entry) {
	            				echo "<script>addGastoSeccion3('".$entry->nodeValue."')</script>";
	            			}
	        </div>
				    	foreach($items as $item ){
				    		echo "<script>addFileSeccion4('".$item->nodeValue."')</script>";
				    	}
            </div>
            <div id="tabs-5">
                        	if($filas->length > 0){
                        		foreach ($filas as $fila){
                        			echo "<script>addRowSeccion5('".$fila->getElementsByTagName("ciudad")->item(0)->nodeValue."','".$fila->getElementsByTagName("hotel")->item(0)->nodeValue."','".$fila->getElementsByTagName("categoria")->item(0)->nodeValue."')</script>";
                        		}
                        	}
    </div>
</html>