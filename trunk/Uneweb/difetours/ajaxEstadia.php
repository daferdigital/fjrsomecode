<?php header('Content-Type: text/html; charset=ISO-8859-1');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<?php
	$estadia = $_POST["estadia"];
	
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
</body>
</html>