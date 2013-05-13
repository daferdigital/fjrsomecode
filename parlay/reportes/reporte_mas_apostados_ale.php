<?
include('../procesos/conexion.php');
include_once('fechas.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body><?

//$concat 
$sql="SELECT *,
	COUNT(CASE descripcion_apuesta WHEN 'A Ganar JC' THEN descripcion_apuesta END) AS GanarJC, 
	COUNT(CASE descripcion_apuesta WHEN 'A Ganar MJ' THEN descripcion_apuesta END) AS GanarMJ, 
	COUNT(CASE descripcion_apuesta WHEN 'A Ganar 2M' THEN descripcion_apuesta END) AS Ganar2M, 
	COUNT(CASE descripcion_apuesta WHEN 'RLJC' THEN descripcion_apuesta END) AS RLJC,
	COUNT(CASE descripcion_apuesta WHEN 'RLMJ' THEN descripcion_apuesta END) AS RLMJ,
	COUNT(CASE descripcion_apuesta WHEN 'SRL' THEN descripcion_apuesta END) AS SRL, 
	COUNT(CASE descripcion_apuesta WHEN 'RunLine Alternativo' THEN descripcion_apuesta END) AS RunLineAlt,
	COUNT(CASE descripcion_apuesta WHEN 'Alta JC' THEN descripcion_apuesta END) AS AltasJC, 
	COUNT(CASE descripcion_apuesta WHEN 'Baja JC' THEN descripcion_apuesta END) AS BajaJC, 
	COUNT(CASE descripcion_apuesta WHEN 'Alta MJ' THEN descripcion_apuesta END) AS AltasMJ, 
	COUNT(CASE descripcion_apuesta WHEN 'Baja MJ' THEN descripcion_apuesta END) AS BajaMJ, 
	COUNT(CASE descripcion_apuesta WHEN 'Alta 6to' THEN descripcion_apuesta END) AS Alta2M,
	COUNT(CASE descripcion_apuesta WHEN 'Baja 6to' THEN descripcion_apuesta END) AS Baja2M,
	COUNT(CASE descripcion_apuesta WHEN 'No' THEN descripcion_apuesta END) AS No, 
	COUNT(CASE descripcion_apuesta WHEN 'Si' THEN descripcion_apuesta END) AS Si,
	COUNT(CASE descripcion_apuesta WHEN '1ero' THEN descripcion_apuesta END) AS 1ero,	
	COUNT(CASE descripcion_apuesta WHEN '1ero' THEN descripcion_apuesta END) AS che,		
	COUNT(CASE descripcion_apuesta WHEN 'ACHE' THEN descripcion_apuesta END) AS ACHE,	
	COUNT(CASE descripcion_apuesta WHEN 'BCHE' THEN descripcion_apuesta END) AS BCHE		
	FROM vista_ventas_detalles 
	WHERE fecha_venta='2012-07-08'
	GROUP BY nombre_equipo
	ORDER BY hora_juego";
$res=mysql_query($sql,$conexion);


if ($row=mysql_fetch_array($res)) {
	
	if ($row["nombre_categoria"]=='Beisbol'){?>
		<table width="1053" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="19"><div align="center">APUESTAS JUGADAS - BEISBOL</div></td>
          </tr>
          <tr class="tope borde_bottom">
            <td width="216" rowspan="2"><div align="center">Equipo</div></td>
            <td colspan="3"><div align="center">A GANAR</div></td>
            <td colspan="4"><div align="center">RUN LINE</div></td>
            <td colspan="6"><div align="center">ALTAS Y BAJAS</div></td>
            <td colspan="2"><div align="center">CHE</div></td>
            <td colspan="2"><div align="center">Primer Inning</div></td>
            <td rowspan="2"><div align="center">Anota <br />
Primero</div></td>
          </tr>
          <tr>
            <td><div align="center">JC</div></td>
            <td><div align="center">MJ</div></td>
            <td><div align="center">2M</div></td>
            <td> <div align="center">JC</div></td>
            <td><div align="center">MJ</div></td>
            <td><div align="center">AL</div></td>
            <td><div align="center">Super</div></td>
            <td><div align="center">A.JC </div></td>
            <td><div align="center"> B.JC </div></td>
            <td><div align="center"> A.MJ</div></td>
            <td><div align="center">MJB</div></td>
            <td><div align="center">A.2M</div></td>
            <td><div align="center">B.2M</div></td>
            <td><div align="center">A</div></td>
            <td><div align="center">B</div></td>
            <td><div align="center">Si</div></td>
            <td><div align="center">No</div></td>
          </tr>
          <?
		do{?>
          <tr>
            <td><? echo $row["nombre_equipo"];?></td>
            <td width="44"><div align="center"><? echo $row["GanarJC"];?></div></td>
            <td width="44"><div align="center"><? echo $row["GanarMJ"];?></div></td>
            <td width="44"><div align="center"><? echo $row["Ganar2M"];?></div></td>
            <td width="44"><div align="center"><? echo $row["RLJC"];?></div></td>
            <td width="44"><div align="center"><? echo $row["RLMJ"];?></div></td>
            <td width="44"><div align="center"><? echo $row["RunLineAlt"];?></div></td>
            <td width="45"><div align="center"><? echo $row["SRL"];?></div></td>
            <td width="45"><div align="center"><? echo $row["AltasJC"];?></div></td>
            <td width="45"><div align="center"><? echo $row["BajaJC"];?></div></td>
            <td width="45"><div align="center"><? echo $row["AltasMJ"];?></div></td>
            <td width="45"><div align="center"><? echo $row["BajaMJ"];?></div></td>
            <td width="56"><div align="center"><? echo $row["Alta2M"];?></div></td>
            <td width="55"><div align="center"><? echo $row["Baja2M"];?></div></td>
            <td width="30"><div align="center"><? echo $row["ACHE"];?></div></td>
            <td width="34"><div align="center"><? echo $row["BCHE"];?></div></td>
            <td width="43"><div align="center"><? echo $row["Si"];?></div></td>
            <td width="39"><div align="center"><? echo $row["No"];?></div></td>
            <td width="51"><div align="center"><? echo $row["1ero"];?></div></td>
          </tr>
          <?
		  $totalAltas=$totalAltas+$row["AltasJC"];
       	}while ($row=mysql_fetch_array($res));?>
                  <tr>
            <td bgcolor="#CCCCCC"><strong>Total de Veces Apostado</strong></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"><strong><? echo $totalAltas;?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td colspan="2" bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC"><strong>Monto Apostado</strong></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td colspan="2" bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC"><div align="center"></div></td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>

		</table><?
}}
/*
else if($row["nombre_categoria"]=='Futbol'){}?>
*/?></body>
</html>
<?
mysql_close($conexion);
?>