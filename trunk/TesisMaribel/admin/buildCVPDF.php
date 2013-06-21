<?php
include('fpdf/fpdf.php');
include "../classes/DBUtil.php";

class PDF extends FPDF {
	
	// Page header
	function Header(){
		// Logo
		$this->Image('../Imagenes/logo.png',3);
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		// Move to the right
		$this->Cell(80);
		// Title
		$this->Cell(55,10,'Solicitud de Empleo',1,0,'C');
		// Line break
		$this->Ln(20);
	}
}

$query = "SELECT s.*, d.nombre as departamento, c.nombre AS cargo "
." FROM departamento d, cargo c, solicitudes s"
." WHERE s.id_cargo = c.id"
." AND c.id_departamento = d.id";

$solicitud = DBUtil::executeSelect($query);
$solicitud = $solicitud[0];
$parsedFechaNacimiento = date_parse($solicitud["fecha_nacimiento"]);
$fechaNacimiento = $parsedFechaNacimiento["day"]."/".$parsedFechaNacimiento["month"]."/".$parsedFechaNacimiento["year"];

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//titulo de datos personales
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"Datos Personales",0,1);

//valores de los datos personales
$pdf->SetFont('Times', '', 12);
$pdf->Cell(120, 10, "Nombre: ".$solicitud["nombre"]." ".$solicitud["apellido"], 0, 0);
$pdf->Cell(100, 10, "CI: ".$solicitud["ci"], 0, 1);
$pdf->Cell(120, 10, "Lugar de Nacimiento: ".$solicitud["lugar_nacimiento"], 0, 0);
$pdf->Cell(100, 10, "Fecha de Nacimiento: ".$fechaNacimiento, 0, 1);
$pdf->Cell(120, 10, "Estado Civil: ".$solicitud["edo_civil"], 0, 0);
$pdf->Cell(100, 10, "Tiene Hijos?: ".$solicitud["tiene_hijos"], 0, 1);
$pdf->Cell(120, 10, "Email: ".$solicitud["email"], 0, 0);
$pdf->Cell(100, 10, "Teléfonos: ".$solicitud["tlf_habitacion"]."; ".$solicitud["tlf_celular"], 0, 1);
$pdf->MultiCell(240, 10, "Dirección: ".$solicitud["direccion"], 0, "J");

//titulo de datos laborales
$pdf->Ln(10);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"Datos Laborales",0,1);

//valores de datos laborales
$pdf->SetFont('Times', '', 12);
$pdf->Cell(120, 10, "Grado de Instrucción: ".$solicitud["grado_instruccion"], 0, 0);
$pdf->Cell(100, 10, "Especialidad: ".$solicitud["especialista_en"], 0, 1);
$pdf->Cell(120, 10, "Profesión: ".$solicitud["profesional_en"], 0, 0);
$pdf->Cell(100, 10, "Posee experiencia laboral: ".$solicitud["experiencia_laboral"], 0, 1);

if(strtolower($solicitud["experiencia_laboral"]) != "no"){
	$pdf->Cell(120, 10, "Trabajos en los últimos 5 años: ".$solicitud["ultimos_trabajos"], 0, 0);
	$pdf->Cell(100, 10, "Permanencia en el último trabajo: ".$solicitud["antiguedad_ultimo_trabajo"], 0, 1);
}

if(strtolower($solicitud["ex_empleado"]) != "no"){
	$pdf->Cell(120, 10, "Es ex empleado de La Muralla: Sí", 0, 0);
	$pdf->Cell(100, 10, "Motivo del Retiro: ".$solicitud["motivo_retiro"], 0, 1);
}

//titulo de solicitud de empleo realizada
$pdf->Ln(10);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0, 10, "Solicitud de Empleo Realizada", 0, 1);

//valores de solicitud de empleo realizada
$pdf->SetFont('Times', '', 12);
$pdf->Cell(120, 10, "Departamento en el que desea laborar: ".$solicitud["departamento"], 0, 0);
$pdf->Cell(100, 10, "Cargo Aspirado: ".$solicitud["cargo"], 0, 1);
$pdf->Cell(100, 10, "Horario solicitado: ".$solicitud["horario_deseado"], 0, 0);

$pdf->Output();
?>