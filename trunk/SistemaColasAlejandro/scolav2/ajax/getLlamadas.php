<?php
	include "../classes/DBUtil.php";
	 
	$query =  "SELECT d.nombre as dpto, sd.nombre as unidad, t.numero";
	$query .= " FROM departamentos d, sub_departamento sd, ticket t";
	$query .= " WHERE t.fecha_creacion >= CURDATE()";
	$query .= " AND t.fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	$query .= " AND t.id_sub_departamento = sd.id";
	$query .= "  AND sd.id_departamento = d.id";
	$query .= " AND t.estado=3";
	$query .= " ORDER BY t.prioridad DESC, t.fecha_atencion";
	
	$tickets = DBUtil::executeSelect($query);
	
	if(count($tickets) < 1){
		//no se ha llamado a ningun ticket
	} else {
		//se llamo a algun ticket, procedemos a dibujar la pantalla
		$isFirst = true;
		$isNone = false;
		foreach ($tickets as $ticket){
			if($isFirst == true){
?>
				<div class="currentTicket">
					<div class="side1">
						&Uacute;ltima llamada:
						<br />
						<?php echo $ticket["dpto"]?>
						<br />
						<?php echo $ticket["unidad"]?>
					</div>
					<div class="side2">
						<?php echo str_pad($infoTickets["numero"], 4, "0", STR_PAD_LEFT);?>
					</div>
				</div>
<?php
			} else {
				$isNone != $isNone;
?>
				<marquee direction="up" scrolldelay="200" height="400">
					<div class="<?php echo $isNone ? "marqueeNone" : "marqueePar" ;?>">
						<span class="side1">
							<?php echo $ticket["dpto"].", ".$ticket["unidad"]?>
						</span>
						<span class="side2">
							<?php echo str_pad($infoTickets["numero"], 4, "0", STR_PAD_LEFT);;?>
						</span>
					</div>
				</marquee>
<?php
			}
		}
	}
?>