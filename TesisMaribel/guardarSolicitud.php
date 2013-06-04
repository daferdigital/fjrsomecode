<?php

$nombre = $_POST ['nombre'];

$apellido = $_POST ['apellido'];

$ci = $_POST ['ci'];

$lugar = $_POST ['lugar'];

$date = $_POST ['date'];

$sexo = $_POST ['sexo'];

$estado = $_POST ['estado'];

$hijos = $_POST ['hijos'];

$direccion = $_POST ['direccion'];

$thab = $_POST ['thab'];

$tcel = $_POST ['tcel'];

$correo = $_POST ['correo'];

$instruccion = $_POST ['instruccion'];

$profesional = $_POST ['profesional'];

$especialista = $_POST ['especialista']; 

$exp = $_POST ['exp']; 

$ultimost = $_POST ['ultimost']; 

$tiempo = $_POST ['tiempo']; 

$cargo = $_POST ['cargo']; 

$tmuralla = $_POST ['tmuralla']; 

$dpto = $_POST ['dpto']; 

$retiro = $_POST ['retiro']; 

$horario = $_POST ['horario']; 



$puerto ="localhost";

$usuario ="root";

$contraseña ="";


$conexion = mysql_connect ($puerto,$usuario,$contraseña);
mysql_select_db("solicitud_empleo",$conexion);


$insertar= "insert into sistemas (nombre, apellido, ci, lugar de nacimiento, fecha de nacimiento, sexo, estado civil, tiene hijos, direccion, telefono hab, telefono cel, correo, grado de instruccion, profesional en, especialista en, exp laboral, ultimos trabajos, tiempo que trabajo, cargo aspira, trabajo en la muralla, dpto trabajo, motivo de retiro, horario) values ('$nombre', '$apellido', '$ci', '$lugar', '$date', '$sexo', '$estado', '$hijos', '$direccion', '$thab', '$tcel', '$correo', '$instruccion', '$profesional', '$especialista', '$exp', '$ultimost', '$tiempo', '$cargo','$tmuralla', '$dpto', '$retiro', '$horario')";


mysql_query($insertar);
echo "Sus datos han sido enviados, pronto nos comunicaremos con usted, gracias por ingresar al sistema";
?>


