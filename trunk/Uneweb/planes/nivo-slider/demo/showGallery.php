<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <title>Nivo Slider Demo</title>
    <script type="text/javascript" src="scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.cycle.all.js"></script>
    <script type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="scripts/chili-1.7.pack.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/jq.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<div id="slider" class="pics">
    	<?php
        	//creamos las imagenes respectivas
			$xmlFileName = "../../xml/plan.xml";
			
			if(isset($_REQUEST['id'])){
				$xmlFileName = "../../xml/plan".$_REQUEST['id'].".xml";
			}
					
            $doc = new DOMDocument();
            $doc->load($xmlFileName);
                	
            $secciones = $doc->getElementsByTagName("seccion");
            $seccion = $secciones->item(3);
                	
            $items = $seccion->getElementsByTagName("item");
            foreach($items as $item ){
        ?>
                <img src="./../../img/<?php echo $item->nodeValue;?>" alt=""  width="618px" height="300px" />
        <?php                	 
        	}
        ?>
    </div>
    
    <script type="text/javascript">
    $(window).load(function() {
    	$('#slider').cycle({ 
    	    fx:    'turnDown', 
    	    width: 618, 
    	    height: 300, 
    	    timeout: 1500 
    	});
    });
    </script>
</body>
</html>