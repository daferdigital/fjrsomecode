<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("classes/DBUtil.php");
include_once("includes/header.php");
?>

<div class="seccionTitle">
	Crear Taquilla
</div>

<div class="seccionDetail">
<?php
	if(isset($_SESSION[Constants::$KEY_MESSAGE_OPERATION])){
?>
		<h3>
			<?php 
				echo $_SESSION[Constants::$KEY_MESSAGE_OPERATION];
				unset($_SESSION[Constants::$KEY_MESSAGE_OPERATION]);
			?>
		</h3>
<?php	
	} 
?>
<form action="formProcess/storeTaquilla.php" method="post">
    <table class="borderCollapse">
    	<tr>
    		<td>Sub-Unidad:</td>
    		<td>
    			<select name="idSubDpto">
    				<option value="0"> -- </option>
    				<?php
    					$query =  "SELECT sd.id, d.nombre AS dpto, sd.nombre";
    					$query .= " FROM departamentos d, sub_departamento sd";
    					$query .= " WHERE d.id = sd.id_departamento";
    					$query .= " AND d.activo =  '1'";
    					$query .= " AND sd.activo =  '1'";
    					$query .= " ORDER BY LOWER( d.nombre ) , LOWER( sd.nombre ) ";
    					
    					$rows = DBUtil::executeSelect($query);
    					foreach ($rows as $row) {
    				?>
    						<option value="<?php echo $row["id"];?>"><?php echo $row["dpto"]." - ".$row["nombre"];?></option>
    				<?php
    					} 
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formIdSubDpto" style="display: none">
					Disculpe, debe especificar la Sub-Unidad
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Operador:</td>
    		<td>
    			<select name="idOperador">
    				<option value="0"> -- </option>
    				<?php
    					$query = "SELECT id, nombre, apellido FROM usuarios WHERE activo='1' AND id_tipo_usuario=3 ORDER BY LOWER(nombre), LOWER(apellido)";
    					$rows = DBUtil::executeSelect($query);
    					foreach ($rows as $row) {
    				?>
    						<option value="<?php echo $row["id"];?>"><?php echo $row["nombre"]." ".$row["apellido"];?></option>
    				<?php
    					} 
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formIdOperador" style="display: none">
					Disculpe, debe indicar quien ser&aacute; el operador de esta taquilla
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Nombre:</td>
    		<td>
    			<input type="text" name="nombre" value="" />
    			<br />
				<span class="smallError" id="formNombre" style="display: none">
					Disculpe, el nombre no puede ser vac&iacute;o
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td >&nbsp;</td>
    		<td>
    			<input type="button" value="Guardar" name="guardar" onclick="javascript:guardarTaquilla(this.form);"/>
    		</td>
    	</tr>
    </table>
</form>
</div>

<?php include_once("includes/footer.php");?>