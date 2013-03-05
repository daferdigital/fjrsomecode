<?Php session_start();

include("conexion.php");
	if($_REQUEST['codigo_ticket']){
		$select="select * from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'";
		$query=mysql_query($select);
			if(mysql_num_rows($query)>0){
				mysql_query("update ventas set anulado='1' where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'");
				echo "Ticket anulado satisfactoriamnete de la BD";
			}else{
				echo "Código de ticket <b>\"".$_REQUEST['codigo_ticket']."\"</b> no encontrado en la BD";
			}
	}
?>