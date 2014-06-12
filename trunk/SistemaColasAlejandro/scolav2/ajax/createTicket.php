<?php
if(isset($_GET["id"])){
	include_once '../classes/DBUtil.php';
	include_once '../fpdf/fpdf.php';
	
	$idSubDpto = $_GET["id"];
	
	//verificamos la secuencia de inicio de los tickets
	$query =  "SELECT COUNT(*) FROM tickets";
	$query .= " WHERE id_sub_departamento = ".$idSubDpto;
	$query .= " AND fecha_creacion >= CURDATE()";
	$query .= " AND fecha_creacion < DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
	
	$tickets = DBUtil::getRecordCountToQuery($query) + 1;
	$tickets = str_pad($tickets, 4, "0", STR_PAD_LEFT);
	
	//ajustamos la hora por la zona horaria
	//en caso de diferencia con el servidor
	$timeZone = 'America/Caracas';  // timezone VZLA
	$dateSrc = date('Y-m-d H:i:s e');
	$dateTime = new DateTime($dateSrc);
	$dateTime->setTimeZone(new DateTimeZone($timeZone));
	
	$pdf = new FPDF('P', 'mm', array(55, 70));
	$pdf->SetMargins(0.5, 1, 0.5);
	$pdf->AddPage();
	
	//imagen de cabecera
	$pdf->Image('../imagenes/logoImpresion.jpg');
	$pdf->Ln();
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(50, 10, "Usted es el número: ".$tickets, 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "______________________________", 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "departamento: ", 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "sub departamento: ", 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "Hora de Llegada: ".$dateTime->format('g:i:s a'), 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(50, 10, "Hora estimada de atención: ".$dateTime->format('g:i:s a'), 0, 0);
	
	$pdf->Output("../tickets/ticket".$idSubDpto."_".$tickets.".pdf", "F");
}
?>