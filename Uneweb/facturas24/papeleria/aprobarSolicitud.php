<?php 
	session_start();
	$_SESSION["tipo"] = $_POST["tipo"];
	$_SESSION["contenido"] = $_POST["contenido"];
	$_SESSION["cantidad"] = $_POST["cantidad"];
	if(isset($_FILES["artFile"])){
		copy($_FILES["artFile"]["tmp_name"], "./artFiles/".$_FILES["artFile"]["name"]);
		$_SESSION["artFile"] = $_FILES["artFile"]["name"];
	}
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
				MUY IMPORTANTE
			</td>
		</tr>
		<tr align="justify">
			<td>
				<p align="justify" style="width: 90%">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Estimado cliente esta es su responsabilidad, revise cuidadosamente todos los detalles: 
					Nombre,  Dirección, RIF, N&deg; de Tel&eacute;fono, E-mail,  N&deg; de Control,  
					N&deg; de documento, Colores  del arte, Tama&ntilde;o, Letra,  
					y si el formato escogido es de su total agrado. <a href="#" onclick="openPopUp('detallesSolicitud.php');">(Ver Datos del Pedido)</a>
				</p>
				<br />
				<p align="justify" style="width: 90%"> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Una vez revisado  el arte por el cliente, favor elija la opción "Aprobar"  
					y coloque su C.I.; Despu&eacute;s de ser aprobado el arte La Empresa 
					<b>LITHO COPY, C.A.</b> y su marca <b>Facturas24.com</b> no se hace responsable 
					por datos mal suministrados y/o datos mal corregidos que aparezcan en el documento enviado. 
					<b>De ser as&iacute; el cliente asumir&aacute; el costo total por reimpresi&oacute;n.</b>
				</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<form action="registrarSolicitud.php" method="post"	onsubmit="return validateRegistro(this);" >
					<table width="60%" align="center">
						<tr>
							<td valign="top">Persona de Contacto: </td>
							<td>
								<input type="text" name="personaContacto" id="personaContacto" />
								<div id="mandatoryPersonaContacto" class="isMandatory" style="display: none;">
									Disculpe, debe indicar el nombre de la persona de contacto.
								</div>
							</td>
						</tr>
						<tr>
							<td valign="top">Correo: </td>
							<td>
								<input type="text" name="correoContacto" id="correoContacto" />
								<div id="mandatoryCorreoContacto" class="isMandatory" style="display: none;">
									Disculpe, debe indicar el correo de la persona de contacto.
								</div>
							</td>
						</tr>
						<tr>
							<td valign="top">C.I.: </td>
							<td>
								<input type="text" name="cedulaContacto" id="cedulaContacto" />
								<div id="mandatoryCedulaContacto" class="isMandatory" style="display: none;">
									Disculpe, debe indicar la c&eacute;dula de la persona de contacto.
								</div>
							</td>
						</tr>
						<tr>
							<td valign="top">Tel&eacute;fono: </td>
							<td>
								<input type="text" name="telefonoContacto" id="telefonoContacto" />
								<div id="mandatoryTelefonoContacto" class="isMandatory" style="display: none;">
									Disculpe, debe indicar el telefono de la persona de contacto.
								</div>
							</td>
						</tr>
						<tr>
							<td align="center">
								<input type="submit" value="Aprobar">
							</td>
							<td align="center">
								<input type="button" value="Rechazar">
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>