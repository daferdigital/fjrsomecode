<?php
	$estadia = $_POST["estadia"];
	$destino = $_POST["destino"];
	
	if(($estadia == "homestay") || ($estadia == "homestay-half-board")
			|| ($estadia == "roomstay")){
		//estadia completa
?>
		<span id="LabelExtrasAirTrans">Traslado (disponible con estadia)</span>
		<table title="only available with accommodation" cellspacing="3" class="calculator-input" border="0">
			<tr>
				<td>
					<input id="AirportPickupRequired_0" type="radio" name="AirportPickupRequired" value="ninguno" checked="checked" onchange="javascript:getTotalInfo()">
					Ninguno
				</td>
				<td>
					<input id="AirportPickupRequired_1" type="radio" name="AirportPickupRequired" value="ida" onchange="javascript:getTotalInfo()">
					Solo ida
				</td>
				<td>
					<input id="AirportPickupRequired_2" type="radio" name="AirportPickupRequired" value="ida-vuelta" onchange="javascript:getTotalInfo()">
					Ida y Vuelta
				</td>
			</tr>
		</table>
		<br>
		<span id="labelAccommodationAge">Tu edad al momento del ingreso:</span>
		<table cellspacing="3" class="calculator-input" border="0">
			<tr>
				<td>
					<input id="accommAge_0" type="radio" name="accommAge" value="precio_over18" checked="checked" onchange="javascript:getTotalInfo()">
					18 a&ntilde;os o mayor
				</td>
				<?php 
					if($estadia != "roomstay"){
				?>
						<td>
							<input id="accommAge_1" type="radio" name="accommAge" value="precio_under18" onchange="javascript:getTotalInfo()">
							Menos de 18 a&ntilde;os
						</td>
				<?php
					}
				?>
			</tr>
		</table>
<?php
	} 
	if($estadia == "none") {
		//estadia por cuenta propia
	}
?>
<?php 
	//obtenemos los conceptos individuales asociados al envio de documentos
	//para el destino en cuestion
	include 'conexion.php';
	
	$query = "SELECT internal_key, descripcion, pago_por_semana, precio "
			."FROM curso_pagos "
			."WHERE id_destino=".$destino
			." AND grupo='sendDocuments' "
			."ORDER BY descripcion";
	
	$result = mysql_query($query);
	$arrayValues = array();
	while($row = mysql_fetch_array($result)){
		$arrayValues[$row["internal_key"]] = array($row["descripcion"],
				$row["pago_por_semana"],
				$row["precio"]);
	}
	
	if(count($arrayValues) > 0){
?>
	<br>
		<span id="sendDocuments">Indique a donde deben ser enviados sus documentos:</span>
		<table cellspacing="3" class="calculator-input" border="0">
			<tr>
			<?php
				$i = 0;
				foreach ($arrayValues as $sendDocuments => $value){
			?>
				<td>
					<input id="sendDocuments_<?php echo $i;?>" type="radio" name="sendDocuments" value="<?php echo $sendDocuments?>" checked="checked" onchange="javascript:getTotalInfo()">
					<?php echo $value["0"]?>
				</td>
			<?php
					$i++;
				} 
			?>
			</tr>
		</table>
<?php
	}
	
	mysql_close();
?>