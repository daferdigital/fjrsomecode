<?Php 
include('../procesos/conexion.php');
include_once('fechas.php'); 
//	$fecha_desde=formato_sql($_GET['fdesde'],'/');
///	$fecha_hasta= formato_sql($_GET['fhasta'],'/');
if ($_GET["fdesde"]!=''){
	$fecha_desde1= formato_sql($_GET['fdesde'],'/');
	$fecha_hasta1=formato_sql($_GET['fhasta'],'/');
}else{
	$fecha_desde1=formato_sql($_GET['fdesde'],'/');
	$fecha_hasta1=formato_sql($_GET['fhasta'],'/');
}

$sql =  " SELECT IF(valorlogroA.pago < valorlogroB.pago, valorlogroA.pago, valorlogroB.pago) AS macho, COUNT(*) AS apuestas";
$sql .= " FROM vista_resultados AS equipoA, vista_resultados AS equipoB, logros_equipos_categorias_apuestas AS valorlogroA, logros_equipos_categorias_apuestas AS valorlogroB";
$sql .= " WHERE equipoA.idcategoria_resultado = 15";
$sql .= " AND equipoB.idcategoria_resultado = 16";
$sql .= " AND equipoA.estatus = 1";
$sql .= " AND equipoB.estatus = 1";
$sql .= " AND valorlogroA.idcategoria_apuesta = 19";
$sql .= " AND valorlogroB.idcategoria_apuesta = 21";
$sql .= " AND equipoA.idlogro = equipoB.idlogro";
$sql .= " AND valorlogroA.idlogro_equipo = equipoA.idlogro_equipo";
$sql .= " AND valorlogroB.idlogro_equipo = equipoB.idlogro_equipo";
$sql .= " AND ((equipoA.resultado = 0 AND equipoB.resultado = 0)";
$sql .= " OR (equipoA.resultado = 1 AND equipoB.resultado = 1))";
$sql .= " AND equipoA.fecha > '".$fecha_desde1."'";
$sql .= " AND equipoB.fecha > '".$fecha_desde1."'";
$sql .= " AND equipoA.fecha < '".$fecha_hasta1."'";
$sql .= " AND equipoB.fecha < '".$fecha_hasta1."'";
$sql .= " GROUP BY IF(valorlogroA.pago < valorlogroB.pago, valorlogroA.pago, valorlogroB.pago)";
$sql .= " HAVING macho IS NOT NULL AND macho <> ''";
$sql .= " ORDER BY 2 DESC, 1";

$results = DBUtil::executeSelect($sql);
?>

<table width="1000" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
	<tr>
    	<td colspan="2" style="color:#03F; font-size:16px; height:40px; font-weight:bold; text-align:right">
        	<br />
        	Estadisticas (empates 0-0 y 1-1)
        </td>
    </tr>
    <tr>
        <td width="50" bgcolor="#CCCCCC"><div align="center"><b>MACHO</b></div></td>
        <td width="273" bgcolor="#CCCCCC"><div align="center"><b>APUESTAS</b></div></td>
	</tr>
<? 
	
	foreach ($results as $row){
?>
		<tr>
	        <td width="50" bgcolor="#CCCCCC">
	        	<div align="center">
	        		<b><?php echo $row["macho"];?></b>
	        	</div>
	        </td>
	        <td width="273" bgcolor="#66FF33">
	        	<div align="center">
	        		<?php echo $row["apuestas"];?>
	        	</div>
	        </td>
		</tr>
<?php
	}

	mysql_close($conexion);
?>
</table>

<script type="text/javascript">
	$(document).ready(function(){
	   $(".ajax_reporte").click(function(evento){
		  // alert(this.href);
		   evento.preventDefault();
		   	  $("#carga_load").css("display", "inline");
			  $("#carga").css("display", "inline");
			 // $('#contenido_padre').load("logros.php");return false;
		   $('#rep_dinamico').load(this.href, function(response, status, xhr){
			   if (status == "error") {
					  alert('Pagina no encontrada, o se esta presentando problemas de conexión a internet... intente de nuevo!!!');					  
				 }
				$("#carga_load").css("display", "none");
				$("#carga").css("display", "none");
			});
	   });	   
	})
</script>