<?php
include_once 'classes/DBConnection.php';
include_once 'classes/DBUtil.php';

$code = -2;
//print_r($_POST);

if(isset($_POST["formSent"])){
	//revisamos si ya existe una solicitud con esa cedula
	$query = "SELECT COUNT(*) AS cuenta FROM solicitudes WHERE ci = '".$_POST["tipoCi"].$_POST["ci"]."'";
	$result = DBUtil::executeSelect($query);
	
	if($result[0]["cuenta"] > 0){
		//debemos hacer el update ya que esa cedula tiene una solicitud creada
		//por lo tanto borramos la informacion anterior para crearla con los datos actuales
		$code = 1;
		$query = "DELETE FROM solicitudes WHERE ci = '".$_POST["tipoCi"].$_POST["ci"]."'";
		DBUtil::executeQuery($query);
	}
	
	//tomamos los valores del horario para unirlos si hay mas de uno
	$horarioDeseado = "";
	foreach ($_POST["horario"] as $valorHorario){
		if($horarioDeseado != ""){
			$horarioDeseado .= ",";
		}
		
		$horarioDeseado .= $valorHorario;
	}
	
	//construimos la sentencia del insert
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
	id_cargo,
	ex_empleado,
	id_exdpto,
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
	".$_POST["cargoAspirado"].",
	'".$_POST["trabajoMuralla"]."',
	".($_POST["trabajoMuralla"] == "Si" ? $_POST["dptoTrabajo"] : "null").",
	".($_POST["trabajoMuralla"] == "Si" ? "'".$_POST["motivoRetiro"]."'" : "''").",
	'".$horarioDeseado."',
	NOW());
	";
	
	//ejecutamos el insert y verificamos si hubo error o no
	//para mostrar el respectivo mensaje de resultado
	$code = 0;
	$exitosa = DBUtil::executeQuery($insertar);
	if(! $exitosa){
		$code = -1;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
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
			} else if(<?php echo $code;?> == 1){
				alert("Disculpe, ya existia una solicitud para la cédula <?php echo $_POST["tipoCi"].$_POST["ci"];?>.\nLa misma fue actualizada.");
				window.location = "index.html";
			}
		</script>
	</body>
</html>