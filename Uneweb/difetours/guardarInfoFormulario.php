<?php
	include ("conexion.php");
	
	function guardarCampoConcepto($registro){
		//vemos si es un concepto nuevo o es uno ya existente
		//vamos modalidad por modalidad
		for($i = 0; $i < count($_POST["ordenModalidad"]); $i++){
			$query = "INSERT INTO curso_semanas (minimo_semanas, maximo_semanas, precio, id_modalidad, id_destino)"
					." VALUES(".$registro[1]
				    .",".$registro[2]
				    .",".$registro[$i + (count($_POST["ordenModalidad"]) - 1)]
				    .",".$_POST["ordenModalidad"][$i]
				    .",".$_POST["selectDestinoId"].")";
			mysql_query($query);
		}
	}
	
	function guardarCampoEstadia($registro){
		$query = "INSERT INTO curso_estadia(internal_key, descripcion, precio_under18, precio_over18, long_desc, id_destino)"
				."VALUES('".$registro[1]."','".$registro[2]."',".$registro[3].",".$registro[4].",'".$registro[5]."',".$_POST["selectDestinoId"].")";
		mysql_query($query);
	}
	
	function guardarOtroConcepto($registro){
		$query = "INSERT INTO curso_pagos(grupo, internal_key, descripcion, precio, pago_por_semana, id_destino, administrar)"
				."VALUES('".$registro[1]."','".$registro[2]."','".$registro[3]."',".$registro[4].",'".(isset($registro[5]) ? $registro[5] : "0")."',".$_POST["selectDestinoId"].", '1')";
		mysql_query($query);
	}
	
	if(isset($_POST["selectDestinoId"])){
		$index = 0;
		$doProcess = true;
		
		//borramos todo primero
		mysql_query("DELETE FROM curso_semanas WHERE id_destino=".$_POST["selectDestinoId"]);
		echo mysql_error()."<br />";
		mysql_query("DELETE FROM curso_estadia WHERE id_destino=".$_POST["selectDestinoId"]);
		echo mysql_error()."<br />";
		mysql_query("DELETE FROM curso_pagos WHERE id_destino=".$_POST["selectDestinoId"]." AND administrar='1'");
		echo mysql_error()."<br />";
		
		while($doProcess){
			if(isset($_POST["campoConcepto".$index])){
				guardarCampoConcepto($_POST["campoConcepto".$index]);
			} else if(isset($_POST["campoEstadia".$index])){
				guardarCampoEstadia($_POST["campoEstadia".$index]);
			} else if(isset($_POST["otroConcepto".$index])){
				guardarOtroConcepto($_POST["otroConcepto".$index]);
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
	window.location = "formularioCurso.php?selectDestinoId=<?php echo $_POST["selectDestinoId"];?>";
</script>