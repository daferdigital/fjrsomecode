<?php session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Servicios</title>
	<style type="text/css">
	<!--
		.txt1{
			font-family:Arial, Helvetica, sans-serif;
			font-size:12px;
			font-weight:bold;
		}
		.txt2{
			font-family:Arial, Helvetica, sans-serif;
			font-size:12px;
		}
	-->
	</style>
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
	<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
	<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
	<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		<?php include ("scripts/ubicaciones.php");?>
	</script>
	<script type="text/javascript" src="scripts/validaciones.js"></script>
</head>
<body>

<?php 
	include "conexion.php";
	if(isset($_REQUEST['codServ']) && isset($_REQUEST['calValue'])){
		$query = "UPDATE servicio_contactado SET calificacion_recibida = ".$_REQUEST['calValue']
		." WHERE id = ".$_REQUEST['codServ'];
		mysql_query($query);
		
		if(! mysql_error()){
			echo '<script language="javascript">alert("Su calificacion fue recibida."); window.close()</script>';
		}
	}
	
	if(! isset($_SESSION['loggedUser'])){
		echo '<script language="javascript">alert("Disculpe, antes de calificar debe ingresar al sistema.");  window.location="contacto.php?goto=qlfy"</script>';
	}else{
		$query = "SELECT * FROM servicio_contactado WHERE calificacion_recibida = -1 AND id_solicitante = ".$_SESSION['loggedUser']['id'];
		$result = mysql_query($query);
		
		if(mysql_num_rows($result) == 0){
			echo '<script language="javascript">alert("Ud. no tiene servicios pendientes por calificar");  window.location="contacto.php"</script>';
		}
		
		while($row = mysql_fetch_array($result)){
			//mostramos las calificaciones pendientes.
?>
	<table align="center">
		<tr>
			<td class="txt1" align="center">C&oacute;digo de solicitud</td>
			<td class="txt1" align="center">Calificaci&oacute;n a otorgar</td>
		</tr>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td>
				<table>
					<tr>
						<td align="center">MALO</td>
						<td align="center">REGULAR</td>
						<td align="center">BUENO</td>
						<td align="center">EXCELENTE</td>
					</tr>
					<tr>
						<td>
							<a href="calificacionesPendientes.php?codServ=<?php echo $row['id'];?>&calValue=1"><img style="text-decoration: none; border: 0px;" src="Images/p1.jpg" /></a>
							<a href="calificacionesPendientes.php?codServ=<?php echo $row['id'];?>&calValue=2"><img style="text-decoration: none; border: 0px;" src="Images/p2.jpg" /></a>
						</td>
						<td>
							<a href="calificacionesPendientes.php?codServ=<?php echo $row['id'];?>&calValue=3"><img style="text-decoration: none; border: 0px;" src="Images/p3.jpg" /></a>
							<a href="calificacionesPendientes.php?codServ=<?php echo $row['id'];?>&calValue=4"><img style="text-decoration: none; border: 0px;" src="Images/p4.jpg" /></a>
						</td>
						<td>
							<a href="calificacionesPendientes.php?codServ=<?php echo $row['id'];?>&calValue=5"><img style="text-decoration: none; border: 0px;" src="Images/p5.jpg" /></a>
							<a href="calificacionesPendientes.php?codServ=<?php echo $row['id'];?>&calValue=6"><img style="text-decoration: none; border: 0px;" src="Images/p6.jpg" /></a>
						</td>
						<td>
							<a href="calificacionesPendientes.php?codServ=<?php echo $row['id'];?>&calValue=7"><img style="text-decoration: none; border: 0px;" src="Images/p7.jpg" /></a>
							<a href="calificacionesPendientes.php?codServ=<?php echo $row['id'];?>&calValue=8"><img style="text-decoration: none; border: 0px;" src="Images/p8.jpg" /></a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<?php
		} //end while 
	} //end if
	
	mysql_close();
?>

</body>
</html>
