<?php
include_once("DBConnection.php");
include_once ("DBUtil.php");
include_once ("BitacoraDAO.php");
include_once ("GanadoresBasket.php");
include_once ("GanadoresFutbol.php");
include_once ("GanadoresBeisbol.php");

$query = "SELECT vd.* ";
$query .= "FROM vista_ventas_detalles vd, ";
$query .= "(SELECT vd1.idventa FROM vista_ventas_detalles vd1 WHERE vd1.fecha_venta='".$_GET["date"]."' GROUP BY vd1.idventa) vd2 ";
$query .= "WHERE vd.anulado = 0  AND vd.idventa = vd2.idventa ORDER BY vd.idventa, vd.idventa_detalle";

echo "En VentasDAO::calcularTicketGanador -> iniciando '".$query."'<br /><br />";

$resultArray = array();
$time0 = time();
$dbConObj = new DBConnection();

echo "Fecha: ".$_GET["date"]."<br /><br />";
ini_set('memory_limit', '1024M');

try {
	$result = mysql_query($query, $dbConObj->getConnectionV2());
	if(!mysql_error()){
		while($r = mysql_fetch_array($result)){
			$resultArray[] = $r;
		}
		
		echo "count(resultArray)= ".count($resultArray)."<br /><br />";
	} else {
		echo "mysql_error(): ".mysql_error()."<br /><br />";;
	}
} catch (Exception $e) {
	echo("Error ejecutando consulta en base de datos".$e)."<br /><br />";;
}
		
$dbConObj->closeConnection();

echo mysql_error()."<br />";
echo "En VentasDAO::calcularTicketGanador -> ejecutado '".$query."<br /><br />";

if(count($result) > 0){
	foreach ($result as $venta){
		print_r($venta);
	}
} else {
	echo "result esta vacio";
}
?>