<?php
include('../fpdf/fpdf.php');
include "../classes/DBUtil.php";
include "../classes/Constants.php";
include "../classes/UsuarioDTO.php";
include "../classes/EnvioDAO.php";
include "../classes/EnvioDTO.php";

session_start();

$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
$idUsuario = "NULL";

if($userDTO === NULL){
	$idUsuario = "NULL";
} else {
	$idUsuario = $userDTO->getId();
}

class ConstanciaPDF extends FPDF {
	
	public function ConstanciaPDF(){
		//invocamos al constructor de la clase padre
		//para indicar tamano carta
		parent::FPDF("P", "mm", "letter");
	}
	
	// Page header
	function Header(){
		// Logo de cabecera
		$this->Image('../images/headerquierounacompuPDF.png', 5);
		// Arial bold 15
		//$this->SetFont('Arial','B',15);
		// Line break
		//$this->Ln(20);
		//imagen de fondo
		//$this->Image('./images/pdfPageBkg.png', 20);
	}
	
	function Footer(){
		$this->SetY(-15);
		$this->SetFont("Arial", "I", 10);
		$this->Cell(0, 10, "Página ".$this->PageNo()." de {nb}",0 ,0, "C");
	}
}

$pdf = new ConstanciaPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetY(60);

//membrete del manifiesto
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,"Quierounacompu.com",0,1);
$pdf->Cell(0,10,"Manifiesto de Envíos entregados al Courier",0,1);
$pdf->Cell(0,10,"Fecha: ".date("d-m-Y"),0,1);
$pdf->Ln(10);

//colocamos la informacion de los ids a procesar
$pdf->SetFont('Arial','B',12);
$pdf->Cell(65, 10, "Nombre del Destinatario", 1, 0);
$pdf->Cell(50, 10, "Empresa de Envío", 1, 0, "C");
$pdf->Cell(35, 10, "Número de Guía", 1, 0, "C");
$pdf->Cell(40, 10, "Ciudad Destino", 1, 1);

$pdf->SetFont('Times', '', 10);
$arrayIds = explode(",", $_GET["ids"]);
foreach ($arrayIds AS $idEnvio){
	$envioDTO = EnvioDAO::getEnvioInfo($idEnvio);
	EnvioDAO::updateEnvioCurrentStatus($idEnvio, EnvioDAO::$COD_STATUS_ENTREGADO_AL_COURIER);
	EnvioDAO::addComment($idEnvio,
		"Cambio de status a Entregado al Courier",
		$idUsuario,
		EnvioDAO::$COD_STATUS_ENTREGADO_AL_COURIER);
	
	if($envioDTO != null){
		$pdf->Cell(65, 10, $envioDTO->getNombreDestinatario(), 1, 0);
		$pdf->Cell(50, 10, $envioDTO->getDescEmpresaEnvio(), 1, 0);
		$pdf->Cell(35, 10, $envioDTO->getCodigoEnvio(), 1, 0);
		$pdf->Cell(40, 10, $envioDTO->getCiudadDestino(), 1, 1);
	}
	
	/*
	if($envioDTO != null){
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$ancho = 10;
		$lines = 0;
		
		$lines = $pdf->MultiCell(55, $ancho, $envioDTO->getNombreDestinatario(), "T", "J");
		
		$pdf->SetY($y);
		$pdf->SetX($x + 55);
		$lines2 = $pdf->MultiCell(55, $ancho, $envioDTO->getDescEmpresaEnvio(), "T", "C");
		$lines = ($lines > $lines2) ? $lines : $lines2;
		
		$pdf->SetY($y);
		$pdf->SetX($x + 55 + 55);
		$lines3 = $pdf->MultiCell(40, $ancho, $envioDTO->getCodigoEnvio(), "T", "C");
		$lines = ($lines > $lines3) ? $lines : $lines3;
		
		$pdf->SetY($y);
		$pdf->SetX($x + 55 + 55 + 40);
		$lines4 = $pdf->MultiCell(40, $ancho, $envioDTO->getCiudadDestino(), "T", "J");
		$lines = ($lines > $lines4) ? $lines : $lines4;
		
		$pdf->SetY($y + ($lines * 10));
	}
	*/
}

//colocamos la seccion de las firmas
$pdf->Ln(15);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(90,10,"Quien Recibe",0,0);
$pdf->Cell(100,10,"Quien Entrega",0,1);

$pdf->SetFont('Arial','',12);

$pdf->Cell(90,10,"Nombre:",0,0);
$pdf->Cell(100,10,"Nombre:",0,1);

$pdf->Cell(90,10,"Cedula: ",0,0);
$pdf->Cell(100,10,"Cedula: ",0,1);

$pdf->Cell(90,10,"Firma: ",0,0);
$pdf->Cell(100,10,"Firma:",0,1);

$pdf->Output();
?>