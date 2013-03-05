<?Php session_start();

include("conexion.php");
	if($_REQUEST['codigo_ticket']){
		if($_SESSION['perfil']==1){//Administrador
			$select="select * from vista_ventas_detalles where fecha_venta='".date('Y-m-d')."' and  codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' limit 1";
///			$select="select * from vista_ventas_detalles where fecha_venta='".date('Y-m-d')."' and hora_juego>='".date('H:i:s')."' and hora_banquero>='".date('H:i:s')."' and  codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' limit 1";
		}elseif($_SESSION['perfil']==2){//banquero
			$select="select * from vista_ventas_detalles where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and fecha_venta='".date('Y-m-d')."' and hora_juego>='".date('H:i:s')."' and hora_banquero>='".date('H:i:s')."' and  codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' limit 1";
		}elseif($_SESSION['perfil']==3){//Intermediario
			$select="select * from vista_ventas_detalles where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and fecha_venta='".date('Y-m-d')."' and hora_juego>='".date('H:i:s')."' and hora_intermediario>='".date('H:i:s')."' and  codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' limit 1";
		}elseif($_SESSION['perfil']==4){//Taquilla
			//$select="select * from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'";
			$select="select * from vista_ventas_detalles where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and fecha_venta='".date('Y-m-d')."' and hora_juego>='".date('H:i:s')."' and hora_taquilla>='".date('H:i:s')."' and  codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' limit 1";
		}
		$query=mysql_query($select);
			if(mysql_num_rows($query)>0){
				//mysql_query("update ventas set anulado='1' where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'");
				mysql_query("update ventas set anulado='1',tm='".$_SESSION['nombre_tabla']."',idtm='".$_SESSION['nombre_idtabla']."',idmodificador='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' where codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'");
				
				echo "Ticket anulado satisfactoriamente de la BD";
			}else{
				echo "Código de ticket <b>\"".$_REQUEST['codigo_ticket']."\"</b> no encontrado en la BD o tiempo limite excedido para anular el ticket";
			}
	}
?>