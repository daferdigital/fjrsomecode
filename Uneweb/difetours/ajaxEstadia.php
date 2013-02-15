<?php
	$estadia = $_POST["estadia"];
	if(($estadia == "homestay") || ($estadia == "homestay-half-board")
			|| ($estadia == "roomstay")){
		//estadia completa
?>
		<span id="LabelExtrasAirTrans">Traslado (disponible con estadia)</span>
		<table id="AirportPickupRequired" title="only available with accommodation" cellspacing="3" class="calculator-input" border="0">
			<tr>
				<td>
					<input id="AirportPickupRequired_0" type="radio" name="AirportPickupRequired" value="none" checked="checked">
					Ninguno
				</td>
				<td>
					<input id="AirportPickupRequired_1" type="radio" name="AirportPickupRequired" value="1_way">
					Aeropuerto-Casa
				</td>
				<td>
					<input id="AirportPickupRequired_2" type="radio" name="AirportPickupRequired" value="2_way">
					Aeropuerto-Casa-Aeropuerto
				</td>
			</tr>
		</table>
<?php
	} 
	if(($estadia == "homestay") || ($estadia == "homestay-half-board")){
?>
		<br>
		<span id="labelAccommodationAge">Your age on accommodation check-in date:</span>
		<table id="accommAge" cellspacing="3" class="calculator-input" border="0">
			<tr>
				<td>
					<input id="accommAge_0" type="radio" name="accommAge" value="18orOver" checked="checked">
					<label for="accommAge_0">18 a&ntilde;os o mayor</label>
				</td>
				<td>
					<input id="accommAge_1" type="radio" name="accommAge" value="under18">
					<label for="accommAge_1">Menos de 18 a&ntilde;os</label>
				</td>
			</tr>
		</table>
<?php
	} 
	if($estadia == "none") {
		//estadia por cuenta propia
	}
?>