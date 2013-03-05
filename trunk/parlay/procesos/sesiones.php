<?Php session_start(); //print_r($_SESSION);//echo session_id();?>
<?Php
	include("procesos/conexion.php");
	if($_GET['salir']=='logout'){
		$_SESSION["autentificado"]='';
		$_SESSION["login_user"]='';
		session_destroy();
		?><script language="javascript">location.href='index.php';</script><?Php
	}
	//echo $_SERVER['PHP_SELF']; exit;///vemex/index.php
	//if($_SESSION["login_user"]=='' && $_SERVER['PHP_SELF']!='/usuario/enrony_west/parley/index.php'){
	//if($_SESSION["login_user"]=='' && $_SERVER['PHP_SELF']!='/parlay/index.php'){	
	if($_SESSION["login_user"]=='' && $_SERVER['PHP_SELF']!='/parlay/index.php'){	
		?><script language="javascript">location.href='index.php';</script><?Php
	}
	//echo '<hr>'.$_SESSION["login_user"].'<hr>';
	
	
	
?>