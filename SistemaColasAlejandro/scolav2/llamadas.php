<!DOCTYPE script PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
	<title>.:: Maternidad la Floresta ::.</title>
	
	<link rel="stylesheet" type="text/css" href="css/llamadas.css" />
	
	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/site.js"></script>
</head>
<body>
	<div id="contenidoDinamico">
	</div>
	<script type="text/javascript">
		function refreshMarquee(){
			$.ajax({
				// la URL para la petición
				url : 'ajax/getLlamadas.php',

			  	// la información a enviar
				// (también es posible utilizar una cadena de datos)
				//data : {},
			  	
				// especifica si será una petición POST o GET
				type : 'POST',
			  	
				// el tipo de información que se espera de respuesta
				//dataType : 'json',
				dataType : 'html',
			  	
				// código a ejecutar si la petición es satisfactoria;
				// la respuesta es pasada como argumento a la función
				success : function(json) {
					 /* $('<h1/>').text(json.title).appendTo('body');
					  $('<div class="content"/>')
						  .html(json.html).appendTo('body');*/
						  if(json)
						 	$('#contenidoDinamico').html(json);
				},
			  	
				// código a ejecutar si la petición falla;
				// son pasados como argumentos a la función
				// el objeto de la petición en crudo y código de estatus de la petición
				error : function(xhr, status) {
					//alert('Disculpe, ocurrio un problema');
				},

				// codigo a ejecutar sin importar si la peticion fallo o no
				complete : function(xhr, status) {
					// alert('Petición realizada');
				}
			});
		}

		setInterval("refreshMarquee()", 10000);
	</script>
</body>
</html>