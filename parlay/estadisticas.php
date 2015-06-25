<?Php
	include_once "./classes/DateUtil.php";
	$fecha_desde = DateUtil::getDateUnderVzlaTZDayMonthYear();
	$fec_emision = DateUtil::getDateUnderVzlaTZDayMonthYear();
	$fecha_hasta = DateUtil::getDateUnderVzlaTZDayMonthYear();
?>
	<br>
	<div align="center" class="titulo">Estadisticas del Sistema</div>
	<div align="center">
		<strong>Desde:</strong>
		<input type="text" name="fdesde" id="fdesde" readonly="readonly" value="<?Php echo $fecha_desde;?>" class="fecha" style="cursor:pointer;" />
		<strong>Hasta:</strong>
		<input type="text" name="fhasta" id="fhasta" readonly="readonly" value="<?Php echo $fecha_hasta;?>" class="fecha" style="cursor:pointer;" />
		<input type="button" class="boton" id="carga_formulario" value="Buscar" />
	</div>
	
	<div id="rep_dinamico">
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".fecha").datepicker();
		    $("#carga_formulario").click(function(evento){
				evento.preventDefault();
				//alert($("#scategorias").val());
				$("#carga_load").css("display", "inline");
				$("#carga").css("display", "inline");
				$("#rep_dinamico").load("reportes/reporte_estadisticas.php?fdesde="+$("#fdesde").val()+"&fhasta="+$("#fhasta").val(), function(response, status, xhr){
					if (status == "error") {
						alert('Pagina del reporte no encontrada, o se esta presentando problemas de conexión... intente de nuevo!!!');					  
					}
					
					$("#carga_load").css("display", "none");
					$("#carga").css("display", "none");
				});
			});
		});
	</script>