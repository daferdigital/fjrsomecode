<?php
	if(isset($_POST["sUO"]) && isset($_POST["nTO"]) && isset($_POST["sUD"])){
		$subUnidadOrigen = $_POST["sUO"];
		$numeroTicketOrigen = $_POST["nTO"];
		$subUnidadDestino = $_POST["sUD"];
		
		include_once '../classes/DBUtil.php';
		
		$query = "UPDATE ticket SET id_sub_departamento=".$subUnidadDestino;
		$query .= ", estado=4";
		$query .= " WHERE id_sub_departamento=".$subUnidadOrigen;
		$query .= " AND numero = ".intval($numeroTicketOrigen);
		$query .= " AND fecha_creacion >= CURDATE()";
		$query .= " AND fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
		
		DBUtil::executeQuery($query);
	}
?>