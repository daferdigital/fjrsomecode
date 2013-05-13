<?
session_start();

include('../procesos/conexion.php');
include_once('fechas.php'); 
?>
<style type="text/css">
td {font-size:12px;}
.color_titu {
	color: #FFF;
}
</style>
</head>
<br><br><?
	$fecha_desde1= formato_sql($_GET['fdesde'],'/');
	
	if($_SESSION['perfil']=='1'){
	//SUPER ADMIN
		$where='';
	}else if($_SESSION['perfil']=='2'){
	//BANQUERO  (BANQUEROS DEL ADMIN)
		$where=" and idbanquero='".$_SESSION['datos']['idbanquero']."' ";
	}else if($_SESSION['perfil']=='3'){
	//INTERMEDIARIO (INTERMEDIARIOS DEL BANQUERO)
		$where=" and idintermediario='".$_SESSION['datos']['idintermediario']."' ";
	}else if($_SESSION['perfil']=='4'){
	//INTERMEDIARIO (INTERMEDIARIOS DEL BANQUERO)
		$where=" and idtaquilla='".$_SESSION['datos']['idtaquilla']."' ";
	}

$sql="SELECT nombre_categoria, nombre_equipo,
	SUM(CASE WHEN descripcion_apuesta = 'A Ganar JC' THEN apuesta END) AS GanarJC,
    COUNT(CASE WHEN descripcion_apuesta = 'A Ganar JC' THEN apuesta END) AS cuentaGanarJC,
	SUM(CASE WHEN descripcion_apuesta = 'A Ganar MJ' THEN apuesta END) AS GanarMJ,
    COUNT(CASE WHEN descripcion_apuesta = 'A Ganar MJ' THEN apuesta END) AS cuentaGanarMJ,
	SUM(CASE WHEN descripcion_apuesta = 'A Ganar 2M' THEN apuesta END) AS Ganar2M,
	COUNT(CASE WHEN descripcion_apuesta = 'A Ganar 2M' THEN apuesta END) AS cuentaGanar2M,	
	SUM(CASE WHEN descripcion_apuesta = 'RLJC' THEN apuesta END) AS RLJC,
    COUNT(CASE WHEN descripcion_apuesta = 'RLJC' THEN apuesta END) AS cuentaRLJC,
	SUM(CASE WHEN descripcion_apuesta = 'RLMJ' THEN apuesta END) AS RLMJ,
    COUNT(CASE WHEN descripcion_apuesta = 'RLMJ' THEN apuesta END) AS cuentaRLMJ,
	SUM(CASE WHEN descripcion_apuesta = 'SRL' THEN apuesta END) AS SRL,
    COUNT(CASE WHEN descripcion_apuesta = 'SRL' THEN apuesta END) AS cuentaSRL,
	SUM(CASE WHEN descripcion_apuesta = 'RLAJC' THEN apuesta END) AS RunLineAlt,
    COUNT(CASE WHEN descripcion_apuesta = 'RLAJC' THEN apuesta END) AS cuentaRunLineAlt,
	SUM(CASE WHEN descripcion_apuesta = 'Alta JC' THEN apuesta END) AS AltasJC,
    COUNT(CASE WHEN descripcion_apuesta = 'Alta JC' THEN apuesta END) AS cuentaAltasJC,
	SUM(CASE WHEN descripcion_apuesta = 'Baja JC' THEN apuesta END) AS BajaJC,
    COUNT(CASE WHEN descripcion_apuesta = 'Baja JC' THEN apuesta END) AS cuentaBajaJC,
	SUM(CASE WHEN descripcion_apuesta = 'Alta MJ' THEN apuesta END) AS AltasMJ,
    COUNT(CASE WHEN descripcion_apuesta = 'Alta MJ' THEN apuesta END) AS cuentaAltasMJ,
	SUM(CASE WHEN descripcion_apuesta = 'Baja MJ' THEN apuesta END) AS BajaMJ,
    COUNT(CASE WHEN descripcion_apuesta = 'Baja MJ' THEN apuesta END) AS cuentaBajaMJ,
	SUM(CASE WHEN descripcion_apuesta = 'Alta 6to' THEN apuesta END) AS Alta2M,	
    COUNT(CASE WHEN descripcion_apuesta = 'Alta 6to' THEN apuesta END) AS cuentaAlta2M,	
	SUM(CASE WHEN descripcion_apuesta = 'Baja 6to' THEN apuesta END) AS Baja2M,	
    COUNT(CASE WHEN descripcion_apuesta = 'Baja 6to' THEN apuesta END) AS cuentaBaja2M,	
	SUM(CASE WHEN descripcion_apuesta = 'No' THEN apuesta END) AS No,
    COUNT(CASE WHEN descripcion_apuesta = 'No' THEN apuesta END) AS cuentaNo,
	SUM(CASE WHEN descripcion_apuesta = 'Si' THEN apuesta END) AS Si,
    COUNT(CASE WHEN descripcion_apuesta = 'Si' THEN apuesta END) AS cuentaSi,
	SUM(CASE WHEN descripcion_apuesta = '1ero' THEN apuesta END) AS 1ero,
	COUNT(CASE WHEN descripcion_apuesta = '1ero' THEN apuesta END) AS cuenta1ero,
	SUM(CASE WHEN descripcion_apuesta = '1ero' THEN apuesta END) AS che,	
    COUNT(CASE WHEN descripcion_apuesta = '1ero' THEN apuesta END) AS cuentache,	
	SUM(CASE WHEN descripcion_apuesta = 'ACHE' THEN apuesta END) AS ACHE,	
    COUNT(CASE WHEN descripcion_apuesta = 'ACHE' THEN apuesta END) AS cuentaACHE,	
	SUM(CASE WHEN descripcion_apuesta = 'BCHE' THEN apuesta END) AS BCHE,
    COUNT(CASE WHEN descripcion_apuesta = 'BCHE' THEN apuesta END) AS cuentaBCHE
	FROM vista_ventas_detalles 
	WHERE fecha_venta='$fecha_desde1' $where
	GROUP BY nombre_equipo
	ORDER BY idliga";

	
$res=mysql_query($sql,$conexion);


if ($row=mysql_fetch_array($res)) {
	
	if ($row["nombre_categoria"]!=''){////Beisbol?>
		<table width="1200" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="19"><div align="center">REPORTE APUESTAS MAS JUGADAS</div></td>
          </tr>
          <tr class="tope borde_bottom">
            <td width="285" rowspan="2" bgcolor="#000000"><div align="center"><strong><span class="color_titu">Equipo</span></strong></div></td>
            <td colspan="3" bgcolor="#000000"><div align="center"><strong><span class="color_titu">A GANAR</span></strong></div></td>
            <td colspan="4" bgcolor="#000000"><div align="center"><strong><span class="color_titu">RUN LINE</span></strong></div></td>
            <td colspan="6" bgcolor="#000000"><div align="center"><strong><span class="color_titu">ALTAS Y BAJAS</span></strong></div></td>
            <td colspan="2" bgcolor="#000000"><div align="center"><strong><span class="color_titu">CHE</span></strong></div></td>
            <td colspan="2" bgcolor="#000000"><div align="center"><strong><span class="color_titu">Primer Inning</span></strong></div></td>
            <td rowspan="2" bgcolor="#000000"><div align="center"><strong><span class="color_titu">Anota <br />
Primero</span></strong></div></td>
          </tr>
          <tr>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">JC</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">MJ</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">2M</span></strong></div></td>
            <td bgcolor="#000000"> <div align="center"><strong><span class="color_titu">JC</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">MJ</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">AL</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">Super</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">A.JC </span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu"> B.JC </span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu"> A.MJ</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">MJB</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">A.2M</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">B.2M</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">A</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">B</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">Si</span></strong></div></td>
            <td bgcolor="#000000"><div align="center"><strong><span class="color_titu">No</span></strong></div></td>
          </tr>
          <?
		do{?>
          <tr>
            <td style="font-size:16px;"><? echo $row["nombre_equipo"];?></td>
            <td width="65">
            	<div style="text-align:right; <? if ($row["GanarJC"]>10000){ ?>color:#0C0; font-weight:bold;<? }?>">
				<? echo number_format($row["GanarJC"], 2, '.', '')." (".$row["cuentaGanarJC"].")";?></div></td>
            <td width="65">
            	<div style="text-align:right; <? if ($row["GanarMJ"]>10000){ ?>color:#0C0; font-weight:bold;<? }?>">
				<? echo $row["GanarMJ"]." (".$row["cuentaGanarMJ"].")";?></div></td>
            <td width="56">
                <div style="text-align:right; <? if ($row["Ganar2M"]>10000){ ?>color:#0C0; font-weight:bold;<? }?>">
                <? echo $row["Ganar2M"]." (".$row["cuentaGanar2M"].")";?></div></td>
            <td width="52">
                <div style="text-align:right; <? if ($row["RLJC"]>10000){ ?>color:#0C0; font-weight:bold;<? }?>">
                <? echo $row["RLJC"]." (".$row["cuentaRLJC"].")";?></div></td>
            <td width="53"><div align="right"><? echo $row["RLMJ"]." (".$row["cuentaRLMJ"].")";?></div></td>
            <td width="48"><div align="right"><? echo $row["RunLineAlt"]." (".$row["cuentaRunLineAlt"].")";?></div></td>
            <td width="46"><div align="right"><? echo $row["SRL"]." (".$row["cuentaSRL"].")";?></div></td>
            <td width="51"><div align="right"><? echo $row["AltasJC"]." (".$row["cuentaAltasJC"].")";?></div></td>
            <td width="47"><div align="right"><? echo $row["BajaJC"]." (".$row["cuentaBajaJC"].")";?></div></td>
            <td width="47"><div align="right"><? echo $row["AltasMJ"]." (".$row["cuentaAltasMJ"].")";?></div></td>
            <td width="43"><div align="right"><? echo $row["BajaMJ"]." (".$row["cuentaBajaMJ"].")";?></div></td>
            <td width="53"><div align="right"><? echo $row["Alta2M"]." (".$row["cuentaAlta2M"].")";?></div></td>
            <td width="52"><div align="right"><? echo $row["Baja2M"]." (".$row["cuentaBaja2M"].")";?></div></td>
            <td width="28"><div align="right"><? echo $row["ACHE"]." (".$row["cuentaACHE"].")";?></div></td>
            <td width="32"><div align="right"><? echo $row["BCHE"]." (".$row["cuentaBCHE"].")";?></div></td>
            <td width="40"><div align="right"><? echo $row["Si"]." (".$row["cuentaSi"].")";?></div></td>
            <td width="37"><div align="right"><? echo $row["No"]." (".$row["cuentaNo"].")";?></div></td>
            <td width="60"><div align="right"><? echo $row["1ero"]." (".$row["cuenta1ero"].")";?></div></td>
          </tr>
          <?
		  $totalJC=$totalJC+$row["GanarJC"];
		  $totalMJ=$totalMJ+$row["GanarMJ"];
		  $Ganar2M=$Ganar2M+$row["Ganar2M"];
		  $RLJC=$RLJC+$row["RLJC"];
		  $RLMJ=$RLMJ+$row["RLMJ"];
		  $RunLineAlt=$RunLineAlt+$row["RunLineAlt"];		  
		  $SRL=$SRL+$row["SRL"];
		  $totalAltas=$totalAltas+$row["AltasJC"];
       	}while ($row=mysql_fetch_array($res));?>
          <tr>
            <td bgcolor="#CCCCCC" align="center"><strong>Totales</strong></td>
            <td bgcolor="#CCCCCC"><div align="right"><strong><? echo number_format($totalJC, 2, '.', '');?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="right"><strong><? echo number_format($totalMJ, 2, '.', '');?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="right"><strong><? echo number_format($Ganar2M, 2, '.', '');?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="right"><strong><? echo number_format($RLJC, 2, '.', '');?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="right"><strong><? echo number_format($RLMJ, 2, '.', '');?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="right"><strong><? echo number_format($RunLineAlt, 2, '.', '');?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="right"><strong><? echo number_format($SRL, 2, '.', '');?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="right"><strong><? echo number_format($totalAltas, 2, '.', '');?></strong></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td colspan="2" bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
          </tr><? /*
          <tr>
            <td bgcolor="#CCCCCC"><strong>Monto Apostado</strong></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td colspan="2" bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
            <td bgcolor="#CCCCCC"><div align="right"></div></td>
          </tr>
		 */?>
		</table><?
}}else{echo "<br><br><center><strong>Para la fecha seleccionada no hay Datos para mostrar</strong></center><br><br>";}
/*
else if($row["nombre_categoria"]=='Futbol'){}?>
*/?></body>
</html>
<?
mysql_close($conexion);?>
<script language="javascript">
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