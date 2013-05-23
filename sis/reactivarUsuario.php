<?php 
include_once("classes/Constants.php");
include_once("classes/UsuarioDTO.php");
include_once("classes/PageAccess.php");
include_once("classes/UsuarioDAO.php");
include_once("classes/BitacoraDAO.php");
include_once("includes/header.php");

PageAccess::validateAccess(Constants::$OPCION_ADMIN_REACTIVAR_USUARIO);

BitacoraDAO::registrarComentario("Acceso a pagina para reactivar usuarios");

$idUsuario = -1;
//busco en session por si vengo de almacenar los permisos
if(isset($_SESSION[Constants::$KEY_USER_ID])){
	$idUsuario = $_SESSION[Constants::$KEY_USER_ID];
	unset($_SESSION[Constants::$KEY_USER_ID]);
}
?>

<div class="seccionTitle">
	Reactivar Usuarios
</div>

<div class="seccionDetail">
	Usuarios del Sistema:
	<select id="selectUsuario" onchange="javascript:obtenerDatosUsuario(true, '<?php echo Constants::$OPCION_ADMIN_REACTIVAR_USUARIO?>');">
		<option value="-1">Indique un Usuario</option>
		<?php
			$allUsers = UsuarioDAO::getAllInactiveUsers();
			foreach ($allUsers as $userDTO){
		?>
				<option value="<?php echo $userDTO->getId()?>" <?php echo $idUsuario == $userDTO->getId() ? "selected" : ""?>>
					<?php echo $userDTO->getNombreCompleto()?>
				</option>
		<?php
			} 
		?>
	</select>
	<br />
	<br />
	
	<div class="centered" id="ajaxAnswerMsg">
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
		<br />
	
	</div>
	<div class="centered" id="ajaxAnswerContainer">
		
	</div>
</div>

<?php
if($idUsuario != -1){
	//llegue a esta pagina despues de almacenar los permisos de un usuario
?>
	<script>
		obtenerDatosUsuario(false, '<?php echo Constants::$OPCION_ADMIN_REACTIVAR_USUARIO?>');
	</script>
<?php
} 
?>
<?php include_once("includes/footer.php");?>