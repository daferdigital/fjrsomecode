<?php include ("conexion.php");?>

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
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + modalidad1 + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + modalidad2 + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + modalidad3 + '"/>'
			+ '        </td>'
			+ '        <td>'
			+ '            <input type="text" name="campoConcepto' + index +'[]" value="' + modalidad4 + '"/>'
			+ '        </td>'
			+ '    </tr>'
			+ '</table>';
		
		index ++;
	}

	function agregarEstadia(id, internalKey, descripcion, precioUnder18, precioOver18, longDesc){
		var divEstadia = document.getElementById("tipoEstadia");

		divEstadia.innerHTML += '<table id="estadia' + index + '">'
			+ '    <tr>'
			+ '        <td>'
			+ '            <input type="button" value="Eliminar Estadia" onclick="javascript:eliminarElemento(\'estadia'+ index +'\');" />'
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

	function agregarOtroConcepto(id, descripcion, precio, semanal, grupo, internalKey){
		var divConceptos = document.getElementById("conceptosFijos");
		var extraInfo = "";
		
		if(semanal == "1"){
			//debemos marcar el check
			extraInfo = "checked";
		}
		
		divConceptos.innerHTML += '<table id="otroConcepto' + index + '">'
			+ '    <tr>'
			+ '        <td>'
			+ '            <input type="button" value="Eliminar" onclick="javascript:eliminarElemento(\'otroConcepto'+ index +'\');" />'
			+ '        </td>'
			+ '        <td>'
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

<form action="guardarInfoFormulario.php" method="post">

<div style="margin-left: auto; margin-right: auto;">
	Indique el pa&iacute;s a ser procesado
	
	<select name="selectDestinoId" onchange="refreshPage(this.options[this.selectedIndex].value)">
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
</div>

<?php 
	if(isset($_GET["selectDestinoId"])){
		$selectDestinoId = $_GET["selectDestinoId"];
?>
    <input type="hidden" name="destinoId" value="<?php echo $_GET["selectDestinoId"];?>"/>
	<div align="center">
		<table>
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
					$modalidadOrder = array();
					$query = "SELECT id, descripcion FROM curso_modalidad WHERE id_destino=".$selectDestinoId." ORDER BY id";
					$result = mysql_query($query);
					while($row = mysql_fetch_array($result)){
				?>
						<td width="150">
							<?php 
								$modalidadOrder[] = $row["id"];
								echo $row["descripcion"];
							?>
							<input type="hidden" name="ordenModalidad[]" value="<?php echo $row["id"];?>"/>
						</td>
				<?php
					}
				?>
			</tr>
		</table>
	</div>
	
	<div id="conceptosPrincipales" align="center" style="border-style: solid;">
	</div>
	
	<div align="center">
		<?php 
			//obtenemos los precios de los distintos tipos de cursos, si existen
			$query = "SELECT id, minimo_semanas, maximo_semanas, precio, id_modalidad FROM curso_semanas WHERE id_destino=".$selectDestinoId." ORDER BY minimo_semanas, id_modalidad";
			$result = mysql_query($query);
			$count = count($modalidadOrder) > 0 ? count($modalidadOrder) : 1;
			$ciclos = mysql_num_rows($result) / $count;
			for($i = 0; $i < $ciclos; $i++){
				$params = "";
				
				for($j = 0; $j < count($modalidadOrder); $j++){
					$row = mysql_fetch_array($result);
					
					if($j == 0){
						$params .= "'".$row["id"]."','".$row["minimo_semanas"]."','".$row["maximo_semanas"]."'";
					}
					$params .= ",'".$row["precio"]."'";
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
	
	<br />
	<div align="center">
		<table>
			<tr>
				<td width="150">
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
			while($row = mysql_fetch_array($result)){
		?>
				<script>
					agregarEstadia('<?php echo $row["id"]?>',
						'<?php echo $row["internal_key"]?>',
						'<?php echo $row["descripcion"]?>',
						'<?php echo $row["precio_under18"]?>',
						'<?php echo $row["precio_over18"]?>',
						'<?php echo $row["long_desc"]?>');
				</script>
		<?php
			}
		?>
		<input type="button" value="Agregar Tipo de Estadia" onclick="javascript:agregarEstadia('','','','','','');">
		<br />
		<br />
	</div>
	
	<div align="center">
		<fieldset>
			<legend>Otros conceptos</legend>
				<div align="center">
					<table>
						<tr>
							<td width="150">
								&nbsp;
							</td>
							<td width="150">
								Descripcion
							</td>
							<td width="150">
								Precio
							</td>
							<td width="150">
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
			                ." AND administrar='1'"
						    ." ORDER BY grupo";
						$result = mysql_query($query);
						while($row = mysql_fetch_array($result)){
					?>
						<script>
							agregarOtroConcepto('<?php echo $row["id"];?>',
									'<?php echo $row["descripcion"];?>',
									'<?php echo $row["precio"];?>',
									'<?php echo $row["pago_por_semana"];?>',
									'<?php echo $row["grupo"];?>',
									'<?php echo $row["internal_key"];?>');
						</script>  
					<?php
						} 
					?>	
				</div>
				
				<br />
				<input type="button" value="Agregar Otro Concepto" onclick="javascript:agregarOtroConcepto('','','','0','','');">			
		</fieldset>
		<br /><br />
		<input type="submit" value="Guardar informacion">
	</div>
<?php
	}
	mysql_close();
?>
</form>