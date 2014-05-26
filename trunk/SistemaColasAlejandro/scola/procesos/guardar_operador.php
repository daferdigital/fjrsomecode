<?Php
	include("conexion.php");
	if($_POST['ido']){
		$ido=$_POST['ido'];
		$ex=2;
	}else{
		mysql_query("insert into operadores(idoperador) values('')");
		$ido=mysql_insert_id();
		$ex=1;
	}
	
	mysql_query("
		UPDATE 
			operadores
		SET
			cedula='".$_POST['cedula']."',
			nombre='".$_POST['nombre']."',
			telefono='".$_POST['telefono']."',
			fecha_nacimiento='".$_POST['fecha_nacimiento']."',
			sexo='".$_POST['sexo']."',
			email='".$_POST['email']."',
			direccion='".$_POST['direccion']."',
			usuario='".$_POST['usuario']."',
			clave='".$_POST['clave']."',
			nivel='2',
			estatus='".$_POST['estatus']."'
		WHERE
			idoperador='".$ido."'	
		LIMIT
			1	
	");
	//exit;
?>

<script language="javascript">
	location.href='../add_operadores.php?exito=<?Php echo $ex;?>';
</script>