<?php 
	include("conexion.php");
	//obtenemos la info desde la pagina principal
	//obtenemos el numero de semanas
	$bgValue = "style=\"background-color:#FFFFCC;\"";
	$putBg = false;
	$semanas = $_POST["cantidadSemanas"];
	$estadia = $_POST["estadia"];
	
	$priceByWeek = -1;
	$grandTotal = 0;
	
	$query = "SELECT precio FROM curso_semanas WHERE id_modalidad = ".$_POST["formaEstudio"]." AND minimo_semanas <= ".$semanas." AND maximo_semanas >= ".$semanas;
	$row = mysql_fetch_array(mysql_query($query));
	$priceByWeek = $row["precio"];
	
	$grandTotal += $semanas*$priceByWeek;
	
	//obtenemos todos los conceptos individuales asociados a los cursos
	$query = "SELECT internal_key, descripcion, pago_por_semana, precio FROM curso_pagos";
	$result = mysql_query($query);
	$arrayValues = array();
	while($row = mysql_fetch_array($result)){
		$arrayValues[$row["internal_key"]] = array($row["descripcion"],
				$row["pago_por_semana"],
				$row["precio"]);
	}
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
		<td align="right">$ 
			<?php
				$putBg = false;
				$grandTotal += $arrayValues["registro"][2]; 
				echo $arrayValues["registro"][2];
			?>
		</td>
	</tr>
	<?php
		if($semanas >= 3){
			$putBg = true;
	?>
	<tr>
		<td align="left">
			Materiales 
		</td>
		<td align="center">&nbsp;</td>
		<td align="right">$ 
			<?php
				if($semanas >= 3 && $semanas <= 12){
					$grandTotal += $arrayValues["3-12"][2];
					echo $arrayValues["3-12"][2];
				} else if($semanas > 12){
					$grandTotal += $arrayValues["13+"][2];
					echo $arrayValues["13+"][2];
				}
			?>
		</td>
	</tr>
	<?php 
		}
	?>
	<?php
		//colocamos la info de la posible estadia
		if($estadia != "none"){
			//es estadia en casa de familia, vemos el tipo
			//y el transporte desde el aeropuerto
			$query = "SELECT long_desc, precio_under18, precio_over18 FROM curso_estadia WHERE internal_key ='".$estadia."'";
			$row = mysql_fetch_array(mysql_query($query));
	?>
	<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
		<td align="left">
			<?php echo $row["long_desc"]." - ".$arrayValues[$_POST["accommAge"]][0]." (".$row[$_POST["accommAge"]]."/semana)";?>
			<span style="color:red">**</span>
		</td>
		<td align="center">
			<strong><?php echo $semanas;?></strong>
		</td>
		<td align="right">
			$ 
			<?php 
				echo $row[$_POST["accommAge"]]*$semanas; 
				$grandTotal += $row[$_POST["accommAge"]]*$semanas;
			?>
		</td>
	</tr>
	<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
		<td align="left">
			<?php echo $arrayValues["searchRoomstay"][0];?>
		</td>
		<td align="center">
			&nbsp;
		</td>
		<td align="right">
			$ 
			<?php 
				echo $arrayValues["searchRoomstay"][2]; 
				$grandTotal += $arrayValues["searchRoomstay"][2];
			?>
		</td>
	</tr>
		<?php
			if($_POST["AirportPickupRequired"] != "ninguno"){
		?>
			<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
				<td align="left">
					Traslado Aeropuerto-Alojamiento
					<?php echo $arrayValues[$_POST["AirportPickupRequired"]][0];?>
				</td>
				<td align="center">
					&nbsp;
				</td>
				<td align="right">
					$ 
					<?php 
						echo $arrayValues[$_POST["AirportPickupRequired"]][2]; 
						$grandTotal += $arrayValues[$_POST["AirportPickupRequired"]][2];
					?>
				</td>
			</tr>
		<?php
			} 
		?>
	<?php
		}
	?>
	<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
		<td align="left">&nbsp;</td>
		<td align="center">
			<strong>Total:</strong>
		</td>
		<td align="right">$ <strong><?php echo $grandTotal; ?></strong></td>
	</tr>
	<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
		<td align="left">
			<span style="color:red">*Nota:</span> 
			Si te registras en <strong>temporada alta (Junio-Julio) el pago por registro es de $200</strong>. 
			(fecha de registro, no de clases)
		</td>
		<td align="center">&nbsp;</td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
		<td align="left">
			<strong>Registro en temporada alta (Junio-Julio)<br> Total:</strong>
		</td>
		<td align="center">&nbsp;</td>
		<td align="right">
			$ <strong><?php echo $grandTotal + 75;?></strong>
		</td>
	</tr>
	<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
		<td align="left">
			<span style="color:red">**Nota:</span> 
			Si tu estadia incluye fechas entre <strong>Junio 23 - Agosto 4</strong>, un 
			<strong>costo por estadia de Verano de $2 extra por noche</strong> 
			sera agregado por las noches dentro de ese periodo.<br>
		</td>
		<td align="center">&nbsp;</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>