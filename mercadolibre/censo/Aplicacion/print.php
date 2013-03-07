<?php
include_once("classDBAndUser.php");

if(!isset($_GET['id'])) die("Encuesta no encontrada"); 
if(!($encuesta=$db->l("SELECT * FROM `encuestas` WHERE id='".intval($_GET['id'])."'",true))) die("Encuesta no encontrada"); 

$id_jefe = $encuesta["id_jefe"];
$familia=$db->l("SELECT p.*, f.parentesco, f.salud FROM familias f, personas p WHERE f.id_persona = p.id AND f.id_jefe='".intval($id_jefe)."'",false);
$direccion=$db->l("SELECT * FROM `direcciones` WHERE id_jefe='".intval($id_jefe)."'",true);
$jefe=$db->l("SELECT * FROM `personas` WHERE id='".intval($id_jefe)."'",true);

$dir=$db->l("SELECT e.estado estado, m.municipio municipio, p.parroquia FROM `estados` e, municipios m, parroquias p WHERE p.id_estado = e.id AND p.id_municipio = m.id AND p.id = {$direccion['id_parroquia']} ORDER BY e.estado, m.municipio",true);

function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($mes_diferencia < 0 || ($mes_diferencia==0 && $dia_diferencia < 0)) 
        $ano_diferencia--;
    return $ano_diferencia;
}

ob_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<head>
		<meta http-equiv="content-type"	content="text/html; charset=UTF-8" />		
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<title>Censo</title>
		<style>
			table td,table{border: 0px;border-collapse: collapse;text-align:left;padding:0;margin:0;border-collapse: collapse;}
			*{font-size:10px;}
			.titulo1, .titulo1 strong {font-size:14px; text-align:center;color:#EC6A5E}
			.titulo2, .titulo2 strong {font-size:13px; text-align:center}
			.titulo3, .titulo3 strong {font-size:12px; text-align:center}
			.todd { background-color:#efefef}
			.border_all {border: 1px solid black; padding:0;margin:0;border-collapse: collapse;}
			.border_left {border-left: 1px solid black; padding:0;margin:0;border-collapse: collapse;}
		</style>
	</head>
	<body>
		<table width="100%" class="border_all" style="padding:15px">
		  <tr>
			<td class="border_all"><table width="100%" border="0">
			  <tr>
				<td width="100" align="center" style="text-align:center"><img width="100" height="80" align="center" src="images/logo.png" alt="Censo" /></td>
				<td><table height="80" width="100%" border="0">
				  <tr>
					<td class="border_left titulo1" height="40" style="height:40px"><strong>Consejo Comunal Las Delicias de Sabana Grande</strong> REG. nº 01-01-09-001-0046 RIF J-30911214-7</td>
				  </tr>
				  <tr>
					<td class="border_all"><table width="100%" border="0" height="20" style="height:20px">
					  <tr>
						<td style="height:20px"><strong>Estado:</strong> <?=$dir["estado"];?></td>
						<td style="height:20px" class="border_left"><strong>Municipio:</strong> <?=$dir["municipio"];?></td>
						<td style="height:20px" class="border_left"><strong>Parroquia:</strong> <?=$dir["parroquia"];?></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td class="border_left"><table width="100%" border="0" height="20" style="height:20px">
					  <tr>
						<td style="height:20px"><strong>Nombre del Inmueble:</strong> <?=$direccion["nombre_inmueble"];?></td>
						<td style="height:20px" class="border_left"><strong>Piso:</strong> <?=$direccion["piso"];?></td>
						<td style="height:20px" class="border_left"><strong>Apto.:</strong> <?=$direccion["apartamento"];?></td>
						<td style="height:20px" class="border_left"><strong>Dirección del Inmueble:</strong> <?=$direccion["direccion"];?></td>
					  </tr>
					</table></td>
				  </tr>
				</table></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td align="center" class="border_all titulo2"><strong>Censo de Habitantes - Proyecto Plan Comunal</strong></td>
		  </tr>
		  <tr>
			<td align="center" class="border_all titulo3"><strong>Información Social</strong></td>
		  </tr>
		  <tr>
			<td class="border_all"><table width="100%" border="1">
			  <tr>
				<td class='border_left'><strong>Nombres y Apellidos del Jefe del Grupo Familiar:</strong> <?=$jefe["nombres"]." ".$jefe["apellidos"];?></td>
				<td class='border_left'><strong>Fecha Nac.:</strong> <?=$jefe["fecha_nacimiento"];?></td>
				<td class='border_left'><strong>C.I.:</strong> <?=$jefe["nacionalidad"]."-".$jefe["cedula"];?></td>
				<td class='border_left'><strong>Sexo:</strong> <?=$jefe["sexo"];?></td>
				<td class='border_left'><strong>Estado Civil:</strong> <?=$estado_civil[$jefe["estado_civil"]];?></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td class="border_all"><table width="100%" border="1">
			  <tr>
				<td class='border_left'><strong>Nivel de Instruccion:</strong> <?=$jefe["instruccion"];?></td>
				<td class='border_left'><strong>Profesion u Oficio:</strong> <?=$jefe["profesion"];?></td>
				<td class='border_left'><strong>Trabaja Actualmente:</strong> <?=$trabajo[$direccion["trabaja"]];?></td>
				<td class='border_left'><strong>Tenencia de la Vivienda:</strong> <?=$vivienda[$direccion["vivienda"]];?></td>
				<td class='border_left'><strong>Tipo de Vivienda:</strong> <?=$vivienda[$direccion["tipo_vivienda"]];?></td>
				<td class='border_left'><strong>Tiempo en la Vivienda:</strong> <?=$direccion["tiempo_vivienda"];?> Años</td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td align="center" class="border_all titulo3"><strong>Información del Grupo Familiar</strong></td>
		  </tr>
		  <tr>
			<td class="border_all"><table width="100%" border="1">
			  <tr>
				<td class='border_left'><strong>Nº</strong></td>
				<td class='border_left'><strong>Nombres y Apellidos</strong></td>
				<td class='border_left'><strong>C.I.</strong></td>
				<td class='border_left'><strong>Sexo</strong></td>
				<td class='border_left'><strong>Fecha Nac.</strong></td>
				<td class='border_left'><strong>Edad</strong></td>
				<td class='border_left'><strong>Estado Civil</strong></td>
				<td class='border_left'><strong>Parentesco</strong></td>
				<td class='border_left'><strong>Estado de Salud</strong></td>
				<td class='border_left'><strong>Nivel de Instruccion</strong></td>
				<td class='border_left'><strong>Profesion u Oficio</strong></td>
			  </tr>
			  <?php 
					for($i=0;$i<count($familia);++$i) {
						$edad = calculaedad($familia[$i]['fecha_nacimiento']);
						echo '<tr '.($i%2==0?' class="todd"':"").' id="r'.$familia[$i]['nacionalidad'].$familia[$i]['cedula'].'">';
							echo "<td class='border_all'>".($i+1)."</td>\n";
							echo "<td class='border_all'>{$familia[$i]['nombres']} {$familia[$i]['apellidos']}</td>\n";
							echo "<td class='border_all'>";
								if($familia[$i]['nacionalidad']=="M")
									echo "Niño/a";
								else
									echo $familia[$i]['nacionalidad'].$familia[$i]['cedula'];
							echo "</td>\n";
							echo "<td class='border_all'>{$familia[$i]['sexo']}</td>\n";
							echo "<td class='border_all'>{$familia[$i]['fecha_nacimiento']}</td>\n";
							echo "<td class='border_all'>".$edad."</td>\n";
							echo "<td class='border_all'>{$estado_civil[$familia[$i]['estado_civil']]}</td>\n";
							echo "<td class='border_all'>{$familia[$i]['parentesco']}</td>\n";
							echo "<td class='border_all'>{$salud[$familia[$i]['salud']]}</td>\n";
							echo "<td class='border_all'>{$familia[$i]['instruccion']}</td>\n";
							echo "<td class='border_all'>{$familia[$i]['profesion']}</td>\n";
						echo '</tr>';
					}
				?>
			</table></td>
		  </tr>
		  <tr>
			<td class="border_all" style="margin:2px;padding:2px">	
				<table width="100%">
					<tr><td width="50%" valign="top">
						<table width="100%">
							<tr><th>Problemas de la Comunidad</th><th></th></tr>
							<tr class="todd"><td>Falta de cooperación de los vecinos</td><td> <?=($encuesta["cooperacion_vecinos"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Violencia vecinal</td><td> <?=($encuesta["violencia_vecinal"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Abuso de las autoridades</td><td> <?=($encuesta["abuso_autoridades"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Prostitución</td><td> <?=($encuesta["prostitucion"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Alcoholismo</td><td> <?=($encuesta["alcoholismo"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Enfermos terminales en la comunidad</td><td> <?=$encuesta["enfermos_terminales"];?> aprox.</td></tr>
							<tr class="todd"><td>Discapacitados en la comunidad</td><td> <?=$encuesta["discapacitados"];?> aprox.</td></tr>
							<tr><td>Delincuencia</td><td> <?=($encuesta["delincuencia"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Indigentes</td><td> <?=$encuesta["indigentes"];?> aprox.</td></tr>
							<tr><td>Niños en situación de abandono</td><td> <?=$encuesta["ninos_abandono"];?> aprox.</td></tr>
							<tr class="todd"><td>Extrema densidad poblacional</td><td> <?=($encuesta["extrema_densidad_poblacional"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Comercio de drogas</td><td> <?=($encuesta["comercio_drogas"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Consumo de drogas</td><td> <?=($encuesta["consumo_drogas"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Servicios públicos</td><td> <?=($encuesta["servicios_publicos"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Basura en las calles</td><td> <?=($encuesta["basura"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Seguridad urbana</td><td> <?=($encuesta["seguridad_urbana"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Aguas servidas emposadas</td><td> <?=($encuesta["aguas_servidas_emposadas"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Residuos tóxicos</td><td> <?=($encuesta["residuos_toxicos"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Barros y pantanos</td><td> <?=($encuesta["barros_pantanos"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Ruidos</td><td> <?=($encuesta["ruidos"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Fabricas contaminantes</td><td> <?=($encuesta["fabricas_contaminantes"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Licorerías</td><td> <?=($encuesta["licorerias"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Transito vehicular</td><td> <?=($encuesta["transito_vehicular"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Terrenos baldíos</td><td> <?=($encuesta["terrenos_baldios"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Falta de espacios de recreación</td><td> <?=($encuesta["falta_espacios_recreacion"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Falta de espacios deportivos</td><td> <?=($encuesta["falta_espacios_deportivos"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Victima de algún delito</td><td> <?=($encuesta["victima_delito"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Otros</td><td> <?=$encuesta["otros_problemas_comunidad"];?></td></tr>
						</table>
					</td><td width="50%" valign="top">
						<table width="100%">
							<tr><th>Beneficiario de alguna Misión</th><th></th></tr>
							<tr class="todd"><td>Misión Robinsion</td><td> <?=($encuesta["mision_robinson"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Misión Ribas</td><td> <?=($encuesta["mision_ribas"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Mision Mercal</td><td> <?=($encuesta["mision_mercal"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Mision Negra Hipolita</td><td> <?=($encuesta["mision_negra_hipolita"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Mision Habitat</td><td> <?=($encuesta["mision_habitat"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Mision Vivienda</td><td> <?=($encuesta["mision_vivienda"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Mision Barrio Adentro</td><td> <?=($encuesta["mision_barrio_adentro"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Mision Ciencia</td><td> <?=($encuesta["mision_ciencia"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Mision Cultura</td><td> <?=($encuesta["mision_cultura"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Simoncito</td><td> <?=($encuesta["simoncito"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Unidad Educativa</td><td> <?=($encuesta["unidad_educativa"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Liceo</td><td> <?=($encuesta["liceo"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Universidad</td><td> <?=($encuesta["universidad"]>0)?"<img src='check.png' />":"";?></td></tr>
						</table>
						<br /><br />
						<table width="100%">
							<tr><th>Servicios Activos</th><th></th></tr>
							<tr class="todd"><td>Aguas blancas</td><td> <?=($encuesta["aguas_blancas"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Aguas servidas</td><td> <?=($encuesta["aguas_servidas"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Sistema eléctrico</td><td> <?=($encuesta["sistema_electrico"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Recoleccion de basura</td><td> <?=($encuesta["recoleccion_basura"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Telefonia</td><td> <?=($encuesta["telefonia"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Transporte</td><td> <?=($encuesta["transporte"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Mecanismo de información</td><td> <?=($encuesta["mecanismo_informacion"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Servicios comunitarios</td><td> <?=($encuesta["servicios_comunitarios"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Gas domestico</td><td> <?=($encuesta["gas_domestico"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr><td>Alumbrado Publico</td><td> <?=($encuesta["alumbrado_publico"]>0)?"<img src='check.png' />":"";?></td></tr>
							<tr class="todd"><td>Modulos de seguridad</td><td> <?=($encuesta["modulos_seguridad"]>0)?"<img src='check.png' />":"";?></td></tr>
						</table>
					</td></tr>
				</table>
				<br />
				<table width="100%">
					<tr><td>Existe en su núcleo familiar alguna persona que padezca de alguna enfermedad?</td><td> <?=($encuesta["familiar_enfermo"]>0)?"<img src='check.png' />":"";?></td></tr>
					<tr class="todd"><td>Necesita Usted de ayuda especial para sus familiares enfermos?</td><td> <?=($encuesta["ayuda_familiar_enfermo"]>0)?"<img src='check.png' />":"";?></td></tr>
					<tr><td>Le gustaría contar con una Universidad Simón Rodríguez en Sabana Grande?</td><td> <?=($encuesta["simon_rodriguez"]>0)?"<img src='check.png' />":"";?></td></tr>
				</table>
			</td>
		  </tr>
		</table>
	</body>	
</html><?php
$html = ob_get_contents();
ob_end_clean();
require_once('dompdf/dompdf_config.inc.php');
$pdf = new DOMPDF();
$pdf->set_paper("latter", "landscape");
$pdf->load_html($html);
$pdf->render();
$pdf->stream('Censo-'.$jefe["nacionalidad"]."-".$jefe["cedula"].'.pdf');


?>