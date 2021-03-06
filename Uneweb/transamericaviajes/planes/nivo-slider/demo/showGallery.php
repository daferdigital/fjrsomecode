<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html lang="en">
<head>
    <title>Nivo Slider Demo</title>
    <link rel="stylesheet" href="../themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/pascal/pascal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../themes/orman/orman.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>
<body>
    <div id="wrapper">
   		<div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
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
                		<img src="./../../img/<?php echo $item->nodeValue;?>" alt="" />
                <?php                	 
                	}
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="../jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
</body>
</html>