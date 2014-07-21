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
	Administrar Unidades
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
<form action="formProcess/updateUnit.php" method="post">
    <table class="borderCollapse">
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
    		<td>Descripci&oacute;n:</td>
    		<td>
    			<textarea rows="5" name="descripcion"></textarea>
    			<br />
				<span class="smallError" id="formDescripcion" style="display: none">
					Disculpe, debe indicar una descripci&oacute;n
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