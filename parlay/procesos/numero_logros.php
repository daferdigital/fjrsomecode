<?Php session_start();
	
	$jsondata['actualizar'] = 'no';
	
	if($_SESSION['datos']){
		if($_REQUEST['nlogros']>=0){
			include('conexion.php');
			$nlogros_real="select * from logros where fecha='".date('Y-m-d')."' and hora>='".date('H:i:00')."' and estatus='1'";
			$nlogros_real=mysql_num_rows(mysql_query($nlogros_real));
				
				if($_REQUEST['nlogros']!=$nlogros_real):					
					$jsondata['actualizar'] = 'si';
					//echo $_REQUEST['nlogros'].' -> '.$nlogros_real;
				endif;
				
		}else{
			$jsondata['actualizar'] = 'nosesion';
		}
	}else{
		$jsondata['actualizar'] = 'nosesion';		
	}	
	
	/*si se actualizo un logro verifico si la taquilla ya actualizo sino ordeno la actualizacion*/
	if($jsondata['actualizar']=='no'){
		$query=mysql_query("select actualizar from taquillas where actualizar='1' and idtaquilla='".$_SESSION['datos']['idtaquilla']."' limit 1");
		$num=mysql_num_rows($query);
			if($num>0){
				$jsondata['actualizar'] = 'si';
			}
	}
	echo json_encode($jsondata);
?>