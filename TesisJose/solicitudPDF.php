<?php
include('fpdf/fpdf.php');
include "./classes/DBUtil.php";

class PDF extends FPDF {
	
	// Page header
	function Header(){
		// Logo
		$this->Image('./images/header1PDF.jpg', 10);
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		// Move to the right
		$this->Cell(50);
		// Title
		$this->Cell(100,10,'Ficha Informativa del Funcionario',1,0,'C');
		// Line break
		$this->Ln(20);
	}
	
	function Footer(){
		$this->SetY(-15);
		$this->SetFont("Arial", "I", 10);
		$this->Cell(0, 10, "Página ".$this->PageNo()." de {nb}",0 ,0, "C");
	}
}

//colocamos los permisos de este funcionario
$query = "SELECT s.*, p.nombre AS tipoPermiso ";
$query .= " FROM solicitud s, permiso p";
$query .= " WHERE s.id_tipo_permiso = p.id";
$query .= " AND s.id = ".$_GET["id"];
$query .= " ORDER BY fecha_inicio";

$permisos = DBUtil::executeSelect($query);

$query = "SELECT p.*, supervisor.nombre AS nombreSupervisor, supervisor.apellido AS apellidoSupervisor, c.nombre AS cargo "
." FROM personal p LEFT JOIN personal supervisor ON p.id_supervisor = supervisor.id, cargo c"
." WHERE c.id = p.id_cargo"
." AND p.id=".$permisos[0]["id_personal"];

$solicitud = DBUtil::executeSelect($query);
$solicitud = $solicitud[0];
$parsedFechaNacimiento = date_parse($solicitud["fecha_ingreso"]);
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
$pdf->Cell(100, 10, "CI: ".$solicitud["cedula"], 0, 1);
$pdf->Cell(120, 10, "Turno: ".$solicitud["turno"], 0, 0);
$pdf->Cell(100, 10, "Fecha de Ingreso: ".$fechaNacimiento, 0, 1);
$pdf->Cell(120, 10, "Ubicación: ".$solicitud["ubicacion"], 0, 0);
$pdf->Cell(100, 10, "Teléfono: ".$solicitud["telefono"], 0, 1);
$pdf->Cell(120, 10, "Cargo: ".$solicitud["cargo"], 0, 0);
$pdf->Cell(100, 10, "Supervisor: ".$solicitud["nombreSupervisor"]." ".$solicitud["apellidoSupervisor"], 0, 1);
$pdf->MultiCell(240, 10, "Dirección: ".$solicitud["direccion"], 0, "J");

$pdf->Ln(30);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,"Permiso Solicitado",0,1,"C");

$pdf->SetFont('Times', '', 12);

if(count($permisos) <= 0){
	$pdf->Cell(120, 10, "Este funcionario aún no ha solicitado ningún permiso o vacación.", 0, 0);
}else{
	$permiso = $permisos[0];
	
	//dibujamos la cabecera de la tabla informativa
	$pdf->SetFont('Arial','B',12);
	$pdf->Write(10, "Tipo: ");
	$pdf->SetFont('Times', '', 12);
	$pdf->Write(10, $permiso["tipoPermiso"]);
	$pdf->Ln(10);
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Write(10, "Fecha de Salida: ");
	$pdf->SetFont('Times', '', 12);
	$pdf->Write(10, $permiso["fecha_inicio"]);
	$pdf->Ln(10);
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Write(10, "Fecha de Llegada: ");
	$pdf->SetFont('Times', '', 12);
	$pdf->Write(10, $permiso["fecha_fin"]);
	$pdf->Ln(10);
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Write(10, "Comentario: ");
	$pdf->SetFont('Times', '', 12);
	$pdf->Write(10, $permiso["comentario"]);
	$pdf->Ln(10);
}

$pdf->Output();
?>