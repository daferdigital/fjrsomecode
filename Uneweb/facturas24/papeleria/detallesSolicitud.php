<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  	<title></title>
  	<link rel="stylesheet" href="css/smoothness/jquery-ui.css" />
  	<link rel="stylesheet" href="css/papeleria.css" />
  	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
  	<script type="text/javascript" src="js/jquery-ui.js"></script>
  	<script type="text/javascript" src="js/papeleria.js"></script>
</head>
<body>
	<table style="width: 50%; margin-left:auto; margin-right: auto; border-color:#C0504D; border-width: 2px; border-style: solid;">
		<tr align="center">
			<td style="padding: 10px; color: red; font-size: 18px; font-weight: bold;" >
				Detalles del pedido solicitado
			</td>
		</tr>
		<tr align="justify">
			<td>
				Tipo de Trabajo: <?php echo $_SESSION["tipo"];?>
			</td>
		</tr>
		<tr align="justify">
			<td>
				Contenido: <?php echo $_SESSION["contenido"];?>
			</td>
		</tr>
		<tr align="justify">
			<td>
				Cantidad: <?php echo $_SESSION["cantidad"];?>
			</td>
		</tr>
		<tr align="justify">
			<td>
				Arte:
				<img width="700px" height="400px" src="<?php echo "./artFiles/".$_SESSION["artFile"];?>"/>
			</td>
		</tr>
	</table>
</body>
</html>