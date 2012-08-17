<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Editor</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="css/custom-theme/jquery-ui-1.8.18.custom.css" type="text/css" rel="stylesheet" />
	<link href="css/dia1.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="js/editor.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/StickyScroller.js"></script>
    <script type="text/javascript" src="js/GetSet.js"></script>
	<script type="text/javascript" src="js/home.js"></script>
	
	<style>
		input {
			font-size-adjust: none;
		}
	</style>
</head>
<body>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Itinerario</a></li>
			<li><a href="#tabs-2">Que incluye</a></li>
			<li><a href="#tabs-3">Condiciones</a></li>
			<li><a href="#tabs-4">Fotos</a></li>
			<li><a href="#tabs-5">Destinos</a></li>
        </ul>
        
        <br />
        
        <?php 
        	$doc = new DOMDocument();
  			$doc->load('prueba.xml');
        	
  			$secciones = $doc->getElementsByTagName("seccion");
  			$i = 1;
        	//iteramos sobre las secciones
			foreach($secciones as $seccion ){
				if($i == 1){
		?>
					<div id="tabs-1">
						<h3><?php echo $seccion->getElementsByTagName("titulo")->item(0)->nodeValue; ?></h3>
						<?php 
						    //vemos si hay imagen que agregar
						    if($seccion->getElementsByTagName("img")->item(0)->nodeValue){
						?>
								<hr width="100%" size="2" /> 
								<img src="<?php echo $seccion->getElementsByTagName("img")->item(0)->nodeValue?>"/> 
						<?php
						    }
						    
						    //iteramos sobre la informacion de los dias
						    $dias = $seccion->getElementsByTagName("dia");
						    
						    foreach($dias as $dia ){
						 ?>
						 		<hr width="100%" size="2" />
						    	<br />
						    	<div class="span4">
						    		<h4><?php echo $dia->getElementsByTagName("title")->item(0)->nodeValue;?></h4>
						    		<p><?php echo $dia->getElementsByTagName("actividades")->item(0)->nodeValue;?></p>
						    	</div>
						    	<?php 
						    		if($dia->getElementsByTagName("img")->item(0)->nodeValue){
						    	?>
						    			<div class="span3">
						    				<img src="<?php echo $dia->getElementsByTagName("img")->item(0)->nodeValue;?>"/>
						    				<br />
						    				<br />
						    			</div>
						    	<?php
						    		}
						    	?>
						 <?php
						    }
						?>
					</div>
		<?php 
				} else if($i == 2){
		?>
					<div id="tabs-2">
						<h3><?php echo $seccion->getElementsByTagName("titulo")->item(0)->nodeValue; ?></h3>
						<?php 
						    //vemos si hay imagen que agregar
						    if($seccion->getElementsByTagName("img")->item(0)->nodeValue){
						?>
								<hr width="100%" size="2" /> 
								<img src="<?php echo $seccion->getElementsByTagName("img")->item(0)->nodeValue?>"/> 
						<?php
						    }
						?>
						<br /> 
                    	<br />
                    	<ul>
                    		<?php 
                    			//iteramos sobre la informacion de lo que se incluye
                    			$items = $seccion->getElementsByTagName("item");
                    			foreach ($items as $item){
                    				echo "<li>".$item->nodeValue."</li>";
                    			}
                    		?>
                    	</ul> 
                        <br />
                        <br />
                    </div> 
		<?php
				} else if($i == 3){
		?>
					<div id="tabs-3">
						<h3><?php echo $seccion->getElementsByTagName("titulo")->item(0)->nodeValue; ?></h3>
						<?php 
						    //vemos si hay imagen que agregar
						    if($seccion->getElementsByTagName("img")->item(0)->nodeValue){
						?>
								<hr width="100%" size="2" /> 
								<img src="<?php echo $seccion->getElementsByTagName("img")->item(0)->nodeValue?>"/> 
						<?php
						    }
						?>
						<br /> 
                    	<br />
                    	<ul>
                    		<?php 
                    			//iteramos sobre la informacion de las condiciones
                    			$items = $seccion->getElementsByTagName("condiciones");
                    			$xpath = new DOMXPath($doc);
                    			$entries = $xpath->query("item", $items->item(0));
                    			
                    			foreach ($entries as $entry) {
                    				echo "<li>$entry->nodeValue</li>";
                    			}

                    			//iteramos sobre la informacion de los gastos
                    			$items = $seccion->getElementsByTagName("gastos");
                    			$xpath = new DOMXPath($doc);
                    			$entries = $xpath->query("item", $items->item(0));
                    			
                    			if($entries->length > 0){
                    				echo "<li>Gastos de anulaci&oacute;n del Viaje</li>";
                    				echo "<ul>";
                    				foreach ($entries as $entry) {
                    					echo "<li>$entry->nodeValue</li>";
                    				}
                    				echo "</ul>";
                    			}
                    		?>
                    	</ul>
					</div>
		<?php
				}
        		
				$i++;
       		}
        ?>
	</div>
</body>
</html>