<?Php include("procesos/sesiones.php");
	if($_SESSION['perfil']!=3){
		header("location: index.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: SATRIM :.</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script type="text/javascript" src="js/jquery-1.6.4.min.js" ></script>
<script type="text/javascript">
	function subDptoInfo(idDpto){
		var idElement = "detailDpto" + idDpto;
		var divElementInfo = document.getElementById(idElement);
		var imgArrowElement = document.getElementById("imgDpto" + idDpto);
		
		//verificamos la tarea a realizar
		if(divElementInfo.innerHTML == ""){
			//esta vacio el componente, debemos cargarlo con la info de los sub-dptos
			imgArrowElement.src = "imagenes/arrowUp.png";
			divElementInfo.innerHTML = "Informaci&oacute;n de los sub-departamentos: ";
			divElementInfo.style.display = "";
			refreshSubDptoInfo(idDpto);
		} else {
			divElementInfo.innerHTML = "";
			divElementInfo.style.display = "none";
			imgArrowElement.src = "imagenes/arrowDown.png";
		}
	}
</script> 
<style type="text/css">
	#terminal *{
		margin-left: 20px;
	}
</style>
</head>
<body>
	<?Php
		$sql_dptos="select * from departamentos where (iddpto_padre = 0 OR iddpto_padre IS NULL) AND estatus=1 ORDER BY LOWER(descripcion)";
		$departamentos=mysql_query($sql_dptos);
		
		if(mysql_num_rows($departamentos)>0){
	?>
		<div id="terminal">
		<?php 
			while ($dpto = mysql_fetch_array($departamentos)){
				//tenemos el listado de departamentos, los dibujamos
		?>
			<div class="dptoTitle">
				<span><?php echo $dpto["descripcion"];?></span>
				<img src="imagenes/arrowDown.png" id="imgDpto<?php echo $dpto["iddepartamento"];?>" onclick="subDptoInfo('<?php echo $dpto["iddepartamento"];?>')"/>
			</div>
			<div id="detailDpto<?php echo $dpto["iddepartamento"];?>" style="display: none;"></div>
		<?php
			} //fin del foreach
		?>
		</div>
	<?php
		} else {//fin del if(mysql_num_rows($departamentos)>0)
	?>
    		<div align="center" class="advertencia">
    			No se han cargado taquillas para el d&iacute;a <?Php echo date("d/m/Y");?>
    		</div>
    <?Php
		}
	?>
	
	<script type="text/javascript">
		function refreshSubDptoInfo(idDpto){
			$.ajax({
				url : 'ajax/disponibilidadSubDptos.php',
				data : {id : idDpto},
				type : 'POST',
				dataType : 'html',
				success : function(response) {
					if(response){
						$('#detailDpto'+idDpto).html(response);
						$('#detailDpto'+idDpto).show();
					  }
				},
				error : function(xhr, status) {
					alert('Disculpe, No pudo obtenerse la informacion');
					$('#detailDpto'+idDpto).hide();
					$('#detailDpto'+idDpto).html("");
				}
			});
		}
		
		function imprime_ticket(ido){
			var valor_dis=$("#dis_"+ido).html();
			//alert(valor_dis);
			//return false;
				$.ajax({
				  // la URL para la petición
				  url : 'imprime_ticket.php',
			  
				  // la información a enviar
				  // (también es posible utilizar una cadena de datos)
				  data : { iot : ido , valor : valor_dis},
			  
				  // especifica si será una petición POST o GET
				  type : 'GET',
			  
				  // el tipo de información que se espera de respuesta
				  //dataType : 'json',
				 dataType : 'html',
			  
				  // código a ejecutar si la petición es satisfactoria;
				  // la respuesta es pasada como argumento a la función
				  success : function(json) {
					 /* $('<h1/>').text(json.title).appendTo('body');
					  $('<div class="content"/>')
						  .html(json.html).appendTo('body');*/
						  //alert(json);
						  if(json){
							  $('#dis_'+ido).html(json);
						  }
				  },
			  
				  // código a ejecutar si la petición falla;
				  // son pasados como argumentos a la función
				  // el objeto de la petición en crudo y código de estatus de la petición
				  error : function(xhr, status) {
					  alert('Disculpe, existia un problema');
				  },
			  
				  // código a ejecutar sin importar si la petición falló o no
				  complete : function(xhr, status) {
					 // alert('Petición realizada');
				  }
			  });
			}
			
			jQuery('.todos_disponibles').hover(function(evento){
				jQuery('#f_'+jQuery(this).attr('id')).removeClass('flecha');
				jQuery('#f_'+jQuery(this).attr('id')).addClass('flecha_hover');
			},function(){
				jQuery('#f_'+jQuery(this).attr('id')).removeClass('flecha_hover');
				jQuery('#f_'+jQuery(this).attr('id')).addClass('flecha');
			});
	</script>
</body>
</html>