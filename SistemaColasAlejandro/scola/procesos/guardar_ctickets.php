<?Php session_start();
	include("conexion.php");
	foreach($_POST['ntickets'] as $key=>$valor){
		//echo $key.' -> '.$valor;
		$datos_dep=dame_datos("select iddepartamento from tickets_encabezados where idticket_encabezado='".$key."' limit 1");
		//echo $datos_dep['iddepartamento']; exit;
		mysql_query("UPDATE departamentos set tickets_disponibles='".$valor."' WHERE iddepartamento='".$datos_dep['iddepartamento']."' limit 1");
		
		if(mysql_query("UPDATE tickets_encabezados SET numero_tickets='".$valor."' where idticket_encabezado='".$key."' limit 1")) $ex='yes';
	}
?>

<script language="javascript">
	location.href='../add_ctickets.php?exito=<?Php echo $ex;?>';
</script>