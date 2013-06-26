<?php
include('./fpdf/fpdf.php');
include "./classes/DBUtil.php";

class ConstanciaPDF extends FPDF {
	
	// Page header
	function Header(){
		// Logo de cabecera
		$this->Image('./images/headerPDF.png', 20);
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		// Line break
		$this->Ln(20);
		//imagen de fondo
		$this->Image('./images/pdfPageBkg.png', 20);
	}
	
	public function getDateTextFormated(){
		$day = date("j");
		$month = date("n");
		$year = date("Y");
		
		$text = "";
		//verificamos el texto del dia
		switch ($day){
			case 1:
				$text .= "al primer (01) d�a ";
				break;
			case 2:
				$text .= "a los dos (02) d�as ";
				break;
			case 3:
				$text .= "a los tres (03) d�as ";
				break;
			case 4:
				$text .= "a los cuatro (04) d�as ";
				break;
			case 5:
				$text .= "a los cinco (05) d�as ";
				break;
			case 6:
				$text .= "a los seis (06) d�as ";
				break;
			case 7:
				$text .= "a los siete (07) d�as ";
				break;
			case 8:
				$text .= "a los ocho (08) d�as ";
				break;
			case 9:
				$text .= "a los nueve (09) d�as ";
				break;
			case 10:
				$text .= "a los diez (10) d�as ";
				break;
			case 11:
				$text .= "a los once (11) d�as ";
				break;
			case 12:
				$text .= "a los doce (12) d�as ";
				break;
			case 13:
				$text .= "a los trece (13) d�as ";
				break;
			case 14:
				$text .= "a los catorce (14) d�as ";
				break;
			case 15:
				$text .= "a los quince (15) d�as ";
				break;
			case 16:
				$text .= "a los dieciseis (16) d�as ";
				break;
			case 17:
				$text .= "a los diecisiete (17) d�as ";
				break;
			case 18:
				$text .= "a los dieciocho (18) d�as ";
				break;
			case 19:
				$text .= "a los diecinueve (19) d�as ";
				break;
			case 20:
				$text .= "a los veinte (20) d�as ";
				break;
			case 21:
				$text .= "a los veintiun (21) d�as ";
				break;
			case 22:
				$text .= "a los veintidos (22) d�as ";
				break;
			case 23:
				$text .= "a los veintitres (23) d�as ";
				break;
			case 24:
				$text .= "a los veinticuatro (24) d�as ";
				break;
			case 25:
				$text .= "a los veinticinco (25) d�as ";
				break;
			case 26:
				$text .= "a los veintiseis (26) d�as ";
				break;
			case 27:
				$text .= "a los veintisiete (27) d�as ";
				break;
			case 28:
				$text .= "a los veintiocho (28) d�as ";
				break;
			case 29:
				$text .= "a los veintinueve (29) d�as ";
				break;
			case 30:
				$text .= "a los treinta (30) d�as ";
				break;
			case 31:
				$text .= "a los treinta y un (31) d�as ";
				break;
		}
		
		$text .= "del mes de ";
		switch ($month){
			case 1:
				$text .= "Enero ";
				break;
			case 2:
				$text .= "Febrero ";
				break;
			case 3:
				$text .= "Marzo ";
				break;
			case 4:
				$text .= "Abril ";
				break;
			case 5:
				$text .= "Mayo ";
				break;
			case 6:
				$text .= "Junio ";
				break;
			case 7:
				$text .= "Julio ";
				break;
			case 8:
				$text .= "Agosto ";
				break;
			case 9:
				$text .= "Septiembre ";
				break;
			case 10:
				$text .= "Octubre ";
				break;
			case 11:
				$text .= "Noviembre ";
				break;
			case 12:
				$text .= "Diciembre ";
				break;
		}
		
		$text .= "del a�o ".$year;
		
		return $text;
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
$pdf = new ConstanciaPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetY(60);

//titulo de datos personales
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"Constancia de Estudio",0,1,'C');
$pdf->Ln(10);

$pdf->SetFont("Times", "", 13);
$pdf->Cell(25);
$pdf->Write(10, "Quien suscribe, ");

$pdf->SetFont("Times", "B", 13);
$pdf->Write(10, "Prof(ra). ".$profesor["nombre"].", ");

$pdf->SetFont("Times", "", 13);
$pdf->Write(10, "Venezolano(a) titular de la c�dula de identidad");

$pdf->SetFont("Times", "B", 13);
$pdf->Write(10, "N� ".$profesor["cedula"].", ");

$pdf->SetFont("Times", "", 13);
$pdf->Write(10, "en mi condici�n de ".$profesor["cargo"]." ubicada en el Municipio San Fernando - Parroquia El Recreo Estado Apure, "
		."por medio de la presente hago constar que el (la) Bachiller: ");

$pdf->SetFont("Times", "B", 13);
$pdf->Write(10, $alumno["nombre"]." titular de la cedula de identidad N� ".$alumno["cedula"]."; ");

$pdf->SetFont("Times", "", 13);
$pdf->Write(10, "es triunfador (a) del: Programa de Formaci�n Nacional de Producci�n Agroalimentaria. Cursa satisfactoriamente el ");

//Parrafo 1
$pdf->SetFont("Times", "B", 13);
$pdf->Write(10, $alumno["trimestre"]." Trimestre. En horario comprendido los d�as ".$alumno["horario"]."; ");

$pdf->ln(20);

$pdf->SetFont("Times", "", 13);
$pdf->Cell(25);
$pdf->Write(10, "Constancia que se expide a solicitud de la parte interesada en la ciudad de San Fernando Estado Apure, "
		."Parroquia El Recreo ".$pdf->getDateTextFormated().".");

$pdf->ln(30);

$pdf->SetFont("Times", "B", 13);
$pdf->Cell(0, 10, "Prof(ra). ".$profesor["nombre"], 0, 1, "C");
$pdf->Cell(0, 10, $profesor["cargo"], 0, 1, "C");
$pdf->Cell(0, 10, "Tlf: ".$profesor["telefono"], 0, 1, "C");
$pdf->Cell(0, 10, "Emails: ".$profesor["correo"], 0, 1, "C");

$pdf->Output();
?>