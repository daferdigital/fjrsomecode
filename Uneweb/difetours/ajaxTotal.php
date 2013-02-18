<?php 
	include("conexion.php");
	//obtenemos la info desde la pagina principal
	//obtenemos el numero de semanas
	$semanas = $_POST["cantidadSemanas"];
	$priceByWeek = -1;
	
	$query = "SELECT precio FROM curso_semanas WHERE id_modalidad = ".$_POST["formaEstudio"]." AND minimo_semanas <= ".$semanas." AND maximo_semanas >= ".$semanas;
	$row = mysql_fetch_array(mysql_query($query));
	$priceByWeek = $row["precio"];
?>
<table class="calculator-result" cellspacing="0" cellpadding="5" rules="rows" border="0" id="dataGridFees" style="border-width:0px;width:85%;border-collapse:collapse;">
	<tr style="font-weight:bold;">
		<td>Concepto</td>
		<td>Semanas</td>
		<td align="right" style="width:60px;">Precio</td>
	</tr>
	<tr>
		<td align="left">Clases ($<?php echo $priceByWeek;?>/semana)</td>
		<td align="center"><?php echo $semanas;?></td>
		<td align="right">$ <?php echo $semanas*$priceByWeek;?></td>
	</tr>
	<tr style="background-color:#FFFFCC;">
		<td align="left">
			Registro (No reembolsable) 
			<span style="color:red">*</span>
		</td>
		<td align="center">&nbsp;</td>
		<td align="right">$ 125</td>
	</tr><tr>
		<td align="left">Materials Fee</td><td align="center">&nbsp;</td><td align="right">$ 70</td>
	</tr><tr style="background-color:#FFFFCC;">
		<td align="left">&nbsp;</td><td align="center"><strong>Grand Total:</strong></td><td align="right">$ <strong>1275</strong></td>
	</tr><tr>
		<td align="left"><span style="color:red">*Note:</span> If you register in <strong>high season (June to July) the registration fee is $200</strong>. (date of registration, not date of classes)</td><td align="center">&nbsp;</td><td align="right">&nbsp;</td>
	</tr><tr style="background-color:#FFFFCC;">
		<td align="left"><strong>For registration in high season (June to July)<br> Grand Total:</strong></td><td align="center">&nbsp;</td><td align="right">$ <strong>1350</strong></td>
	</tr><tr>
		<td align="left"><span style="color:red">**Note:</span> If your accommodation includes dates from <strong>June 23 - August 4</strong>, a <strong>Summer Homestay &amp; Roomstay supplement fee of $2 extra per night</strong> will be added for the nights in that period.<br></td><td align="center">&nbsp;</td><td align="right">&nbsp;</td>
	</tr>
</tbody></table>