<?php 
//verificamos la seccion a la que pertenece este programa para saber que editor accesar

if(isset($_REQUEST['id'])){
	include ("../conexion.php");
	
	$location = null;
	$query = "SELECT seccion FROM programas WHERE id=".$_REQUEST['id'];
	
	//53 - crucero
	//70 - circuito
	$result = mysql_fetch_array(mysql_query($query));
	mysql_close();
	
	if($result["seccion"] == 53){
		$location = "location: loadCruceroXML.php";
	} else if($result["seccion"] == 70){
		$location = "location: loadCircuitoXML.php";
	}
	
	if($location == null){
		echo "La secci&oacute;n '".$result["seccion"]."' no esta registrada en estos momentos";
	} else {
		header($location."?id=".$_REQUEST['id']);
	}
} else {
	echo "No se encontro el parametro id";
}
?>