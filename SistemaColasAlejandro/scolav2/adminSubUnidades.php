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
				<span class="smallError" id="formIdDpto" style="display: none">
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
    				<option value="12:00:00 AM"> 12:00 AM </option>
    				<option value="12:30:00 AM"> 12:30 AM </option>
    				<option value="01:00:00 AM"> 01:00 AM </option>
    				<option value="01:30:00 AM"> 01:30 AM </option>
    				<option value="02:00:00 AM"> 02:00 AM </option>
    				<option value="02:30:00 AM"> 02:30 AM </option>
    				<option value="03:00:00 AM"> 03:00 AM </option>
    				<option value="03:30:00 AM"> 03:30 AM </option>
    				<option value="04:00:00 AM"> 04:00 AM </option>
    				<option value="04:30:00 AM"> 04:30 AM </option>
    				<option value="05:00:00 AM"> 05:00 AM </option>
    				<option value="05:30:00 AM"> 05:30 AM </option>
    				<option value="06:00:00 AM"> 06:00 AM </option>
    				<option value="06:30:00 AM"> 06:30 AM </option>
    				<option value="07:00:00 AM"> 07:00 AM </option>
    				<option value="07:30:00 AM"> 07:30 AM </option>
    				<option value="08:00:00 AM"> 08:00 AM </option>
    				<option value="08:30:00 AM"> 08:30 AM </option>
    				<option value="09:00:00 AM"> 09:00 AM </option>
    				<option value="09:30:00 AM"> 09:30 AM </option>
    				<option value="10:00:00 AM"> 10:00 AM </option>
    				<option value="10:30:00 AM"> 10:30 AM </option>
    				<option value="11:00:00 AM"> 11:00 AM </option>
    				<option value="11:30:00 AM"> 11:30 AM </option>
    				<option value="12:00:00 PM"> 12:00 PM </option>
    				<option value="12:30:00 PM"> 12:30 PM </option>
    				<option value="01:00:00 PM"> 01:00 PM </option>
    				<option value="01:30:00 PM"> 01:30 PM </option>
    				<option value="02:00:00 PM"> 02:00 PM </option>
    				<option value="02:30:00 PM"> 02:30 PM </option>
    				<option value="03:00:00 PM"> 03:00 PM </option>
    				<option value="03:30:00 PM"> 03:30 PM </option>
    				<option value="04:00:00 PM"> 04:00 PM </option>
    				<option value="04:30:00 PM"> 04:30 PM </option>
    				<option value="05:00:00 PM"> 05:00 PM </option>
    				<option value="05:30:00 PM"> 05:30 PM </option>
    				<option value="06:00:00 PM"> 06:00 PM </option>
    				<option value="06:30:00 PM"> 06:30 PM </option>
    				<option value="07:00:00 PM"> 07:00 PM </option>
    				<option value="07:30:00 PM"> 07:30 PM </option>
    				<option value="08:00:00 PM"> 08:00 PM </option>
    				<option value="08:30:00 PM"> 08:30 PM </option>
    				<option value="09:00:00 PM"> 09:00 PM </option>
    				<option value="09:30:00 PM"> 09:30 PM </option>
    				<option value="10:00:00 PM"> 10:00 PM </option>
    				<option value="10:30:00 PM"> 10:30 PM </option>
    				<option value="11:00:00 PM"> 11:00 PM </option>
    				<option value="11:30:00 PM"> 11:30 PM </option>
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
    				<option value="12:00:00 AM"> 12:00 AM </option>
    				<option value="12:30:00 AM"> 12:30 AM </option>
    				<option value="01:00:00 AM"> 01:00 AM </option>
    				<option value="01:30:00 AM"> 01:30 AM </option>
    				<option value="02:00:00 AM"> 02:00 AM </option>
    				<option value="02:30:00 AM"> 02:30 AM </option>
    				<option value="03:00:00 AM"> 03:00 AM </option>
    				<option value="03:30:00 AM"> 03:30 AM </option>
    				<option value="04:00:00 AM"> 04:00 AM </option>
    				<option value="04:30:00 AM"> 04:30 AM </option>
    				<option value="05:00:00 AM"> 05:00 AM </option>
    				<option value="05:30:00 AM"> 05:30 AM </option>
    				<option value="06:00:00 AM"> 06:00 AM </option>
    				<option value="06:30:00 AM"> 06:30 AM </option>
    				<option value="07:00:00 AM"> 07:00 AM </option>
    				<option value="07:30:00 AM"> 07:30 AM </option>
    				<option value="08:00:00 AM"> 08:00 AM </option>
    				<option value="08:30:00 AM"> 08:30 AM </option>
    				<option value="09:00:00 AM"> 09:00 AM </option>
    				<option value="09:30:00 AM"> 09:30 AM </option>
    				<option value="10:00:00 AM"> 10:00 AM </option>
    				<option value="10:30:00 AM"> 10:30 AM </option>
    				<option value="11:00:00 AM"> 11:00 AM </option>
    				<option value="11:30:00 AM"> 11:30 AM </option>
    				<option value="12:00:00 PM"> 12:00 PM </option>
    				<option value="12:30:00 PM"> 12:30 PM </option>
    				<option value="01:00:00 PM"> 01:00 PM </option>
    				<option value="01:30:00 PM"> 01:30 PM </option>
    				<option value="02:00:00 PM"> 02:00 PM </option>
    				<option value="02:30:00 PM"> 02:30 PM </option>
    				<option value="03:00:00 PM"> 03:00 PM </option>
    				<option value="03:30:00 PM"> 03:30 PM </option>
    				<option value="04:00:00 PM"> 04:00 PM </option>
    				<option value="04:30:00 PM"> 04:30 PM </option>
    				<option value="05:00:00 PM"> 05:00 PM </option>
    				<option value="05:30:00 PM"> 05:30 PM </option>
    				<option value="06:00:00 PM"> 06:00 PM </option>
    				<option value="06:30:00 PM"> 06:30 PM </option>
    				<option value="07:00:00 PM"> 07:00 PM </option>
    				<option value="07:30:00 PM"> 07:30 PM </option>
    				<option value="08:00:00 PM"> 08:00 PM </option>
    				<option value="08:30:00 PM"> 08:30 PM </option>
    				<option value="09:00:00 PM"> 09:00 PM </option>
    				<option value="09:30:00 PM"> 09:30 PM </option>
    				<option value="10:00:00 PM"> 10:00 PM </option>
    				<option value="10:30:00 PM"> 10:30 PM </option>
    				<option value="11:00:00 PM"> 11:00 PM </option>
    				<option value="11:30:00 PM"> 11:30 PM </option>
    			</select>
    			<br />
				<span class="smallError" id="formHoraFin" style="display: none">
					Disculpe, debe indicar la hora de fin de labores para esta sub unidad
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
    			<select name="promedioAtencion">
    				<option value=""> -- </option>
    				<option value="-1"> N/A </option>
    				<?php
    					for ($i=1; $i < 120; $i++){
    				?>
    						<option value="<?php echo $i;?>"><?php echo $i;?></option>
    				<?php
    					} 
    				?>
    			</select>
    			<br />
				<span class="smallError" id="formPromedioAtencion" style="display: none">
					Disculpe, debe indicar el tiempo promedio de antenci&oacute;n de esta sub-unidad
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			Atenci&oacute;n por 
    			<br />
    			previa cita?
    		</td>
    		<td>
    			<input type="radio" name="previaCita" value="1"/> S&iacute;
    			<input type="radio" name="previaCita" value="0"/> No
    			<br />
				<span class="smallError" id="formPreviaCita" style="display: none">
					Disculpe, debe indicar si la atenci&oacute;n previa cita aplica en esta sub-unidad.
				</span>
    		</td>
    	</tr>
    	<tr>
    		<td >&nbsp;</td>
    		<td>
    			<input type="button" value="Guardar" name="guardar" onclick="javascript:guardarSubUnidad(this.form);"/>
    		</td>
    	</tr>
    </table>
</form>
</div>

<?php include_once("includes/footer.php");?>