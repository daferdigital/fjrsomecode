<?php 
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
    </div>
</html>