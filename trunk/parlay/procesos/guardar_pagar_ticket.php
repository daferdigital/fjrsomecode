<?Php session_start();

include("conexion.php");
	if($_REQUEST['codigo_ticket']){
		if($_SESSION['perfil']==1){//Administrador
			$select="select * from vista_ventas where fecha_prorroga>='".date('Y-m-d')."' and (ganador='1' or reembolsar='1' or recalculado='1') and vencido='0' and reembolsado=0 and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' and codigo_cliente='".(int)($_REQUEST['codigo_cliente']*1)."' limit 1";
		}elseif($_SESSION['perfil']==2){//banquero
			$select="select * from vista_ventas where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and (ganador='1' or reembolsar='1' or recalculado='1') and reembolsado=0 and vencido='0' and fecha_prorroga>='".date('Y-m-d')."' and  codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' and codigo_cliente='".(int)($_REQUEST['codigo_cliente']*1)."' limit 1";
		}elseif($_SESSION['perfil']==3){//Intermediario
			$select="select * from vista_ventas where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and (ganador='1' or reembolsar='1' or recalculado='1') and reembolsado=0 and vencido='0' and fecha_prorroga>='".date('Y-m-d')."' and  codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' and codigo_cliente='".(int)($_REQUEST['codigo_cliente']*1)."' limit 1";
		}elseif($_SESSION['perfil']==4){//Taquilla
			//$select="select * from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'";
			$select="select * from vista_ventas where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and (ganador='1' or reembolsar='1' or recalculado='1') and reembolsado=0 and vencido='0' and fecha_prorroga>='".date('Y-m-d')."' and  codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."' and codigo_cliente='".(int)($_REQUEST['codigo_cliente']*1)."' limit 1";
		}
		$query=mysql_query($select);
			if(mysql_num_rows($query)>0){
				$tick=mysql_fetch_assoc($query);
				if($tick['pagado']==0){
					//mysql_query("update ventas set anulado='1' where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'");
					//if($tick['reembolsar']==1 || $tick['recalculado']==1) $concat=',reembolsado=1';
					if($tick['reembolsar']==1) $concat=',reembolsado=1';
					mysql_query("update ventas set pagado='1',anulado='0',vencido='0',tm='".$_SESSION['nombre_tabla']."',idtm='".$_SESSION['nombre_idtabla']."',idmodificador='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' $concat where codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'");
					echo "Ticket pagado satisfactoriamente";
				}else{
					echo "Ticket ya fue pagado";
				}
				
				
			}else{
				echo "Código de ticket <b>\"".$_REQUEST['codigo_ticket']."\"</b> y código de cliente <b>\"".$_REQUEST['codigo_cliente']."\"</b> no encontrado en la BD, intente nuevamente!!!";
			}
	}
?>