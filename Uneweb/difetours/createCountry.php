<?php 

include ("conexion.php");

$message;

if(isset($_POST["countryName"])){
	if(trim($_POST["countryName"]) != ""){
		//tenemos el nombre del pais, procedemos a guardarlo
		$query = "INSERT INTO curso_destino (destino) VALUES('".$_POST["countryName"]."')";
		mysql_query($query);
		$message = "El nuevo pais fue almacenado de manera exitosa";
	} else {
		$message = "Disculpe, el nombre del pais no puede ser vacio";
	}
} else {
	$message = "Disculpe, el nombre del pais no puede ser vacio";
}

mysql_close();
?>

<script>
	alert('<?php echo $message?>');
	window.location = "formularioCurso.php";
</script>