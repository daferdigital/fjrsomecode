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
$isAdv = 0;
if(isset($_GET["isAdv"])){
	$isAdv = $_GET["isAdv"];	
}
$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
$envioDTO = EnvioDAO::getEnvioInfo($recordId);

$statusEnvio = $envioDTO->getIdStatusActual();
$canEdit = false;

if($envioDTO->getIdStatusActual() == EnvioDAO::$COD_STATUS_NOTIFICADO){
	$canEdit = EnvioDAO::checkIfUserCanEdit($userDTO, Constants::$OPCION_EDICION_NOTIFICADOS);
}else if($envioDTO->getIdStatusActual() == EnvioDAO::$COD_STATUS_PAGO_NO_ENCONTRADO){
	$canEdit = EnvioDAO::checkIfUserCanEdit($userDTO, Constants::$OPCION_EDICION_PAGOS_NO_ENCONTRADOS);
}else if($envioDTO->getIdStatusActual() == EnvioDAO::$COD_STATUS_PRESUPUESTADO){
	$canEdit = EnvioDAO::checkIfUserCanEdit($userDTO, Constants::$OPCION_EDICION_PRESUPUESTADO);
}else if($envioDTO->getIdStatusActual() == EnvioDAO::$COD_STATUS_PAGO_CONFIRMADO){
	$canEdit = EnvioDAO::checkIfUserCanEdit($userDTO, Constants::$OPCION_EDICION_PAGOS_CONFIRMADOS);
}else if($envioDTO->getIdStatusActual() == EnvioDAO::$COD_STATUS_FACTURADO){
	$canEdit = EnvioDAO::checkIfUserCanEdit($userDTO, Constants::$OPCION_EDICION_FACTURADO);
}else if($envioDTO->getIdStatusActual() == EnvioDAO::$COD_STATUS_ENVIADO){
	$canEdit = EnvioDAO::checkIfUserCanEdit($userDTO, Constants::$OPCION_EDICION_ENVIADO);
}

BitacoraDAO::registrarComentario("Ingreso en pagina ajax para vizualizar envio[".$recordId."]");
BitacoraDAO::registrarComentario("El usuario ".($canEdit ? "" : "NO")." puede editar el envio[".$recordId."]");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
<div style="padding: 10px; width: 850px;" class="centered">
	<div id="tabs">
		<ul>
			<li><a href="#tabs-0">Datos del Cliente</a></li>
			<li><a href="#tabs-1">Datos del Pago</a></li>
			<li><a href="#tabs-2">Productos Comprados</a></li>
			<li><a href="#tabs-3">Datos del env&iacute;o</a></li>
			<li><a href="#tabs-4">Observaciones</a></li>
			<?php
			//si estamos frente a un envio en estatus enviado, o venimos de la busqueda avanzada
			//no podemos editar nada del registro
			if($statusEnvio != EnvioDAO::$COD_STATUS_ENVIADO && $isAdv != 1 && $canEdit){
			?>
			<li><a href="#tabs-5">Nuevo Status</a></li>
			<?php
			} 
			?>
		</ul>
		<br style="clear: both;" />
		<div id="tabs-0" style="background-color: white;">
			<table>
				<tr>
					<td>Nombre:</td>
					<td><?php echo $envioDTO->getNombreCompleto();?></td>
				</tr>
				<tr>
					<td>Seudonimo MercadoLibre:</td>
					<td><?php echo $envioDTO->getSeudonimoML();?></td>
				</tr>
				<tr>
					<td>C.I. RIF:</td>
					<td><?php echo $envioDTO->getCiRIF();?></td>
				</tr>
				<tr>
					<td>Correo:</td>
					<td><?php echo $envioDTO->getCorreo();?></td>
				</tr>
				<tr>
					<td>Tel&eacute;fonos:</td>
					<td><?php echo $envioDTO->getTlfCliente();?></td>
				</tr>
			</table>
		</div>
		<div id="tabs-1" style="background-color: white;">
			<table>
				<tr>
					<td>Banco Destino de los Fondos:</td>
					<td><?php echo $envioDTO->getDescBanco();?></td>
				</tr>
				<tr>
					<td>Banco Origen de los Fondos:</td>
					<td><?php echo $envioDTO->getDescBancoOrigen();?></td>
				</tr>
				<tr>
					<td>Medio de Pago:</td>
					<td><?php echo $envioDTO->getDescMedioPago();?></td>
				</tr>
				<tr>
					<td>Fecha del pago:</td>
					<td><?php echo $envioDTO->getFechaPago();?></td>
				</tr>
				<tr>
					<td>Nro. Comprobante:</td>
					<td><?php echo $envioDTO->getNumVoucher();?></td>
				</tr>
				<tr>
					<td>Monto:</td>
					<td><?php echo str_replace(".", ",", $envioDTO->getMontoPago());?></td>
				</tr>
				<?php
					$dir = "../comprobantes/".$envioDTO->getId();
					$url = "comprobantes/".$envioDTO->getId();
					$isFirst = true;
					
					if(file_exists($dir)){
						//este envio tiene relacionadas imagenes de los comprobantes de pago
						$files = scandir($dir);
						foreach ($files as $fileName){
							if($fileName != "." && $fileName != ".."){
				?>
								<tr>
									<td><?php echo ($isFirst ? "Comprobantes:" : "");?> </td>
									<td>
										<a href="#" onclick="openImagePopUp('<?php echo $url."/".$fileName;?>');">
											<?php echo $fileName;?>
										</a>
									</td>
								</tr>
				<?php
								$isFirst = false;
							}
						}
					}
				?>
			</table>
		</div>
		<div id="tabs-2" style="background-color: white;">
			<table id="detalleProductosComprados" class="Estilo17">
	        	<?php echo $envioDTO->getDetalleCompra();?>
	        </table>
		</div>
		<div id="tabs-3" style="background-color: white;">
			<table>
				<tr>
					<td>Destinatario:</td>
					<td><?php echo $envioDTO->getNombreDestinatario();?></td>
				</tr>
				<tr>
					<td>C&eacute;dula destinatario:</td>
					<td><?php echo $envioDTO->getCedulaDestinatario();?></td>
				</tr>
				<tr>
					<td>Compa&ntilde;ia de env&iacute;o:</td>
					<td><?php echo $envioDTO->getDescEmpresaEnvio();?></td>
				</tr>
				<tr>
					<td>Direcci&oacute;n:</td>
					<td><?php echo $envioDTO->getDireccionDestino();?></td>
				</tr>
				<tr>
					<td>Ciudad:</td>
					<td><?php echo $envioDTO->getCiudadDestino();?></td>
				</tr>
				<tr>
					<td>Estado:</td>
					<td><?php echo $envioDTO->getEstadoDestino();?></td>
				</tr>
				<tr>
					<td>Tlfs:</td>
					<td>
						<?php echo $envioDTO->getTlfCelularDestinatario();?>
						&nbsp;&nbsp;
						<?php echo $envioDTO->getTlfLocalDestinatario();?>
					</td>
				</tr>
				<tr>
					<td>Observaciones:</td>
					<td><?php echo $envioDTO->getObservacionesEnvio();?></td>
				</tr>
			</table>
		</div>
		<div id="tabs-4" style="background-color: white;">
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
		
		<?php
		//si estamos frente a un envio en estatus distinto a enviado, 
		//y no venimos de la busqueda avanzada
		//no podemos editar nada del registro
		if($statusEnvio != EnvioDAO::$COD_STATUS_ENVIADO && $isAdv != 1 && $canEdit){
		?>
		<div id="tabs-5" style="background-color: white;">
			<table>
				<tr>
					<td>Estatus Actual</td>
					<td><?php echo $envioDTO->getDescStatusActual();?></td>
				</tr>
				<tr>
					<td>Nuevo Estatus</td>
					<td>
					    <input type="hidden" name="idEnvio" id="idEnvio" value="<?php echo $envioDTO->getId();?>"/>
						<select name="newStatus" id="newStatus">
					<?php 
						$result = EnvioDAO::getAllSiguientesStatus($envioDTO->getIdStatusActual());
						foreach ($result as $row){
					?>
							<option value="<?php echo $row["id"]?>"><?php echo $row["descripcion"]?></option>
					<?php
						}
					?>
						</select>
					</td>
				</tr>
				<?php
					if($envioDTO->getIdStatusActual() == EnvioDAO::$COD_STATUS_FACTURADO){
						//si el status es facturado, el que sigue es enviado, debemos solicitar el
						//codigo del envio que nos indico la empresa de envio
						//y nombre de la empresa de envio 
				?>
					<tr>
						<td>C&oacute;digo. de env&iacute;o</td>
						<td>
							<input type="text" name="codEnvio" id="codEnvio"/>
							<span class="isMandatory" id="spanCodEnvio" style="display: none;">
				    			<br/>
				    			Disculpe debe indicar el c&oacute;digo real del env&iacute;o.
			    			</span>
						</td>
					</tr>
					<tr>
						<td>Compa&ntilde;ia de env&iacute;o</td>
						<td>
							<select name="ciaEnvio" id="ciaEnvio" class="Estilo11" style="FONT-SIZE: 10pt">
								<option value="-1">Seleccione</option>
								<?php 
			    					$query = "SELECT id, nombre "
			    					."FROM empresa_envio "
			    					."WHERE active='1' "
			    					."ORDER BY nombre";
			    					
			    					$results = DBUtil::executeSelect($query);
			    					foreach ($results as $row){
			    				?>
			    					<option value="<?php echo $row["id"];?>"><?php echo $row["nombre"];?></option>
			    				<?php
			    					}
			    				?>
							</select>
							<span class="isMandatory" id="spanCiaEnvio" style="display: none;">
				    			<br/>
				    			Disculpe debe indicar con que compa&ntilde;ia desea realizar el env&iacute;o.
			    			</span>
					</tr>
				<?php
					} 
				?>
				<?php
					if($envioDTO->getIdStatusActual() == EnvioDAO::$COD_STATUS_PRESUPUESTADO){
						//si el status es presupuestado, debemos almacenar el codigo de nuestra
						//factura interna 
				?>
					<tr>
						<td>Nro. de Factura</td>
						<td>
							<input type="text" name="codFactura" id="codFactura"/>
							<span class="isMandatory" id="spanCodFactura" style="display: none;">
				    			<br/>
				    			Disculpe debe indicar el c&oacute;digo de factura.
			    			</span>
						</td>
					</tr>
				<?php
					} 
				?>
				<tr>
					<td>Indique su Comentario</td>
					<td>
						<textarea rows="5" cols="30" name="newComment" id="newComment"></textarea>
						<div class="isMandatory" id="mandatoryComentario" style="display: none;">
							<br />
							Disculpe, debe indicar el comentario de manera obligatoria.
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="button" id="guardar" name="guardar" value="Actualizar" onclick="javascript:actualizarEnvio('guardar',<?php echo $envioDTO->getIdStatusActual()?>)"/>
					</td>
				</tr>
			</table>
		</div>
		<?php
		} 
		?>
	</div>
</div>
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
</script>
</body>
</html>