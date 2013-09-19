<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <title>jQuery UI Accordion - Default functionality</title>
  <link rel="stylesheet" href="css/smoothness/jquery-ui.css" />
  <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="js/jquery-ui.js"></script>
  <script>
  	$(function() {
    	$( "#accordion" ).accordion();
  	});
  </script>
</head>
<body>
	<div id="accordion" style="width: 25%; display: inline-block;">
  		<h3>Papeleria Fiscal</h3>
  		<div style="padding: 0px;">
    		<ul>
    			<li>Facturas</li>
    			<li>Notas de D&eacute;bito</li>
    			<li>Notas de Cr&eacute;dito</li>
    			<li>Orden de Entrega</li>
    			<li>Forma Libre</li>
    			<li>Formas Continuas</li>
    		</ul>
  		</div>
  		<h3>Papeleria Corporativa</h3>
  		<div style="padding: 0px;">
    		<ul>
    			<li>Tarjetas de Presentaci&oacute;n</li>
    			<li>Membretes</li>
    			<li>Carpetas</li>
    			<li>Sobres</li>
    			<li>Manuales</li>
    			<li>Presentaciones <br /> Corporativas</li>
    			<li>Otros</li>
    		</ul>
  		</div>
  		<h3>Papeleria Publicitaria</h3>
  		<div style="padding: 0px;">
    		<ul>
    			<li>Afiches</li>
    			<li>Tr&iacute;pticos / D&iacute;pticos</li>
    			<li>Volantes</li>
    			<li>Calendario</li>
    			<li>Almanaque</li>
    			<li>Carteles Comerciales</li>
    			<li>Otros</li>
    		</ul>
  		</div>
  		<h3>Papeleria Publicitaria</h3>
  		<div style="padding: 0px;">
    		<ul>
    			<li>Afiches</li>
    			<li>Tr&iacute;pticos / D&iacute;pticos</li>
    			<li>Volantes</li>
    			<li>Calendario</li>
    			<li>Almanaque</li>
    			<li>Carteles Comerciales</li>
    			<li>Otros</li>
    		</ul>
  		</div>
	</div>
	<div style="display: inline-block; width: 25%; vertical-align: top; text-align: center;">
		<span id="imageLoaging1" style="display: none;">
			<img src="images/loadIndicator.gif" />
		</span>
		<form enctype="multipart/form-data" name="formFase1" method="post">
			
		</form>
	</div>
</body>
</html>