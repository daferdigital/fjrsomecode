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
	Crear Sub-Unidades
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
<form action="formProcess/storeSubUnit.php" method="post">
    <table class="borderCollapse">
    	<tr>
    		<td>Unidad:</td>
    		<td>
    			<select name="idDpto">
    				<option value="0"> -- </option>
    				<?php
    					$query = "SELECT id, nombre FROM departamentos WHERE activo='1' ORDER BY LOWER(nombre)";
    					$rows = DBUtil::executeSelect($query);
    					foreach ($rows as $row) {
    				?>
    						<option value="<?php echo $row["id"];?>"><?php echo $row["nombre"];?></option>
    				<?php
    					} 
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formUnidad" style="display: none">
					Disculpe, debe especificar la Unidad
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
    		<td>Cupo M&aacute;ximo:</td>
    		<td>
    			<select name="cupoMaximo">
    				<option value=""> -- </option>
    				<option value="-1"> Ilimitado </option>
    				<?php
    					for ($i=1; $i < 1001; $i++){
    				?>
    						<option value="<?php echo $i;?>"><?php echo $i;?></option>
    				<?php
    					} 
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formCupoMaximo" style="display: none">
					Disculpe, debe indicar el cupo para esta sub unidad
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Hora de Inicio:</td>
    		<td>
    			<select name="horaInicio">
    				<option value=""> -- </option>
    				<option value="12:00:00 AM"> N/A </option>
    				<?php
    					for ($i=1; $i < 1001; $i++){
    				?>
    						<option value="<?php echo $i;?>"><?php echo $i;?></option>
    				<?php
    					} 
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formHoraInicio" style="display: none">
					Disculpe, debe indicar la hora de inicio de labores para esta sub unidad
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>Hora de Fin:</td>
    		<td>
    			<select name="horaFin">
    				<option value=""> -- </option>
    				<option value="11:59:59 PM"> N/A </option>
    				<?php
    					for ($i=1; $i < 1001; $i++){
    				?>
    						<option value="<?php echo $i;?>"><?php echo $i;?></option>
    				<?php
    					} 
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formHoraFin" style="display: none">
					Disculpe, debe indicar la hora de inicio de labores para esta sub unidad
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			Tiempo promedio de
    			<br />
    			atenci&oacute;n (en minutos)
    		</td>
    		<td>
    			<select name="horaFin">
    				<option value=""> -- </option>
    				<option value="11:59:59 PM"> N/A </option>
    				<?php
    					for ($i=1; $i < 1001; $i++){
    				?>
    						<option value="<?php echo $i;?>"><?php echo $i;?></option>
    				<?php
    					} 
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formHoraFin" style="display: none">
					Disculpe, debe indicar la hora de inicio de labores para esta sub unidad
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td >&nbsp;</td>
    		<td>
    			<input type="button" value="Guardar" name="guardar" onclick="javascript:guardarUnidad(this.form);"/>
    		</td>
    	</tr>
    </table>
</form>
</div>

<?php include_once("includes/footer.php");?>