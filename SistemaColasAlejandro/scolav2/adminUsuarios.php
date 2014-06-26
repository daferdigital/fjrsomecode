<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/EnvioDAO.php");
include_once("includes/header.php");

$seccionTitle = "Edici&oacute;n de usuarios";
?>

<div class="seccionTitle">
	<?php echo $seccionTitle;?>
</div>

<div class="seccionDetail">
	<table width="60%">
    	<tr>
    		<td>
    			Tipo de Usuario
    		</td>
    		<td>
    			<select name="tipoUsuario" id="tipoUsuario">
    				<option value="0"> -- </option>
    				<?php
    					$query = "SELECT * FROM tipo_usuario ORDER BY nombre";
    					$rows = DBUtil::executeSelect($query);
    					foreach ($rows as $row) {
    				?>
    						<option value="<?php echo $row["id"];?>"><?php echo $row["nombre"];?></option>
    				<?php
    					}
    				?>
    			</select>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			Nombre
    		</td>
    		<td>
    		    <input type="text" id="nombre" name="nombre" value=""/>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			Apellido
    		</td>
    		<td>
    		    <input type="text" id="apellido" name="apellido" value=""/>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			C.I.
    		</td>
    		<td>
    			<input type="text" id="ci" name="ci" value=""/>
    		</td>
    	</tr>
      	<tr>
    		<td colspan="2" align="right">
    			<input type="button" value="Buscar" onclick="javascript:searchUsuariosAjax(1);"/>
    		</td>
    	</tr>
    </table>
</div>

<div style="width: 100%" id="ajaxPageResult">
	&nbsp;
</div>

<?php include_once 'includes/footer.php';?>