<?php
//Al momento de guardar un ticket, verificar que de todos los eventos involucrados 
//ninguno tenga una hora de inicio que implique que el evento esta ya en curso. + 5 minutos.

include_once '../classes/DBUtil.php';
$query = "SELECT l.fecha, l.hora, lecab.* "
		."FROM logros l, logros_equipos le, logros_equipos_categorias_apuestas_banqueros lecab "
		."WHERE le.idlogro_equipo = lecab.idlogro_equipo "
		."AND l.idlogro = le.idlogro "
		."AND lecab.idlogro_equipo_categoria_apuesta_banquero = 924028";

$selectResults = DBUtil::executeSelect($query);

//calculamos el tiempo del sistema
echo "Fecha del sistema: ".date("Y-m-d h:i:s")."<br />";
//print_r(getdate(time()));
//echo "<br />";

echo "Current Timestamp: ".strtotime(date("Y-m-d h:i:s"))."<br />";
//print_r(getdate(strtotime(date("Y-m-d h:i:s"))));
echo "<br />";

echo "Fecha del evento: ".$selectResults["fecha"]." ".$selectResults["hora"]."<br />";
echo "EventoTimestamp: ".strtotime($selectResults["fecha"]." ".$selectResults["hora"])."<br />";
//print_r(getdate(strtotime($selectResults["fecha"]." ".$selectResults["hora"])));
//echo "<br />";

$sysdate = time();
if($sysdate > strtotime($selectResults["fecha"]." ".$selectResults["hora"])){
	//este logro (evento) (apuesta) esta relacionada con un evento cuya hora de inicio
	//es menor a la fecha del sistema, lo que quiere decir que dicho evento ya inicio
	//detenemos la creacion de la venta en este punto
	
	die("Evento iniciado, debemos frenar la creacion del ticket.");
}
?>
