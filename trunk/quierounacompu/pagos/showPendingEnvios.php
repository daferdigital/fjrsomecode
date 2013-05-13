<?php
include_once "../sis/classes/Constants.php";
include_once "../sis/classes/DBUtil.php";
include_once "../sis/classes/EnvioDAO.php";
include_once "../sis/classes/BitacoraDAO.php";

$query = "SELECT id, detalle_compra"
." FROM envios"
." WHERE ci_rif='".$_GET["ciRif"]."'"
." AND id_status_actual <> 6";

$result = DBUtil::executeSelect($query);
if(count($result) == 0){
?>
	<div width="550px;" style="width: 550px">
		<h3>Disculpe, usted no tiene ningun envio de productos en proceso</h3>
	</div>
<?php
} else {
	//tenemos productos, mostramos el listado
	foreach ($result as $envio){
?>
		<table id="detalleProductosComprados" class="Estilo17">
	    	<?php echo $envio["detalle_compra"];?>
	    	<tr>
				<td colspan="3">
					<input type="button" value="Actualizar" onclick="actualizarEnvio(<?php echo $envio["id"];?>)"/>
				</td>
			</tr>
	    </table>
	    
	    <br />
	    <br />
<?php
	}
}
?>
