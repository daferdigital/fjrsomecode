<?php

    include_once ("classDBAndUser.php");

    if (!User::isAdmin())
    {
        echo "Not is admin...";
        exit;
    }	
    if ($_GET['t'] == "parroquias")
    {
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
    if ($_GET['t'] == "delete")
    {
        if(intval($_GET['id'])<=0) 
            echo "Invalid ID";
        else{
            if(!$db->qs("DELETE FROM `encuestas` WHERE id=%d;", array(intval($_GET['id'])))){
				echo "Database Error";
			}
        }
        exit;
    }
	
    if ($_GET['t'] == "list")
    {
	$w = "";
	if($_GET['filtro'] == "cedula" && intval($_GET['search'])>0) $w = " AND per.cedula = ".intval($_GET['search']);
	else if($_GET['filtro'] == "cedula" && $_GET['search']!="") $w = " AND 1=0";
	if($_GET['filtro'] == "nombre" && trim($_GET['search'])!="") {
		$nombres = explode(" ",$_GET['search']);
		for($i=0;$i<count($nombres);++$i){
			if($nombres[$i]!=""){
				$w.=" AND (per.nombres LIKE '%".secInjection($nombres[$i])."%' OR per.apellidos LIKE '%".secInjection($nombres[$i])."%') ";
			}	
		}
	}
	
	if(intval($_GET['municipio'])>0) 
		$w.=" AND j.id_municipio = ".intval($_GET['municipio']);
		
	$estados=$db->l("SELECT e.id id_estado, m.id id_municipio, e.estado, m.municipio FROM `estados` e, municipios m WHERE m.id_estado = e.id ORDER BY e.estado, m.municipio",false);

	//echo "LIKE: $w";
     $list=$db->l("SELECT enc.id, per.nacionalidad, per.cedula, per.nombres, per.apellidos, m.municipio, e.estado, p.parroquia FROM `municipios` m, `encuestas` enc, estados e, 
parroquias p, direcciones j, personas per WHERE enc.id_jefe = per.id AND per.id = j.id_jefe AND j.id_parroquia = p.id AND p.id_estado = e.id AND p.id_municipio = m.id $w order by 
e.estado, per.cedula, per.nombres asc", false);

    ?>
	<script>function urlencode(str) {
return escape(str).replace(/\+/g,'%2B').replace(/%20/g, '+').replace(/\*/g, '%2A').replace(/\//g, '%2F').replace(/@/g, '%40');
}</script>
	<a href="javascript:form_add('adminEncuestas');"><img src="./images/add.png">Agregar Encuesta</a><br />
	<br />
	<b>Buscar:</b> 
	<select id="filtro">
	<option value="cedula" <?=$_GET['filtro']=="cedula"?"selected":"";?>>Numero de Cedula</option>
	<option value="nombre" <?=$_GET['filtro']=="nombre"?"selected":"";?>>Nombre y/o Apellido</option>
</select> 
<input value="<?=$_GET['search'];?>" id="search" type="text" size="10"/> 
- Municipio: 		
	<select id = "filtro_municipio">
		<option value="">Todos...</option>
		<?php
			for($i=0;$i<count($estados);++$i){
				if($id_estado_ant!=$estados[$i]['id_estado']){
					$id_estado_ant=$estados[$i]['id_estado'];
					if($i!=0)echo "</optgroup>";
					echo "<optgroup label='{$estados[$i]['estado']}'>";
				}
				echo "<option value = '{$estados[$i]['id_municipio']}' ".($_GET['municipio']==$estados[$i]['id_municipio']?"selected":"").">{$estados[$i]['municipio']}</option>";
				if($i==count($estados)-1) echo "</optgroup>";
			}
		?>
	</select>
	<button onclick="fn_listar('adminEncuestas','municipio='+$('#filtro_municipio').val()+'&filtro='+urlencode($('#filtro').val())+'&search='+urlencode($('#search').val()))">Buscar</button> 
	<button onclick="fn_listar('adminEncuestas','filtro=all')">Mostrar Todos</button><br><br>
    <table width = "100%">
	
        <tr>
            <th>Cedula de Identidad</th><th>Nombre</th><th>Estado</th><th>Municipio / Parroquia</th><th>Opciones</th>
        </tr>

        <?php
            for ($i=intval($_GET['ind']); $i < min(intval($_GET['ind']) + ITEMS_PAGE, count($list)); ++$i)
            {
                echo ("<tr " . (($i % 2 == 0) ? 'class="odd"' : 'class="even"')
                . "><td>{$list[$i]['nacionalidad']}-{$list[$i]['cedula']}</td>"
                . "<td>{$list[$i]['nombres']} {$list[$i]['apellidos']}</td>"
                . "<td>{$list[$i]['estado']}</td>" 
                . "<td>{$list[$i]['municipio']} / {$list[$i]['parroquia']}</td>" 
                . "<td><a href='javascript:form_update({$list[$i]['id']},\"adminEncuestas\");'><img src='images/page_edit.png' alt='Editar' title='Editar'></a> | <a href='javascript:form_delete({$list[$i]['id']},\"{$list[$i]['nacionalidad']}-{$list[$i]['cedula']}\",\"adminEncuestas\");'><img src='images/delete.png' alt='Eliminar' title='Eliminar'></a> | <a href='print.php?id={$list[$i]['id']}'><img src='images/print.png' alt='Imprimir' title='Imprimir'></a></td></tr>");
            }
        ?>
    </table>

<?php if(count($list)==0) echo '<center><b>Sin Resultados</b></center>'; ?>
        <?php 
			if(count($list) / ITEMS_PAGE >1){
		?>
    <center>
        Paginas:

        <?php
            for ($i=0; $i < count($list) / ITEMS_PAGE; ++$i)
                if ($i == 0)
                    echo "<a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminEncuestas\")'>{$i}</a>";
                else
                    echo " | <a href='javascript:fn_listar_pg(" . ($i * ITEMS_PAGE) . ",\"adminEncuestas\")'>{$i}</a>";
        ?>
    </center>
   
    <?php
		}
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
			
			if($_GET['t'] == 'add')
			{
				if($db->l("SELECT id FROM `encuestas` WHERE `id_jefe`=".intval($jefe['id']),true)){
					echo "El jefe de familia ya hizo la encuesta.";
					exit;
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
				echo "Error en la Base de Datos Insertando la direccion".$db->errors();
			} else {
				$fields = array("id_jefe");
				$sec_fields = array("%d");
				$values = array($jefe['id']);
				
				if($_GET['t'] == 'update') {
						$fields[]="`id`";
						$sec_fields[]="%d";
						$values[]=intval($_POST["id"]);
				}
				
				foreach($_POST as $key => $val) {
					if(!strstr($key, "_jefe") && !strstr($key, "_persona") && $key!="persona" && $key!="id") {
						$fields[]="`".secInjection($key)."`";
						$sec_fields[]="'%s'";
						$values[]=secInjection($val);
					}
				}
				
				if($_GET['t'] == 'update')
					$db->qs("DELETE FROM `encuestas` WHERE id_jefe=%d;", array(intval($jefe['id'])));
				if (!$db->qs("INSERT INTO encuestas (".implode(", ", $fields).") VALUES (".implode(", ", $sec_fields).")", $values)) {
					echo "Error en la Base de Datos Insertando la encuesta ".$db->errors();
				}else{
					$db->qs("DELETE FROM `familias` WHERE id_jefe=%d;", array(intval($jefe['id'])));
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
	
?>            
<form action = "<?php if($_GET['t']!='update') echo 'javascript:fn_agregar();'; else echo 'javascript:fn_update();'; ?>" method = "post" id = "form_adminEncuestas">
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
						<input value="<?=$direccion["nombre_inmueble"];?>" name="nombre_inmueble_jefe" class="" id="nombre_inmueble_jefe" maxlength="100" />
					</td>
				</tr> 
				<tr>
					<td>Piso:</td>
					<td>
						<input value="<?=$direccion["piso"];?>" name="piso_jefe" class="" id="piso_jefe" maxlength="100" />
					</td>
				</tr> 
				<tr>
					<td>Apartamento:</td>
					<td>
						<input value="<?=$direccion["apartamento"];?>" name="apartamento_jefe" class="" id="apartamento_jefe" maxlength="100" />
					</td>
				</tr> 
				<tr>
					<td>Direccion:</td>
					<td>
						<input value="<?=$direccion["direccion"];?>" name="direccion_jefe" class="required" id="direccion_jefe" />
					</td>
				</tr> 
			</table>
		</div>
		<div id="tabs-1">
			<table width="100%">
				<tr>
					<td>Cedula:</td>
					<td>
						<select <?=$jefe?"readonly":"";?> onchange="reloadJefe()" name="nacionalidad_jefe" id="nacionalidad_jefe">
							<option value="V" <?=$jefe['nacionalidad']=="V"?"selected":"";?>>V</option>
							<option value="E" <?=$jefe['nacionalidad']=="E"?"selected":"";?>>E</option>
						</select> - <input <?=$jefe?"readonly":"";?> value="<?=$jefe["cedula"];?>" name="cedula_jefe" class="required digits" id="cedula_jefe" onchange="reloadJefe()" />
					</td>
				</tr>
				<tr>
					<td>Nombres:</td>
					<td>
						<input value="<?=$jefe["nombres"];?>" name="nombres_jefe" class="required" id="nombres_jefe" maxlength="100" />
					</td>
				</tr>
				<tr>
					<td>Apellidos:</td>
					<td>
						<input value="<?=$jefe["apellidos"];?>" name="apellidos_jefe" class="required" id="apellidos_jefe" maxlength="100" />
					</td>
				</tr>
				<tr>
					<td>Sexo:</td>
					<td>
						<select name="sexo_jefe" id="sexo_jefe">
							<option value="M" <?=$jefe['sexo']=="M"?"selected":"";?>>M</option>
							<option value="F" <?=$jefe['sexo']=="F"?"selected":"";?>>F</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Fecha de Nacimiento:</td>
					<td>
						<input value="<?=$jefe["fecha_nacimiento"];?>" name="fecha_nacimiento_jefe" class="required date" readonly id="fecha_nacimiento_jefe" />
					</td>
				</tr>
				<tr>
					<td>Estado Civil</td>
					<td>
						<select name="estado_civil_jefe" class="required" id="estado_civil_jefe">
							<option value="">Seleccione...</option>
							<option value="<?=SOLTERO;?>" <?=$jefe['estado_civil']==SOLTERO?"selected":"";?>><?=$estado_civil[SOLTERO];?></option>
							<option value="<?=DIVORSIADO;?>" <?=$jefe['estado_civil']==DIVORSIADO?"selected":"";?>><?=$estado_civil[DIVORSIADO];?></option>
							<option value="<?=CASADO;?>" <?=$jefe['estado_civil']==CASADO?"selected":"";?>><?=$estado_civil[CASADO];?></option>
							<option value="<?=VIUDO;?>" <?=$jefe['estado_civil']==VIUDO?"selected":"";?>><?=$estado_civil[VIUDO];?></option>
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
		<table width="100%"><tr><td width="50%" valign="top">
			<table width="100%">
				<tr><th>Problemas de la Comunidad</th><th></th></tr>
				<tr><td>Falta de cooperación de los vecinos</td><td><input type="checkbox" value="1" name="cooperacion_vecinos" id="cooperacion_vecinos" /></td></tr>
				<tr><td>Violencia vecinal</td><td><input type="checkbox" value="1" name="violencia_vecinal" id="violencia_vecinal" /></td></tr>
				<tr><td>Abuso de las autoridades</td><td><input type="checkbox" value="1" name="abuso_autoridades" id="abuso_autoridades" /></td></tr>
				<tr><td>Prostitución</td><td><input type="checkbox" value="1" name="prostitucion" id="prostitucion" /></td></tr>
				<tr><td>Alcoholismo</td><td><input type="checkbox" value="1" name="alcoholismo" id="alcoholismo" /></td></tr>
				<tr><td>Enfermos terminales en la comunidad</td><td><input type="checkbox" value="1" name="dummy_persona" id="enfermos_terminales_cb" /><span id="view_enfermos_terminales">Cuantos Aprx.?: <input type="text" size="1" name="enfermos_terminales" id="enfermos_terminales" value="0" /></span></td></tr>
				<tr><td>Discapacitados en la comunidad</td><td><input type="checkbox" value="1" name="dummy_persona" id="discapacitados_cb" /> <span id="view_discapacitados">Cuantos Aprx.?: <input type="text" size="1" name="discapacitados" id="discapacitados" value="0" /></span></td></tr>
				<tr><td>Delincuencia</td><td><input type="checkbox" value="1" name="delincuencia" id="delincuencia" /></td></tr>
				<tr><td>Indigentes</td><td><input type="checkbox" value="1" id="indigentes_cb" name="dummy_persona" /> <span id="view_indigentes">Cuantos Aprx.?: <input type="text" size="1" name="indigentes" id="indigentes" value="0" /></span></td></tr>
				<tr><td>Niños en situación de abandono</td><td><input type="checkbox" value="1" id="ninos_abandono_cb" name="dummy_persona" /> <span id="view_ninos_abandono">Cuantos Aprx.?: <input type="text" size="1" name="ninos_abandono" id="ninos_abandono" value="0" /></span></td></tr>
				<tr><td>Extrema densidad poblacional</td><td><input type="checkbox" value="1" name="extrema_densidad_poblacional" id="extrema_densidad_poblacional" /></td></tr>
				<tr><td>Comercio de drogas</td><td><input type="checkbox" value="1" name="comercio_drogas" id="comercio_drogas" /></td></tr>
				<tr><td>Consumo de drogas</td><td><input type="checkbox" value="1" name="consumo_drogas" id="consumo_drogas" /></td></tr>
				<tr><td>Servicios públicos</td><td><input type="checkbox" value="1" name="servicios_publicos" id="servicios_publicos" /></td></tr>
				<tr><td>Basura en las calles</td><td><input type="checkbox" value="1" name="basura" id="basura" /></td></tr>
				<tr><td>Seguridad urbana</td><td><input type="checkbox" value="1" name="seguridad_urbana" id="seguridad_urbana" /></td></tr>
				<tr><td>Aguas servidas emposadas</td><td><input type="checkbox" value="1" name="aguas_servidas_emposadas" id="aguas_servidas_emposadas" /></td></tr>
				<tr><td>Residuos tóxicos</td><td><input type="checkbox" value="1" name="residuos_toxicos" id="residuos_toxicos" /></td></tr>
				<tr><td>Barros y pantanos</td><td><input type="checkbox" value="1" name="barros_pantanos" id="barros_pantanos" /></td></tr>
				<tr><td>Ruidos</td><td><input type="checkbox" value="1" name="ruidos" id="ruidos" /></td></tr>
				<tr><td>Fabricas contaminantes</td><td><input type="checkbox" value="1" name="fabricas_contaminantes" id="fabricas_contaminantes" /></td></tr>
				<tr><td>Licorerías</td><td><input type="checkbox" value="1" name="licorerias" id="licorerias" /></td></tr>
				<tr><td>Transito vehicular</td><td><input type="checkbox" value="1" name="transito_vehicular" id="transito_vehicular" /></td></tr>
				<tr><td>Terrenos baldíos</td><td><input type="checkbox" value="1" name="terrenos_baldios" id="terrenos_baldios" /></td></tr>
				<tr><td>Falta de espacios de recreación</td><td><input type="checkbox" value="1" name="falta_espacios_recreacion" id="falta_espacios_recreacion" /></td></tr>
				<tr><td>Falta de espacios deportivos</td><td><input type="checkbox" value="1" name="falta_espacios_deportivos" id="falta_espacios_deportivos" /></td></tr>
				<tr><td>Victima de algún delito</td><td><input type="checkbox" value="1" name="victima_delito" id="victima_delito" /></td></tr>
				<tr><td>Otros</td><td><input type="text" value="" size="4" name="otros_problemas_comunidad" id="otros_problemas_comunidad" /></td></tr>
			</table>
		</td><td width="50%" valign="top">
			<table width="100%">
				<tr><th>Beneficiario de alguna Misión</th><th></th></tr>
				<tr><td>Misión Robinsion</td><td><input type="checkbox" value="1" name="mision_robinson" id="mision_robinson" /></td></tr>
				<tr><td>Misión Ribas</td><td><input type="checkbox" value="1" name="mision_ribas" id="mision_ribas" /></td></tr>
				<tr><td>Mision Mercal</td><td><input type="checkbox" value="1" name="mision_mercal" id="mision_mercal" /></td></tr>
				<tr><td>Mision Negra Hipolita</td><td><input type="checkbox" value="1" name="mision_negra_hipolita" id="mision_negra_hipolita" /></td></tr>
				<tr><td>Mision Habitat</td><td><input type="checkbox" value="1" name="mision_habitat" id="mision_habitat" /></td></tr>
				<tr><td>Mision Vivienda</td><td><input type="checkbox" value="1" name="mision_vivienda" id="mision_vivienda" /></td></tr>
				<tr><td>Mision Barrio Adentro</td><td><input type="checkbox" value="1" name="mision_barrio_adentro" id="mision_barrio_adentro" /></td></tr>
				<tr><td>Mision Ciencia</td><td><input type="checkbox" value="1" name="mision_ciencia" id="mision_ciencia" /></td></tr>
				<tr><td>Mision Cultura</td><td><input type="checkbox" value="1" name="mision_cultura" id="mision_cultura" /></td></tr>
				<tr><td>Simoncito</td><td><input type="checkbox" value="1" name="simoncito" id="simoncito" /></td></tr>
				<tr><td>Unidad Educativa</td><td><input type="checkbox" value="1" name="unidad_educativa" id="unidad_educativa" /></td></tr>
				<tr><td>Liceo</td><td><input type="checkbox" value="1" name="liceo" id="liceo" /></td></tr>
				<tr><td>Universidad</td><td><input type="checkbox" value="1" name="universidad" id="universidad" /></td></tr>
			</table>
			<br />
			<table width="100%">
				<tr><th>Servicios Activos</th><th></th></tr>
				<tr><td>Aguas blancas</td><td><input type="checkbox" value="1" name="aguas_blancas" id="aguas_blancas" /></td></tr>
				<tr><td>Aguas servidas</td><td><input type="checkbox" value="1" name="aguas_servidas" id="aguas_servidas" /></td></tr>
				<tr><td>Sistema eléctrico</td><td><input type="checkbox" value="1" name="sistema_electrico" id="sistema_electrico" /></td></tr>
				<tr><td>Recoleccion de basura</td><td><input type="checkbox" value="1" name="recoleccion_basura" id="recoleccion_basura" /></td></tr>
				<tr><td>Telefonia</td><td><input type="checkbox" value="1" name="telefonia" id="telefonia" /></td></tr>
				<tr><td>Transporte</td><td><input type="checkbox" value="1" name="transporte" id="transporte" /></td></tr>
				<tr><td>Mecanismo de información</td><td><input type="checkbox" value="1" name="mecanismo_informacion" id="mecanismo_informacion" /></td></tr>
				<tr><td>Servicios comunitarios</td><td><input type="checkbox" value="1" name="servicios_comunitarios" id="servicios_comunitarios" /></td></tr>
				<tr><td>Gas domestico</td><td><input type="checkbox" value="1" name="gas_domestico" id="gas_domestico" /></td></tr>
				<tr><td>Alumbrado Publico</td><td><input type="checkbox" value="1" name="alumbrado_publico" id="alumbrado_publico" /></td></tr>
				<tr><td>Modulos de seguridad</td><td><input type="checkbox" value="1" name="modulos_seguridad" id="modulos_seguridad" /></td></tr>
			</table>
		</td></tr></table>
		<br />
		<table width="100%">
			<tr><td>Existe en su núcleo familiar alguna persona que padezca de alguna enfermedad?</td><td><input type="checkbox" value="1" name="familiar_enfermo" id="familiar_enfermo" /></td></tr>
			<tr><td>Necesita Usted de ayuda especial para sus familiares enfermos?</td><td><input type="checkbox" value="1" name="ayuda_familiar_enfermo" id="ayuda_familiar_enfermo" /></td></tr>
			<tr><td>Le gustaría contar con una Universidad Simón Rodríguez en Sabana Grande?</td><td><input type="checkbox" value="1" name="simon_rodriguez" id="simon_rodriguez" /></td></tr>
		</table>
		</div>
	</div>
	<br />
	<br />
	<center>
		<button type="submit">Enviar</button>
		<button type="button" onclick = "fn_cerrar();">Cancelar</button>
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
		load_persona("nacionalidad_persona", "cedula_persona", "cedula_persona", reloadPersona);
	}
	function cerrarPersona(){
		$("#botonesPersona").show(100);
		$("#persona").hide(100);
		$("#cedula_persona").removeAttr("disabled");
		$("#nacionalidad_persona").removeAttr("disabled");
	}
	function validateForm(){
		var validator = $("#form_adminEncuestas").validate();
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
	}
	function onLoadForm(){
		<?php
			echo '/*  ';
				print_r($encuesta);
			echo '  */';
			if($encuesta) {
				foreach($encuesta as $key => $val) {
					if($val != "0")
						echo 'if($("#'.$key.'").attr("type")=="checkbox") $("#'.$key.'").attr("checked", true); else $("#'.$key.'").val(\''.secInjection($val).'\');'."\n\t\t";
				}
			}
		?>
		styleViewFamilia();
		reloadParroquia($("#id_municipio_jefe").val(), 'load_parroquia', 'id_parroquia_jefe');
		load_persona("nacionalidad_jefe", "cedula_jefe", "cedula_jefe", reloadJefe);
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
		$("button").button();
	}
	function reloadParroquia(id_municipio, contenedor, name) {
		if(!id_municipio || id_municipio=="") id_municipio = "0";
		$('#'+contenedor).html("Cargando...");
		$.get('adminEncuestas.php?t=parroquias&id='+id_municipio+'&id_parroquia='+$('#'+contenedor+"_h").val()+'&name='+name, function(data) {
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
	}
    function fn_agregar()
    {      
		if(!$("#cedula_jefe").val().trim()){
			alert("La cedula del jefe de familia es obligatorio");
			return;
		}
		if(!$("input[name^=persona]").val()) {
			if(!confirm("¿Seguro desea enviar la encuesta sin ningun miembro de familia?")) return;
		}
		
		var str = $("#form_adminEncuestas").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminEncuestas.php?t=add',
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
						alert("Agregado correctamente");
						fn_cerrar();
						fn_listar('adminEncuestas');
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		);
    }

    function fn_update()
    {
		if(!$("#cedula_jefe").val().trim()){
			alert("La cedula del jefe de familia es obligatorio");
			return;
		}
		if(!$("input[name^=persona]").val()) {
			if(!confirm("¿Seguro desea enviar la encuesta sin ningun miembro de familia?")) return;
		}
		
		var str = $("#form_adminEncuestas").serializeArray();           
        ajaxLoading();
		$.ajaxFileUpload
		(
			{
				url:'adminEncuestas.php?t=update',
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
						fn_cerrar();
						fn_listar('adminEncuestas');
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		);
    }
</script>
