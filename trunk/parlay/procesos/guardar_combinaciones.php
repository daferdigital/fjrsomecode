<?php session_start();
	include("conexion.php");
	//mysql_query("SET NAMES utf8");
	//$_POST=convertArrayKeysToUtf82($_POST);
		if($_POST['idsca']){
			mysql_query("update categorias_apuestas_combinaciones set estatus='0' where idcategoria_apuesta='".$_POST['idcategoria_apuesta']."'");
			$sepidsca=explode(",",$_POST['idsca']);
				foreach($sepidsca as $key){
					if($_POST[$key]){
						$existe=dame_datos("select idcategoria_apuesta_combinacion from categorias_apuestas_combinaciones where idcategoria_apuesta='".$_POST['idcategoria_apuesta']."' and idcategoria_apuesta_combinar='".$_POST[$key]."' limit 1");
						if($existe){
							mysql_query("update categorias_apuestas_combinaciones set estatus='1' where idcategoria_apuesta='".$_POST['idcategoria_apuesta']."' and idcategoria_apuesta_combinar='".$_POST[$key]."' limit 1");
						}else{
							mysql_query("insert into categorias_apuestas_combinaciones() values('','".$_POST['idcategoria_apuesta']."','".$key."','1')");
						}
					}
				}
		}
			
?>