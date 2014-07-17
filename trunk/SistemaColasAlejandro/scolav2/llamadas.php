<?php
	include_once("includes/headerLlamadas.php");
?>
	<div id="ultimoLlamado"></div>
	<div id="contenidoMarquee"></div>
	
	<script type="text/javascript">
		$(document).ready(function() {
	        var audioElement = document.createElement('audio');
	        audioElement.setAttribute('src', 'audio/timbre.mp3');
	        
	     	audioElement.addEventListener("load", function() {
	            audioElement.play();
	        }, true);
			
	        $('#ultimoLlamado').click(function() {
	            audioElement.play();
	        });
	    });
	    
		function refreshUltimoLlamado(){
			$.ajax({
				// la URL para la peticion
				url : 'ajax/getLlamadas.php',

			  	// la informacion a enviar
				// (tambion es posible utilizar una cadena de datos)
				//data : {},
			  	
				// especifica si sera una peticion POST o GET
				type : 'POST',
			  	
				// el tipo de informacion que se espera de respuesta
				//dataType : 'json',
				dataType : 'html',
			  	
				// codigo a ejecutar si la peticion es satisfactoria;
				// la respuesta es pasada como argumento a la funcion
				success : function(result) {
					if(result){
						var pieces = result.split(":,;")
						var prevHTML = $('#ultimoLlamado').html();

						$('#ultimoLlamado').html(pieces[1]);
						if(pieces[0] == "true" || prevHTML == ""){
							//debemos tocar el audio	
							$("#ultimoLlamado").click();
						}
					}
				}
			});
		}
		
		function refreshMarquee(largoEstimado){
			$.ajax({
				// la URL para la peticion
				url : 'ajax/getMarqueeContent.php',

			  	// la informacion a enviar
				// (tambien es posible utilizar una cadena de datos)
				data : {h:largoEstimado},
			  	
				// especifica si será una petición POST o GET
				type : 'POST',
			  	
				// el tipo de informacion que se espera de respuesta
				//dataType : 'json',
				dataType : 'html',
			  	
				// codigo a ejecutar si la peticion es satisfactoria;
				// la respuesta es pasada como argumento a la funcion
				success : function(result) {
					if(result){
						$('#contenidoMarquee').html(result);
					}
				}
			});
		}

		//obtenemos el largo estimado del marquee
		//los -100 son por la secci�n de "Ultimo Llamado"
		var heigthEstimado = parseInt(window.screen.height - $(document).height() - 100);
		setInterval("refreshUltimoLlamado()", 10000);
		setInterval(function(){
				refreshMarquee(heigthEstimado);
			}, 10000);
	</script>
<?php 
	include_once "includes/footerV2.php";
?>