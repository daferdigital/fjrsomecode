<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  	<title></title>
  	<link rel="stylesheet" href="css/smoothness/jquery-ui.css" />
  	<link rel="stylesheet" href="css/papeleria.css" />
  	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
  	<script type="text/javascript" src="js/jquery-ui.js"></script>
  	<script type="text/javascript" src="js/papeleria.js"></script>
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
    			<li><a href="#" onclick="loadFrame('papeleriaFiscal', 'formPart1', 'Facturas')">Facturas</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaFiscal', 'formPart1', 'Notas de Debito')">Notas de D&eacute;bito</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaFiscal', 'formPart1', 'Notas de Credito')">Notas de Cr&eacute;dito</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaFiscal', 'formPart1', 'Orden de Entrega')">Orden de Entrega</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaFiscal', 'formPart1', 'Forma Libre')">Forma Libre</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaFiscal', 'formPart1', 'Formas Continuas')">Formas Continuas</a></li>
    		</ul>
  		</div>
  		<h3>Papeleria Corporativa</h3>
  		<div style="padding: 0px;">
    		<ul>
    			<li><a href="#" onclick="loadFrame('papeleriaCorporativa', 'formPart1', 'Tarjetas de Presentacion')">Tarjetas de Presentaci&oacute;n</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaCorporativa', 'formPart1', 'Membretes')">Membretes</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaCorporativa', 'formPart1', 'Carpetas')">Carpetas</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaCorporativa', 'formPart1', 'Sobres')">Sobres</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaCorporativa', 'formPart1', 'Manuales')">Manuales</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaCorporativa', 'formPart1', 'Presentaciones Corporativas')">Presentaciones <br /> Corporativas</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaCorporativa', 'formPart1', 'Otros')">Otros</a></li>
    		</ul>
  		</div>
  		<h3>Papeleria Publicitaria</h3>
  		<div style="padding: 0px;">
    		<ul>
    			<li><a href="#" onclick="loadFrame('papeleriaPublicitaria', 'formPart1', 'Afiches')">Afiches</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaPublicitaria', 'formPart1', 'Tripticos / Dipticos')">Tr&iacute;pticos / D&iacute;pticos</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaPublicitaria', 'formPart1', 'Volantes')">Volantes</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaPublicitaria', 'formPart1', 'Calendario')">Calendario</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaPublicitaria', 'formPart1', 'Almanaque')">Almanaque</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaPublicitaria', 'formPart1', 'Carteles Comerciales')">Carteles Comerciales</a></li>
    			<li><a href="#" onclick="loadFrame('papeleriaPublicitaria', 'formPart1', 'Otros')">Otros</a></li>
    		</ul>
  		</div>
	</div>
	<div style="display: inline-block; width: 25%; vertical-align: top; margin-left: 15px;">
		<form action="aprobarSolicitud.php" enctype="multipart/form-data" name="formFase1" method="post" onsubmit="return validarSolicitud(this);">
			<span id="formPart1">
			</span>
			<span id="formPart2">
			</span>
		</form>
	</div>
</body>
</html>