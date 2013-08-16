<?php
include('../fpdf/fpdf.php');
include "../classes/DBUtil.php";
include "../classes/EnvioDAO.php";
include "../classes/EnvioDTO.php";

class ConstanciaPDF extends FPDF {

	// Page header
	function Header(){
		// Logo de cabecera
		$this->Image('../images/headerquierounacompuPDF.png', 40);
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
$pdf->Cell(55, 10, "Nombre del Destinatario", 1, 0);
$pdf->Cell(55, 10, "Empresa de Envío", 1, 0);
$pdf->Cell(40, 10, "Número de Guía", 1, 0);
$pdf->Cell(40, 10, "Ciudad Destino", 1, 1);

$pdf->SetFont('Times', '', 10);
$arrayIds = explode(",", $_GET["ids"]);
foreach ($arrayIds AS $idEnvio){
	$envioDTO = EnvioDAO::getEnvioInfo($idEnvio);
	EnvioDAO::updateEnvioCurrentStatus($idEnvio, EnvioDAO::$COD_STATUS_ENTREGADO_AL_COURIER);
	
	if($envioDTO != null){
		$pdf->Cell(55, 10, $envioDTO->getNombreDestinatario(), 1, 0);
		$pdf->Cell(55, 10, $envioDTO->getDescEmpresaEnvio(), 1, 0);
		$pdf->Cell(40, 10, $envioDTO->getCodigoEnvio(), 1, 0);
		$pdf->Cell(40, 10, $envioDTO->getCiudadDestino(), 1, 1);
	}
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