<?php
	include "../classes/DBUtil.php";
	
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
	
	//queremos la marquee
	if(count($tickets) < 1){
		//no se ha llamado a ningun ticket
	} else {
		//se llamo a algun ticket, procedemos a dibujar la pantalla
		$printedMarquee = false;
		
		foreach ($tickets as $ticket){
			if(!$printedMarquee){
				$printedMarquee = true;
?>
				<marquee direction="up" scrolldelay="200" height="<?php echo isset($_POST["h"]) ? $_POST["h"] : 200;?>">
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
									<?php echo str_pad($ticket["numero"], 4, "0", STR_PAD_LEFT);?>
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
?>