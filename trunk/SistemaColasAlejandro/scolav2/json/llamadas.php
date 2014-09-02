<?php
	include "../classes/DBUtil.php";
	/*
	 * Con este query obtenemos el ultimo llamado
	 * o en su defecto repetimos el ultimo llamado ya mostrado en pantalla 
	 */
	$query = "(SELECT d.nombre as dpto, sd.nombre as unidad, t.numero, t.id, t.estado";
	$query .= " FROM departamentos d, sub_departamento sd, ticket t";
	$query .= " WHERE t.fecha_creacion >= CURDATE()";
	$query .= " AND t.fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	$query .= " AND t.id_sub_departamento = sd.id";
	$query .= " AND sd.id_departamento = d.id";
	$query .= " AND t.estado=3";
	$query .= " ORDER BY t.fecha_atencion)";
	$query .= " UNION(";
	$query .= " SELECT d.nombre as dpto, sd.nombre as unidad, t.numero, t.id, t.estado";
	$query .= " FROM departamentos d, sub_departamento sd, ticket t";
	$query .= " WHERE t.fecha_creacion >= CURDATE()";
	$query .= " AND t.fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	$query .= " AND t.id_sub_departamento = sd.id";
	$query .= " AND sd.id_departamento = d.id";
	$query .= " AND t.estado=7";
	$query .= " ORDER BY t.fecha_atencion DESC LIMIT 1)";
	$query .= " LIMIT 1";
	
	$tickets = DBUtil::executeSelect($query);
	$ticket = null;
	
	if(count($tickets) > 0){
		$ticket = $tickets[0];
	} else {
		//forzamos un ticket vacio
		$ticket["dpto"] = "No se han llamado tickets";
		$ticket["unidad"] = "";
		$ticket["numero"] = "0";
	}

	//obtenemos los tickets ya llamados
	$query =  "SELECT d.nombre as dpto, sd.nombre as unidad, MAX(t.numero) as numero, MAX(t.id) as id, t.estado";
	$query .= " FROM departamentos d, sub_departamento sd, ticket t";
	$query .= " WHERE t.fecha_creacion >= CURDATE()";
	$query .= " AND t.fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	$query .= " AND t.id_sub_departamento = sd.id";
	$query .= " AND sd.id_departamento = d.id";
	$query .= " AND (t.estado=3 OR t.estado=7)";
	$query .= " GROUP BY d.nombre, sd.nombre";
	$query .= " HAVING MAX(t.fecha_atencion)";
	$query .= " ORDER BY t.fecha_atencion, t.prioridad DESC";
	
	$tickets = DBUtil::executeSelect($query);
?>
{
    "llamadas": [
    	{
                "unidad": "<?php echo $ticket["dpto"]." ".$ticket["unidad"]; ?>",
                "numero": "<?php echo str_pad($ticket["numero"], 4, "0", STR_PAD_LEFT); ?>"
        }
        <?php 
        	foreach ($tickets as $ticket){
		?>
				,{
	                "unidad": "<?php echo $ticket["unidad"]; ?>",
	                "numero": "<?php echo str_pad($ticket["numero"], 4, "0", STR_PAD_LEFT); ?>"
	        	}
		<?php
			}
        ?>
    ]
}