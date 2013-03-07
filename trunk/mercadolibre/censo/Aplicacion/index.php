<?php
include_once("classDBAndUser.php");
if(isset($_GET['logOut'])) User::logOut();  

$isLogin=false;
$isAdministrator=false;

if(isset($_POST['user']) && isset($_POST['pass'])){

	if(User::validpass($_POST['user'],$_POST['pass'])){
		User::login($_POST['user'],$_POST['pass']);
		if (!User::isAdmin()){
			$eMsj = "Esta cuenta no esta autorizada para utilizar esta seccion";
			User::logOut();  			
		}else {
			$isLogin=true;
			$isAdministrator=true;
		}
	}
    else  $eMsj = "Usuario o contraseña invalida"; 
}
if (User::authSession())
{
	$isLogin=true;
    if (User::isAdmin())
	{
		$isAdministrator=true;
	}
}   
$isAccess=  $isLogin &&  $isAdministrator;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<head>
		<meta http-equiv="content-type"	content="text/html; charset=UTF-8" />		
		<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/redmond/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/ajaxfileupload.js"></script>	
		<script type="text/javascript" src="js/functions.js"></script>
		<title>Censo</title>
	</head>
	<body onload='$("button").button();$("input, select").addClass( "ui-corner-all" );'>
		<div id="div_oculto" style="display: none;"></div>
		<div id="overlay" style="display: none;"></div>
		<div id="loadajax" style="display: none;"><img width="20" src="images/ajax.gif" alt="Loading..." /><br />Loading...</div>
		<div id="barraHead" <?php if(!$isAccess) echo "style='padding-bottom: 500px;padding-top: 200px;'" ?>>
			<div class="wrap" <?php if(!$isAccess) echo "style='width: 500px;'" ?>>
				<br /><br /><table width="100%">
					<tr>
						<td width="180"><img src="images/logo.png" alt="Censo" /></td>
						<td><?php if(!$isAccess) echo "<img src='images/sepLogin.jpg' alt='Sep' />" ?></td>
						<td <?php if(!$isAccess) echo "width='250'" ?>><?php 
						
						if(!$isAccess) {
							?>
							<form method="post" action="index.php"> 
							<table width="100%">
								<tr>
									<td style="padding:5px;color:#294977;font-size:14px;font-weight: bold;" align="left">Usuario</td><td><input style="font-size:14px;width:100%" name="user" type="text" /></td>
								</tr>
								<tr>
									<td style="padding:5px;color:#294977;font-size:14px;font-weight: bold;" align="left">Contraseña</td><td><input style="font-size:14px;width:100%" name="pass" type="password" /></td>
								</tr>
								<?php if(isset($eMsj)){ ?>
								<tr>
									<td></td><td  class="error" style="padding:5px;"><?php echo $eMsj; ?></td>
								</tr>
								<?php } ?>
								<tr>
									<td></td><td align="right"><button type="submit">Enviar</button></td>
								</tr>
							</table>
							</form> 
							<?php
						}						
						
						
						?></td>
					</tr>
				</table>
			</div>
		</div><br /><br />
<?php if($isAccess){ ?>
		<div id="content2">
			<div class="wrap"> 
				<table width="100%">
					<tr>
						<td width="150" valign="top">
							<b>Menu</b><br /><br /><hr /><br />
							<a href="index.php?s=adminEncuestas">Encuestas</a>
							<br />
							<a href="index.php?s=adminItemsEncuesta">Preguntas de Encuestas</a>
							<br /><br /><hr /><br />
							<a href="index.php?s=adminEstados">Estados</a><br /><br />
							<a href="index.php?s=adminMunicipios">Municipios</a><br /><br />
							<a href="index.php?s=adminParroquias">Parroquias</a>
							<br /><br /><hr /><br />
							<a href="index.php?s=adminUser">Usuarios</a><br /><br />
							<a href="index.php?logOut">Logout</a>
						</td>
						<td align="left" valign="top">
						<div id="div_listar"></div>
						<?php if($_GET["s"]){?> <script type="text/javascript">fn_listar('<?php echo $_GET["s"]; ?>');</script><?php } ?> 
						</td>
					</tr> 
				</table>
			</div>
		</div>
		
		 <?php } ?>
		<div id="barraFoot">
			<div class="wrap">
				<table width="100%"><tr><td width="100%" style="color: #fff;text-align:left;font-size:10px"></td><td></td></tr></table>
			</div>
		</div>
	</body>	
</html>