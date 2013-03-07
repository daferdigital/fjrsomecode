<?php
    include_once ("classDBAndUser.php");
   
    if($_GET['search']) {
		if($_REQUEST['nacionalidad']=="M"){
			echo json_encode(array());
			exit;
		}
		$personas = $db->l(
			"SELECT * 
			FROM  `personas` 
			WHERE nacionalidad = '".secInjection($_REQUEST['nacionalidad'])."' AND CAST( cedula AS CHAR ) LIKE  '%".secInjection($_REQUEST['search'])."%'
			LIMIT 10", false);
		echo json_encode($personas);
  }else if($_GET['cedula']) {
	if($_REQUEST['nacionalidad']=="M" && intval($_REQUEST['cedula']==0)){
		echo json_encode(false);
		exit;
	}
	$personas = $db->l(
		"SELECT * 
		FROM  `personas` 
		WHERE nacionalidad = '".secInjection($_REQUEST['nacionalidad'])."' AND cedula = ".intval($_REQUEST['cedula'])."", true);
	echo json_encode($personas);
  }else if($_POST['cedula'] && $_POST['nacionalidad']) {
	$persona = $db->l("SELECT *
                        FROM  `personas`
                        WHERE nacionalidad = '".secInjection($_POST['nacionalidad'])."' AND cedula = ".intval($_POST['cedula'])."", true);
	
	if($persona && !isset($_POST['edit'])) echo json_encode(-1);
	else if(!$persona) {
		if($_POST['nacionalidad']=="M" && intval($_POST['cedula']==0)) {
			$_POST['cedula'] = $db->pid("personas");
		}
		$result = $db->q("INSERT INTO personas (nacionalidad, cedula, nombres, apellidos, sexo, fecha_nacimiento, estado_civil, instruccion, profesion) VALUES ".
					"('".secInjection($_POST['nacionalidad'])."', ".intval($_POST['cedula']).", '".secInjection($_POST['nombres'])."',
						'".secInjection($_POST['apellidos'])."',  '".secInjection($_POST['sexo'])."', '".secInjection($_POST['fecha_nacimiento'])."', 
						".intval($_POST['estado_civil']).", '".secInjection($_POST['instruccion'])."', '".secInjection($_POST['profesion'])."' 
					 )");
		echo json_encode($result?$_POST['cedula']:false);
	}else if(isset($_POST['edit'])) {
		$result = $db->q("UPDATE personas SET nombres='".secInjection($_POST['nombres'])."', apellidos='".secInjection($_POST['apellidos'])."',  
					sexo = '".secInjection($_POST['sexo'])."', fecha_nacimiento = '".secInjection($_POST['fecha_nacimiento'])."', estado_civil = ".intval($_POST['estado_civil']).",
					instruccion = '".secInjection($_POST['instruccion'])."', profesion = '".secInjection($_POST['profesion'])."' WHERE nacionalidad = '".secInjection($_POST['nacionalidad'])."' AND cedula = ".intval($_POST['cedula']));
		echo json_encode($result?$_POST['cedula']:false);
	}else json_encode(false);

  }


