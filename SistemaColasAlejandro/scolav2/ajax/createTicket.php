<?php
if(isset($_POST["id"])){
	include_once '../classes/DBUtil.php';
	include_once '../fpdf/fpdf.php';
	include_once '../fpdf/PDFAutoPrint.php';
	
	$idSubDpto = $_POST["id"];
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
	
	//verificamos la secuencia para el ticket recien creado
	$query =  "SELECT COUNT(*) as cuenta, MAX(TIME(fecha_estimada_atencion)) as ultimoticket FROM ticket";
	$query .= " WHERE id_sub_departamento = ".$idSubDpto;
	$query .= " AND fecha_creacion >= CURDATE()";
	$query .= " AND fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	
	$infoTickets = DBUtil::executeSelect($query);
	$infoTickets = $infoTickets[0];
	$tickets = str_pad($infoTickets["cuenta"], 4, "0", STR_PAD_LEFT);
	
	$query =  "SELECT d.nombre as nombreDpto, sd.nombre as nombreSubDpto, sd.horario_inicial, sd.tiempo_promedio_atencion";
	$query .= " FROM departamentos d, sub_departamento sd";
	$query .= " WHERE sd.id=".$idSubDpto;
	$query .= " AND d.id=sd.id_departamento";
	
	$datos = DBUtil::executeSelect($query);
	$datos = $datos[0];
	
	//calculamos la hora estimada de atencion
	$minutosParaIniciar = strtotime($dateTime->format("Y-m-d")." ".$datos["horario_inicial"]);
	//echo $minutosParaIniciar."<br />";
	//echo print_r($infoTickets, true)."<br />";
	//echo strtotime($dateTime->format("Y-m-d")." ".$infoTickets["ultimoticket"])."<br />";
	
	if(strtotime($dateTime->format("Y-m-d")." ".$infoTickets["ultimoticket"]) > $minutosParaIniciar){
		$minutosParaIniciar = strtotime($dateTime->format("Y-m-d")." ".$infoTickets["ultimoticket"]);
	}
	$minutosDesdeHorarioInicio = ceil((strtotime($now) - $minutosParaIniciar) / 60);
	$minutosOcupados = $datos["tiempo_promedio_atencion"] * (((int) $infoTickets["cuenta"]) - 1);
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
	
	$query =  "UPDATE ticket SET numero=".$infoTickets["cuenta"];
	$query .= " , fecha_estimada_atencion='".date("Y-m-d H:i:s", $fechaAtencion)."'";
	$query .= " WHERE id=".$idTicket;
	DBUtil::executeQuery($query);
	
	//ya se realizo el proceso del ticket
	//ahora creamos su HTML respectivo para impresion
	$ticketHTML= file_get_contents("../ajax/templateTicket.html");
	$ticketHTML = str_replace("{0}", $tickets, $ticketHTML);
	$ticketHTML = str_replace("{1}", $datos["nombreDpto"], $ticketHTML);
	$ticketHTML = str_replace("{2}", $datos["nombreSubDpto"], $ticketHTML);
	$ticketHTML = str_replace("{3}", $dateTime->format('g:i a'), $ticketHTML);
	$ticketHTML = str_replace("{4}", date("g:i a", $fechaAtencion), $ticketHTML);
	
	file_put_contents("../tickets/ticket_".$idTicket.".html", $ticketHTML);
	//echo $ticketHTML;
	
	$pdf = new PDFAutoPrint('P', 'mm', array(55, 80));
	$pdf->SetMargins(0.2, 0.5, 0.5);
	$pdf->AddPage();
	
	//imagen de cabecera
	$pdf->Image('../imagenes/logoImpresion.jpg', 10);
	$pdf->Ln();
	
	$pdf->SetFont('Arial','', 20);
	$pdf->Cell(50, 10, $tickets, 0, 0, "C");
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(50, 10, "Número de atención", 0, 0, "C");
	$pdf->Ln(3);
	$pdf->Cell(50, 10, "___________________________", 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "Unidad: ".$datos["nombreDpto"], 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, $datos["nombreSubDpto"], 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "Hora de Llegada: ".$dateTime->format('g:i a'), 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "Atención aproximada: ".date("g:i a", $fechaAtencion), 0, 0);
	
	//marcamos el pdf para que al descargarse y mostrarse vaya directo a la impresora por defecto
	$pdf->AutoPrint(false);
	
	$pdf->Output("../tickets/ticket_".$idTicket.".pdf", "F");
	echo $idTicket;
}
?>