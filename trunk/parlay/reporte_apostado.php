<?Php
	$fechas=getdate(mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
	
	
	$fecha_desde=date("d/m/Y");
	
	$can_dias = 1;
	$fec_emision = date('m/d/Y');
	$fecha_hasta= date("d/m/Y");///, strtotime("$fec_emision + $can_dias day"));  
?>
<br>
            <div align="center" class="titulo">Reporte de Jugadas m&aacute;s Apostadas </div>
<div align="center"><strong>Desde:</strong> <input type="text" name="fdesde" id="fdesde" readonly="readonly" value="<?Php echo $fecha_desde;?>" class="fecha" style="cursor:pointer;" /><input type="button" class="boton" id="carga_formulario" value="Buscar" /></div>
<div id="rep_dinamico">

</div>
<script language="javascript">
	$(document).ready(function() {
           $(".fecha").datepicker();
		   $("#carga_formulario").click(function(evento){
			
			  evento.preventDefault();
			  //alert($("#scategorias").val());
			  $("#carga_load").css("display", "inline");
			  $("#carga").css("display", "inline");
			  $("#rep_dinamico").load("reportes/reporte_mas_apostados1.php?fdesde="+$("#fdesde").val(), function(response, status, xhr){
				  if (status == "error") {
					  alert('Pagina para la categoria no encontrada, o se esta presentando problemas de conexión... intente de nuevo!!!');					  
				  }
					 $("#carga_load").css("display", "none");
					 $("#carga").css("display", "none");
				  
			  });
			
	   });		   
    });
	
</script>