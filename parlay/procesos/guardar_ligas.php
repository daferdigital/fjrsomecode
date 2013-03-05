<?php 
	include("conexion.php");	
		$oligas='';
			if($_POST['nregistros']>0){
				for($i=0;$i<$_POST['nregistros'];$i++){
					echo $idcategoria.' / '.$_POST['idoliga'.$i].'<br>';
					if($_POST['idoliga'.$i]){
						if($oligas) $oligas.=',';
							$oligas.='|'.$_POST['idoliga'.$i].'|';
					}
				}
			}
		if(!$_POST['idliga']){
			$cadena=sprintf("insert into ligas() values('','%s','%s','".$_POST['estatus']."','".$_POST['liga_padre']."','".$oligas."')",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['categoria']));
			mysql_query($cadena)or die(mysql_error());// exit;
		}else{
			$cadena=sprintf("update ligas set nombre='%s', idcategoria='%s',liga_padre='".$_POST['liga_padre']."', otras_ligas='".$oligas."', estatus='".$_POST['estatus']."' where idliga='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['categoria']),mysql_escape_string($_POST['idliga']));
			mysql_query($cadena);
		}
		
?>