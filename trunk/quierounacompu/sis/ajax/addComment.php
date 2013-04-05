<?php
include_once '../classes/Constants.php';
include_once '../classes/DBUtil.php';
include_once '../classes/PageAccess.php';
include_once '../classes/BitacoraDAO.php';
include_once '../classes/ModuloDAO.php';
include_once '../classes/EnvioDAO.php';
include_once '../classes/EnvioDTO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../includes/session.php';

$recordId = $_GET["id"];
$envioDTO = EnvioDAO::getEnvioInfo($recordId);

$statusEnvio = $envioDTO->getIdStatusActual();

BitacoraDAO::registrarComentario("Ingreso en pagina ajax para comentar el envio[".$recordId."]");
BitacoraDAO::registrarComentario("El usuario puede comentar el envio[".$recordId."]");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<div style="padding: 10px; width: 850px;" class="centered">
	<input type="hidden" name="idEnvio" id="idEnvio" value="<?php echo $envioDTO->getId();?>"/>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Observaciones</a></li>
			<li><a href="#tabs-2">Nuevo Comentario</a></li>
		</ul>
		<br style="clear: both;" />
		<div id="tabs-1" style="background-color: white;">
			<table>
				<tr>
					<td>Comentarios anteriores</td>
					<td>
						<div style="width: 100%; height: 250px; overflow: scroll; font-size: 12px;">
							<?php 
								$result = EnvioDAO::getComentariosEnvio($envioDTO->getId());
								foreach ($result as $row){
							?>
									<span style="width: 15%"><?php echo $row["nombre"] === NULL ? "Comprador" : $row["nombre"]." ".$row["apellido"]?></span>
									en la fecha
									<span style="width: 15%"><?php echo $row["fecha_comentario"]?>: </span>
									<span style="width: 65%"><b><?php echo $row["comentario"]?></b></span>
									<br />
							<?php
								}
							?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div id="tabs-2" style="background-color: white;">
			<table>
				<tr>
					<td>Indique su Comentario</td>
					<td>
						<textarea rows="5" cols="30" name="newComment" id="newComment"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="button" name="guardar" value="Comentar" onclick="javascript:comentarEnvio()"/>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
</script>
</body>
</html>