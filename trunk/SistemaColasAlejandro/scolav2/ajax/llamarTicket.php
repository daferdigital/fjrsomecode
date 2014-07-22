<?php
if(isset($_POST["taquilla"])){
	include_once '../classes/DBUtil.php';
	
	$idTaquilla = $_POST["taquilla"];
	
	//selecciono el id del ticket a procesar
	$query  = "SELECT ti.id, ti.numero";
	$query .= " FROM taquilla ta, ticket ti";
	$query .= " WHERE (ti.estado = 1 OR ti.estado=2 OR ti.estado=4 OR ti.estado=6)";
	$query .= " AND ti.fecha_creacion >= CURDATE()";
	$query .= " AND ti.fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	$query .= " AND ti.id_sub_departamento=ta.id_sub_departamento";
	$query .= " AND ta.id=".$idTaquilla;
	$query .= " ORDER BY ti.prioridad DESC";
	$query .= " LIMIT 1";
	
	$ticket = DBUtil::executeSelect($query);
	if(count($ticket) > 0){
		//tengo el ticket proximo a atender, lo cambio de estatus y muestro su id por pantalla
		
		$query = "UPDATE ticket set estado=3, fecha_atencion=NOW() WHERE id=".$ticket[0]["id"];
		DBUtil::executeQuery($query);
		
		echo str_pad($ticket[0]["numero"], 4, "0", STR_PAD_LEFT);
	} else {
		echo "Cola v&aacute;cia";
	}
}