<?Php include_once("procesos/conexion.php");?>
<script language="javascript">
	$(document).ready(function(){
		$("#carga_formulario").click(function(evento){
			if($("#scategorias").val()!='' && $("#sligas").val()!='' && $("#fecha_ld").val()!=''){
			  evento.preventDefault();
			  var pagina;
			  switch($("#scategorias").val()){
				  case '2': pagina='beisbol_banquero.php';
				  break;
				   case '1': pagina='futbol_banquero.php';
				  break;
				   case '3': pagina='basket_banquero.php';
				  break;
				   case '6': pagina='futbolamericano_banquero.php';
				  break;
				  default: pagina='no.php';
			  }
			  //alert($("#scategorias").val());
			  $("#carga_load").css("display", "inline");
			  $("#carga").css("display", "inline");
			  $("#contenido_parley").load("logros_"+pagina+"?liga="+$("#sligas").val()+"&categoria="+$("#scategorias").val()+"&fecha="+$("#fecha_ld").val(), function(response, status, xhr){
				  if (status == "error") {
					  alert('Pagina para la categoria '+pagina+' no encontrada, o se esta presentando problemas de conexión... intente de nuevo!!!');					  
				  }
					 $("#carga_load").css("display", "none");
					 $("#carga").css("display", "none");
				  
			  });
			}else{
				alert("Indique tanto la categoria y la liga para proceder la carga de logros");
			}
	   });
	})
</script>
	<?Php include("logro_dia.php");?>
	<div id="contenido_parley" style="margin-top:10px;"></div>
<script language="javascript">
$("#fecha_ld").datepicker();
</script>