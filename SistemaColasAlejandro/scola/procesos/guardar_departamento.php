<?Php
	include("conexion.php");
	if($_POST['ido']){
		$ido=$_POST['ido'];
		$ex=2;
	}else{
		mysql_query("insert into departamentos(iddepartamento) values('')");
		$ido=mysql_insert_id();
		mysql_query("insert into tickets_encabezados() values('','".$ido."','50',CURDATE(),'1')");
		$ex=1;
	}
	
	mysql_query("
		UPDATE departamentos SET
			descripcion='".$_POST['descripcion']."',
			tickets_disponibles='50',
			estatus='".$_POST['estatus']."'
		WHERE
			iddepartamento='".$ido."'	
		LIMIT
			1	
	");
	
	switch($ex){
		case '1':
			for($i=0;$i<100;$i++){
				mysql_query("insert into taquillas() values('','".$ido."','".$_POST['desc_taq'][$i]."','1')");
				$idt=mysql_insert_id();
				mysql_query("insert into operadores_taquillas() values('','".$_POST['operador'][$i]."','".$idt."','1')");
			}
		break;
		case '2':
			for($i=0;$i<100;$i++){
				mysql_query("UPDATE taquillas SET descripcion='".$_POST['desc_taq'][$i]."' where idtaquilla='".$_POST['taquilla'][$i]."' limit 1");				
				if($_POST['operador'][$i])
					mysql_query("UPDATE operadores_taquillas SET idoperador='".$_POST['operador'][$i]."' where idtaquilla='".$_POST['taquilla'][$i]."' limit 1");
			}
		break;
	}
	
	//exit;
?>

<script language="javascript">
	location.href='../add_departamentos.php?exito=<?Php echo $ex;?>&ido=<?Php echo $ido;?>';
</script>