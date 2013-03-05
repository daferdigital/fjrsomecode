<?Php session_start();
	print_r($_SESSION['datos']);
	echo date('Y-m-d');
	include_once("procesos/conexion.php"); //sleep(2);
	$_REQUEST['fecha']=date('Y-m-d');
	$banquero=$_SESSION['datos']['idbanquero'];
	list($ano,$mes,$dia)=explode("-",$_REQUEST['fecha']);
	$selectlogros="select *,date_format(CONCAT(fecha,' ',hora),'%r') as hora_f from vista_logros_banqueros where fecha='".$ano.'-'.$mes.'-'.$dia."' and idbanquero='".$banquero."' and estatus_categoria_apuesta='1' and hora>='".date('H:i:00')."' and estatus_logro='1' ORDER BY idliga,hora,idlogro,idlogro_equipo,que_equipo ASC, nombre_tipo_apuesta ASC";
	echo '<br>'.$selectlogros.'<br>';
	echo mysql_num_rows(mysql_query($selectlogros));
	phpinfo();
?>