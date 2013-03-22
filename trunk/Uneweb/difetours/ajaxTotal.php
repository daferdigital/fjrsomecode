<?php header('Content-Type: text/html; charset=ISO-8859-1');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<?php 
	include("conexion.php");
	//obtenemos la info desde la pagina principal
	//obtenemos el numero de semanas
	$bgValue = "style=\"background-color:#FFFFCC;\"";
	$putBg = false;
	$semanas = $_POST["cantidadSemanas"];
	$estadia = $_POST["estadia"];
	$destino = $_POST["destino"];
	
	
	$mailContent = "";
	//colocamos el pais destino
	$row = mysql_fetch_array(mysql_query("SELECT destino FROM curso_destino WHERE id=".$destino));
	$mailContent = "Destino: ".$row["destino"]." <br />";
	
	$codCiudad = "";
	$nombreCiudad = "";
	if(isset($_POST["ciudaDestino"])){
		$codCiudad = $_POST["ciudaDestino"];
	}
	
	$precioEnvioDocumentos = 0;
	$precioBusquedaAlojamiento = 0;
	if($codCiudad != ""){
		//colocamos la ciudad destino
		$row = mysql_fetch_array(mysql_query("SELECT ciudad, precio_envio_documentos, precio_busqueda_alojamiento FROM curso_ciudad WHERE id=".$codCiudad));
		$precioEnvioDocumentos = $row["precio_envio_documentos"];
		$nombreCiudad = $row["ciudad"];
		$precioBusquedaAlojamiento = $row["precio_busqueda_alojamiento"];
		$mailContent = "Ciudad: ".$row["ciudad"]." <br />";
	}
	
	$priceByWeek = -1;
	$grandTotal = 0;
	
	$query = "SELECT precio FROM curso_semanas WHERE id_modalidad = ".$_POST["formaEstudio"]
	." AND minimo_semanas <= ".$semanas
	." AND maximo_semanas >= ".$semanas
	." AND id_destino=".$destino;
	
	$row = mysql_fetch_array(mysql_query($query));
	$priceByWeek = $row["precio"];
	
	$grandTotal += $semanas*$priceByWeek;
	
	//obtenemos todos los conceptos individuales asociados a los cursos
	$query = "SELECT internal_key, descripcion, pago_por_semana, precio FROM curso_pagos WHERE id_destino=".$destino;
	$result = mysql_query($query);
	$arrayValues = array();
	while($row = mysql_fetch_array($result)){
		$arrayValues[$row["internal_key"]] = array($row["descripcion"],
				$row["pago_por_semana"],
				$row["precio"]);
	}
	
	$arrayValues["precio_under18"] = array("Alojamiento en casa de familia - Alumnos menores de 18 años", "0", "0");
	$arrayValues["precio_over18"] = array("Alojamiento en casa de familia - Alumnos mayores de 18 años", "0", "0");
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
		<?php
			$row = mysql_fetch_array(mysql_query("SELECT descripcion FROM curso_modalidad WHERE id=".$_POST["formaEstudio"]." AND id_destino=".$destino)); 
			$mailContent .= "Curso: ".$row["descripcion"]." Clases (".$priceByWeek."/semana)<br />";
		?>
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
			$query = "SELECT long_desc, precio_under18, precio_over18 FROM curso_estadia WHERE internal_key ='".$estadia."' AND id_destino=".$destino;
			$row = mysql_fetch_array(mysql_query($query));
	?>
	<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
		<td align="left">
			<?php 
				echo $row["long_desc"]." - ".$arrayValues[$_POST["accommAge"]][0]." (".$row[$_POST["accommAge"]]."/semana)";
				$mailContent .= $row["long_desc"]." - ".$arrayValues[$_POST["accommAge"]][0]." (".$row[$_POST["accommAge"]]."/semana)<br />";
			?>
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
			<?php 
				$mailContent .= "B&uacute;squeda de alojamiento en ".$nombreCiudad." (no reembolsable) <br />";
				echo "B&uacute;squeda de alojamiento en ".$nombreCiudad." (no reembolsable)";
			?>
		</td>
		<td align="center">
			&nbsp;
		</td>
		<td align="right">
			$ 
			<?php 
				echo $precioBusquedaAlojamiento;
				$grandTotal += $precioBusquedaAlojamiento;
			?>
		</td>
	</tr>
		<?php
			if($_POST["AirportPickupRequired"] != "ninguno"){
		?>
			<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
				<td align="left">
					Traslado Aeropuerto-Alojamiento
					<?php 
						echo $arrayValues[$_POST["AirportPickupRequired"]][0];
						$mailContent .= "Traslado Aeropuerto-Alojamiento: ".$arrayValues[$_POST["AirportPickupRequired"]][0]." <br />";
					?>
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
	<?php
		if($codCiudad != ""){
			//envio de documentos a una ciudad en especifico
	?>
			<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
				<td align="left">
					<?php 
						echo "Envio de documentos a ".$nombreCiudad;
						$mailContent .= "Envio de documentos a ".$nombreCiudad." <br />";
					?>
				</td>
				<td align="center">
					&nbsp;
				</td>
				<td align="right">
					$ 
					<?php 
						echo $precioEnvioDocumentos; 
						$grandTotal += $precioEnvioDocumentos;
					?>
				</td>
			</tr>
	<?php
		} else {
			//cobro generico de envio de documentos
		}
	?>
	<?php
		if(isset($_POST["accommAge"]) && ($_POST["accommAge"] == "precio_under18")){
	?>
			<tr <?php echo $putBg ? $bgValue : ""; $putBg = !$putBg;?>>
				<td align="left">
					<?php 
						$mailContent .= $arrayValues["custodyLetter"][0]."<br />";
						echo $arrayValues["custodyLetter"][0];
					?>
				</td>
				<td align="center">
					&nbsp;
				</td>
				<td align="right">
					$ 
					<?php 
						echo $arrayValues["custodyLetter"][2];
						$grandTotal += $arrayValues["custodyLetter"][2];
					?>
				</td>
			</tr>
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
			Si te registras en 
			<strong>temporada alta (Junio-Julio) el pago por registro es de $<?php echo $arrayValues["registroHighSeason"][2];?></strong>. 
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
			$ <strong>
				<?php 
					echo $grandTotal + ($arrayValues["registroHighSeason"][2] - $arrayValues["registro"][2])	
				?>
			</strong>
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
	<tr>
		<td colspan="3" align="right">
			<form action="presupuesto.php" method="post">
				<input type="hidden" name="mailContent" value="<?php echo $mailContent;?>"/>
				<input type="submit" value="Solicitar Presupuesto">
			</form>
		</td>
	</tr>
</table>
<?php 
	mysql_close();
?>
</body>
</html>