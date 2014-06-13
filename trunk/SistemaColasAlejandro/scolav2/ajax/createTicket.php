<?php
if(isset($_GET["id"])){
	include_once '../classes/DBUtil.php';
	include_once '../fpdf/fpdf.php';
	
	$idSubDpto = $_GET["id"];
	$timeZone = "America/Caracas";  // timezone VZLA
	$dateSrc = date("Y-m-d H:i:s e");
	$dateTime = new DateTime($dateSrc);
	$dateTime->setTimeZone(new DateTimeZone($timeZone));
	$now = $dateTime->format("Y-m-d H:i:s");
	
	//inserto el ticket
	$query =  "INSERT INTO ticket (numero, fecha_creacion, fecha_estimada_atencion, estado, id_sub_departamento) VALUES (";
	$query .= " 0,";
	$query .= " '".$now."',";
	$query .= " '".$now."',";
	$query .= " 4,";
	$query .= $idSubDpto.")";
	
	$idTicket = DBUtil::executeQueryAndReturnLastId($query);
	//con este id debemos actualizar despues el registro, para generar el ticket impreso
	
	//verificamos la secuencia para el ticket recienb creado
	$query =  "SELECT COUNT(*) FROM ticket";
	$query .= " WHERE id_sub_departamento = ".$idSubDpto;
	$query .= " AND fecha_creacion >= CURDATE()";
	$query .= " AND fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	
	$tickets = DBUtil::getRecordCountToQuery($query);
	$tickets = str_pad($tickets, 4, "0", STR_PAD_LEFT);
	
	$query =  "SELECT d.nombre as nombreDpto, sd.nombre as nombreSubDpto, sd.horario_inicial, sd.tiempo_promedio_atencion";
	$query .= " FROM departamentos d, sub_departamento sd";
	$query .= " WHERE sd.id=".$idSubDpto;
	$query .= " AND d.id=sd.id_departamento";
	
	$datos = DBUtil::executeSelect($query);
	$datos = $datos[0];
	
	//calculamos la hora estimada de atencion
	$minutosDesdeHorarioInicio = ceil((strtotime($now) - strtotime($dateTime->format("Y-m-d")." ".$datos["horario_inicial"])) / 60);
	$minutosOcupados = $datos["tiempo_promedio_atencion"] * (((int) $tickets) - 1);
	$minutosEspera = abs($minutosOcupados - $minutosDesdeHorarioInicio) + $datos["tiempo_promedio_atencion"];
	
	$fechaAtencion = strtotime($now);
	$minutes = "+".$datos["tiempo_promedio_atencion"]." minute";
	if($minutosOcupados <= $minutosDesdeHorarioInicio){
		//este ticket debe ser el proximo a atender segun tiempo
		$fechaAtencion = strtotime($minutes, $fechaAtencion);
	} else {
		//hay cola de pacientes
		$minutes = '+'.($minutosEspera + $datos["tiempo_promedio_atencion"]).' minutes';
		$fechaAtencion = strtotime($minutes, $fechaAtencion);
	}
	
	/*
	echo $minutes."<br />";
	echo $minutosDesdeHorarioInicio."<br />";
	echo $minutosOcupados."<br />";
	echo $minutosEspera."<br />";
	echo date("Y-m-d H:i:s", $fechaAtencion)."<br />";
	*/
	
	$query =  "UPDATE ticket SET numero=".$tickets;
	$query .= " , fecha_estimada_atencion='".date("Y-m-d H:i:s", $fechaAtencion)."'";
	$query .= " WHERE id=".$idTicket;
	DBUtil::executeQuery($query);
	
	//ajustamos la hora por la zona horaria
	//en caso de diferencia con el servidor
	$pdf = new FPDF('P', 'mm', array(55, 70));
	$pdf->SetMargins(0.5, 1, 0.5);
	$pdf->AddPage();
	
	//imagen de cabecera
	$pdf->Image('../imagenes/logoImpresion.jpg');
	$pdf->Ln();
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(50, 10, "Usted es el número: ".$tickets, 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "___________________________", 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "Unidad: ".$datos["nombreDpto"], 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, $datos["nombreSubDpto"], 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "Hora de Llegada: ".$dateTime->format('g:i a'), 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "Atención aproximada: ".date("g:i a", $fechaAtencion), 0, 0);
	
	$pdf->Output("../tickets/ticket_".$idTicket.".pdf", "F");
	
	header("Location: ../tickets/ticket_".$idTicket.".pdf");
}
?>