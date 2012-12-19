function cargarCiudades(edoId, selectObject){
	selectObject.length = 0;
	<?php 
		$query = "SELECT estados.nombre, ciudades.nombre FROM ubicaciones ciudades, ubicaciones estados WHERE ciudades.tipo_ubicacion = 2 AND ciudades.id_padre = estados.id ORDER BY LOWER(estados.nombre), LOWER(ciudades.nombre)";
		$consulta = mysql_query($query);
		while(list($edoNombre, $ciudadNombre) = mysql_fetch_array($consulta)){
	?>
		if(edoId == "<?php echo $edoNombre?>"){
			selectObject.options[selectObject.length] = new Option("<?php echo $ciudadNombre?>", "<?php echo $ciudadNombre?>");
		}
	<?php
		}
	?>
}
