<?
include ("../procesos/conexion.php");
include_once('fechas.php'); 

$envio1=$_POST["envio"];
$departamento1=$_POST["departamento"];

	$fecha_desde=$_POST["fecha_desde"];
	$fecha_desde1= FechaOrdenar($fecha_desde, "/", "");
	
	$fecha_hasta=$_POST["fecha_hasta"];
	$fecha_hasta1= FechaOrdenar($fecha_hasta, "/", "");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: SATRIM :.</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<link href="datepicker/epoch_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="datepicker/epoch_classes.js"></script>
<script language="javascript" src="old.sm.js"></script>

<script>
window.onload = function () {
		var obj;
		// nombre del div donde se crea el calendario, forma de aparecer, objeto donde se va a colocar
		obj  = new Epoch('divfechan','popup',document.getElementById('fecha_desde'));
		obj  = new Epoch('divfechan2','popup',document.getElementById('fecha_hasta'));
}


function validar(consulta){
	
	if (consulta.fecha_desde.value == ""){
	 alert("Introduzca la Fecha de Inicio"); 
		 consulta.fecha_desde.focus(); 
		 return (false); 
	 }

	if (consulta.fecha_hasta.value == ""){
	 alert("Introduzca la Fecha Final"); 
		 consulta.fecha_hasta.focus(); 
		 return (false); 
	 }

	if (consulta.presentacion.value == ""){
	 alert("Indique el formato de salida"); 
		 consulta.presentacion.focus(); 
		 return (false); 
	 }

	if (consulta.estilo.value == ""){
	 alert("Indique el estilo"); 
		 consulta.estilo.focus(); 
		 return (false); 
	 }

}
</script> 
<style type="text/css">
.desaparece {display:none}
</style>
</head>

<body>
<div align="center"><img src="../imagenes/HEADER_LOCKHEART.png" width="803" height="103" border="0" /></div>
<form method="post" name="consulta" action="estadistica.php" onSubmit="return validar(this)">
<div class="desaparece">
	<input name="envio" value="E" type="text" size="15" maxlength="10">
</div>
<table width="800" border="0" align="center">
  <tr>
    <td colspan="2" align="left">
    <input type="button" class="boton" value="MENU" onclick="javascript:location.href='../index.php';" />
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>Consulta de Visitas </strong></td>
  </tr>
  <tr>
    <td width="242" align="right">&nbsp;</td>
    <td width="354">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Fecha desde:</td>
    <td>
    <input id="fecha_desde" name="fecha_desde" class="caja_tex" value="<? echo $fecha_desde;?>" type="text" size="15" maxlength="10"><div id="divfechan"></div> 
    </td>
  </tr>
  <tr>
    <td align="right">Fecha hasta:</td>
    <td>    <input id="fecha_hasta" name="fecha_hasta" class="caja_tex" value="<? echo $fecha_hasta;?>" type="text" size="15" maxlength="10"><div id="divfechan2"></div> 
</td>
  </tr>
  <tr>
    <td  align="right">Formato de Presentación:</td>
    <td><select size="1" name="presentacion">
      <option value="1" selected="selected">En Pantalla</option>
      <option value="2">Hoja de C&aacute;lculo</option>
    </select></td>
  </tr>
  <tr>
    <td align="right">Estilo:</td>
    <td align="left">
    <select size="1" name="estilo">
      <option selected="selected" value="">Seleccione..</option>
      <option value="1">Detallar Por Fecha</option>
      <option value="2">Totalizar Intervalos</option>
    </select></td>
  </tr>
  <tr>
    <td align="right">Departamento:</td>
    <td align="left"><select id="departamento" size="1" name="departamento">
        <?
	$result1 = mysql_query("select * from departamentos", $conexion);
	 $num_rows1 = mysql_num_rows($result1);
	if ($num_rows1 != 0){?>
        <option selected="selected" value="">Todos los Departamentos</option>
        <?
			for($i=1;$i<=$num_rows1;$i++){
			$j=$i-1;
			$descripcion=mysql_result($result1, $j, "descripcion");
			$id=mysql_result($result1, $j, "iddepartamento");
			echo "<option value=".$id.">".$descripcion."</option>";}}?>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type='submit' class="boton" value='Ejecutar consulta' />
      <input type='reset' class="boton" value='Limpiar Datos' /></td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
    <?php
if($envio1=='E'){
	$presentacion1=$_POST["presentacion"];
		
		$estilo1=$_POST["estilo"];
		if ($estilo1==1){
			$grupo="d.descripcion, e.fecha";
		}else if ($estilo1==2){
			$grupo="d.descripcion";
		}else{}
	
	if($departamento1>='1'){
		$fil_dep="AND d.iddepartamento='$departamento1'";	
	}
	
	
	$sql="select e.fecha, d.descripcion, COUNT(*) AS total from tickets_encabezados e 
			LEFT JOIN tickets_detalles td ON (e.idticket_encabezado=td.idticket_encabezado) 
			LEFT JOIN departamentos d ON (e.iddepartamento=d.iddepartamento) 
			WHERE e.fecha BETWEEN '$fecha_desde1' AND '$fecha_hasta1' $fil_dep
			GROUP BY $grupo
			ORDER BY e.fecha ASC, td.hora ASC";	

/*select e.fecha, d.descripcion, COUNT(*) from tickets_encabezados e
			LEFT JOIN tickets_detalles td ON  (e.idticket_encabezado=td.idticket_encabezado)
			LEFT JOIN departamentos d ON (e.iddepartamento=d.iddepartamento)
			WHERE e.fecha BETWEEN '$fecha_desde1' AND '$fecha_hasta1'
			GROUP BY d.descripcion
			ORDER BY e.fecha ASC, td.hora ASC*/
	$res=mysql_query($sql);

	if ($presentacion1==1){}
	else if ($presentacion1==2){
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: filename=\"excel.xls\";");
	}else{
		echo "<center>Debe seleccionar las fechas</center>";
	}

?>
<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="left" colspan="4"><p>Desde:<? echo $fecha_desde; ?><br />
      Hasta:<? echo $fecha_hasta; ?></p></td>
    </tr>
  <tr>
   	<? if ($estilo1==2){?>
	    <td align="center" bgcolor="#E2E2E2"><strong>Departamento</strong></td>
    <? }else{?>
        <td align="center" bgcolor="#E2E2E2"><strong>Fecha</strong></td>
        <td align="center" bgcolor="#E2E2E2"><strong>Departamento</strong></td>
    <? }?>
    <td align="center" bgcolor="#E2E2E2"><strong>Personas Atendidas</strong></td>
  </tr>
  <? 
  if ($row=mysql_fetch_array($res)) {
	  do {?>
  <tr>
  	<? if ($estilo1==2){?>
        <td align="left"><a href="estadistica_detalles.php?dep=<? echo $row["descripcion"];?>&fecha_desde=<? echo $fecha_desde1; ?>&fecha_hasta=<? echo $fecha_hasta1;?>"><? echo $row["descripcion"];?></a></td>
    <? }else{?>
        <td align="center"><? echo (FechaOrdenar($row['fecha'],"-",""));?></td>
        <td><a href="estadistica_detalles.php?dep=<? echo $row["descripcion"];?>&fecha_desde=<? echo $fecha_desde1; ?>&fecha_hasta=<? echo $fecha_hasta1;?>"><? echo $row["descripcion"];?></a></td>
    <? }?>
    
    
    <td align="center"><? echo $row["total"];?></td>
  </tr>  
	<? } while ($row=mysql_fetch_array($res));
  }
	?>
</table>
<? }
/*		
		$columnas = mysql_num_fields($res);
		
		echo "<table>";
		echo "<tr>";
		
		for($i=0; $i<$columnas; $i++){
				echo "<td><strong>".mysql_field_name($res,$i)."</strong></td>";
		}
		
		echo "</tr>";
		
		while($datos = mysql_fetch_assoc($res)){
				echo "<tr>";
				for($j=0; $j<$columnas; $j++){
						echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
				}
				echo "</tr>";
		}
		
		echo "</table>";
		}
*/
////}else{}
?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>
</form>  
</body>
</html>