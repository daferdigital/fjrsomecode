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
	echo json_encode($jsondata);
?>