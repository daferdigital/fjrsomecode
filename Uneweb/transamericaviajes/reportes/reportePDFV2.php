<?php
    /** Error reporting */
    error_reporting(E_ALL);

require('fpdf/fpdf.php');
include ('dbConnection.php');

class PDF extends FPDF {

	// Tabla simple
	function BasicTable($localizador) {
		$sql1 = "SELECT DATE_FORMAT(vpc.fecha_compra, '%d-%m-%Y'), lvpc.nro_inscripcion, UPPER(cl.tipo_cliente) AS persona_juridica, cl.razon_social, cl.rif, cl.nombre_contacto, cl.apellido_contacto, cl.ci, cl.direccion, cl.telefono_trabajo1, cl.telefono_trabajo2, cl.telefono_habitacion,
		lvpc.nombre_pasajero, lvpc.ci, DATE_FORMAT(vpc.fecha_nacimiento, '%d-%m-%Y'), vpc.edad, vpc.nro_pasaporte_pas, vpc.nro_visa_pas, vpc.telefono_pas, vpc.correo_pas, vpc.colegio, vpc.talla_camisa, vpc.ciudad, vpc.direccion_pas,
		lvpc.descripcion, lvpc.cantidad, lvpc.costo_unitario
		FROM clientes cl, ventas_paquetes_credito vpc, linea_ventas_paquetes_credito lvpc
		WHERE vpc.nro_inscripcion = ".$localizador."
		AND vpc.codigo_cliente = cl.id
		AND lvpc.nro_inscripcion = vpc.nro_inscripcion
		ORDER BY lvpc.ci DESC";
		
		$dbLink = getConnection();
		$consulta1 = mysql_query($sql1, $dbLink);
		$esPrimerRegistro = true;
		$deudaTotal = 0;
		
		while(list($fechaCompra, $nroInscripcion, $esJuridica, $razonSocial, $rif, $nombre, $apellido, $clienteCI, $clienteDir,
				$telefono1, $telefono2, $fax, $nombrePasajero, $ciPasajero, $fechaNacimiento, $edad, $nroPasaporte,
				$nroVisa, $tlfPasajero, $correoPasajero, $colegio, $tallaCamisa, $ciudad, $dirPasajero,
				$descPaquete, $cantidad, $montoPagar) = mysql_fetch_array($consulta1)){
			if($esPrimerRegistro){
				$this->SetFont('Arial','B',9);
				
				$this->Cell(112, 5, "Caracas, ".$fechaCompra, 0);
				$this->Cell(50, 5, "Inscripción Nro.: ".$nroInscripcion, 0);
				$this->Ln();
				$this->Ln();
				
				$this->SetFont('Arial','B',10);
				$this->Cell(100, 5, "DATOS DEL CLIENTE:", 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Nombre: ", 0);
				$this->SetFont('Arial','',9);
				if($razonSocial != ""){
					$this->Cell(90, 5, $razonSocial, 0);
				}else{
					$this->Cell(90, 5, $nombre." ".$apellido, 0);
				}
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Cédula/RIF: ", 0);
				$this->SetFont('Arial','',9);
				if($razonSocial != ""){
					$this->Cell(40, 5, $rif, 0);
				}else{
					$this->Cell(40, 5, $clienteCI, 0);
				}
				$this->Ln();
					
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Dirección: ", 0);
				$this->SetFont('Arial','',9);
				$this->MultiCell(100, 5, $clienteDir, 0);
				//$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Teléfonos: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(70, 5, $telefono1." / ".$telefono2." / ".$fax, 0);
				$this->Ln();
				
				$this->Ln();
				$this->SetFont('Arial','B',10);
				$this->Cell(100, 5, "DATOS DEL PASAJERO:", 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(40, 5, "Nombre: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(70, 5, $nombrePasajero, 0);
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Cédula/RIF: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(40, 5, $ciPasajero, 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(40, 5, "Fecha de Nacimiento: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(70, 5, $fechaNacimiento, 0);
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Edad: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(40, 5, $edad, 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(40, 5, "Nro Pasaporte: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(70, 5, $nroPasaporte, 0);
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Nro Visa: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(40, 5, $nroVisa, 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(40, 5, "Celular: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(70, 5, $tlfPasajero, 0);
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Email: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(40, 5, $correoPasajero, 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(40, 5, "Colegio: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(70, 5, $colegio, 0);
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Talla Camisa: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(40, 5, $tallaCamisa, 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Ciudad: ", 0);
				$this->SetFont('Arial','',9);
				$this->Cell(70, 5, $ciudad, 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(22, 5, "Dirección: ", 0);
				$this->SetFont('Arial','',9);
				$this->MultiCell(100, 5, $dirPasajero, 0);
				$this->Ln();
				
				$this->SetFont('Arial','B',9);
				$this->Cell(20, 5, "Cantidad", 1);
				$this->Cell(90, 5, "Descripción", 1);
				$this->Cell(25, 5, "Costo Unitario", 1);
				$this->Cell(25, 5, "Costo Total", 1);
				$this->Ln();
				
				$esPrimerRegistro = false;
			}
			
			$x = $this->lMargin;
			$y = $this->GetY();
			$nl = 1;
			
			$this->SetFont('Arial','',9);
			$this->SetX(20 + $this->lMargin);
			$nl = $this->MultiCell(90, 5, $descPaquete, 1);
			$this->SetX($this->lMargin);
			$this->SetY($y);
			$this->Cell(20, 5 * $nl, $cantidad, 1);
			$this->SetX($this->lMargin + 20 + 90);
			$this->Cell(25, 5 * $nl,  $montoPagar, 1);
			$this->Cell(25,  5 * $nl, $montoPagar * $cantidad, 1);
			$this->Ln();
			
			$deudaTotal += ($montoPagar * $cantidad);
		}
		
		$this->SetFont('Arial','B',9);
		$this->SetX($this->lMargin + 20 + 90);
		$this->Cell(25, 5,  "Total General", 1);
		$this->Cell(25,  5 , $deudaTotal, 1);
		$this->Ln();
		
		//colocamos la info de los recibos
		$sql1 = "SELECT rec.id, DATE_FORMAT(rec.fecha_pago, '%d-%m-%Y'), rec.tipo_pago, rec.moneda, rec.tasa_cambio, rec.monto_pago, rec.equivalente_dolar, 
		rec.forma_pago, rec.referencia, rec.banco
		FROM recibos rec
		WHERE rec.nro_inscripcion = ".$localizador."
		ORDER BY rec.fecha_pago";
		
		$consulta1 = mysql_query($sql1, $dbLink);
		$esPrimerRegistro = true;
		$abonosTotales = 0;
		
		while(list($idRecibo, $fechaRecibo, $tipoPago, $moneda, $tasaCambio, $montoPago, $equivalenteDolar, $formaPago,
				$referencia, $banco) = mysql_fetch_array($consulta1)){
			if($esPrimerRegistro){
				$this->Ln();
				$this->Ln();
				
				$x = $this->lMargin;
				$y = $this->GetY();
				
				$this->SetFont('Arial','B',8);
				$this->SetX($x + 65);
				$this->MultiCell(15,  5, "Tasa Cambio", 1);
				$this->SetY($y);
				
				$this->SetX($x + 100);
				$this->MultiCell(20,  5, "Dolares Equivalentes", 1);
				$this->SetY($y);
				
				$this->SetX($x);
				$this->Cell(15,  10 , "Recibo", 1);
				$this->Cell(20,  10, "Fecha", 1);
				$this->Cell(15,  10, "Tipo Pago", 1);
				$this->Cell(15,  10, "Moneda", 1);
				$this->SetX($x + 80);
				$this->Cell(20,  10, "Monto Pago", 1);
				$this->SetX($x + 120);
				$this->Cell(20,  10, "Forma Pago", 1);
				$this->Cell(25,  10, "Referencia", 1);
				$this->Cell(25,  10, "Banco", 1);
				$this->Ln();
				
				$esPrimerRegistro = false;
			}
			
			$abonosTotales += $montoPago;
			
			$this->SetFont('Arial','',8);
			$this->Cell(15,  5, $idRecibo, 1);
			$this->Cell(20,  5, $fechaRecibo, 1);
			$this->Cell(15,  5, $tipoPago, 1);
			$this->Cell(15,  5, $moneda, 1);
			$this->Cell(15,  5, $tasaCambio, 1);
			$this->Cell(20,  5, $montoPago, 1);
			$this->Cell(20,  5, $equivalenteDolar, 1);
			$this->Cell(20,  5, $formaPago, 1);
			$this->Cell(25,  5, $referencia, 1);
			$this->Cell(25,  5, $banco, 1);
			$this->Ln();
		}
		
		$this->Ln();
		$this->Ln();
		$this->SetFont('Arial','B',10);
		$this->Cell(190,  5, "Total Pagos ".$abonosTotales, 0, 0 , 'R');
		
		$this->Ln();
		$this->Ln();
		$this->Cell(190,  5, "Total Pendiente ".($deudaTotal - $abonosTotales), 0, 0 , 'R');
		
		mysql_close($dbLink);
	}
}

//verificamos si introdujeron un valor para la cedula (a veces ese valor no representa una cedula sino un localizador)
//a efectos del reporte no importa lo que implica el valor de cedula, sigue siendo un query sobre ese campo
if(isset($_POST["cedula"])){
	$pdf = new PDF();
	
	$sql1 = "SELECT lvpc.nro_inscripcion FROM linea_ventas_paquetes_credito lvpc"
	    ." WHERE lvpc.ci = '".$_POST["cedula"]."'"
	    ." AND lvpc.ci != '0'";
	
	$dbLink = getConnection();
	$consulta1 = mysql_query($sql1, $dbLink);
	$haveRecords = false;
	
	while(list($localizador) = mysql_fetch_array($consulta1)){
		$haveRecords = true;
		$pdf->AddPage();
		$pdf->BasicTable($localizador);
	}
	
	if(! $haveRecords){
		$pdf->AddPage();
		$pdf->SetY(80);
		$pdf->SetFont('Arial','B',14);
		$pdf->MultiCell(200,  5, "Disculpe, no se encontró información para la cedula: ".$_POST["cedula"]);
	}
	
	$pdf->Output();
	mysql_close($dbLink);
} else {
	echo "No se tiene un valor de cedula o localizador para hacer la busqueda";
}

?>
