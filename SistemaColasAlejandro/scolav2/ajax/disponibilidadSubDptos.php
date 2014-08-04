<?php
include_once("../classes/DBUtil.php");
if(isset($_POST["id"])){
	//tenemos el id del dpto, obtenemos los sub-dptos
	$query  = "SELECT *, (SELECT COUNT(*) FROM ticket t WHERE t.id_sub_departamento = sd.id AND t.fecha_creacion >= CURDATE() AND t.fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AS ticketsRegistrados"; 
	$query .= " FROM sub_departamento sd";
	$query .= " WHERE sd.activo='1'";
	$query .= " AND sd.id_departamento=".$_POST["id"];
	$query .= " AND CURTIME() >= sd.horario_inicial";
	$query .= " AND CURTIME() <= sd.horario_final";
	$query .= " ORDER BY sd.nombre";
	$subDptos = DBUtil::executeSelect($query);
	
	if(count($subDptos) < 1){
		echo "<b>Este departamento no tiene informaci&oacute;n de sub-departamentos</b>";
	} else {
?>	
		<div class="contenedorSubDpto">
			<?php echo strtoupper($subDptos[0]["nombre"]);?>
			<br />
			<?php 
				$cupoActual = $subDptos[0]["cupo_maximo"] - $subDptos[0]["ticketsRegistrados"];
			?>
			&nbsp;DISPONIBILIDAD:&nbsp;<b><?php echo $cupoActual < 1 ? "AGOTADO" : $cupoActual;?></b>&nbsp;
			<br />
			<?php
				if($cupoActual  > 0){
			?>
				<div style="width: 50%; display: inline; margin-right: 25px;">
					<a style="margin-left: auto; margin-right: auto; text-decoration: none;" class="btnPrint" href="javascript:printTicket('<?php echo $_POST["id"]?>','<?php echo $subDptos[0]["id"]?>', false)">
						<img alt="print" src="imagenes/printer.png" style="display: inline-block; cursor: pointer; border:0px;"/>
					</a>
				</div>
				<div style="width: 50%; display: inline;">
					<a style="margin-left: auto; margin-right: auto; text-decoration: none;" class="btnPrint" href="javascript:printTicket('<?php echo $_POST["id"]?>','<?php echo $subDptos[0]["id"]?>', true)">
						<img alt="print" src="imagenes/emergencia.png" style="display: inline-block; cursor: pointer; border:0px;"/>
					</a>
				</div>
			<?php
				}
			?>
		</div>
		<div style="display: inline; width: 10%">
			&nbsp;
		</div>
		<?php 
			if(isset($subDptos[1])){
		?>
				<div class="contenedorSubDpto">
					<?php echo strtoupper($subDptos[1]["nombre"]);?>
					<br />
					<?php 
						$cupoActual = $subDptos[1]["cupo_maximo"] - $subDptos[1]["ticketsRegistrados"];
					?>
					&nbsp;DISPONIBILIDAD:&nbsp;<b><?php echo $cupoActual < 1 ? "AGOTADO" : $cupoActual;?></b>&nbsp;
					<br />
					<?php
						if($cupoActual  > 0){
					?>
						<div style="width: 50%; display: inline; margin-right: 25px;">
							<a style="margin-left: auto; margin-right: auto; text-decoration: none;" class="btnPrint" href="javascript:printTicket('<?php echo $_POST["id"]?>','<?php echo $subDptos[1]["id"]?>', false)">
								<img alt="print" src="imagenes/printer.png" style="display: inline-block; cursor: pointer; border:0px;"/>
							</a>
						</div>
						<div style="width: 50%; display: inline;">
							<a style="margin-left: auto; margin-right: auto; text-decoration: none;" class="btnPrint" href="javascript:printTicket('<?php echo $_POST["id"]?>','<?php echo $subDptos[1]["id"]?>', true)">
								<img alt="print" src="imagenes/emergencia.png" style="display: inline-block; cursor: pointer; border:0px;"/>
							</a>
						</div>
					<?php
						}
					?>
				</div>
		<?php	
			}
		}
	}
?>