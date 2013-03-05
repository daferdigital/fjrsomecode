<?php
if($_GET['usuario']):
	include("procesos/conexion.php");	 
	$no='';
	 $tablas_logueo=array('usuario'=>'usuario','banqueros'=>'usuario','intermediarios'=>'usuario','taquillas'=>'usuario');
		foreach($tablas_logueo as $tabla=>$campo_usuario){
			if($no==''){
				$no=verifica_disponibilidad_usuario("select $campo_usuario from $tabla where $campo_usuario='".$_GET['usuario']."' limit 1");
			}
		}
		$jsondata['usuario'] = $no;
		echo json_encode($jsondata);
endif;	
?>