<?php 
	include("conexion.php");
	//$_POST=convertArrayKeysToUtf82($_POST);
		if(!$_POST['idcategoria']){
			$cadena=sprintf("insert into categorias() values('','%s','".$_POST['estatus']."')",mysql_escape_string($_POST['nombre']));
			mysql_query($cadena)or die(mysql_error());// exit;
			$idcategoria=mysql_insert_id();
		}else{
			$cadena=sprintf("update categorias set nombre='%s',estatus='".$_POST['estatus']."' where idcategoria='%s' limit 1",mysql_escape_string($_POST['nombre']),mysql_escape_string($_POST['idcategoria']));
			mysql_query($cadena);
			$idcategoria=$_POST['idcategoria'];
		}
			mysql_query("update categorias_apuestas set estatus='0' where idcategoria='".$idcategoria."'");
			if($_POST['nregistros']>0){
				for($i=0;$i<$_POST['nregistros'];$i++){
					echo $idcategoria.' / '.$_POST['idapuesta'.$i].'<br>';
					if($_POST['idapuesta'.$i]){
						$existe=dame_datos("select idcategoria from categorias_apuestas where idcategoria='".$idcategoria."' and idapuesta='".$_POST['idapuesta'.$i]."' limit 1");
						if($existe){
							mysql_query("update categorias_apuestas set estatus='1' where idcategoria='".$idcategoria."' and idapuesta='".$_POST['idapuesta'.$i]."' limit 1")or die(" error al actualizar".mysql_error());
						}else{
							echo $idcategoria.' / '.$_POST['idapuesta'.$i];
							mysql_query("insert into categorias_apuestas() values('','".$idcategoria."','".$_POST['idapuesta'.$i]."','1')")or die(" error al insertar".mysql_error());
						}
					}
				}
			}
			//echo $_POST['nregistros'];
			//exit;
?>