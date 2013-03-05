<?Php session_start(); //CONDICIONES DE TAQUILLAS
	if($_POST['napuestas']>0){
		$_SESSION['vender']='si';
		if($_SESSION['datos']){
			$jsondata['vender_ticket'] = 'si';
			$par_ley=false;
			$gan=(float)($_POST['monto_pagar'] - $_POST['monto_apuesta']);
			
			$fa=(float)($_POST['monto_apuesta']*$_SESSION['datos']['fa']);//Para factor apuesta
			if($fa<$_POST['monto_pagar']){
				$jsondata['mensaje'] = 'No se puede vender el ticket porque el monto a pagar supera el monto establecido por el factor apuesta, cuyo valor calculado es de '.$fa.'BsF.!!!';
				$jsondata['vender_ticket'] = 'no';
				$_SESSION['vender']='no';
			}
			
			
			switch($_POST['napuestas']){
				case '1':
					/*if($_SESSION['datos']['mjpd']<$_POST['monto_pagar']){ //MAXIMO DE JUGADAS POR DERECHO
						$jsondata['mensaje'] = 'Se supera el máximo a pagar en jugadas por derecho';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}*/
					
					
					if(($_SESSION['datos']['cmapd']>0)&&($_SESSION['datos']['cmapd']<($_SESSION['cmapd']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas por derecho ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}/*elseif(($_SESSION['datos']['cdpd']>0)&&($_SESSION['datos']['cdpd']==$_SESSION['cdpd'])){
						$jsondata['mensaje'] = 'El cupo diario de ventas por derecho ha sido excedido!!!';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}*/elseif(($_SESSION['datos']['cdpd']>0)&&($_SESSION['datos']['cdpd']<($_SESSION['cdpd']+$_POST['monto_apuesta']))){
						$jsondata['mensaje'] = 'El cupo diario de ventas por derecho ha sido excedido!!!';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}
					/*if($_SESSION['datos']['mpjpd']<$gan){ //Maximo perdida jugada por derecho
						
					}*/
				break;
				case '2':
					if(($_SESSION['datos']['cma2']>0)&&($_SESSION['datos']['cma2']<($_SESSION['cma2']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con dos logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
				case '3':
					if(($_SESSION['datos']['cma3']>0)&&($_SESSION['datos']['cma3']<($_SESSION['cma3']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con tres logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
				case '4':
					if(($_SESSION['datos']['cma4']>0)&&($_SESSION['datos']['cma4']<($_SESSION['cma4']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con cuatro logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
				case '5':
					if(($_SESSION['datos']['cma5']>0)&&($_SESSION['datos']['cma5']<($_SESSION['cma5']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con cinco logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
				case '6':
					if(($_SESSION['datos']['cma6']>0)&&($_SESSION['datos']['cma6']<($_SESSION['cma6']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con seis logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
				case '7':
					if(($_SESSION['datos']['cma7']>0)&&($_SESSION['datos']['cma7']<($_SESSION['cma7']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con siete logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
				case '8':
					if(($_SESSION['datos']['cma8']>0)&&($_SESSION['datos']['cma8']<($_SESSION['cma8']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con ocho logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
				case '9':
					if(($_SESSION['datos']['cma9']>0)&&($_SESSION['datos']['cma9']<($_SESSION['cma9']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con nueve logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
				case '10':
					if(($_SESSION['datos']['cma10']>0)&&($_SESSION['datos']['cma10']<($_SESSION['cma10']+$_POST['monto_pagar']))){
						$jsondata['mensaje'] = 'La cantidad maxima de apuestas con ocho logros ha sido alcanzada';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}else $par_ley=true;
				break;
			}
			
			//condiciones generales
			
			if($_SESSION['datos']['mapt']<$_POST['monto_apuesta']){ //Maximo de apuesta por ticket
						$jsondata['mensaje'] = 'Se supera el monto máximo en apuesta el cual es de '.$_SESSION['datos']['mapt'].'BsF.';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}
			if($_SESSION['datos']['cmina']>$_POST['monto_apuesta']){ //Maximo de apuesta por ticket
						$jsondata['mensaje'] = 'El monto minimo para apostar es de '.$_SESSION['datos']['cmina'].'BsF.';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}		
			if($_SESSION['datos']['cmlp']<$_POST['napuestas']){ //Cantidad Maxima de combinaciones permitidas
						$jsondata['mensaje'] = 'Se supera el máximo de jugadas por parley el cual es de '.$_SESSION['datos']['mjpp'].' y se tienen '.$_POST['napuestas'].' jugadas';
						$jsondata['vender_ticket'] = 'no';
						$_SESSION['vender']='no';
					}
			if($_SESSION['datos']['mp']<$_POST['monto_pagar']){ //Maximo de apuesta por ticket
				$jsondata['mensaje'] = 'Se supera el monto máximo en premio a pagar';
				$jsondata['vender_ticket'] = 'no';
				$_SESSION['vender']='no';
			}
			
			if($par_ley){
				if(($_SESSION['datos']['cdpp']>0)&&($_SESSION['datos']['cdpp']<($_SESSION['cdpp']+$_POST['monto_apuesta']))){
					$jsondata['mensaje'] = 'El cupo diario de ventas por parley ha sido excedido!!!';
					$jsondata['vender_ticket'] = 'no';
					$_SESSION['vender']='no';
				}
			}
			
	}else{
				$jsondata['vender_ticket'] = 'nosesion';
				$_SESSION['vender']='no';
	}
		//$jsondata['napuestas'] =$_POST['napuestas'];
		echo json_encode($jsondata);
	}
	
?>