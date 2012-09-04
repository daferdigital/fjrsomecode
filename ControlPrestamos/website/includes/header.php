<?php 
	include_once 'constants.php';
	include_once 'includes/sessionOperations.php';
	checkSessionInfo();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" >
<html>
	<head>
		<title>.:: Sistema de Control de Prestamos ::.</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		
		<link rel="stylesheet" type="text/css" href="<?php echo $ROOT_SITE_URL?>/css/style.css"/>
		<link rel="SHORTCUT ICON" href="<?php echo $ROOT_SITE_URL?>/favicon.ico" />
		<script type="text/javascript" src="<?php echo $ROOT_SITE_URL?>/js/siteScripts.js"></script>
	</head>
	
	<body>
		<table class="backGroundWhite" width="1200px" cellpadding="0" cellspacing="0" border="0">
			<tr>
			    <td align="right" width="40%">
			        <a href="<?php echo $ROOT_SITE_URL?>"><img src="<?php echo $ROOT_SITE_URL?>/images/header.jpg"></img></a>
			    </td>
			    <td width="25%">
			    	<h4>
			    		Sistema <br /> <br />
			    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de Control<br /><br /> 
			    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;de Prestamos
			    	</h4>
			    </td>
			</tr>
		</table>
		
		<table class="backGroundWhite" width="1200px" cellpadding="0" cellspacing="0">
		<tr>
