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
		<div class="subDptosContainer">
		<?php 
			foreach($subDptos as $subDpto){
		?>
				<div>
					<span>
						<?php echo $subDpto["nombre"];?>
						<br />
						<?php 
							$cupoActual = $subDpto["cupo_maximo"] - $subDpto["ticketsRegistrados"];
						?>
						Disponibilidad: <b><?php echo $cupoActual < 1 ? "Agotado" : $cupoActual;?></b>
					</span>
					<?php
						if($cupoActual  > 0){
					?>
						<br />
						<a style="margin-left: auto; margin-right: auto;" class="btnPrint" href="javascript:printTicket('<?php echo $_POST["id"]?>','<?php echo $subDpto["id"]?>', false)">
							<img alt="print" src="imagenes/printer32x32.png" style="display: inline-block; cursor: pointer; border:0px;"/>
						</a>
						<a style="margin-left: auto; margin-right: auto;" class="btnPrint" href="javascript:printTicket('<?php echo $_POST["id"]?>','<?php echo $subDpto["id"]?>', true)">
							<img alt="print" src="imagenes/emergencia32x32.png" style="display: inline-block; cursor: pointer; border:0px;"/>
						</a>
					<?php
						}
					?>
				</div>
		<?php
			}
		?>
		</div>
<?php
	}
}
?>