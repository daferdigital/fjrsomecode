<?php

    include_once ("classDBAndUser.php");
/*
    if (!User::isAdmin())
    {
        echo "Not is admin...";
        exit;
    }	
*/
	
    if ($_GET['t'] == "parroquias") {
        //if(intval($_GET['id'])<=0) 
       //     echo "Invalid ID";
       // else{
			$parroquias = $db->l("SELECT id, parroquia FROM `parroquias` WHERE `id_municipio`=".intval($_GET['id'])."", false);
		?>
            <select id = "<?=$_GET["name"];?>" name = "<?=$_GET["name"];?>" class = "required">
				<option value="">Seleccione uno...</option>
				<?php
					for($i=0;$i<count($parroquias);++$i){
						echo "<option value = '{$parroquias[$i]['id']}' ".($_GET['id_parroquia']==$parroquias[$i]['id']?"selected":"").">{$parroquias[$i]['parroquia']}</option>";
					}
				?>
			</select><?php
       // }
        exit;
    }

    if ($_POST)
    {
		if(isset($_POST['persona'][$_POST['nacionalidad'].$_POST['cedula_jefe']]))
			$error = "El jefe de familia no puede estar incluido en el grupo familiar";
		if(!isset($error)){
		
			$estado = $db->l("SELECT id_estado FROM `municipios` WHERE `id`=".intval($_POST['id_municipio_jefe'])."", true);
			
			$jefe = $db->l("SELECT id FROM `personas` WHERE `cedula`=".intval($_POST['cedula_jefe'])." AND `nacionalidad`='".secInjection($_POST['nacionalidad_jefe'])."'", true);
			if(!$jefe) {
				$result = $db->q("INSERT INTO personas (nacionalidad, cedula, nombres, apellidos, sexo, fecha_nacimiento, estado_civil, instruccion, profesion) VALUES ".
					"('".secInjection($_POST['nacionalidad_jefe'])."', ".intval($_POST['cedula_jefe']).", '".secInjection($_POST['nombres_jefe'])."',
						'".secInjection($_POST['apellidos_jefe'])."',  '".secInjection($_POST['sexo_jefe'])."', '".secInjection($_POST['fecha_nacimiento_jefe'])."', 
						".intval($_POST['estado_civil_jefe']).", '".secInjection($_POST['instruccion_jefe'])."', '".secInjection($_POST['profesion_jefe'])."' 
					 )");
			}else{
				$result = $db->q("UPDATE personas SET nombres='".secInjection($_POST['nombres_jefe'])."', apellidos='".secInjection($_POST['apellidos_jefe'])."',  
					sexo = '".secInjection($_POST['sexo_jefe'])."', fecha_nacimiento = '".secInjection($_POST['fecha_nacimiento_jefe'])."', estado_civil = ".intval($_POST['estado_civil_jefe']).",
					instruccion = '".secInjection($_POST['instruccion_jefe'])."', profesion = '".secInjection($_POST['profesion_jefe'])."' WHERE nacionalidad = '".secInjection($_POST['nacionalidad_jefe'])."' AND cedula = ".intval($_POST['cedula_jefe']));
			}
			
			$jefe = $db->l("SELECT id FROM `personas` WHERE `cedula`=".intval($_POST['cedula_jefe'])." AND `nacionalidad`='".secInjection($_POST['nacionalidad_jefe'])."'", true);
			
			if($db->l("SELECT id FROM `encuestas` WHERE `id_jefe`=".intval($jefe['id']),true)){
				echo "El jefe de familia ya hizo la encuesta.";
				exit;
			}

			if($db->l("SELECT id FROM `familias` WHERE `id_persona`=".intval($jefe['id']),true)){
				echo "El jefe de familia ya pertenece es miembro de otra familia.";
				exit;
			}
			
			if(isset($_POST["persona"]) && count($_POST["persona"])>0) {
				foreach($_POST["persona"] as $key => $val) {
					$persona = json_decode($val);
					if($db->l("SELECT id FROM `familias` WHERE `id_persona`=".intval($persona->id)." AND `id_jefe`=".intval($jefe['id'])."", true)) {
						echo "Uno de los miembros de familia ya fue registrado en otra encuesta.";
						exit;
					}
					if(!$db->l("SELECT id FROM `personas` WHERE `id`=".intval($persona->id)." AND `cedula`=".intval($persona->cedula)." AND `nacionalidad`='".secInjection($persona->nacionalidad)."'", true)) {
						echo "El miembro {$persona->nombres} {$persona->apellidos} no existe en la base de datos.";
						exit;
					}
				}
			}
			
			$db->qs("DELETE FROM `direcciones` WHERE id_jefe=%d;", array(intval($jefe['id'])));
			if (!$db->qs("INSERT INTO `direcciones` (`id_jefe`,`id_estado`,`id_municipio`,`id_parroquia`,`nombre_inmueble`,`piso`,`apartamento`,`direccion`,`trabaja`,`vivienda`,`tipo_vivienda`,`tiempo_vivienda`) VALUES (%d, %d, %d, %d, '%s', '%s', '%s', '%s', %d, %d, %d, %d)", array
			(
				intval($jefe['id']),
				intval($estado['id_estado']),
				intval($_POST['id_municipio_jefe']),
				intval($_POST['id_parroquia_jefe']),
				secInjection($_POST['nombre_inmueble_jefe']),
				secInjection($_POST['piso_jefe']),
				secInjection($_POST['apartamento_jefe']),
				secInjection($_POST['direccion_jefe']),
				intval($_POST['trabaja_jefe']),
				intval($_POST['vivienda_jefe']),
				intval($_POST['tipo_vivienda_jefe']),
				intval($_POST['tiempo_vivienda_jefe'])
			))){
				echo "Error en la Base de Datos Insertando la direccion";
			} else {
				$fields = array("id_jefe");
				$sec_fields = array("%d");
				$values = array($jefe['id']);
				

				foreach($_POST as $key => $val) {
					if(!strstr($key, "_jefe") && !strstr($key, "_persona") && $key!="persona" && $key!="id") {
						$fields[]="`".secInjection($key)."`";
						$sec_fields[]="'%s'";
						$values[]=secInjection($val);
					}
				}
				
				if (!$db->qs("INSERT INTO encuestas (".implode(", ", $fields).") VALUES (".implode(", ", $sec_fields).")", $values)) {
					echo "Error en la Base de Datos Insertando la encuesta ".$db->errors();
				}else{
					$db->qs("DELETE FROM `familias` WHERE id_jefe=%d;", array(intval($jefe['id'])));
					if($_POST["persona"] ){
						foreach($_POST["persona"] as $key => $val) {
							if(!$val) continue;
							$persona = json_decode($val);
							//print_r($persona);
							$db->qs("INSERT INTO familias (id_jefe, id_persona, parentesco, salud) VALUES (%d,%d,'%s',%d)", array(
								$jefe['id'],
								intval($persona->id),
								secInjection($persona->parentesco),
								intval($persona->salud)
							));
						}
					}
				}
			}
			
		}else echo $error; 
		exit;
    }
	
    if (intval($_GET['id'])>0){
        $encuesta=$db->l("SELECT * FROM `encuestas` WHERE id='".intval($_GET['id'])."'",true);
		$id_jefe = $encuesta["id_jefe"];
        $familia=$db->l("SELECT p.*, f.parentesco, f.salud FROM familias f, personas p WHERE f.id_persona = p.id AND f.id_jefe='".intval($id_jefe)."'",false);
        $direccion=$db->l("SELECT * FROM `direcciones` WHERE id_jefe='".intval($id_jefe)."'",true);
	    $jefe=$db->l("SELECT * FROM `personas` WHERE id='".intval($id_jefe)."'",true);
	}
    
	$estados=$db->l("SELECT e.id id_estado, m.id id_municipio, e.estado, m.municipio FROM `estados` e, municipios m WHERE m.id_estado = e.id ORDER BY e.estado, m.municipio",false);
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<head>
		<meta http-equiv="content-type"	content="text/html; charset=UTF-8" />		
		<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/redmond/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/ajaxfileupload.js"></script>	
		<script type="text/javascript" src="js/functions.js"></script>
		<title>Censo</title>
	</head>
	<body>
		<div id="div_oculto" style="display: none;"></div>
		<div id="overlay" style="display: none;"></div>
		<div id="loadajax" style="display: none;"><img width="20" src="images/ajax.gif" alt="Loading..." /><br />Loading...</div>
		<div id="barraHead">
			<div class="wrap">
				<br /><br /><img src="images/logo.png" alt="Censo" />
			</div>
		</div><br /><br />
		<div id="content2">
			<div class="wrap"> 
						
				<form action = "javascript:fn_agregar();" method = "post" id = "form_index">
					<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" />
					<div id="tabs">
						<ul>
							<li><a href="#tabs-0">Direccion</a></li>
							<li><a href="#tabs-1">Jefe de Familia</a></li>
							<li><a href="#tabs-2">Grupo Familiar</a></li>
							<li><a href="#tabs-3">Encuesta</a></li>
						</ul>
						<div id="tabs-0">
							<table width="100%">
								<tr> 
									<td>Estado/Municipio:</td>
									<td>
									<input type="hidden" value="<?php echo $direccion['id_parroquia']; ?>" id="load_parroquia_h" />
										<select id = "id_municipio_jefe" name = "id_municipio_jefe" class = "required" onchange="reloadParroquia(this.value, 'load_parroquia', 'id_parroquia_jefe')">
											<option value="">Seleccione uno...</option>
											<?php
												for($i=0;$i<count($estados);++$i){
													if($id_estado_ant!=$estados[$i]['id_estado']){
														$id_estado_ant=$estados[$i]['id_estado'];
														if($i!=0)echo "</optgroup>";
														echo "<optgroup label='{$estados[$i]['estado']}'>";
													}
													echo "<option value = '{$estados[$i]['id_municipio']}' ".($direccion['id_municipio']==$estados[$i]['id_municipio']?"selected":"").">{$estados[$i]['municipio']}</option>";
													if($i==count($estados)-1) echo "</optgroup>";
												}
											?>
										</select>
									</td>
								</tr> 
								<tr>
									<td>Parroquia:</td>
									<td id="load_parroquia"></td>
								</tr> 
								<tr>
									<td>Nombre del Inmueble:</td>
									<td>
										<input value="<?php echo $direccion["nombre_inmueble"];?>" name="nombre_inmueble_jefe" class="" id="nombre_inmueble_jefe" maxlength="100" />
									</td>
								</tr> 
								<tr>
									<td>Piso:</td>
									<td>
										<input value="<?php echo $direccion["piso"];?>" name="piso_jefe" class="" id="piso_jefe" maxlength="100" />
									</td>
								</tr> 
								<tr>
									<td>Apartamento:</td>
									<td>
										<input value="<?php echo $direccion["apartamento"];?>" name="apartamento_jefe" class="" id="apartamento_jefe" maxlength="100" />
									</td>
								</tr> 
								<tr>
									<td>Direccion:</td>
									<td>
										<input value="<?php echo $direccion["direccion"];?>" name="direccion_jefe" class="required" id="direccion_jefe" />
									</td>
								</tr> 
							</table>
						</div>
						<div id="tabs-1">
							<table width="100%">
								<tr>
									<td>Cedula:</td>
									<td>
										<select <?php echo $jefe?"readonly":"";?> onchange="reloadJefe()" name="nacionalidad_jefe" id="nacionalidad_jefe">
											<option value="V" <?php echo $jefe['nacionalidad']=="V"?"selected":"";?>>V</option>
											<option value="E" <?php echo $jefe['nacionalidad']=="E"?"selected":"";?>>E</option>
										</select> - <input <?php echo $jefe?"readonly":"";?> value="<?php echo $jefe["cedula"];?>" name="cedula_jefe" class="required digits" id="cedula_jefe" onchange="reloadJefe()" />
									</td>
								</tr>
								<tr>
									<td>Nombres:</td>
									<td>
										<input value="<?php echo $jefe["nombres"];?>" name="nombres_jefe" class="required" id="nombres_jefe" maxlength="100" />
									</td>
								</tr>
								<tr>
									<td>Apellidos:</td>
									<td>
										<input value="<?php echo $jefe["apellidos"];?>" name="apellidos_jefe" class="required" id="apellidos_jefe" maxlength="100" />
									</td>
								</tr>
								<tr>
									<td>Sexo:</td>
									<td>
										<select name="sexo_jefe" id="sexo_jefe">
											<option value="M" <?php echo $jefe['sexo']=="M"?"selected":"";?>>M</option>
											<option value="F" <?php echo $jefe['sexo']=="F"?"selected":"";?>>F</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Fecha de Nacimiento:</td>
									<td>
										<input value="<?php echo $jefe["fecha_nacimiento"];?>" name="fecha_nacimiento_jefe" class="required date" readonly id="fecha_nacimiento_jefe" />
									</td>
								</tr>
								<tr>
									<td>Estado Civil</td>
									<td>
										<select name="estado_civil_jefe" class="required" id="estado_civil_jefe">
											<option value="">Seleccione...</option>
											<option value="<?php echo SOLTERO;?>" <?php echo $jefe['estado_civil']==SOLTERO?"selected":"";?>><?php echo $estado_civil[SOLTERO];?></option>
											<option value="<?php echo DIVORSIADO;?>" <?php echo $jefe['estado_civil']==DIVORSIADO?"selected":"";?>><?php echo $estado_civil[DIVORSIADO];?></option>
											<option value="<?php echo CASADO;?>" <?php echo $jefe['estado_civil']==CASADO?"selected":"";?>><?php echo $estado_civil[CASADO];?></option>
											<option value="<?php echo VIUDO;?>" <?php echo $jefe['estado_civil']==VIUDO?"selected":"";?>><?php echo $estado_civil[VIUDO];?></option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Instruccion:</td>
									<td>
										<input value="<?=$jefe["instruccion"];?>" name="instruccion_jefe" class="required" id="instruccion_jefe" maxlength="100" />
									</td>
								</tr>    
								<tr>
									<td>Profesion:</td>
									<td>
										<input value="<?=$jefe["profesion"];?>" name="profesion_jefe" id="profesion_jefe" class="required" maxlength="100" />
									</td>
								</tr>     
								<tr>
									<td>Trabaja Actualmente:</td>
									<td>
										<select name="trabaja_jefe" class="required" id="trabaja_jefe">
											<option value="">Seleccione...</option>
											<option value="<?=TRABAJA_SI;?>" <?=$direccion['trabaja']==TRABAJA_SI?"selected":"";?>><?=$trabajo[TRABAJA_SI];?></option>
											<option value="<?=TRABAJA_NO;?>" <?=$direccion['trabaja']==TRABAJA_NO?"selected":"";?>><?=$trabajo[TRABAJA_NO];?></option>
											<option value="<?=TRABAJA_PENSIONADO;?>" <?=$direccion['trabaja']==TRABAJA_PENSIONADO?"selected":"";?>><?=$trabajo[TRABAJA_PENSIONADO];?></option>
										</select>
									</td>
								</tr> 
								<tr>
									<td>Tendencia de la Vivienda:</td>
									<td>
										<select name="vivienda_jefe" class="required" id="vivienda_jefe">
											<option value="">Seleccione...</option>
											<option value="<?=VIVIENDA_PROPIA;?>" <?=$direccion['vivienda']==VIVIENDA_PROPIA?"selected":"";?>><?=$vivienda[VIVIENDA_PROPIA];?></option>
											<option value="<?=VIVIENDA_ALQUILADA;?>" <?=$direccion['vivienda']==VIVIENDA_ALQUILADA?"selected":"";?>><?=$vivienda[VIVIENDA_ALQUILADA];?></option>
											<option value="<?=VIVIENDA_FAOV;?>" <?=$direccion['vivienda']==VIVIENDA_FAOV?"selected":"";?>><?=$vivienda[VIVIENDA_FAOV];?></option>
											<option value="<?=VIVIENDA_CRD;?>" <?=$direccion['vivienda']==VIVIENDA_CRD?"selected":"";?>><?=$vivienda[VIVIENDA_CRD];?></option>
										</select>
									</td>
								</tr> 
								<tr>
									<td>Tipo de Vivienda:</td>
									<td>
										<select name="tipo_vivienda_jefe" class="required" id="tipo_vivienda_jefe">
											<option value="">Seleccione...</option>
											<option value="<?=VIVIENDA_CASA;?>" <?=$direccion['tipo_vivienda']==VIVIENDA_CASA?"selected":"";?>><?=$vivienda[VIVIENDA_CASA];?></option>
											<option value="<?=VIVIENDA_QUINTA;?>" <?=$direccion['tipo_vivienda']==VIVIENDA_QUINTA?"selected":"";?>><?=$vivienda[VIVIENDA_QUINTA];?></option>
											<option value="<?=VIVIENDA_APTO;?>" <?=$direccion['tipo_vivienda']==VIVIENDA_APTO?"selected":"";?>><?=$vivienda[VIVIENDA_APTO];?></option>
											<option value="<?=VIVIENDA_RANCHO;?>" <?=$direccion['tipo_vivienda']==VIVIENDA_RANCHO?"selected":"";?>><?=$vivienda[VIVIENDA_RANCHO];?></option>
											<option value="<?=VIVIENDA_ANEXO;?>" <?=$direccion['tipo_vivienda']==VIVIENDA_ANEXO?"selected":"";?>><?=$vivienda[VIVIENDA_ANEXO];?></option>
											<option value="<?=VIVIENDA_HAB;?>" <?=$direccion['tipo_vivienda']==VIVIENDA_HAB?"selected":"";?>><?=$vivienda[VIVIENDA_HAB];?></option>
											<option value="<?=VIVIENDA_OTRO;?>" <?=$direccion['tipo_vivienda']==VIVIENDA_OTRO?"selected":"";?>><?=$vivienda[VIVIENDA_OTRO];?></option>
										</select>
									</td>
								</tr> 
								<tr>
									<td>Tiempo en la Vivienda:</td>
									<td>
										<input value="<?=$direccion["tiempo_vivienda"];?>" name="tiempo_vivienda_jefe" class="digits required" id="tiempo_vivienda_jefe" maxlength="3" /> (años)
									</td>
								</tr> 
							</table>
						</div>
						<div id="tabs-2">
							<div id="list_familia">
								<?php 
									for($i=0;$i<count($familia);++$i) {
										echo '<input type="hidden" name="persona['.$familia[$i]['nacionalidad'].$familia[$i]['cedula'].']" id="persona'.$familia[$i]['nacionalidad'].$familia[$i]['cedula'].'" value=\''.secInjection(json_encode($familia[$i])).'\' />'."\n";
									}
								?>
							</div>
							<table width="100%" id="view_familia">
								<tr><th>Cedula</th><th>Nombres</th><th>Sexo</th><th>Fecha Nacimiento</th><th>Estado Civil</th><th>Instruccion</th><th>Profesion</th><th>Salud</th><th>Parentesco</th><th>Opciones</th></tr>
							
								<?php 
									for($i=0;$i<count($familia);++$i) {
										echo '<tr id="r'.$familia[$i]['nacionalidad'].$familia[$i]['cedula'].'">';
											echo '<td>';
												if($familia[$i]['nacionalidad']=="M")
													echo "Niño/a";
												else
													echo $familia[$i]['nacionalidad'].$familia[$i]['cedula'];
											echo "</td>\n";
											echo "<td>{$familia[$i]['nombres']} {$familia[$i]['apellidos']}</td>\n";
											echo "<td>{$familia[$i]['sexo']}</td>\n";
											echo "<td>{$familia[$i]['fecha_nacimiento']}</td>\n";
											echo "<td>{$estado_civil[$familia[$i]['estado_civil']]}</td>\n";
											echo "<td>{$familia[$i]['instruccion']}</td>\n";
											echo "<td>{$familia[$i]['profesion']}</td>\n";
											echo "<td>{$salud[$familia[$i]['salud']]}</td>\n";
											echo "<td>{$familia[$i]['parentesco']}</td>\n";
											echo "<td><a href='javascript:editarPersona(\"".$familia[$i]['nacionalidad'].$familia[$i]['cedula']."\");'><img src='images/page_edit.png' alt='Editar' title='Editar'></a> | <a href='javascript:eliminarPersona(\"".$familia[$i]['nacionalidad'].$familia[$i]['cedula']."\");'><img src='images/delete.png' alt='Eliminar' title='Eliminar'></a></td>\n";
										echo '</tr>';
									}
								?>
							</table>
							<hr />
							<div id="persona" style ="display:none">
								<br /><center><b>Agregar / Editar Miembros</b></center><br />
								<table width="100%">
									<tr>
										<td>Cedula:</td>
										<td>
											<select onchange="reloadPersona()" id="nacionalidad_persona">
												<option value="V">V</option>
												<option value="E">E</option>
												<option value="M">Niño/a</option>
											</select> - <input class="digits" id="cedula_persona" onchange="reloadPersona()" />
										</td>
									</tr>
									<tr>
										<td>Nombres:</td>
										<td>
											<input id="nombres_persona" maxlength="100" />
										</td>
									</tr>
									<tr>
										<td>Apellidos:</td>
										<td>
											<input id="apellidos_persona" maxlength="100" />
										</td>
									</tr>
									<tr>
										<td>Sexo:</td>
										<td>
											<select id="sexo_persona">
												<option value="M">M</option>
												<option value="F">F</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Fecha de Nacimiento:</td>
										<td>
											<input class="date" readonly id="fecha_nacimiento_persona" />
										</td>
									</tr>
									<tr>
										<td>Estado Civil</td>
										<td>
											<select id="estado_civil_persona">
												<option value="">Seleccione...</option>
												<option value="<?=SOLTERO;?>"><?=$estado_civil[SOLTERO];?></option>
												<option value="<?=DIVORSIADO;?>"><?=$estado_civil[DIVORSIADO];?></option>
												<option value="<?=CASADO;?>"><?=$estado_civil[CASADO];?></option>
												<option value="<?=VIUDO;?>"><?=$estado_civil[VIUDO];?></option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Instruccion:</td>
										<td>
											<input id="instruccion_persona" maxlength="100" />
										</td>
									</tr>    
									<tr>
										<td>Profesion:</td>
										<td>
											<input id="profesion_persona" maxlength="100" />
										</td>
									</tr>  
									<tr>
										<td>Parentesco:</td>
										<td>
											<input id="parentesco_persona" maxlength="100" />
										</td>
									</tr>  
									<tr>
										<td>Estado de Salud:</td>
										<td>
											<select id="salud_persona">
												<option value="<?=SALUD_NORMAL;?>"><?=$salud[SALUD_NORMAL];?></option>
												<option value="<?=SALUD_ENFERMO;?>"><?=$salud[SALUD_ENFERMO];?></option>
												<option value="<?=SALUD_DISC;?>"><?=$salud[SALUD_DISC];?></option>
											</select>
										</td>
									</tr>  
								</table><br />
								<center><button type="button" onclick = "guardarPersona();">Guardar</button> <button type="button" onclick = "cerrarPersona();">Cancelar</button></center>
							</div><br />
							<div id="botonesPersona"><button type="button" onclick ="abrirPersona();">Agregar un miembro de la Familia</button></div>
						</div>
						<div id="tabs-3">
						<?php 
						$seccionesEncuesta = $db->l("SELECT DISTINCT cie.id, cie.texto, cie.orden FROM categoria_item_encuesta cie, items_encuesta ie WHERE cie.active='1' AND cie.id=ie.id_item_categoria ORDER BY cie.orden, cie.texto", false);
						for($i = 0; $i < count($seccionesEncuesta); $i++){
							//creamos la tabla de la seccion
						?>
							<table width="100%">
							<tr>
								<th align="left" colspan="4"><?php echo $seccionesEncuesta[$i]["texto"];?></th>
							</tr>
							<tr>
								<td colspan="4"><hr></hr></td>
							</tr>
							<?php
							$itemsEncuesta = $db->l("SELECT id, texto, is_check, require_number, is_text, orden FROM items_encuesta WHERE active='1' AND id_item_categoria=".$seccionesEncuesta[$i]["id"]." ORDER BY orden, texto", false);
							for($j = 0; $j < (int) ((count($itemsEncuesta) / 2) + (count($itemsEncuesta) % 2)); $j++){
							?>
							<tr>
								<td width="30%">
									<?php echo $itemsEncuesta[$j*2]["texto"];?>
								</td>
								<td width="20%">
									<?php
									if($itemsEncuesta[$j*2]["is_check"] == "1"){
									?>
										<input type="checkbox" name="values['<?php echo $itemsEncuesta[$j*2]["id"]?>']['is_check']" value="1"/>
										<?php 
										if($itemsEncuesta[$j*2]["require_number"] == "1"){
										?>
											Cuantos Aprox.?: <input type="text" name="values['<?php echo $itemsEncuesta[$j*2]["id"]?>']['require_number']" value="0" size="3"/>
										<?php
										}
										?>
									<?php
									}else{
									?>
										<input type="text" name="values['<?php echo $itemsEncuesta[$j*2]["id"]?>']['text']" value=""/>
									<?php
									} 
									?>
								</td>
								<td width="30%">
									<?php echo $itemsEncuesta[($j*2) + 1]["texto"];?>
								</td>
								<td width="20%">
									<?php
									if($itemsEncuesta[($j*2) + 1]["is_check"] == "1"){
									?>
										<input type="checkbox" name="<?php echo $itemsEncuesta[($j*2) + 1]["id"]?>']['is_check']" value="1"/>
										<?php 
										if($itemsEncuesta[($j*2) + 1]["require_number"] == "1"){
										?>
											Cuantos Aprox.?: <input type="text" name="values['<?php echo $itemsEncuesta[($j*2) + 1]["id"]?>']['require_number']" value="0" size="3"/>
										<?php
										}
										?>
									<?php
									}else if($itemsEncuesta[($j*2) + 1]["is_check"] == "0"){
									?>
										<input type="text" name="values['<?php echo $itemsEncuesta[($j*2) + 1]["id"]?>']['text']" value=""/>
									<?php
									} 
									?>
								</td>
							</tr>
							<?php
							} 
							?>
							</table>
						<?php
						}
						?>
						</div>
					</div>
					<br />
					<br />
					<center>
						<button type="submit">Enviar</button>
					</center>
					<br />
				</form>

				<script language = "javascript" type = "text/javascript">

					var estado_civil = <?=json_encode($estado_civil);?>;
					var trabajo = <?=json_encode($trabajo);?>;
					var vivienda = <?=json_encode($vivienda);?>;
					var salud = <?=json_encode($salud);?>;
					
					function validateCheckBox(){
						if($("#enfermos_terminales_cb").is(':checked')){
							$("#view_enfermos_terminales").show(100); 
						}else{
							$("#view_enfermos_terminales").hide(100);
							$("#enfermos_terminales").val("0"); 
						}
						
						if($("#discapacitados_cb").is(':checked')){
							$("#view_discapacitados").show(100);
						}else{
							$("#view_discapacitados").hide(100);
							$("#discapacitados").val("0"); 
						}
						
						if($("#ninos_abandono_cb").is(':checked')){
							$("#view_ninos_abandono").show(100);
						}else{
							$("#view_ninos_abandono").hide(100);
							$("#ninos_abandono").val("0"); 
						}
						
						if($("#indigentes_cb").is(':checked')){
							$("#view_indigentes").show(100);
						}else{
							$("#view_indigentes").hide(100);
							$("#indigentes").val("0"); 
						}
					}
					
					function validateValueCheckbox(){

						if($("#enfermos_terminales").val()>0){
							$("#view_enfermos_terminales").show(100); 
							 $("#enfermos_terminales_cb").attr('checked', true); 
						}else{
							$("#view_enfermos_terminales").hide(100);
							 $("#enfermos_terminales_cb").attr('checked', false);
						}
						
						if($("#discapacitados").val()>0){
							$("#view_discapacitados").show(100);
							 $("#discapacitados_cb").attr('checked', true); 
						}else{
							$("#view_discapacitados").hide(100);
							 $("#discapacitados_cb").attr('checked', false); 
						}
						
						if($("#ninos_abandono").val()>0){
							$("#view_ninos_abandono").show(100);
							 $("#ninos_abandono_cb").attr('checked', true); 
						}else{
							$("#view_ninos_abandono").hide(100);
							 $("#ninos_abandono_cb").attr('checked', false); 
						}
						
						if($("#indigentes").val()>0){
							$("#view_indigentes").show(100);
							 $("#indigentes_cb").attr('checked', true); 
						}else{
							$("#view_indigentes").hide(100);
							$("#indigentes_cb").attr('checked', false); 
						}
					}
					function styleViewFamilia() {
						$("#view_familia tr:odd").css("background-color", "#ccc");
					}
					function eliminarPersona(id) {
						if(confirm("Esta seguro que desea eliminar el miembro "+id)){
							$("#persona"+id).remove();
							$("#r"+id).remove();
						}
					}
					function editarPersona(id) {
						var persona = null;
						if($("#persona"+id).val())
							eval("persona = " + $("#persona"+id).val());
						if(persona){
							abrirPersona();
							for(var key in persona) {
								var v = persona[key];
								$("#"+key+"_persona").val(v);
							}			
							$("#cedula_persona").attr("disabled","disabled");
							$("#nacionalidad_persona").attr("disabled","disabled");
						}else alert("No encontrado, error inesperado");
					}
					function cargarPersona(n,c) {
						ajaxLoading();
						$.get("personas.php?nacionalidad="+n+"&cedula="+c, function(data) {
							ajaxLoadingOut();
							var result = null;
							eval("result = "+data);
							if(result) {
								result.parentesco = $("#parentesco_persona").val();
								result.salud = $("#salud_persona").val();

								$("#persona"+n+c).remove();
								$("#r"+n+c).remove();

								var e = $("<input type='hidden' id='persona"+n+c+"' name='persona["+n+c+"]' />");
								$(e).attr("value", json_encode(result));
								$("#list_familia").append(e);
								var v = $("<tr id='r"+n+c+"'><td>"+(n=="M"?"Niño/a":n+""+c)+"</td><td>"+result.nombres+" "+result.apellidos+"</td><td>"+result.sexo+"</td>  <td>"+result.fecha_nacimiento+"</td> <td>"+estado_civil[result.estado_civil]+"</td> <td>"+result.instruccion+"</td> <td>"+result.profesion+"</td> <td>"+salud[result.salud]+"</td> <td>"+result.parentesco+"</td> <td><a href='javascript:editarPersona(\""+n+c+"\");'><img src='images/page_edit.png' alt='Editar' title='Editar'></a> | <a href='javascript:eliminarPersona(\""+n+c+"\");'><img src='images/delete.png' alt='Eliminar' title='Eliminar'></a></td></tr>");
								$("#view_familia  > tbody:last").append(v);
								cerrarPersona();
								styleViewFamilia();
							}
						});
					}
					function guardarPersona(){

						if(!$("#cedula_persona").val()){ alert("La cedula es necesaria");return;}
						if(!$("#nombres_persona").val()){ alert("El nombre es necesario");return;}
						if(!$("#apellidos_persona").val()){ alert("El apellido es necesario");return;}
						if(!$("#sexo_persona").val()){ alert("El sexo es necesario");return;}
						if(!$("#fecha_nacimiento_persona").val()){ alert("La fecha de nacimiento es necesaria");return;}
						if(!$("#estado_civil_persona").val()){ alert("El estado civil es necesario");return;}
						if(!$("#instruccion_persona").val()){ alert("La instruccion es necesaria");return;}
						if(!$("#profesion_persona").val()){ alert("La profesion es necesaria");return;}
						if(!$("#parentesco_persona").val()){ alert("El parentesco es necesario");return;}
						if($("#cedula_persona").val() == $("#cedula_jefe").val()){ alert("El jefe de familia no puede estar en grupo"); return;}
						
						var data = {};
						data.nacionalidad = $("#nacionalidad_persona").val();
						data.cedula = $("#cedula_persona").val();
						data.nombres = $("#nombres_persona").val();
						data.apellidos = $("#apellidos_persona").val();
						data.sexo = $("#sexo_persona").val();
						data.fecha_nacimiento = $("#fecha_nacimiento_persona").val();
						data.estado_civil = $("#estado_civil_persona").val();
						data.instruccion = $("#instruccion_persona").val();
						data.profesion = $("#profesion_persona").val();
					   
						ajaxLoading();
						$.post("personas.php", data, function(result) {
							var rsp = null;
							eval("rsp = "+result);
							if(rsp==-1) {
								if(confirm("Esta persona ya existe en la BD, desea actualizar y utilizar de todos modos estos datos?")) {
									data.edit = 1;
									$.post("personas.php", data, function(result2) {
										ajaxLoadingOut();
										var rsp2 = null;
										eval("rsp2 = "+result2);
										if(rsp2) {
											$("#cedula_persona").val(rsp2);
											cargarPersona($("#nacionalidad_persona").val(), $("#cedula_persona").val());
											alert("Modificado y agregado con exito");
										}else{
											alert("Error interno modificando");
										}
									});
								}else ajaxLoadingOut();
							}else if(rsp){ 
								$("#cedula_persona").val(rsp);
								ajaxLoadingOut();
								cargarPersona($("#nacionalidad_persona").val(), $("#cedula_persona").val());
								alert("Agregado con exito");
							} else {
								ajaxLoadingOut();
								alert("Error interno agregando");
							}
						});

					}
					function abrirPersona(){
						$("#botonesPersona").hide(100);
						$("#persona").show(100);
						$("#persona input").val("");
						$("#persona select").val("");
						//load_persona("nacionalidad_persona", "cedula_persona", "cedula_persona", reloadPersona);
					}
					function cerrarPersona(){
						$("#botonesPersona").show(100);
						$("#persona").hide(100);
						$("#cedula_persona").removeAttr("disabled");
						$("#nacionalidad_persona").removeAttr("disabled");
					}
					function validateForm(){
						var validator = $("#form_index").validate();
						$( "#tabs" ).tabs({
							select: function(event, ui) {
								var valid = true;
								var current = $(this).tabs("option", "selected");
								var panelId = $("#tabs ul a").eq(current).attr("href");

								//if (ui.index > current) {

									$(panelId).find("input,select").each(function() {
										console.log(valid);
										if (!validator.element(this) && valid) {
											valid = false;
										}
									});
								//}

								return valid;
							}
						});
						$('input, select').addClass( "ui-corner-all" );
					}
					function onLoadForm(){
						styleViewFamilia();
						reloadParroquia($("#id_municipio_jefe").val(), 'load_parroquia', 'id_parroquia_jefe');
						$( ".date" ).datepicker({
							changeMonth: true,
							changeYear: true,
							dateFormat: "yy-mm-dd",
							yearRange: "-120:+0"
						});
						
						validateValueCheckbox();
						validateForm();
						 
						$("#enfermos_terminales_cb").click(validateCheckBox);
						$("#discapacitados_cb").click(validateCheckBox);
						$("#ninos_abandono_cb").click(validateCheckBox);
						$("#indigentes_cb").click(validateCheckBox);
					}
					function reloadParroquia(id_municipio, contenedor, name) {
						if(!id_municipio || id_municipio=="") id_municipio = "0";
						$('#'+contenedor).html("Cargando...");
						$.get('index.php?t=parroquias&id='+id_municipio+'&id_parroquia='+$('#'+contenedor+"_h").val()+'&name='+name, function(data) {
							$('#'+contenedor).html(data);
							$('#'+contenedor+" select").addClass( "ui-corner-all" );
							validateForm();
						});
					}

					function reloadPersona(){
						if($( "#nacionalidad_persona").val()=="M"){
							$("#cedula_persona").attr("readonly", true);
							$("#cedula_persona").css("background-color", "#ccc");
							if($("#cedula_persona").val()=="")
								$("#cedula_persona").val("00000000");
							return;
						}else{
							$("#cedula_persona").removeAttr("readonly");
							$("#cedula_persona").css("background-color", "#fff");
						}
							
						ajaxLoading(); 
						$.get("personas.php?nacionalidad="+$( "#nacionalidad_persona").val()+"&cedula="+$( "#cedula_persona").val(), function(data) {
							ajaxLoadingOut();
							var result = null;
							eval("result = "+data);
							if(result) {
								$("#nombres_persona").val(result.nombres);
								$("#apellidos_persona").val(result.apellidos);
								$("#sexo_persona").val(result.sexo);
								$("#fecha_nacimiento_persona").val(result.fecha_nacimiento);
								$("#estado_civil_persona").val(result.estado_civil);
								$("#instruccion_persona").val(result.instruccion);
								$("#profesion_persona").val(result.profesion);
								validateForm();
							}
						});
					}
				 
					function reloadJefe(){
						$.get("personas.php?nacionalidad="+$( "#nacionalidad_jefe").val()+"&cedula="+$( "#cedula_jefe").val(), function(data) {
							var result = null;
							eval("result = "+data);
							if(result) {
								$("#nombres_jefe").val(result.nombres);
								$("#apellidos_jefe").val(result.apellidos);
								$("#sexo_jefe").val(result.sexo);
								$("#fecha_nacimiento_jefe").val(result.fecha_nacimiento);
								$("#estado_civil_jefe").val(result.estado_civil);
								$("#instruccion_jefe").val(result.instruccion);
								$("#profesion_jefe").val(result.profesion);
								validateForm();
							}
						});
					}
					/*
					function load_persona(n, c, s, callback) {
						$( "#"+s ).autocomplete({
							source: function( request, response ) {
								$.ajax({
									url: "personas.php?nacionalidad="+$( "#"+n ).val()+"&search="+$( "#"+c ).val(),
									dataType: "json",
									success: function( data ) {
										response( $.map( data, function( item ) {
											return {
												label: item.nacionalidad + "-"+item.cedula+ ": "+item.nombres + " "+item.apellidos,
												value: item.cedula
											}
										}));
									}
								});
							},
							minLength: 3,
							select: function( event, ui ) {
								callback();
							},
							open: function() {
								$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
							},
							close: function() {
								$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
								callback();
							}
						});
					}*/
					function fn_agregar()
					{      
						if(!$("#cedula_jefe").val().trim()){
							alert("La cedula del jefe de familia es obligatorio");
							return;
						}
						if(!$("input[name^=persona]").val()) {
							if(!confirm("¿Seguro desea enviar la encuesta sin ningun miembro de familia?")) return;
						}
						
						var str = $("#form_index").serializeArray();           
						ajaxLoading();
						$.ajaxFileUpload
						(
							{
								url:'index.php?t=add',
								secureuri:false,
								fileElementId:'imagen',
								dataType: 'text',
								data:str,
								success: function (data, status)
								{
									if(data != '')
									{
										alert(data.replace(/<\/?[^>]+(>|$)/g, ""));
										ajaxLoadingOut();
									}else{
										alert("Encuesta registrada correctamente");
										$("#content2 .wrap").html("<br><br><center><b>Gracias...</b></center>");
										//fn_cerrar();
										//fn_listar('index');
										ajaxLoadingOut();
									}
								},
								error: function (data, status, e)
								{
									alert(e);
									ajaxLoadingOut();
								}
							}
						);
					}
/*
					function fn_update()
					{
						var str = $("#form_index").serializeArray();           
						ajaxLoading();
						$.ajaxFileUpload
						(
							{
								url:'index.php?t=update',
								secureuri:false,
								fileElementId:'imagen',
								dataType: 'text',
								data:str,
								success: function (data, status)
								{
									if(data != '')
									{
										alert(data.replace(/<\/?[^>]+(>|$)/g, ""));
										ajaxLoadingOut();
									}else{
										alert("Actualizado correctamente");
										//fn_cerrar();
										//fn_listar('index');
									}
								},
								error: function (data, status, e)
								{
									alert(e);
								}
							}
						);
					}*/
					onLoadForm();
					$("button").button();
				</script>
			</div>
		</div>
		<div id="barraFoot">
			<div class="wrap">
				<table width="100%"><tr><td width="100%" style="color: #fff;text-align:left;font-size:10px"></td><td></td></tr></table>
			</div>
		</div>
	</body>	
</html>