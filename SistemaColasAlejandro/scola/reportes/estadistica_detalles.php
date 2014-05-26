<?
include ("../procesos/conexion.php");
include_once('fechas.php'); 

	$fecha_desde=$_REQUEST["fecha_desde"];
	$fecha_desde1= FechaOrdenar($fecha_desde, "/", "");
	
	$fecha_hasta=$_REQUEST["fecha_hasta"];
	$fecha_hasta1= FechaOrdenar($fecha_hasta, "/", "");
	
	$departamento=$_REQUEST["dep"];

echo	$sql="SELECT td.idticket_detalle, d.descripcion, td.hora, td.hora_atendido, 
		subtime(td.hora_atendido, td.hora) AS total, o.nombre, o.telefono, te.fecha
		FROM tickets_detalles td
		LEFT JOIN tickets_encabezados te ON (td.idticket_encabezado=te.idticket_encabezado)
		LEFT JOIN departamentos d ON (te.iddepartamento=d.iddepartamento)
		LEFT JOIN operadores_taquillas ot ON (td.idoperador_taquilla=ot.idoperador_taquilla)
		LEFT JOIN operadores o ON (o.idoperador=ot.idoperador)
		WHERE d.descripcion='$departamento' AND te.fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'
		ORDER BY td.idticket_detalle, td.hora";	
	$res=mysql_query($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: SATRIM :.</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
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
    <td width="596" colspan="2" align="left">
      <a href="Javascript:history.back();"><< Regresar</a>
      </td>
  </tr>
  <tr>
    <td colspan="2">

  <table width="824" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td align="left" colspan="6">
      <p>
      <strong>Departamento:</strong> <? echo $departamento;?><br />
      <br /><strong>Desde:</strong><? echo $fecha_desde1; ?> | <strong>Hasta:</strong><? echo $fecha_hasta1; ?>
      </p></td>
      </tr>
    <tr>
      <td width="129" align="center" bgcolor="#E2E2E2"><strong>Ticket</strong></td>
      <td width="107" align="center" bgcolor="#E2E2E2"><strong>Hora de Llegada</strong></td>
      <td width="105" align="center" bgcolor="#E2E2E2"><strong>Hora de Atenci&oacute;n</strong></td>
      <td width="115" align="center" bgcolor="#E2E2E2"><strong>Tiempo <br />en Espera</strong></td>
      <td width="189" align="center" bgcolor="#E2E2E2"><strong>Nombre <br />del Operador</strong></td>
      <td width="149" align="center" bgcolor="#E2E2E2"><strong>Tel&eacute;fono</strong></td>
    </tr>
    <? 
  if ($row=mysql_fetch_array($res)) {
	  do {?>
    <tr>
      <td align="center" ><? echo $row["idticket_detalle"];?></td>
      <td align="center" ><? echo $row["hora"];?></td>
      <td align="center" ><? if($row["hora_atendido"]=='00:00:00'){echo "<center>No atendido</center>";
	  						}else{echo $row["hora_atendido"];}?></td>
      <td align="center"><? if($row["hora_atendido"]=='00:00:00'){echo "<center>No atendido</center>";
	  						}else{echo $row["total"];}?></td>
      <td align="center"><? echo $row["nombre"];?></td>
      <td align="center"><? echo $row["telefono"];?></td>
    </tr>  
    <? } while ($row=mysql_fetch_array($res));
  }
	?>
  </table>
      </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>
</form>  
</body>
</html>