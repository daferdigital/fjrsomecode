<?php
	include ("conexion.php");
	
	function ajustarModalidades(){
		foreach ($_POST["ordenModalidad"] as $key => $value){
			if(trim($value[1]) != ""){
				//guardamos esta modalidad
				$query = "INSERT INTO curso_modalidad (internal_key, descripcion, id_destino)".
						" VALUES('".$key."','".$value[1]."',".$_POST["destinoId"].")";
				
				mysql_query($query);
				
				$_POST["ordenModalidad"][$key][0] = mysql_insert_id();
			} else {
				$_POST["ordenModalidad"][$key][0] = -1;
			}
		}
	}
	
	function guardarCampoConcepto($registro){
		//vemos si es un concepto nuevo o es uno ya existente
		//vamos modalidad por modalidad
		$i = 0;
		
		foreach ($_POST["ordenModalidad"] as $key => $value){
			if($_POST["ordenModalidad"][$key][0] != -1){
				$query = "INSERT INTO curso_semanas (minimo_semanas, maximo_semanas, precio, id_modalidad, id_destino)"
				." VALUES(".$registro[1]
				.",".$registro[2]
				.",".$registro[$i + (count($_POST["ordenModalidad"]) - 1)]
				.",".$_POST["ordenModalidad"][$key][0]
				.",".$_POST["destinoId"].")";
				
				mysql_query($query);
			}
			
			$i++;
		}
	}
	
	function guardarCampoEstadia($registro){
		if(trim($registro[2]) != ""){
			$query = "INSERT INTO curso_estadia(internal_key, descripcion, precio_under18, precio_over18, long_desc, id_destino)"
			."VALUES('".$registro[1]."','".$registro[2]."',".$registro[3].",".$registro[4].",'".$registro[5]."',".$_POST["destinoId"].")";
			mysql_query($query);
		}
	}
	
	function guardarCampoCiudad($registro){
		$query = "INSERT INTO curso_ciudad(ciudad, precio_envio_documentos, id_destino, precio_busqueda_alojamiento, precio_envio_carta)"
		."VALUES('".$registro[0]."',".$registro[1].",".$_POST["destinoId"].",".$registro[2].",".$registro[3].")";
		mysql_query($query);
	}
	
	function guardarOtroConcepto($registro){
		$query = "INSERT INTO curso_pagos(grupo, internal_key, descripcion, precio, pago_por_semana, id_destino, administrar)"
				."VALUES('".$registro[1]."','".$registro[2]."','".$registro[3]."',".$registro[4].",'".(isset($registro[5]) ? $registro[5] : "0")."',".$_POST["destinoId"].", '1')";
		mysql_query($query);
		echo mysql_error()."<br />";
	}
	
	if(isset($_POST["destinoId"])){
		$index = 0;
		$doProcess = true;
		
		//borramos todo primero
		mysql_query("DELETE FROM curso_semanas WHERE id_destino=".$_POST["destinoId"]);
		echo mysql_error()."<br />";
		
		mysql_query("DELETE FROM curso_estadia WHERE id_destino=".$_POST["destinoId"]);
		echo mysql_error()."<br />";
		
		mysql_query("DELETE FROM curso_pagos WHERE id_destino=".$_POST["destinoId"]." AND administrar='1'");
		echo mysql_error()."<br />";
		
		mysql_query("DELETE FROM curso_ciudad WHERE id_destino=".$_POST["destinoId"]);
		echo mysql_error()."<br />";
		
		mysql_query("DELETE FROM curso_modalidad WHERE id_destino=".$_POST["destinoId"]);
		echo mysql_error()."<br />";
		
		ajustarModalidades();
		
		while($doProcess){
			if(isset($_POST["campoConcepto".$index])){
				guardarCampoConcepto($_POST["campoConcepto".$index]);
			} else if(isset($_POST["campoEstadia".$index])){
				guardarCampoEstadia($_POST["campoEstadia".$index]);
			} else if(isset($_POST["otroConcepto".$index])){
				guardarOtroConcepto($_POST["otroConcepto".$index]);
			}  else if(isset($_POST["campoCiudad".$index])){
				guardarCampoCiudad($_POST["campoCiudad".$index]);
			} else {
				$doProcess = false;
			}
		
			$index ++;
		}
	}
	
	mysql_close();
?>
<script>
	alert("Su solicitud fue procesada");
	window.location = "formularioCurso.php?selectDestinoId=<?php echo $_POST["destinoId"];?>";
</script>