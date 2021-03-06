<?php include ("conexion.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<script>
	var index = 0;

	function eliminarElemento(elementId){
		var element = document.getElementById(elementId);
		element.parentNode.removeChild(element);
	}

	function agregarPrecioXSemana(idSemanas, minSemanas, maxSemanas, modalidad1, modalidad2,
			modalidad3, modalidad4){
		var divConceptos = document.getElementById("conceptosPrincipales");

		divConceptos.innerHTML += '<table id="concepto' + index + '">'
			+ '    <tr>'
			+ '        <td>'
			+ '            <input type="button" value="Eliminar concepto" onclick="javascript:eliminarElemento(\'concepto'+ index +'\');" />'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="hidden" name="campoConcepto' + index +'[]" value="' + idSemanas + '"/>'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + minSemanas + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + maxSemanas + '"/>'
			+ '        </td>'
			+ '        <td width="190">'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + modalidad1 + '"/>'
			+ '        </td>'
			+ '        <td width="190">'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + modalidad2 + '"/>'
			+ '        </td>'
			+ '        <td width="190">'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + modalidad3 + '"/>'
			+ '        </td>'
			+ '        <td width="190">'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + modalidad4 + '"/>'
			+ '        </td>'
			+ '    </tr>'
			+ '</table>';
		
		index ++;
	}

	function agregarCiudadXDestino(nombreCiudad, precioEnvioDocumentos, precioBusquedaAlojamiento){
		var divConceptos = document.getElementById("ciudadDestino");

		divConceptos.innerHTML += '<table id="ciudadDestino' + index + '">'
			+ '    <tr>'
			+ '        <td>'
			+ '            <input type="button" value="Eliminar" onclick="javascript:eliminarElemento(\'ciudadDestino'+ index +'\');" />'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoCiudad' + index +'[]" value="' + nombreCiudad + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoCiudad' + index +'[]" value="' + precioEnvioDocumentos + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoCiudad' + index +'[]" value="' + precioBusquedaAlojamiento + '"/>'
			+ '        </td>'
			+ '    </tr>'
			+ '</table>';
		
		index ++;
	}

	function agregarEstadia(id, internalKey, descripcion, precioUnder18, precioOver18, longDesc, seccionText){
		var divEstadia = document.getElementById("tipoEstadia");

		divEstadia.innerHTML += '<table id="estadia' + index + '">'
			+ '    <tr>'
			+ '        <td width="200">'
			+ '            ' + seccionText
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="hidden" name="campoEstadia' + index +'[]" value="' + id + '"/>'
			+ '            <input type="hidden" name="campoEstadia' + index +'[]" value="' + internalKey + '"/>'
			+ '            <input type="text" name="campoEstadia' + index +'[]" value="' + descripcion + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoEstadia' + index +'[]" value="' + precioUnder18 + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoEstadia' + index +'[]" value="' + precioOver18 + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoEstadia' + index +'[]" value="' + longDesc + '"/>'
			+ '        </td>'
			+ '    </tr>'
			+ '</table>';
		
		index ++;
	}

	function agregarOtroConcepto(id, descripcion, precio, semanal, grupo, internalKey, moreDescInfo){
		var divConceptos = document.getElementById("conceptosFijos");
		var extraInfo = "";
		
		if(semanal == "1"){
			//debemos marcar el check
			extraInfo = "checked";
		}
		
		divConceptos.innerHTML += '<table id="otroConcepto' + index + '">'
			+ '    <tr>'
			+ '        <td width="200">'
			+ '            ' + moreDescInfo
			+ '        </td>'
			+ '        <td width="150" align="right">'
			+ '            <input type="hidden" name="otroConcepto' + index +'[]" value="'+ id +'" />'
			+ '            <input type="hidden" name="otroConcepto' + index +'[]" value="'+ grupo +'" />'
			+ '            <input type="hidden" name="otroConcepto' + index +'[]" value="'+ internalKey +'" />'
			+ '            <input type="text" name="otroConcepto' + index +'[]" value="'+ descripcion +'" />'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="otroConcepto' + index +'[]" value="'+ precio +'" />'
			+ '        </td>'
			+ '        <td width="100" align="center">'
			+ '            <input type="checkbox" name="otroConcepto' + index +'[]" value="'+ semanal +'"' + extraInfo +' onclick="reverseValue(this)"/>'
			+ '        </td>'
			+ '</table>';
		
		index ++;
	}

	function reverseValue(checkBox){
		if(checkBox.value == "1"){
			checkBox.checked = false;
			checkBox.value = "0";
		} else {
			checkBox.checked = true;
			checkBox.value = "1";
		}
	}
	
	function refreshPage(destinoId){
		window.location = "formularioCurso.php?selectDestinoId=" + destinoId;
	}
</script>
</head>
<body>

<h1>Nota: Si no desea crear alguna modalidad de curso o tipo de estadia deje esa descripci&oacute;n en blanco.</h1>
<hr></hr>

<div style="margin-left: auto; margin-right: auto;">
	Indique el pa&iacute;s a ser procesado
	
	<select name="selectDestinoId" onchange="refreshPage(this.options[this.selectedIndex].value)" style="display: inline-block;">
	    <option value="-1"> - -</option>
<?php 
	$query = "SELECT id, destino FROM curso_destino ORDER BY id";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)){
?>
		<option value="<?php echo $row["id"]?>" <?php echo (isset($_GET["selectDestinoId"]) && $_GET["selectDestinoId"] == $row["id"]) ? "selected" : ""?>>
			<?php echo $row["destino"]?>
		</option>
<?php
	}
?>
	</select>
	
	<form method="post" action="createCountry.php" style="display: inline-block;">
		<span style="margin-left: 50px;">
			Crear Pais
			<input type="text" name="countryName" />
			<input type="submit" value="Crear"/>		
		</span>
	</form>
</div>

<form action="guardarInfoFormulario.php" name="formulario" method="post">
<?php 
	if(isset($_GET["selectDestinoId"])){
		$selectDestinoId = $_GET["selectDestinoId"];
?>
    <input type="hidden" name="destinoId" value="<?php echo $_GET["selectDestinoId"];?>"/>
	<div align="center">
		<table>
			<tr>
				<td width="150" colspan="3">
					&nbsp;
				</td>
				<td width="150">
					Informaci&oacute;n de Curso intensivo
				</td>
				<td width="150">
					Informaci&oacute;n de Curso tiempo completo
				</td>
				<td width="150">
					Informaci&oacute;n de Curso medio tiempo AM
				</td>
				<td width="150">
					Informaci&oacute;n de Curso medio tiempo PM
				</td>
			</tr>
			<tr>
				<td width="150">
					&nbsp;
				</td>
				<td width="150">
					Cantidad M&iacute;nima de Semanas
				</td>
				<td width="150">
					Cantidad M&aacute;xima de Semanas
				</td>
				<?php 
					//colocamos las distintas modalidades de los cursos
					$query = "SELECT id, descripcion, internal_key FROM curso_modalidad WHERE id_destino=".$selectDestinoId." ORDER BY id";
					$result = mysql_query($query);
					$modalidadOrder = array();
					$modalidades = array();
					
					while($row = mysql_fetch_array($result)){
						$modalidades[$row["internal_key"]] = array($row["id"], $row["descripcion"]);
					}
				?>
				<td width="150">
					<?php
						$id = 1;
						$desc = "";
						
						if(isset($modalidades["intensive"])){
							$id = $modalidades["intensive"][0];
							$desc = $modalidades["intensive"][1];
						}
						
						$modalidadOrder[] = $id;
					?>
					<input type="hidden" name="ordenModalidad[intensive][]" value="<?php echo $id;?>"/>
					<textarea name="ordenModalidad[intensive][]"><?php echo $desc;?></textarea>
				</td>
				<td width="150">
					<?php
						$id = 2;
						$desc = "";
						
						if(isset($modalidades["standard"])){
							$id = $modalidades["standard"][0];
							$desc = $modalidades["standard"][1];
						}
						
						$modalidadOrder[] = $id;
					?>
					<input type="hidden" name="ordenModalidad[standard][]" value="<?php echo $id;?>"/>
					<textarea name="ordenModalidad[standard][]"><?php echo $desc;?></textarea>
				</td>
				<td width="150">
					<?php
						$id = 3;
						$desc = "";
						
						if(isset($modalidades["part-timeAM"])){
							$id = $modalidades["part-timeAM"][0];
							$desc = $modalidades["part-timeAM"][1];
						}
						
						$modalidadOrder[] = $id;
					?>
					<input type="hidden" name="ordenModalidad[part-timeAM][]" value="<?php echo $id;?>"/>
					<textarea name="ordenModalidad[part-timeAM][]"><?php echo $desc;?></textarea>
				</td>
				<td width="150">
					<?php
						$id = 4;
						$desc = "";
						
						if(isset($modalidades["part-timePM"])){
							$id = $modalidades["part-timePM"][0];
							$desc = $modalidades["part-timePM"][1];
						}
						
						$modalidadOrder[] = $id;
					?>
					<input type="hidden" name="ordenModalidad[part-timePM][]" value="<?php echo $id;?>"/>
					<textarea name="ordenModalidad[part-timePM][]"><?php echo $desc;?></textarea>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="conceptosPrincipales" align="center" style="border-style: solid;">
	</div>
	
	<div align="center">
		<?php 
			//obtenemos los precios de los distintos tipos de cursos, si existen
			$query = "SELECT id, minimo_semanas, maximo_semanas, precio, id_modalidad FROM curso_semanas WHERE id_destino=".$selectDestinoId." ORDER BY minimo_semanas, maximo_semanas";
			$result = mysql_query($query);
			$arreglo = array();
			
			while($row = mysql_fetch_array($result)){
				$arreglo[$row["minimo_semanas"]."-".$row["maximo_semanas"]][] = array($row["id_modalidad"], $row["precio"], $row["minimo_semanas"], $row["maximo_semanas"]);
			}
			
			foreach ($arreglo as $value){	
				for($j = 0; $j < count($modalidadOrder); $j++){
					$found = false;
					
					foreach ($value as $value2){
						if($j == 0){
							$params = "'','".$value2[2]."','".$value2[3]."'";
						}

						if($modalidadOrder[$j] == $value2[0]){
							$params .= ",'".$value2[1]."'";
							$found = true;
							break;
						}
					}
					
					if(!$found){
						$params .= ",''";
					}
				}
		?>
			<script>agregarPrecioXSemana(<?php echo $params;?>);</script>
		<?php
			}
		?>
		<input type="button" value="Agregar Precios por semana" onclick="javascript:agregarPrecioXSemana('','','','','','','');">
		<br />
		<br />
	</div>
	
	<div align="center">
		<table>
			<tr>
				<td width="150">
					&nbsp;
				</td>
				<td width="150">
					Ciudad
				</td>
				<td width="150">
					Precio envio de Documentos
				</td>
				<td width="150">
					Precio B&uacute;squeda Alojamiento
				</td>
			</tr>
		</table>
	</div>
	<div id="ciudadDestino" align="center" style="border-style: solid;">
	</div>
	<div align="center">
		<?php 
			//obtenemos las estadias
			$query = "SELECT ciudad, precio_envio_documentos, precio_busqueda_alojamiento FROM curso_ciudad WHERE id_destino=".$selectDestinoId." ORDER BY ciudad";
			$result = mysql_query($query);
			while($row = mysql_fetch_array($result)){
		?>
				<script>
					agregarCiudadXDestino('<?php echo $row["ciudad"]?>',
						'<?php echo $row["precio_envio_documentos"]?>',
						'<?php echo $row["precio_busqueda_alojamiento"]?>');
				</script>
		<?php
			}
		?>
		<input type="button" value="Agregar Ciudad" onclick="javascript:agregarCiudadXDestino('','','','');">
		<br />
		<br />
	</div>
	
	<br />
	<div align="center">
		<table>
			<tr>
				<td width="200">
					&nbsp;
				</td>
				<td width="150">
					Descripci&oacute;n
				</td>
				<td width="150">
					Precio para menores de 18
				</td>
				<td width="150">
					Precio para mayores de 18
				</td>
				<td width="150">
					Descripci&oacute;n Completa
				</td>
			</tr>
		</table>
	</div>
	<div id="tipoEstadia" align="center" style="border-style: solid;">
	</div>
	<div align="center">
		<?php 
			//obtenemos las estadias
			$query = "SELECT id, internal_key, descripcion, precio_under18, precio_over18, long_desc FROM curso_estadia WHERE id_destino=".$selectDestinoId." ORDER BY id";
			$result = mysql_query($query);
			$arrayValues = array();
			while($row = mysql_fetch_array($result)){
				$arrayValues[$row["internal_key"]] = array($row["id"],
						$row["descripcion"],
						$row["precio_under18"],
						$row["precio_over18"],
						$row["long_desc"]);
			}
			
			?>
				<script>
					agregarEstadia('<?php echo isset($arrayValues["homestay"]) ? $arrayValues["homestay"][0] : "";?>',
							'homestay',
							'<?php echo isset($arrayValues["homestay"]) ? $arrayValues["homestay"][1] : "";?>',
							'<?php echo isset($arrayValues["homestay"]) ? $arrayValues["homestay"][2] : "0";?>',
							'<?php echo isset($arrayValues["homestay"]) ? $arrayValues["homestay"][3] : "0";?>',
							'<?php echo isset($arrayValues["homestay"]) ? $arrayValues["homestay"][4] : "Pensi&oacute;n Completa (incluye todas las comidas)";?>',
							'Pensi&oacute;n completa: ');
					agregarEstadia('<?php echo isset($arrayValues["homestay-half-board"]) ? $arrayValues["homestay-half-board"][0] : "";?>',
							'homestay-half-board',
							'<?php echo isset($arrayValues["homestay-half-board"]) ? $arrayValues["homestay-half-board"][1] : "";?>',
							'<?php echo isset($arrayValues["homestay-half-board"]) ? $arrayValues["homestay-half-board"][2] : "0";?>',
							'<?php echo isset($arrayValues["homestay-half-board"]) ? $arrayValues["homestay-half-board"][3] : "0";?>',
							'<?php echo isset($arrayValues["homestay-half-board"]) ? $arrayValues["homestay-half-board"][4] : "Media Pensi&oacute;n (sin almuerzo)";?>',
							'Media pensi&oacute;n: ');
					agregarEstadia('<?php echo isset($arrayValues["roomstay"]) ? $arrayValues["roomstay"][0] : "";?>',
							'roomstay',
							'<?php echo isset($arrayValues["roomstay"]) ? $arrayValues["roomstay"][1] : "";?>',
							'<?php echo isset($arrayValues["roomstay"]) ? $arrayValues["roomstay"][2] : "0";?>',
							'<?php echo isset($arrayValues["roomstay"]) ? $arrayValues["roomstay"][3] : "0";?>',
							'<?php echo isset($arrayValues["roomstay"]) ? $arrayValues["roomstay"][4] : "Solo estadia (sin comidas)";?>',
							'Solo estadia');
					agregarEstadia('<?php echo isset($arrayValues["none"]) ? $arrayValues["none"][0] : "";?>',
							'none',
							'<?php echo isset($arrayValues["none"]) ? $arrayValues["none"][1] : "";?>',
							'<?php echo isset($arrayValues["none"]) ? $arrayValues["none"][2] : "0";?>',
							'<?php echo isset($arrayValues["none"]) ? $arrayValues["none"][3] : "0";?>',
							'<?php echo isset($arrayValues["none"]) ? $arrayValues["none"][4] : "Ninguna";?>',
							'Sin estadia:');
				</script>
		<br />
	</div>
	
	<div align="center">
		<fieldset>
			<legend>Otros conceptos</legend>
				<div align="center">
					<table>
						<tr>
							<td width="200">&nbsp;</td>
							<td width="150" align="center">
								Descripcion
							</td>
							<td width="150" align="center">
								Precio
							</td>
							<td width="150" align="center">
								Semanal?
							</td>
						</tr>
					</table>
				</div>
				<div id="conceptosFijos" align="center">
					<?php
						$query = "SELECT id, descripcion, pago_por_semana, precio, grupo, internal_key"
		                    ." FROM curso_pagos"
			                ." WHERE id_destino=".$selectDestinoId
						    ." ORDER BY grupo";
						$result = mysql_query($query);
						$arrayValues = array();
						while($row = mysql_fetch_array($result)){
							$arrayValues[$row["internal_key"]] = array($row["id"],
									$row["descripcion"],
									$row["pago_por_semana"],
									$row["precio"],
									$row["grupo"]);
						}
					?>
						<script>
							agregarOtroConcepto('<?php echo isset($arrayValues["ninguno"]) ? $arrayValues["ninguno"][0] : "";?>',
									'<?php echo isset($arrayValues["ninguno"]) ? $arrayValues["ninguno"][1] : "Ninguno";?>',
									'<?php echo isset($arrayValues["ninguno"]) ? $arrayValues["ninguno"][3] : "0";?>',
									'<?php echo isset($arrayValues["ninguno"]) ? $arrayValues["ninguno"][2] : "0";?>',
									'<?php echo isset($arrayValues["ninguno"]) ? $arrayValues["ninguno"][4] : "AirportPickupRequired";?>',
									'ninguno',
									'Sin traslado aereo: ');
							agregarOtroConcepto('<?php echo isset($arrayValues["ida"]) ? $arrayValues["ida"][0] : "";?>',
									'<?php echo isset($arrayValues["ida"]) ? $arrayValues["ida"][1] : "Solo Ida";?>',
									'<?php echo isset($arrayValues["ida"]) ? $arrayValues["ida"][3] : "0";?>',
									'<?php echo isset($arrayValues["ida"]) ? $arrayValues["ida"][2] : "0";?>',
									'<?php echo isset($arrayValues["ida"]) ? $arrayValues["ida"][4] : "AirportPickupRequired";?>',
									'ida',
									'Traslado aereo solo ida: ');
							agregarOtroConcepto('<?php echo isset($arrayValues["ida-vuelta"]) ? $arrayValues["ida-vuelta"][0] : "";?>',
									'<?php echo isset($arrayValues["ida-vuelta"]) ? $arrayValues["ida-vuelta"][1] : "Ida y Vuelta";?>',
									'<?php echo isset($arrayValues["ida-vuelta"]) ? $arrayValues["ida-vuelta"][3] : "0";?>',
									'<?php echo isset($arrayValues["ida-vuelta"]) ? $arrayValues["ida-vuelta"][2] : "0";?>',
									'<?php echo isset($arrayValues["ida-vuelta"]) ? $arrayValues["ida-vuelta"][4] : "AirportPickupRequired";?>',
									'ida-vuelta',
									'Traslado aereo ida y vuelta: ');
							agregarOtroConcepto('<?php echo isset($arrayValues["registro"]) ? $arrayValues["registro"][0] : "";?>',
									'<?php echo isset($arrayValues["registro"]) ? $arrayValues["registro"][1] : "Registro (cuota &uacute;nica no reembolsable)";?>',
									'<?php echo isset($arrayValues["registro"]) ? $arrayValues["registro"][3] : "0";?>',
									'<?php echo isset($arrayValues["registro"]) ? $arrayValues["registro"][2] : "0";?>',
									'<?php echo isset($arrayValues["registro"]) ? $arrayValues["registro"][4] : "registro";?>',
									'registro',
									'Registro en temporada baja');
							agregarOtroConcepto('<?php echo isset($arrayValues["registroHighSeason"]) ? $arrayValues["registroHighSeason"][0] : "";?>',
									'<?php echo isset($arrayValues["registroHighSeason"]) ? $arrayValues["registroHighSeason"][1] : "Registro en temporada alta";?>',
									'<?php echo isset($arrayValues["registroHighSeason"]) ? $arrayValues["registroHighSeason"][3] : "0";?>',
									'<?php echo isset($arrayValues["registroHighSeason"]) ? $arrayValues["registroHighSeason"][2] : "0";?>',
									'<?php echo isset($arrayValues["registroHighSeason"]) ? $arrayValues["registroHighSeason"][4] : "registro";?>',
									'registroHighSeason',
									'Registro en temporada alta');
							agregarOtroConcepto('<?php echo isset($arrayValues["3-12"]) ? $arrayValues["3-12"][0] : "";?>',
									'<?php echo isset($arrayValues["3-12"]) ? $arrayValues["3-12"][1] : "Materiales de 3 a 12 semanas";?>',
									'<?php echo isset($arrayValues["3-12"]) ? $arrayValues["3-12"][3] : "0";?>',
									'<?php echo isset($arrayValues["3-12"]) ? $arrayValues["3-12"][2] : "0";?>',
									'<?php echo isset($arrayValues["3-12"]) ? $arrayValues["3-12"][4] : "materiales";?>',
									'3-12',
									'Materiales de 3 a 12 semanas');
							agregarOtroConcepto('<?php echo isset($arrayValues["13+"]) ? $arrayValues["13+"][0] : "";?>',
									'<?php echo isset($arrayValues["13+"]) ? $arrayValues["13+"][1] : "Materiales 13 semanas o m&aacute;s";?>',
									'<?php echo isset($arrayValues["13+"]) ? $arrayValues["13+"][3] : "0";?>',
									'<?php echo isset($arrayValues["13+"]) ? $arrayValues["13+"][2] : "0";?>',
									'<?php echo isset($arrayValues["13+"]) ? $arrayValues["13+"][4] : "materiales";?>',
									'13+',
									'Materiales 13 semanas o m&aacute;s');
							agregarOtroConcepto('<?php echo isset($arrayValues["custodyLetter"]) ? $arrayValues["custodyLetter"][0] : "";?>',
									'<?php echo isset($arrayValues["custodyLetter"]) ? $arrayValues["custodyLetter"][1] : "Carta Custodia (no reembolsable)";?>',
									'<?php echo isset($arrayValues["custodyLetter"]) ? $arrayValues["custodyLetter"][3] : "0";?>',
									'<?php echo isset($arrayValues["custodyLetter"]) ? $arrayValues["custodyLetter"][2] : "0";?>',
									'<?php echo isset($arrayValues["custodyLetter"]) ? $arrayValues["custodyLetter"][4] : "custodyLetter";?>',
									'custodyLetter',
									'Envio Carta de Custodia');
							/*
							agregarOtroConcepto('<?php echo isset($arrayValues["searchRoomstay"]) ? $arrayValues["searchRoomstay"][0] : "";?>',
									'<?php echo isset($arrayValues["searchRoomstay"]) ? $arrayValues["searchRoomstay"][1] : "B&uacute;squeda de alojamiento (no reembolsable)";?>',
									'<?php echo isset($arrayValues["searchRoomstay"]) ? $arrayValues["searchRoomstay"][3] : "0";?>',
									'<?php echo isset($arrayValues["searchRoomstay"]) ? $arrayValues["searchRoomstay"][2] : "0";?>',
									'<?php echo isset($arrayValues["searchRoomstay"]) ? $arrayValues["searchRoomstay"][4] : "searchRoomstay";?>',
									'searchRoomstay',
									'');
							*/
						</script>  
				</div>
				
				<br />		
		</fieldset>
		<br /><br />
		<input type="submit" value="Guardar informacion">
	</div>
<?php
	}
	mysql_close();
?>
</form>
</body>
</html>