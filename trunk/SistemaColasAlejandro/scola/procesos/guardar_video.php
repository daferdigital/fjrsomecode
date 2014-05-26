<?Php session_start();
	include("conexion.php");
$malas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "Ñ", " ","¿","?","¡","!");
$reemplazalas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "", "", "", "", "");	
if($_FILES['video']['name']){
$tipo1=explode(".",$_FILES['video']['name']);

	// Tratar de guardar la foto /////////////////////////////////////////////////////////////////
if(($_FILES['video']['name'] != '')&&(strtolower($tipo1[1])=='swf' || strtolower($tipo1[1])=='swf'))
{
	//echo "entro"; exit;
$remember=$_FILES['video']['name'];
$remember=str_replace($malas,$reemplazalas,$remember);
$_FILES['video']['name']=$remember;

	// Verificamos si el directorio existe
	if(!is_dir("../swf/"))
		// si el directorio no existe lo trato de crear
		mkdir("../swf/", 0777);

	$uploadDir = '../swf/';
	$name_temp= "temp".$_FILES['video']['name'];
	$uploadFile = $uploadDir.$name_temp;
	//echo $uploadFile;
	move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile);
	
	/*
	$newFile=$uploadDir.$name_temp;
	$iError = 1;

	define("IMAGEN_NAME",$newFile);
	iPintaImagenRedimensionada($uploadFile, FALSE, 502, 0, IMAGETYPE_JPEG,1);
	$nombrefoto=$name_temp;
	$size = getimagesize($uploadDir.$name_temp);
	if($altoF<$size[1])$altoF=$size[1];
*/
}else{$nosubio = true;}
}
if($nosubio==''){	
	if($_POST['ido']){
		$ido=$_POST['ido'];
		$ex=2;
	}else{
		mysql_query("insert into videos(idvideo,fecha,hora,idusuario) values('','".date('Y-m-d')."','".date('H:i:s')."','".$_SESSION['datos']['idusuario']."')");
		$ido=mysql_insert_id();
		$ex=1;
	}

if($name_temp) $concat="descripcion='".$name_temp."',";
	
	mysql_query("
		UPDATE 
			videos
		SET
			$concat						
			estatus='".$_POST['estatus']."'
		WHERE
			idvideo='".$ido."'	
		LIMIT
			1	
	");
	//exit;
}else{
	$ex='no';
}
?>

<script language="javascript">
	location.href='../add_videos.php?exito=<?Php echo $ex;?>';
</script>