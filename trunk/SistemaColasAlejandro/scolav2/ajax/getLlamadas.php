<?php
	include "../classes/DBUtil.php";
	 
	$query =  "SELECT d.nombre as dpto, sd.nombre as unidad, t.numero";
	$query .= " FROM departamentos d, sub_departamento sd, ticket t";
	$query .= " WHERE t.fecha_creacion >= CURDATE()";
	$query .= " AND t.fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	$query .= " AND t.id_sub_departamento = sd.id";
	$query .= "  AND sd.id_departamento = d.id";
	$query .= " AND (t.estado=3 OR t.estado=4)";
	$query .= " ORDER BY t.prioridad DESC, t.fecha_atencion";
	
	$tickets = DBUtil::executeSelect($query);
	
	if(count($tickets) < 1){
		//no se ha llamado a ningun ticket
	} else {
		//se llamo a algun ticket, procedemos a dibujar la pantalla
		$isFirst = true;
		$isNone = false;
		$printedMarquee = false;
		
		foreach ($tickets as $ticket){
			if($isFirst == true){
				$isFirst = false;
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
								<?php echo str_pad($infoTickets["numero"], 4, "0", STR_PAD_LEFT);?>
							</span>
							
						</td>
					</tr>
				</table>
				<div class="lineaSep">
					&nbsp;
				</div>
				
<?php
			} else {
				$isNone = !$isNone;
				if(!$printedMarquee){
					$printedMarquee = true;
?>
					<marquee direction="up" scrolldelay="200" height="200">
<?php
				}
?>
						<table class="oldsTicket">
						<tr>
							<td class="ticketSide1">
								<span id="side1">
									<?php echo $ticket["unidad"]?>
								</span>
								
							</td>
							<td class="ticketSide2">
								<span id="side1">
									<?php echo str_pad($infoTickets["numero"], 4, "0", STR_PAD_LEFT);?>
								</span>
								
							</td>
						</tr>
					</table>
					<div class="lineaSep">
						&nbsp;
					</div>
<?php
			}
		}
		
		if($printedMarquee){
?>
					</marquee>	
<?php
		}		
	}
?>