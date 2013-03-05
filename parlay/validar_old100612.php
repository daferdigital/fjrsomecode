<?Php 
session_start();
session_regenerate_id();
$sid = session_id();
session_write_close();
session_id($sid);
session_start();

$_SESSION["idsesion"]= session_id($sid);

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
				
				//GENERO TICKETS VENCIDOS
				calcula_ticket_vencidos(date('Y-m-d'));
				
				$_SESSION["autentificado"]= "SI";
				$_SESSION["login_user"]= $_POST['usuario'];
				$_SESSION['nombre_usuario']=$var['nombre'].' '.$var['apellido'];	
				$_SESSION["usuario_id"]=$var['idusuario'];
				$_SESSION["tipo_usr"]=$var['tipo'];
				switch($tabla){
					case 'usuario':
						$_SESSION["tipo"]= 'Adminitradores';
						$_SESSION["perfil"]= '1';
						$_SESSION['nombre_tabla']='usuario';
						$_SESSION['nombre_idtabla']='idusuario';			
					break;
					case 'banqueros':
						$_SESSION["tipo"]= 'Banqueros';
						$_SESSION["perfil"]= '2';
						$_SESSION['nombre_tabla']='banqueros';
						$_SESSION['nombre_idtabla']='idbanquero';
					break;
					case 'vista_intermediarios':
						$_SESSION["tipo"]= 'Intermediarios';
						$_SESSION["perfil"]= '3';
						$_SESSION['nombre_tabla']='intermediarios';
						$_SESSION['nombre_idtabla']='idintermediario';
					break;
					case 'vista_taquillas':
						$_SESSION["tipo"]= 'Taquillas';
						$_SESSION["perfil"]= '4';
						$_SESSION['nombre_tabla']='taquillas';
						$_SESSION['nombre_idtabla']='idtaquilla';
						//calculo la cantidad de jugadas por logro 1,2,3,4,5,6,7,8,9,10 para una determinada taquilla
						jugadas_cantidad();
					break;
				}
				return 'no';
			}else{
				return '';
			}
	}
	$tablas_logueo=array('usuario'=>'usuario','banqueros'=>'usuario','vista_intermediarios'=>'usuario','vista_taquillas'=>'usuario');
		foreach($tablas_logueo as $tabla=>$campo_usuario){
			if($no==''){
				$no=logueo_usuario(CStringSQL(sprintf("select * from $tabla where $campo_usuario='%s' and clave='%s'", mysql_real_escape_string($u),mysql_real_escape_string($c))),$tabla);
			}
		}
		//exit;
	if ($no){ //QUIERE DECIR SI LOGUEO
		control_logueo($_POST['usuario']);		
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
