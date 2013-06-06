<?php
$code = -2;
$puerto ="localhost";
$usuario ="root";
$contraseña ="root1006";

//print_r($_POST);

$conexion = mysql_connect ($puerto,$usuario,$contraseña,true);
mysql_select_db("solicitud_empleo", $conexion);

if(isset($_POST["formSent"])){
	$horarioDeseado = "";
	
	foreach ($_POST["horario"] as $valorHorario){
		if($horarioDeseado != ""){
			$horarioDeseado .= ",";
		}
		
		$horarioDeseado .= $valorHorario;
	}
	
	$insertar= "INSERT INTO solicitudes
	(nombre,
	apellido,
	ci,
	lugar_nacimiento,
	fecha_nacimiento,
	sexo,
	edo_civil,
	tiene_hijos,
	direccion,
	tlf_habitacion,
	tlf_celular,
	email,
	grado_instruccion,
	profesional_en,
	especialista_en,
	experiencia_laboral,
	ultimos_trabajos,
	antiguedad_ultimo_trabajo,
	cargo_solicitado,
	ex_empleado,
	ex_dpto,
	motivo_retiro,
	horario_deseado,
	fecha_registro)
	VALUES
	(
	'".$_POST["nombre"]."',
	'".$_POST["apellido"]."',
	'".$_POST["tipoCi"].$_POST["ci"]."',
	'".$_POST["lugarNacimiento"]."',
	'".$_POST["fechaNacimientoHidden"]."',
	'".$_POST["sexo"]."',
	'".$_POST["edoCivil"]."',
	'".$_POST["tieneHijos"]."',
	'".str_replace("'", "''", $_POST["direccion"])."',
	'".$_POST["telefonoHab"]."',
	'".$_POST["telefonoCel"]."',
	'".$_POST["correo"]."',
	'".$_POST["gradoInstruccion"]."',
	'".$_POST["profesionalEn"]."',
	'".$_POST["especialistaEn"]."',
	'".$_POST["expLaboral"]."',
	".($_POST["expLaboral"] == "Si" ? "'".$_POST["cuantosTrabajos"]."'" : "''").",
	".($_POST["expLaboral"] == "Si" ? "'".$_POST["tiempoTrabajo"]."'" : "''").",
	'".$_POST["cargoAspirado"]."',
	'".$_POST["trabajoMuralla"]."',
	".($_POST["trabajoMuralla"] == "Si" ? "'".$_POST["dptoTrabajo"]."'" : "''").",
	".($_POST["trabajoMuralla"] == "Si" ? "'".$_POST["motivoRetiro"]."'" : "''").",
	'".$horarioDeseado."',
	NOW());
	";
	
	$code = 0;
	mysql_query($insertar);
	if(mysql_error()){
		$code = -1;
	}
	
	mysql_close();	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Guardando Solicitud</title>
	</head>
	<body>
		<script type="text/javascript">
			if(<?php echo $code;?> == 0){
				alert("Su solicitud fue almacenada, pronto lo contactaremos.");
				window.location = "index.html";
			} else if(<?php echo $code;?> == -1){
				alert("Disculpe, hubo un error almacenando su solicitud intente nuevamente por favor.");
				window.history.back();
			} else if(<?php echo $code;?> == -2){
				alert("Acceso no permitido a esta página.");
				window.location = "index.html";
			}
		</script>
	</body>
</html>