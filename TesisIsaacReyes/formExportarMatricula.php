<?php
/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';./classes/');

include_once 'DBUtil.php';

/** PHPExcel */
include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';
include 'PHPExcel/Reader/Excel2007.php';

//copiamos el excel de plantilla a su salido final
$fileName = "./matriculas/Matricula".time().".xlsx";
copy("./matriculas/template.xlsx", $fileName);

//tomamos el archivo original y lo copiamos como una plantilla
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load($fileName);

//agregamos el logo del colegio
$gdImage = imagecreatefromjpeg('./matriculas/LogoColegio.jpg');
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('LogoColegio');
$objDrawing->setDescription('LogoColegio');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(180);
$objDrawing->setCoordinates("D1");
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Set properties
$objPHPExcel->getProperties()->setCreator("Isaac Reyes");
$objPHPExcel->getProperties()->setLastModifiedBy("Isaac Reyes");
$objPHPExcel->getProperties()->setTitle("Archivo de Matricula");
$objPHPExcel->getProperties()->setSubject("Archivo de Matricula");
$objPHPExcel->getProperties()->setDescription("Archivo de Matricula");

$objPHPExcel->setActiveSheetIndex(0);

// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('Matricula');
// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";


// Add some data
//consultamos la matricula del colegio en el momento actual
$query = "SELECT g.id, g.grado, g.turno, p.nombre, p.apellido, a.nombre, a.apellido, a.cedula_alumno, a.fecha_nacimiento, a.lugar_nacimiento, a.sexo, a.nombre_representante, a.cedula_representante, a.direccion, a.telefono, a.literal";
$query .= " FROM grados g, profesores p, alumnos a";
$query .= " WHERE a.id_grado = g.id";
$query .= " AND g.id_profesor = p.id";
$query .= " ORDER BY g.grado, g.turno, g.id, p.nombre, p.apellido";

$prevGradoId = -1;
$alumnoCount = 1;
$filaInicial = 9;
$result = DBUtil::executeSelect($query);
if(count($result) < 1){
	//no existen registros en la base de datos
	$objPHPExcel->getActiveSheet()->SetCellValue('D13', 'No se encontraron Alumnos en la Matricula.');
} else {
	foreach ($result AS $alumno){
		if($alumno[0] != $prevGradoId){
			//estoy dibujando un salon nuevo, debo hacer el encabezado
			$filaInicial = $filaInicial + 2;
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$filaInicial, "Profesor(a): ".$alumno[3]." ".$alumno[4]);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$filaInicial, "Grado: ".$alumno[1]);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$filaInicial, "Turno: ".$alumno[2]);
			
			$filaInicial++;
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$filaInicial, "Nro.");
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$filaInicial, "Apellidos y Nombres: ");
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$filaInicial, "C.I.");
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$filaInicial, "F/N");
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$filaInicial, "L/N");
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$filaInicial, "Sexo");
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$filaInicial, "Edad");
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$filaInicial, "Representante");
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$filaInicial, "C.I.");
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$filaInicial, "Direccion");
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$filaInicial, "Teléfonos");
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$filaInicial, "Literal");
			
			$prevGradoId = $alumno[0];
			$alumnoCount = 0;
		} 
		
		//dibujamos al alumno
		$filaInicial++;
		$alumnoCount++;
		
		$age = floor((strtotime(date('Y-m-d')) - strtotime($alumno[8])) / 31556926);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$filaInicial, $alumnoCount);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$filaInicial, $alumno[6]." ".$alumno[5]);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$filaInicial, $alumno[7]);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$filaInicial, $alumno[8]);
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$filaInicial, $alumno[9]);
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$filaInicial, strtoupper($alumno[10]));
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$filaInicial, $age);
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$filaInicial, $alumno[11]);
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$filaInicial, $alumno[12]);
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$filaInicial, $alumno[13]);
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$filaInicial, $alumno[14]);
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$filaInicial, $alumno[15]);
			
	}
}

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($fileName);

header("Location: ".$fileName);

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";
?>