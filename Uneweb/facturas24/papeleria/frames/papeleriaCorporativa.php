<?php
	header("Content-Type: text/html; charset=iso-8859-1");
?>

	<div>
		Cantidad:
		<br />
		<select name="cantidad" id="cantidad">
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
	</div>
	<div>
		<br />
		<br />
		<br />
		Cargar Arte:
		<br />
		(Sobres, Mles, Pcorp, Otros)
		<br />
		<input type="file" name="artFile" id="artFile" />
	</div>