<?Php
	if($_GET['equipo']){
		include("conexion.php");
		$tablas=array(
			"equipos"=>array("campoid"=>"idequipo"),
			"ligas"=>array("campoid"=>"idliga"),
			"categorias"=>array("campoid"=>"idcategoria"),
			"banqueros"=>array("campoid"=>"idbanquero"),
			"roster"=>array("campoid"=>"idroster"),
			"logros"=>array("campoid"=>"idlogro"),
			"tipo_apuestas"=>array("campoid"=>"idtipo_apuesta"),
			"apuestas"=>array("campoid"=>"idapuesta"));		
			if($_GET['deshab']){
				mysql_query("update ".$_GET['equipo']." set estatus='0' where ".$tablas[$_GET['equipo']]['campoid']."='".$_GET['id']."'");
			}else{
				mysql_query("update ".$_GET['equipo']." set estatus='1' where ".$tablas[$_GET['equipo']]['campoid']."='".$_GET['id']."'");
			}
	}
	//exit;
	header("location: ../".$_GET['redir']);
?>