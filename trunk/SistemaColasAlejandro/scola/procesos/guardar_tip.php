<?Php session_start();
	include("conexion.php");
	if($_POST['ido']){
		$ido=$_POST['ido'];
		$ex=2;
	}else{
		mysql_query("insert into tips(idtip,fecha,hora,idusuario) values('','".date('Y-m-d')."','".date('H:i:s')."','".$_SESSION['datos']['idusuario']."')");
		$ido=mysql_insert_id();
		$ex=1;
	}
	
	mysql_query("
		UPDATE 
			tips
		SET
			nota='".$_POST['nota']."',			
			estatus='".$_POST['estatus']."'
		WHERE
			idtip='".$ido."'	
		LIMIT
			1	
	");
	//exit;
?>

<script language="javascript">
	location.href='../add_tips.php?exito=<?Php echo $ex;?>';
</script>