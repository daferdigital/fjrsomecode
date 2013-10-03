<?php
/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';./classes/');

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


// Add some data
//consultamos la matricula del colegio en el momento actual
$query = "SELECT g.grado, g.turno, p.nombre, p.apellido, a.nombre, a.apellido, a.cedula_alumno, a.fecha_nacimiento, a.lugar_nacimiento, a.sexo, a.nombre_representante, a.cedula_representante, a.direccion, a.telefono, a.literal";
$query .= " FROM grados g, profesores p, alumnos a";
$query .= " WHERE a.id_grado = g.id";
$query .= " AND g.id_profesor = p.id";
$query .= " ORDER BY g.grado, g.turno, p.nombre, p.apellido";
	
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hello');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'world!');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Hello');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'world!');

// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('Matricula');
// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";


$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($fileName);

header("Location: ".$fileName);

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";
?>