<?Php session_start(); //CONDICIONES DE TAQUILLAS
	if($_POST['cc']>0 && $_POST['ct']>0){
		include("procesos/conexion.php");
		$_SESSION['vender']='si';
		if($_SESSION['datos']){
			if($_SESSION['perfil']==1){//Administrador
				$select="select * from vista_ventas where codigo_ticket='".(int)($_REQUEST['ct']*1)."' and codigo_cliente='".(int)($_REQUEST['cc']*1)."' limit 1";
			}elseif($_SESSION['perfil']==2){//banquero
				$select="select * from vista_ventas where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and  codigo_ticket='".(int)($_REQUEST['ct']*1)."' and codigo_cliente='".(int)($_REQUEST['cc']*1)."' limit 1";
			}elseif($_SESSION['perfil']==3){//Intermediario
				$select="select * from vista_ventas where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and  codigo_ticket='".(int)($_REQUEST['ct']*1)."' and codigo_cliente='".(int)($_REQUEST['cc']*1)."' limit 1";
			}elseif($_SESSION['perfil']==4){//Taquilla
				//$select="select * from ventas where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'";
				$select="select * from vista_ventas where ".$_SESSION['nombre_idtabla']."='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' and  codigo_ticket='".(int)($_REQUEST['ct']*1)."' and codigo_cliente='".(int)($_REQUEST['cc']*1)."' limit 1";
			}
			$query=mysql_query($select);
				if(mysql_num_rows($query)>0){
					$tick=mysql_fetch_assoc($query);
					if($tick['reembolsado']==1){
						$datos_mod=dame_datos("select * from ".$tick['tm']." where ".$tick['idtm']."='".$tick['idmodificador']."' limit 1");
						$jsondata['estatus_ticket'] =  "El ticket fue reembolsado por: ".($datos_mod['nombre']!=''?$datos_mod['nombre']:$datos_mod['nombres']);
						$jsondata['nestatus_ticket']='reembolsado';
					}elseif($tick['pagado']==1){
						//mysql_query("update ventas set anulado='1' where idtaquilla='".$_SESSION['datos']['idtaquilla']."' and fecha='".date('Y-m-d')."' and codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'");
						//mysql_query("update ventas set pagado='1',anulado='0',vencido='0',tm='".$_SESSION['nombre_tabla']."',idtm='".$_SESSION['nombre_idtabla']."',idmodificador='".$_SESSION['datos'][$_SESSION['nombre_idtabla']]."' where codigo_ticket='".(int)($_REQUEST['codigo_ticket']*1)."'");
						$datos_mod=dame_datos("select * from ".$tick['tm']." where ".$tick['idtm']."='".$tick['idmodificador']."' limit 1");
						
						$jsondata['estatus_ticket'] = 'Ticket ya fue pagado por: '.($datos_mod['nombre']!=''?$datos_mod['nombre']:$datos_mod['nombres']);
					}elseif($tick['anulado']==1){
						$datos_mod=dame_datos("select * from ".$tick['tm']." where ".$tick['idtm']."='".$tick['idmodificador']."' limit 1");
						$jsondata['estatus_ticket'] =  "El ticket fue anulado por: ".($datos_mod['nombre']!=''?$datos_mod['nombre']:$datos_mod['nombres']);
						$jsondata['nestatus_ticket']='anulado';
					}elseif($tick['perdedor']==1){						
						$jsondata['estatus_ticket'] =  "El ticket es perdedor, por lo tanto no lo puede pagar";
						$jsondata['nestatus_ticket']='perdedor';
					}elseif($tick['vencido']==1){						
						$jsondata['estatus_ticket'] =  "El ticket esta vencido, su fecha de expiración fue: ".$tick['fecha_prorroga'];
						$jsondata['nestatus_ticket']='vencido';						
					}elseif($tick['ganador']==1){						
						$jsondata['estatus_ticket'] =  "El ticket es GANADOR y no ha sido pagado, debe pagar un total de ".$tick['monto_real_pagar'].' BsF.<br><center><input type="button" class="boton" value="Pagar" onclick="javascript: mostrarmens=\'si\';comentario=\'Indique tanto código del ticket como código del cliente\'; nolistado=\'no\'; validar(document.pagar,\'pagar_ticket.php\');">  <input type="reset" class="boton" value="Limpiar campo" onclick="javascript:$(\'#bot_cons\').show(\'slow\');$(\'#detalle_del_ticket\').html(\'\');">';
						$jsondata['nestatus_ticket']='ganador';
					}elseif($tick['reembolsar']==1){						
						$jsondata['estatus_ticket'] =  "El ticket se tiene que Reembolsar, debe reembolsar un total de ".$tick['monto_real_pagar'].' BsF.<br><center><input type="button" class="boton" value="Pagar" onclick="javascript: mostrarmens=\'si\';comentario=\'Indique tanto código del ticket como código del cliente\'; nolistado=\'no\'; validar(document.pagar,\'pagar_ticket.php\');">  <input type="reset" class="boton" value="Limpiar campo" onclick="javascript:$(\'#bot_cons\').show(\'slow\');$(\'#detalle_del_ticket\').html(\'\');">';
						$jsondata['nestatus_ticket']='ganador';
					}elseif($tick['recalculado']==1){						
						$jsondata['estatus_ticket'] =  "Ticket recalculado, debe pagarse un total de ".$tick['monto_real_pagar'].' BsF.<br><center><input type="button" class="boton" value="Pagar" onclick="javascript: mostrarmens=\'si\';comentario=\'Indique tanto código del ticket como código del cliente\'; nolistado=\'no\'; validar(document.pagar,\'pagar_ticket.php\');">  <input type="reset" class="boton" value="Limpiar campo" onclick="javascript:$(\'#bot_cons\').show(\'slow\');$(\'#detalle_del_ticket\').html(\'\');">';
						$jsondata['nestatus_ticket']='ganador';
					}
					$jsondata['ticket_conseguido'] = 'si';
					
				}else{
					$jsondata['estatus_ticket']= "Código de ticket <b>\"".$_REQUEST['ct']."\"</b> y código de cliente <b>\"".$_REQUEST['cc']."\"</b> no encontrado en la BD, intente nuevamente!!!";
					$jsondata['ticket_conseguido'] = 'no';
				}
		}else{
				$jsondata['vender_ticket'] = 'nosesion';
				$_SESSION['vender']='no';
				$jsondata['ticket_conseguido'] = 'no';
				$jsondata['estatus_ticket']= "";
		}
		//$jsondata['napuestas'] =$_POST['napuestas'];		
	}else{
		$jsondata['vender_ticket'] = 'nosesion';
		$_SESSION['vender']='no';
		$jsondata['ticket_conseguido'] = 'no';
		$jsondata['estatus_ticket']= "";
	}
		
	echo json_encode($jsondata);	
		
?>