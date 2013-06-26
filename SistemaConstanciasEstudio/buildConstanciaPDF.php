<?php
include('./fpdf/fpdf.php');
include "./classes/DBUtil.php";

class PDF extends FPDF {
	
	// Page header
	function Header(){
		// Logo
		$this->Image('./images/headerPDF.png', 20);
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		// Line break
		$this->Ln(20);
	}
}

$query = "SELECT * FROM profesor_constancia pc";
$profesor = DBUtil::executeSelect($query);
$profesor = $profesor[0];

$query = "SELECT ac.* "
." FROM alumno_constancia ac"
." WHERE ac.cedula=".$_GET["id"];

$alumno = DBUtil::executeSelect($query);
$alumno = $alumno[0];

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//titulo de datos personales
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"Constancia de Estudio",0,1,'C');
$pdf->Ln(10);

//Parrafo 1
$pdf->SetFont('Times', '', 13);
$pdf->Cell(20, 10, "", 0, 0);
$pdf->Cell(30, 10, "Quien suscribe, ", 0, 0);
$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(80, 10, "Prof(ra). ".$profesor["nombre"].", ", 1, 0);
$pdf->SetFont('Times', '', 13);
$pdf->MultiCell(30, 10, "Venezolano titular de la cédula de identidad ", 0, 0);

$pdf->Output();
?>