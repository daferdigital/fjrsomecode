<?Php 
session_start();


//print_r($_SESSION);
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

$id_banquero=$_GET["idbanquero"];
$id_intermediario=$_GET["idintermediario"];
$id_taquilla=$_GET["idtaquilla"];


if($fecha_desde=='' && $fecha_hasta=='' && $id_banquero=='' && $id_intermediario=='' && $id_taquilla=='' && $_SESSION['perfil']=='1'){
	//SUPER ADMIN
	$select=", b.*";
	$nivel_muestra='1';
	$grupo="b.idbanquero";
	$ejecuta_sql=mysql_query($sql);
	
}else if($fecha_desde=='' && $fecha_hasta=='' && $id_banquero=='' && $id_intermediario=='' && $id_taquilla=='' && $_SESSION['perfil']=='2'){
	//BANQUERO  (BANQUEROS DEL ADMIN)
	$select=", b.*";
	$nivel_muestra='1';
	$grupo="b.idbanquero";
	$ejecuta_sql=mysql_query($sql);
	$where=" and b.idbanquero='".$_SESSION['datos']['idbanquero']."' ";
	
}else if($id_banquero!='' && $id_intermediario=='' && $id_taquilla=='' && ($_SESSION['perfil']=='1' || $_SESSION['perfil']=='2')){
	//INTERMEDIARIO (INTERMEDIARIOS DEL BANQUERO)
	$select=", i.* ";
	$intermediario=", i.pp, i.pd";
	$nivel_muestra='2';
	$where="and i.idbanquero=$id_banquero";
	$grupo="i.idintermediario";
	$ejecuta_sql=mysql_query($sql);
	
}else if(($id_intermediario!='' || $id_intermediario=='') && $id_taquilla=='' &&( $_SESSION['perfil']=='1' || $_SESSION['perfil']=='2' || $_SESSION['perfil']=='3' || $_SESSION['perfil']=='4')){
	//lista taquillas del intermediario..	
	$select=", i.*, t.*, SUM(CASE vsv.pagado WHEN '1' THEN vsv.monto_real_pagar END) AS pre_pagados, 
			SUM(CASE vsv.vencido WHEN '1' THEN vsv.monto_real_pagar END) AS pre_no_pagados";
	$nivel_muestra='3';
		if($_SESSION['perfil']=='3'){
			$where="and i.idintermediario='".$_SESSION['datos']['idintermediario']."' ";
		}else if($_SESSION['perfil']=='4'){
			$where="and t.idtaquilla='".$_SESSION['datos']['idtaquilla']."' ";
		}else{
			$where="and i.idintermediario=$id_intermediario";
		}
	$grupo="vsv.idtaquilla";
	$ejecuta_sql=mysql_query($sql);

}else if($id_taquilla!='' || $_SESSION['perfil']=='1' || $_SESSION['perfil']=='2' || $_SESSION['perfil']=='3' || $_SESSION['perfil']=='4'){
	//lista taquillas del intermediario..	
	///$id_banquero!='' && $id_intermediario!='' && 
	

	
		if($_SESSION['perfil']=='4'){
			
			$where="and i.idintermediario='".$_SESSION['datos']['idintermediario']."' ";			
			
			$where1="and idtaquilla='".$_SESSION['datos']['idtaquilla']."' ";
			$where="vsv.idtaquilla='".$_SESSION['datos']['idtaquilla']."' ";
		}else{
			$where1="and idtaquilla=$id_taquilla";///$id_intermediario
			$where="vsv.idtaquilla=$id_taquilla";
		}

	
	$nivel_muestra='4';
	$ejecuta_sql=mysql_query($sql2);
}

if($nivel_muestra!='4'){
 $sql="SELECT vsv.*, i.idintermediario, b.idbanquero, i.nombre, 
		SUM(CASE WHEN vsv.cantidad_apuesta >= '2' THEN vsv.apuesta END) AS ventas_parlay,
		SUM(CASE WHEN vsv.cantidad_apuesta = '1' THEN vsv.apuesta END) AS ventas_derecho, 
		SUM(CASE WHEN vsv.reembolsar = '1' THEN 0/*vsv.monto_real_pagar*/ WHEN vsv.ganador = '1' THEN vsv.monto_real_pagar WHEN vsv.recalculado = '1' THEN vsv.monto_real_pagar END) AS premios,
		SUM(CASE vsv.reembolsar WHEN '1' THEN vsv.apuesta END) AS devolucion,
		SUM(vsv.apuesta) as total	$select $taquilla
	FROM ventas vsv 
	LEFT JOIN taquillas t ON (vsv.idtaquilla=t.idtaquilla)	
	LEFT JOIN intermediarios i ON (t.idintermediario=i.idintermediario)
	LEFT JOIN banqueros b ON (i.idbanquero=b.idbanquero) 
	WHERE vsv.fecha BETWEEN '$fecha_desde1' AND '$fecha_hasta1'  AND vsv.anulado='0' $where
	GROUP BY $grupo
	ORDER BY b.nombres,i.nombre ASC";
}else{
$sql="SELECT vsv.*, i.idintermediario, b.idbanquero, i.nombre, t.*
	FROM ventas vsv
	LEFT JOIN taquillas t ON (vsv.idtaquilla=t.idtaquilla)	
	LEFT JOIN intermediarios i ON (t.idintermediario=i.idintermediario)
	LEFT JOIN banqueros b ON (i.idbanquero=b.idbanquero) 
	WHERE vsv.anulado='0' AND vsv.fecha BETWEEN '$fecha_desde1' AND '$fecha_hasta1' and $where
	ORDER BY idventa";
	////(select SUM(apuesta) FROM ventas WHERE anulado='0' AND fecha BETWEEN '$fecha_desde1' AND '$fecha_hasta1' $where1  GROUP BY idtaquilla)  AS total
}
echo "<!-- $sql -->";
$res=mysql_query($sql);?>

<?
$ventas_total='0';
$totalVentas_parlay='0';
$totalVentas_derecho='0';
$totalPremios='0';
$totalSaldo='0';

if($nivel_muestra=='1'){
		///banquero level
		?>
      <!--<div style="background:#FFF; font-size:16px; text-align:center;"> fechas desde 01/06/2012 - 20/06/2012</div>-->
     <table width="1000" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
      <tr>
        <td colspan="8" style="color:#03F; font-size:16px; height:40px; font-weight:bold; text-align:right"><br />
        Nivel: Banqueros</td>
       </tr>
      <tr>
        <td width="50" bgcolor="#CCCCCC"><div align="center">ID</div></td>
        <td width="273" bgcolor="#CCCCCC"><div align="center">BANCA</div></td>
        <td width="150" bgcolor="#66FF33"><div align="center"><strong>TOTAL VENTAS</strong></div></td>
        <td width="128" bgcolor="#CCCCCC"><div align="center">VENTAS <br />PARLAY</div></td>
        <td width="107" bgcolor="#CCCCCC"><div align="center">VENTAS <br />DERECHO</div></td>
        <td width="159" bgcolor="#CCCCCC"><div align="center">PREMIOS</div></td>
        <td width="159" bgcolor="#CCCCCC"><div align="center">DEVOLUCIONES</div></td>
        <td width="117" bgcolor="#CCCCCC"><div align="center">SALDO</div></td>
      </tr><? 
	if ($row=mysql_fetch_array($res)) {
		$i='0';
		$ventas_total='0';
	do{
		$ventas=$row["total"];
		$ventas_parlay=$row["ventas_parlay"];
		$ventas_derecho=$row["ventas_derecho"];
		$premios=$row["premios"];
		$devolucion=$row["devolucion"];
		$i++;?>  
      <tr>
        <td><div align="center"><? echo $i;?></div></td>
        <td>
        <a class="ajax_reporte" href="reportes/reporte_1.php?idbanquero=<? echo $row["idbanquero"]?>&fdesde=<?Php echo $_GET['fdesde'];?>&fhasta=<?Php echo $_GET['fhasta'];?>">
        	<strong><? echo $row["nombres"]." ".$row["apellidos"];?></strong></a>
        </td>
        <td bgcolor="#66FF33"><div align="right"><? echo $ventas;?> Bs.</div></td>
        <td><div align="right"><? echo $ventas_parlay;?> Bs.</div></td>
        <td><div align="right"><? if($ventas_derecho<='0'){echo "0";}else{echo $ventas_derecho;}?> Bs.</div></td>
        <td><div align="right"><? if($premios>='1'){echo $premios;}else{ echo "0";} ?> Bs.</div></td>
        <td><div align="right"><? if($devolucion>='1'){echo $devolucion;}else{ echo "0";} ?> Bs.</div></td>
        <td><? $saldo=($ventas-$premios-$devolucion);?><div align="right" <? if($saldo<0){echo "style='color: #F00;'";}?>><? echo $saldo;?> Bs.</div></td>
      </tr><?
	  $ventas_total=$ventas_total+$ventas;
	  $totalVentas_parlay=$totalVentas_parlay+$ventas_parlay;
	  $totalVentas_derecho=$totalVentas_derecho+$ventas_derecho;
	  $totalPremios=$totalPremios+$premios;
	  $totalSaldo=$totalSaldo+$saldo;
	  $totalDevoluciones=$totalDevoluciones+$devolucion;
	}while ($row=mysql_fetch_array($res));?>
      <tr>
        <td>&nbsp;</td>
        <td><div align="left"><strong>Totales</strong></div></td>
        <td bgcolor="#66FF33" align="right"><strong><? echo number_format($ventas_total, 2, '.', '');?> Bs.</strong></td>
        <td><div align="right"><strong><? echo number_format($totalVentas_parlay, 2, '.', '');?> Bs.</strong></div></td>
        <td><div align="right"><strong><? echo number_format($totalVentas_derecho, 2, '.', '');?> Bs.</strong></div></td>
        <td><div align="right"><strong><? echo number_format($totalPremios, 2, '.', '');?> Bs.</strong></div></td>
        <td><div align="right"><strong><? echo number_format($totalDevoluciones, 2, '.', '');?> Bs.</strong></div></td>
        <td>
        <div align="right" <? if($totalSaldo<0){echo "style='color: #F00;'";}?>>
        	<strong><? echo $totalSaldo;?> Bs.</strong>
        </div>
        </td>
      </tr><?
	}?>
	</table><?
	
}else if($nivel_muestra=='2'){
		///intermediario level
		?>
     <center></center>
     <table width="1020" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">        
      <tr>
        <td colspan="2"><div align="center"><br />Regresar a >>> 
           <a class="ajax_reporte" href="reportes/reporte_1.php?fdesde=<?Php echo $_GET['fdesde'];?>&fhasta=<?Php echo $_GET['fhasta'];?>">Banqueros</a><br />
        <br />
        </div></td>
        <td colspan="8" style="color:#03F; font-size:16px; height:40px; font-weight:bold; text-align:right"><br />
        Nivel: Intermediarios</td>
       </tr>
      <tr>
        <td width="30" bgcolor="#CCCCCC"><div align="center">ID</div></td>
        <td width="271" bgcolor="#CCCCCC"><div align="center">NOMBRE DEL INTERMEDIARIO</div></td>
        <td width="86" bgcolor="#66FF33"><div align="center"><strong>TOTAL <br />VENTAS</strong></div></td>
        <td width="91" align="center" bgcolor="#CCCCCC">VENTAS<br />PARLAY</td>
        <td width="94" align="center" bgcolor="#CCCCCC">VENTAS <br />DERECHO</td>
        <td width="100" bgcolor="#CCCCCC"><div align="center">% PARLAY</div></td>
        <td width="111" bgcolor="#CCCCCC"><div align="center">% DERECHO</div></td>
        <td width="109" bgcolor="#CCCCCC"><div align="center">PREMIOS</div></td>
        <td width="109" bgcolor="#CCCCCC"><div align="center">DEVOLUCIONES</div></td>
        <td width="88" bgcolor="#CCCCCC"><div align="center">SALDO</div></td>
      </tr><? 
	if ($row=mysql_fetch_array($res)) {
		$i='0';
	do{
		$ventas=$row["total"];
		$ventas_parlay=$row["ventas_parlay"];
		$ventas_derecho=$row["ventas_derecho"];
		$premios=$row["premios"];
		$devoluciones=$row["devolucion"];
		$i++;
		?>            
      <tr>
        <td><div align="center"><? echo $i;?></div></td>
        <td>
            <a class="ajax_reporte" href="reportes/reporte_1.php?idbanquero=<? echo $row["idbanquero"]?>&idintermediario=<? echo $row["idintermediario"]?>&fdesde=<?Php echo $_GET['fdesde'];?>&fhasta=<?Php echo $_GET['fhasta'];?>">
            <strong><? echo $row["nombre"];?></strong></a>
        </td>
        <td bgcolor="#66FF33"><div align="right"><? echo $ventas;?> Bs.</div></td>
        <td> <div align="right"><? echo $ventas_parlay;?> Bs.</div></td>
        <td> <div align="right">
          <? if($ventas_derecho<='0'){echo "0";}else{echo $ventas_derecho;}?> 
        Bs.</div></td>
        <td><div align="right"><? echo $por_parlay=($row["pp"]/100)*$ventas_parlay;?> Bs.</div></td>
        <td align="center"><div align="right"><? echo $por_derecho=($row["pd"]/100)*$ventas_derecho;?> Bs.</div></td>
        <td><div align="right">
          <? if($premios>='1'){echo $premios;}else{echo "0";} ?> 
        Bs.</div></td>
        <td><div align="right">
          <? if($devoluciones>='1'){echo $devoluciones;}else{echo "0";} ?> 
        Bs.</div></td>
        <td>
        <? $saldo=($ventas-$premios-$por_parlay-$por_derecho-$devoluciones);?>
        <div align="right" <? if($saldo<0){echo "style='color: #F00;'";}?>><? echo $saldo;?> Bs.</div></td>
      </tr><?
  	  $ventas_total=$ventas_total+$ventas;
	  $totalVentas_parlay=$totalVentas_parlay+$ventas_parlay;
	  $totalVentas_derecho=$totalVentas_derecho+$ventas_derecho;
	  $totalPremios=$totalPremios+$premios;
	  $totalSaldo=$totalSaldo+$saldo;
	  $totalDevolucion=$totalDevolucion+$devoluciones;
	}while ($row=mysql_fetch_array($res));?>
      <tr>
        <td>&nbsp;</td>
        <td><div align="left"><strong>Totales</strong></div></td>
        <td bgcolor="#66FF33"><div align="right"><strong><? echo number_format($ventas_total, 2, '.', '');?> Bs.</strong></div></td>
        <td><div align="right"><strong><? echo number_format($totalVentas_parlay, 2, '.', '');?> Bs.</strong></div></td>
        <td><div align="right"><strong><? echo number_format($totalVentas_derecho, 2, '.', '');?> Bs.</strong></div></td>
        <td><div align="right"></div></td>
        <td align="center"><div align="right"></div></td>
        <td><div align="right"><strong><? echo number_format($totalPremios, 2, '.', '');?> Bs.</strong></div></td>
        <td><div align="right"><strong><? echo number_format($totalDevolucion, 2, '.', '');?> Bs.</strong></div></td>
        <td><div align="right" <? if($totalSaldo<0){echo "style='color: #F00;'";}?>>
        	<strong><? echo $totalSaldo;?> Bs.</strong>
        </div></td>
      </tr><?
	}
	?>
	</table><?
}else if($nivel_muestra=='3'){
		///intermediario level
		?>
     <table width="1200" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">        
      <tr>
        <td colspan="3"><div align="center"><br />
        <? if ($_SESSION['perfil']=='4'){}else{?>
        Regresar a >>> <a class="ajax_reporte" href="reportes/reporte_1.php?fdesde=<?Php echo $_GET['fdesde'];?>&fhasta=<?Php echo $_GET['fhasta'];?>&idbanquero=<? echo $id_banquero;//$row["idbanquero"];?>">Intermediarios</a>
     <? }?>
          <br />
        <br />
        </div></td>
        <td colspan="12" style="color:#03F; font-size:16px; height:40px; font-weight:bold; text-align:right"><br />
        Nivel: Taquillas</td>
       </tr>
      <tr>
        <td width="17" bgcolor="#CCCCCC"><div align="center">ID</div></td>
        <td width="118" bgcolor="#CCCCCC"><div align="center">NOMBRE DE LA TAQUILLA</div></td>
        <td width="76" bgcolor="#66FF33"><div align="center"><strong>TOTAL <br />VENTAS</strong></div></td>
        <td width="81" bgcolor="#CCCCCC"><div align="center">VENTAS <br />PARLAY</div></td>
        <td width="73" bgcolor="#CCCCCC"><div align="center">VENTAS DERECHO</div></td>
        <td width="61" bgcolor="#CCCCCC"><div align="center">% PARLAY</div></td>
        <td width="85" bgcolor="#CCCCCC"><div align="center">% DERECHO</div></td>
        <td width="72" bgcolor="#CCCCCC" style="font-size:11px;"><div align="center">DEVOLUCI&Oacute;N</div></td>
        <td width="80" bgcolor="#CCCCCC"><div align="center">PREMIOS</div></td>
        <td width="85" bgcolor="#CCCCCC"><div align="center">PREMIOS PAGADOS</div></td>
        <td width="77" bgcolor="#CCCCCC"><div align="center">PREMIOS <br />SIN PAGAR</div></td>
        <td width="78" bgcolor="#CCCCCC"><div align="center">SUB TOTAL</div></td>
        <td width="81" bgcolor="#CCCCCC"><div align="center">% UTILIDAD</div></td>
        <td width="80" bgcolor="#CCCCCC"><div align="center">SALDO <br />USUARIO</div></td>
        <td width="104" bgcolor="#CCCCCC"><div align="center">SALDO <br />BANCA</div></td>
      </tr>
      <? 
	if ($row=mysql_fetch_array($res)) {
		$i='0';
		$total_ventas_parlay='0';
		$totalDevoluciones='0';
	do{
		$ventas=$row["total"];
		$ventas_parlay=$row["ventas_parlay"];
		$ventas_derecho=$row["ventas_derecho"];
		$premios=$row["premios"];
		$devolucion=$row["devolucion"];
		$pre_pagados1=$row["pre_pagados"];
		$pre_no_pagados1=$row["pre_no_pagados"];		
		$total1=$row["total"];
		$i++;
		?>            
      <tr>
        <td><div align="center"><? echo $i;?></div></td>
        <td style="font-size:11px;">
            <? /* <a class="ajax_reporte" href="?idbanquero=<? echo $row["idbanquero"]?>&fdesde=<?Php echo $_GET['fdesde'];?>&fhasta=<?Php echo $_GET['fhasta'];?>">*/?>
        <a class="ajax_reporte" href="reportes/reporte_1.php?fdesde=<?Php echo $_GET['fdesde'];?>&fhasta=<?Php echo $_GET['fhasta'];?>&idtaquilla=<? echo $row["idtaquilla"]?>&idbanquero=<? echo $row["idbanquero"]?>&idintermediario=<? echo $row["idintermediario"]?>">    
            <strong><? echo $row["nombre"];?></strong></a>
        </td>
        <td bgcolor="#66FF33" style="font-size:11px;"><div align="right"><? echo $ventas;?> Bs.</div></td>
        <td style="font-size:11px;"><div align="right"><? if($ventas_parlay<='0'){echo "0";}else{echo $ventas_parlay;}?> Bs.</div></td>
        <td style="font-size:11px;"><div align="right"><? if($ventas_derecho<='0'){echo "0";}else{echo $ventas_derecho;}?> Bs.</div></td>
        <td style="font-size:11px;"><div align="right"><? echo $por_parlay=($row["pdv"]/100)*$ventas_parlay;?> Bs.</div></td>
        <td style="font-size:11px;"><div align="right"><? echo $por_derecho=($row["pdvd"]/100)*$ventas_derecho;?> Bs.</div></td>
        <td style="font-size:11px;"><div align="right"><? if($devolucion>='1'){echo $devolucion;}else{echo "0";} ?> Bs.</div></td>
        <td style="font-size:10px;"><div align="right"><? if($premios>='1'){echo $premios;}else{echo "0";} ?> Bs.</div></td>
        <td style="font-size:10px;"><div align="right">

        <? if($pre_pagados1>='1'){echo $pre_pagados1;}else{echo "0";} ?> 
        Bs.</div></td>
        <td style="font-size:10px;"><div align="right"> 
          <? if($pre_no_pagados1>='1'){echo $pre_no_pagados1;}else{echo "0";} ?>
        Bs.</div></td>
        <td style="font-size:10px;"><? $saldo=($ventas-$premios-$devolucion-$por_parlay-$por_derecho);?>
        <div align="right" <? if($saldo<0){echo "style='color: #F00;'";}?>><? echo $saldo;?> Bs.</div></td>
        <td style="font-size:10px;"><div align="right"><? if($saldo>='1'){$por_utilidad=($row["pdu"]/100)*$saldo; echo number_format($por_utilidad, 2, '.', ''); }else{echo "0";}?> Bs.</div>
        </td>
        <td style="font-size:10px;"><div align="right"><?  $por_participacion=($row["pp"]/100)*$saldo;  echo number_format($por_participacion, 2, '.', ''); ?> Bs.</div></td>
        <td style="font-size:10px;"><div align="right">
        <? $saldo_total=$saldo-$por_participacion-$por_utilidad;?>
          <div  <? if($saldo_total<0){echo "style='color: #F00;'";}?>><? echo number_format($saldo_total, 2, '.', '');?> Bs.</div>
        </div></td>
      </tr><?
	 ///lo quite para ver>> $total_ventas_parlay=$total_ventas_parlay+$ventas_parlay;//$row["ventas_parlay"]
	  
   	  $ventas_total=$ventas_total+$ventas;
	  $totalVentas_parlay=$totalVentas_parlay+$ventas_parlay;
	  $totalVentas_derecho=$totalVentas_derecho+$ventas_derecho;
	  $totalPremios=$totalPremios+$premios;
	  $totalSaldo=$totalSaldo+$saldo_total;
	  $totalDevoluciones=$totalDevoluciones+$devolucion;	  
	}while ($row=mysql_fetch_array($res));?>	
      <tr>
        <td>&nbsp;</td>
        <td style="font-size:11px;"><div align="left"><strong>Totales</strong></div></td>
        <td bgcolor="#66FF33" style="font-size:11px;"><div align="right"><strong><? echo number_format($ventas_total, 2, '.', '');?> Bs.</strong></div></td>
        <td style="font-size:11px;" align="right"><div align="right"><strong><? echo number_format($totalVentas_parlay, 2, '.', '');?> Bs.</strong></div></td>
        <td style="font-size:11px;"><div align="right"><strong><? echo number_format($totalVentas_derecho, 2, '.', '');?> Bs.</strong></div></td>
        <td style="font-size:11px;"><div align="right"></div></td>
        <td style="font-size:11px;"><div align="right"></div></td>
        <td style="font-size:11px;"><div align="right">
        <strong><span style="font-size:11px;"><? echo number_format($totalDevoluciones, 2, '.', '');?> Bs.</span></strong></div></td>
        <td style="font-size:10px;"><div align="right">
        <strong><span style="font-size:11px;"><? echo number_format($totalPremios, 2, '.', '');?> Bs.</span></strong></div></td>
        <td style="font-size:10px;"><div align="right"></div></td>
        <td style="font-size:10px;"><div align="right"></div></td>
        <td style="font-size:10px;"><div align="right"></div></td>
        <td style="font-size:10px;"><div align="right"></div></td>
        <td style="font-size:10px;"><div align="right"></div></td>
        <td style="font-size:10px;"><div align="right"><strong><span style="font-size:11px;"><? echo number_format($totalSaldo, 2, '.', '');?> Bs.</span></strong></div></td>
      </tr><?
      }?>
	</table><?
}else if($nivel_muestra=='4'){
	if ($row=mysql_fetch_array($res)) {
			$total1=$row["total"];
	?>
	<table width="1018" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">        
      <tr>
        <td colspan="3"><div align="center"><br />
          Regresar a &gt;&gt;&gt; <a class="ajax_reporte" href="reportes/reporte_1.php?fdesde=<?Php echo $_GET['fdesde'];?>&fhasta=<?Php echo $_GET['fhasta'];?>&idbanquero=<? echo $id_banquero;?>&idintermediario=<? echo $id_intermediario;?>">Taquillas</a><br />
        <br />
        </div></td>
        <td colspan="6" style="color:#03F; font-size:16px; height:40px; font-weight:bold; text-align:right"><br />
        Nivel: Detalle Taquilla</td>
       </tr>
      <tr>
        <td width="45" bgcolor="#CCCCCC">&nbsp;</td>
        <td width="141" bgcolor="#CCCCCC"><div align="center"><strong>TICKET</strong></div></td>
        <td width="140" bgcolor="#CCCCCC"><div align="center"><strong>EMISI&Oacute;N</strong></div></td>
        <td width="108" bgcolor="#CCCCCC"><div align="center"><strong> EXPIRACI&Oacute;N </strong></div></td>
        <td width="97" bgcolor="#66FF33"><div align="center">
          <div align="center"><strong>MONTO APUESTA</strong></div>
        </div></td>
        <td width="91" bgcolor="#CCCCCC"><div align="center"><strong>PREMIO <br />
        TICKET</strong></div></td>
        <td width="88" bgcolor="#CCCCCC"><div align="center"><strong>MONTO <br />
        A PAGAR</strong></div></td>
        <td width="94" bgcolor="#CCCCCC"><div align="center"><strong>ESTADO</strong></div></td>
        <td width="194" bgcolor="#CCCCCC"><div align="center"><strong>TAQUILLA</strong></div></td>
      </tr>
      <? 
	  $i='0';
	  $monto_pagar='0';
	do{
		$apuesta1=$row["apuesta"];
		$ventas_parlay=$row["ventas_parlay"];
		$ventas_derecho=$row["ventas_derecho"];
		$premios=$row["premios"];
		$devolucion=$row["devolucion"];
		$pre_pagados1=$row["pre_pagados"];
		$pre_no_pagados1=$row["pre_no_pagados"];		
		$i++;
		?>            
      <tr>
        <td><div align="center"><? echo $i;?></div></td>
        <td ><div align="center"><strong>			
		<a href="#" onclick="javascript: window.open('detalle_ticket.php?idticket=<?Php echo $row["idventa"];?>', '', 'toolbar=,location=no,status=no,menubar=yes,scroll bars=yes, resizable=no,width=530,height=400'); return false" class="mainlevel" >			
					<?Php echo str_pad($row["idventa"],8,'0',STR_PAD_LEFT);?>
        </a>
		</strong></div></td>
        <td style="font-size:11px;"><div align="center"><? echo FechaOrdenar($row["fecha"],"-","")." ".$row["hora"];?></div></td>
        <td style="font-size:11px;"><div align="center"><? echo FechaOrdenar($row["fecha_prorroga"],"-","");?> </div></td>
        <td bgcolor="#66FF33" style="font-size:11px;"><div align="right"><? echo $apuesta1;?> Bs.</div></td>
        <td style="font-size:11px;"><div align="right"><? echo $row["total_ganar"]; ?> Bs.</div></td>
        <td style="font-size:11px;"><div align="right">

        <? if($row['anulado']=='1'){echo "-";}else{echo $row['monto_real_pagar'];} ?> 
        Bs.</div></td>
        <td style="font-size:11px;"><?        
        		if($row['reembolsar']):
							echo "<label class='reembolsar'>Reembolsar</label>";
						elseif($row['recalculado']):
							echo "<label class='recalculado'>Recalculado</label>";
						elseif($row['anulado']):
							echo "<label class='anulado'>Anulado</label>";
						elseif($row['vencido']):
							echo "<label class='vencido'>Vencido</label>";
						elseif($row['pagado']):
							echo "<label class='pagado'>Pagado</label>";
						elseif($row['ganador']):
							echo "<label class='ganador'>Ganador</label>";
						elseif($row['perdedor']):	
							echo "<label class='perdedor'>Perdedor</label>";
						else:
							echo "<label class='pendiente'>Vendido</label>";	
						endif;?>
        </td>
        <td style="font-size:11px;"><div align="left">   
          <div><? echo $row["nombre"];?> </div>
        </div></td>
      </tr> <?
	  $monto_pagar=$monto_pagar+$row['monto_real_pagar'];
	  $total1=$total1+$apuesta1;
	}while ($row=mysql_fetch_array($res));?>
      <tr>
        <td colspan="4" style="font-size:11px;">&nbsp;</td>
        <td bgcolor="#66FF33" style="font-size:11px;"><div align="right"><strong><? echo $total1;?> Bs.</strong></div></td>
        <td style="font-size:11px;">&nbsp;</td>
        <td style="font-size:11px;"><div align="right"><strong><? echo number_format($monto_pagar, 2, '.', '');?> Bs.</strong></div></td>
        <td colspan="2" style="font-size:11px;">&nbsp;</td>
      </tr><?     
	}?>
    
    
	</table><?
	}?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? mysql_close($conexion);?>
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