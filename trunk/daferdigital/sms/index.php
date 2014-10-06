<?php 
include_once './classes/Constants.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Envio de SMS's</title>
		<link rel="stylesheet" type="text/css" href="./css/site.css" />
		<link rel="stylesheet" type="text/css" href="./css/jquerycssmenu.css" />
		
		<script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="./js/jquerycssmenu.js"></script>
	</head>
	<body>
		<table class="mainTable">
			<tr>
				<td>
					<img src="./images/header.png" alt="header" />
				</td>
			</tr>
			<tr>
				<td align="right">
					<?php include_once "./includes/menus.php";?>
				</td>
				<td align="right" width="200px">
					<span class="welcomeText"> 
		  				Bienvenido 
		  				<?php 
		  					//echo $usuarioDTO->getNombreCompleto();
		  				?>
		  			</span>
		  			<a href="doLogout.php" style="display: inline-block;" title="Cerrar sesion">
		  					<img border="0" src="images/logout.png" />
		  			</a>
		  		</td>
		  	</tr>
		</table>
	</body>
</html>
