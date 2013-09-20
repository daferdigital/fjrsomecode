<?php
	header("Content-Type: text/html; charset=iso-8859-1");
	$tipoContenido = $_POST["contenido"];
?>
	<input type="hidden" name="tipo" value="Papeleria Corporativa"/>
	<input type="hidden" name="contenido" value="<?php echo $tipoContenido;?>"/>
	<div>
		Cantidad:
		<br />
		<select name="cantidad" id="cantidad">
			<option value="">Seleccione</option>
			<option value="10">10</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="200">200</option>
			<option value="300">300</option>
			<option value="500">500</option>
			<option value="1000">1000</option>
			<option value="2000">2000</option>
			<option value="5000">5000</option>
			<option value="10000">10000</option>
			<option value="+10000">M&aacute;s de 10000</option>
		</select>
		<span id="mandatoryCantidad" class="isMandatory" style="display: none;">
			<br />
			Debe indicar la cantidad estimada de articulos que desea.
		</span>
	</div>
	<div>
		<br />
		<br />
		Cargar Arte:
		<br />
		(Sobres, Mles, Pcorp, Otros)
		<br />
		<input type="file" name="artFile" id="artFile" />
		<span id="mandatoryArtFile" class="isMandatory" style="display: none;">
			<br />
			Debe indicar el archivo a usar como arte para su pedido.
		</span>
	</div>
	
	<input type="submit" value="Solicitar" />