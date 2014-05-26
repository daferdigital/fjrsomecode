<?Php session_start();
//print_r($_SESSION);
	include("procesos/conexion.php");
	
	if(!function_exists('CStringSQL')){
		function CStringSQL($string) {
			if (get_magic_quotes_gpc()) {
				return stripslashes($string) ;
			} else {
				return  $string ;
			}
		}
	}
	
	$u=$_POST['usuario'];
	$c=$_POST['clave'];
	
	function logueo_usuario($select,$tabla){
		//echo $select;
		 $query=mysql_query($select)or die(mysql_error());
			if(mysql_num_rows($query)>0){
				$var=mysql_fetch_assoc($query);
				$_SESSION['datos']=$var;				
				
				$_SESSION["autentificado"]= "SI";
				$_SESSION["login_user"]= $_POST['usuario'];
				$_SESSION['nombre_usuario']=$var['nombre'].' '.$var['apellido'];				
				switch($tabla){
					case 'usuarios':
						$_SESSION["tipo"]= 'Adminitradores';
						$_SESSION["perfil"]= '1';
					break;
					case 'vista_operadores_taquillas':
						$_SESSION["tipo"]= 'Operadores';
						$_SESSION["perfil"]= '2';
					break;
					case 'terminales':
						$_SESSION["tipo"]= 'Terminales';
						$_SESSION["perfil"]= '3';
					break;
					
				}
				return 'no';
			}else{
				return '';
			}
	}
	//$tablas_logueo=array('usuarios'=>'usuario','banqueros'=>'usuario','vista_intermediarios'=>'usuario','vista_taquillas'=>'usuario');
	$tablas_logueo=array('usuarios'=>'usuario','vista_operadores_taquillas'=>'usuario','terminales'=>'usuario');
		foreach($tablas_logueo as $tabla=>$campo_usuario){
			if($no==''){
				$no=logueo_usuario(CStringSQL(sprintf("select * from $tabla where $campo_usuario='%s' and clave='%s' and estatus='1'", mysql_real_escape_string($u),mysql_real_escape_string($c))),$tabla);
			}
		}
		//exit;
	if ($no){ //QUIERE DECIR SI LOGUEO
		control_logueo($_POST['usuario']);
		
		$siticket=dame_datos("select * from tickets_encabezados where fecha=CURDATE() and estatus='1'");
		if(!$siticket){
			$queryd=mysql_query("select iddepartamento,tickets_disponibles from departamentos");
			if(mysql_num_rows($queryd)>0){
				while($vard=mysql_fetch_assoc($queryd)){
					mysql_query("insert into tickets_encabezados() values('','".$vard['iddepartamento']."','".$vard['tickets_disponibles']."',CURDATE(),'1')");
				}
			}
		}
			
		
		header('location: index.php');
	}
	else {
		if($_SESSION['veces']){
			$_SESSION['veces']++;
		}else{
			$_SESSION['veces']=2;
		}
		?><script languaje='javascript'>location.href='index.php';</script><?Php
	}
	
	
	
?>
