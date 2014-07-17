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
	$gotResults = false;
	
	if(count($tickets) > 0){
		$gotResults = true;
		$ticket = $tickets[0];
		
		echo ($ticket["estado"] == 7 ? "false": "true").":,;";
		
		$query = "UPDATE ticket set estado=7 WHERE id=".$ticket["id"];
		DBUtil::executeQuery($query);
	} else {
		echo "false:,;";
		//forzamos un ticket vacio
		$ticket["dpto"] = "";
		$ticket["unidad"] = "";
		$ticket["numero"] = "0";
	}
?>
	<div class="lineaSep">
		&nbsp;
	</div>
	<table class="currentTicket">
		<tr>
			<td class="currentTicketSide1">
				<span id="side1">
					<?php echo $ticket["dpto"]?>
				</span>
				<br />
				<span id="side2">
					<?php echo $ticket["unidad"]?>
				</span>
			</td>
			<td class="currentTicketSide2">
				<span id="side1">
					&Uacute;LTIMO LLAMADO:
				</span>
				<br />
				<span id="side2">
					<?php echo str_pad($ticket["numero"], 4, "0", STR_PAD_LEFT);?>
				</span>
			</td>
		</tr>
	</table>