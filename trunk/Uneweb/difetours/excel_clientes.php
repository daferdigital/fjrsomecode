<?php

/**
 * @author Iranid Perez & David Antunes
 * @project 3WEditable - 2009
 */

session_start();
include "conexion.php";

if($_SESSION["activo"]!= 1){
	header("location: index.php");
	exit();
}

extract ($_GET);



$template_1 = "excel_clientesHeader.inc";
$template_2 = "generar_pie.inc";

// Se abre y extrae la cabecera del XML
if ($gestor = fopen($template_1, "r")){
	$header = fread($gestor, filesize($template_1));
	fclose($gestor);
}


$sql="SELECT * FROM clientes";
$consulta= mysql_query($sql,$conexion);


$rows = "";

$rows .= "<Row ss:Index='3'>";
$rows .= "<Cell><Data ss:Type='String'>Nombre</Data></Cell>";
$rows .= "<Cell><Data ss:Type='String'>Apellido</Data></Cell>";
$rows .= "<Cell><Data ss:Type='String'>Email</Data></Cell>";
$rows .= "<Cell><Data ss:Type='String'>Cédula</Data></Cell>";
$rows .= "<Cell><Data ss:Type='String'>Dirección Habitación</Data></Cell>";
$rows .= "<Cell><Data ss:Type='String'>Dirección Edo. de Cta</Data></Cell>";
$rows .= "<Cell><Data ss:Type='String'>Telefono</Data></Cell>";
$rows .= "<Cell><Data ss:Type='String'>Fecha Registro</Data></Cell>";
$rows .= "<Cell><Data ss:Type='String'>Status</Data></Cell>";
$rows .= "</Row>";

while($row= mysql_fetch_array($consulta)){

// Se genera el contenido añadiendo las filas
	
	$rows .= "<Row>\n";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[1]</Data></Cell>";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[2]</Data></Cell>";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[3]</Data></Cell>";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[5]</Data></Cell>";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[6]</Data></Cell>";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[7]</Data></Cell>";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[8]</Data></Cell>";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[9]</Data></Cell>";
	$rows .= "<Cell><Data ss:Type=\"String\">$row[10]</Data></Cell>";
	$rows .= "</Row>";

}

// Se abre y extrae el pie del XML
if ($gestor = fopen($template_2, "r")){
	$footer = fread($gestor, filesize($template_2));
	fclose($gestor);
}

// Se juntan las partes resultantes
$content = $header . $rows . $footer;

// Se envia el archivo al navegador
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"Clientes_registrados.xls\"" ); 
print $content;



?>