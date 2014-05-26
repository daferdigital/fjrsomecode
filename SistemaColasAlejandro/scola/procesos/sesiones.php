<?Php session_start(); //print_r($_SESSION);//echo session_id();?>
<?Php
		
	include("procesos/conexion.php");
	if($_GET['salir']=='logout'){
		$_SESSION["autentificado"]='';
		$_SESSION["login_user"]='';
		session_destroy();
		?><script language="javascript">location.href='index.php';</script><?Php
	}
	if($_SESSION["login_user"]=='' && $_SERVER['PHP_SELF']!='/scola/index.php'){	
		?><script language="javascript">location.href='index.php';</script><?Php
	}

	
	
?>