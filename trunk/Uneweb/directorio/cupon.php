<?php
session_start();
error_reporting(0);

include("PHP/Clases/oDp_Paginador.php");
include("PHP/Funciones/funciones.php");

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cupones</title>
	<script type="text/javascript" src="JS/efectos.js"></script>
	<script type="text/javascript" src="JS/validaciones.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/css.css" media="all">
</head>
<body>';

$con=new oDp_paginador();

$con->oInsert("cu_clickcupon");
$con->oData_in("clc_fechahora", date("Y-m-d H:i:s"));
$con->oData_in("clc_ip", $_SERVER['REMOTE_ADDR']);
$con->oData_in("clc_idcup", $_REQUEST['id']);
$con->oData_in("clc_sessionid", session_id());
$con->oCommit();

$con->oConsulta("cu_cupones as A, cu_cliente as B", "B.cli_id=A.cup_idcliente AND A.cup_id='".$_REQUEST['id']."'");
$row=$con->oDatosarray();
$con->oLimpiaconsulta();



echo '<table width="930">
	<tr>
		<td class="td_blanco" height="50" colspan="2" align="center">';
			if(!$_SESSION['VIS_logeo'])
			{
				echo '<form action="validar.php" method="post">
					&nbsp;<img src="Images/candado.JPG" border="0">&nbsp;
					<b>Correo</b>&nbsp;<input type="text" name="correo">
					<b>Clave</b>&nbsp;<input type="password" name="clave">
					&nbsp;&nbsp;<input type="button" value="Enviar" onclick="javascript:index(this.form);">
					&nbsp;&nbsp;&nbsp;&nbsp;		
					<a href="otros.php?id=1">Usuarios No registrados</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="otros.php?id=2">¿Olvid&oacute; su clave?</a>
				</form>';
			}
			else
			{
				echo 'Bienvenido '.$_SESSION['VIS_nombre'].'
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="salir.php">Salir</a>';

				/////////CONSULTA PARA AVG DE CALIFICACIONES EN EL CUPON////////
				$con->oEjecutar("SELECT AVG(sol_calificacion) as promedio, COUNT(*) as numero FROM cu_solicitud WHERE sol_idcup='".$_REQUEST['id']."' AND sol_calificacion IS NOT NULL");
				$data=$con->oDatosarray();
				$con->oLimpiaconsulta();
			}
		echo '</td>
	</tr>
	<tr height="230">
		<td width="230"><a href="'.$row['cli_link1'].'"><img src="'.$row['cli_banner1'].'" width="230" height="230" border="0"></a></td>
		<td width="700" class="td_blanco"  align="justify" style="padding:10px 10px 10px 10px;">
			<img src="'.$row['cli_logo'].'" border="0" width="230" height="83"><br /><br /><br />
			<b>Información de la Empresa</b><br><br>'.acentos($row['cup_descripcion']).'<br><br /><br />
		</td>
	</tr>
	<tr>
		<td height="230"><a href="'.$row['cli_link2'].'"><img src="'.$row['cli_banner2'].'" width="230" height="230" border="0"></a></td>
		<td rowspan="2">
			<b>CUPON DE LA EMPRESA</b><br /><br />
			<img src="'.$row['cup_ruta'].'" border="0" width="690" height="350">
		</td>
	</tr>
	<tr>
		<td height="230"><a href="'.$row['cli_link3'].'"><img src="'.$row['cli_banner3'].'" width="230" height="230" border="0"></a></td>
	</tr>
	<tr height="230">
		<td><a href="'.$row['cli_link4'].'"><img src="'.$row['cli_banner4'].'" width="230" height="230" border="0"></a></td>
		<td valign="top">					
			<table cellpadding="3" cellspacing="3">
				<tr>
					<td class="td_sb">
						<a href="imprimir.php?id=3&ruta='.$row['cup_ruta'].'&cup='.$row['cup_id'].'"><img src="Images/printer.png" width="80" height="80"></a>'; 					
						if($row['cli_paginaweb'] && $_SESSION['VIS_logeo']) 
						echo '<a href="http://'.$row['cli_paginaweb'].'" target="_blank"><img src="Images/icono_web_corporativa.png" width="71" height="85" /></a><br><br>';
						
						echo '<table cellspacing="0" cellpadding="0">
							<tr>
								<td colspan="2" width="67" align="center" class="td_sb"><b>MALO</b></td>
								<td colspan="2" width="67" align="center" class="td_sb"><b>REGULAR</b></td>
								<td colspan="2" width="67" align="center" class="td_sb"><b>BUENO</b></td>
								<td colspan="2" width="67" align="center" class="td_sb"><b>EXCELENTE</b></td>
							</tr>
							<tr>
								<td width="33" bgcolor="FF0000">&nbsp;</td>
								<td width="33" bgcolor="FF9900">&nbsp;</td>
								<td width="33" bgcolor="ECE562">&nbsp;</td>
								<td width="33" bgcolor="FFFF00">&nbsp;</td>
								<td width="33" bgcolor="CEEC98">&nbsp;</td>
								<td width="33" bgcolor="B0E57F">&nbsp;</td>
								<td width="33" bgcolor="8CE56D">&nbsp;</td>
								<td width="33" bgcolor="34DD27">&nbsp;</td>
							</tr>
							<tr>
								<td width="33" align="center"><a href="operaciones.php?id=5&cup='.$_REQUEST['id'].'&p=1">1</a></td>
								<td width="33" align="center"><a href="operaciones.php?id=5&cup='.$_REQUEST['id'].'&p=2">2</a></td>
								<td width="33" align="center"><a href="operaciones.php?id=5&cup='.$_REQUEST['id'].'&p=3">3</a></td>
								<td width="33" align="center"><a href="operaciones.php?id=5&cup='.$_REQUEST['id'].'&p=4">4</a></td>
								<td width="33" align="center"><a href="operaciones.php?id=5&cup='.$_REQUEST['id'].'&p=5">5</a></td>
								<td width="33" align="center"><a href="operaciones.php?id=5&cup='.$_REQUEST['id'].'&p=6">6</a></td>
								<td width="33" align="center"><a href="operaciones.php?id=5&cup='.$_REQUEST['id'].'&p=7">7</a></td>
								<td width="33" align="center"><a href="operaciones.php?id=5&cup='.$_REQUEST['id'].'&p=8">8</a></td>
							</tr>
						</table>
						<br><br>
						<b>Promedio:</b>&nbsp;';
						if($data['promedio']) echo $data['promedio'];
						else echo 0;
						echo '<br>
						<b>N&uacute;mero de Calificaciones:</b>&nbsp;';
						if($data['numero']) echo $data['numero'];
						else echo 0;
					echo '</td>
					<td class="td_sb">
						<form action="operaciones.php" method="post">
						<table align="center">
							<tr>
								<td class="td_blanco"><b>'.acentos('Fecha y Hora').'</b></td>
								<td align="center">'.date("d/m/Y h:m:s a").'</td>
							</tr>
							<tr>
								<td class="td_blanco"><b>'.acentos('Solicitud').'</b></td>
								<td align="center">
									Servicio <input type="radio" name="tipo" value="1">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Pregunta <input type="radio" name="tipo" value="2">
									</td>
							</tr>
							<tr>
								<td class="td_blanco"><b>'.acentos('Comentario').'</b></td>
								<td><textarea name="comentario" rows="7" cols="34"></textarea></td>
								<input type="hidden" name="correos" value="'.$row['cli_correos'].'">
								<input type="hidden" name="id_cliente" value="'.$row['cli_id'].'">
							</tr>
							<tr>
								<input type="hidden" name="id" value="4">
								<input type="hidden" name="cupon" value="'.$_GET['id'].'">
								<td colspan="2" align="center">
									<input type="button" value="Enviar" onclick="javascript:val_cupon(this.form);">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="reset" value="Borrar">
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>';
		echo '</td>
	</tr>
</table>	
</body>
</html>';

?>