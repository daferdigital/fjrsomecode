<?php 
include_once("classes/UsuarioDAO.php");
include_once("includes/header.php");

$idUsuario = -1;
//busco en session por si vengo de almacenar los permisos
if(isset($_SESSION["usuarioPermiso"])){
	$idUsuario = $_SESSION["usuarioPermiso"];
	unset($_SESSION["usuarioPermiso"]);
}
?>

<div class="seccionTitle">
	Permisos
	<br />
	<span>
		(Gestione los permisos de los distintos usuarios del Sistema)
	</span>
</div>

<div class="seccionDetail">
	Usuarios del Sistema:
	<select id="usuarioPermiso" onchange="javascript:obtenerPermisosUsuario();">
		<option value="-1">Indique un Usuario</option>
		<?php
			$usuarioDAO = new UsuarioDAO();
			$allUsers = $usuarioDAO->getAllUsers();
			print_r($allUsers);
			foreach ($allUsers as $userDTO){
		?>
				<option value="<?php echo $userDTO->getId()?>" <?php echo $idUsuario == $userDTO->getId() ? "selected" : ""?>>
					<?php echo $userDTO->getNombre()." ".$userDTO->getApellido()?>
				</option>
		<?php
			} 
		?>
	</select>
	<br />
	<br />
	
	<div class="centered" id="ajaxAnswerContainer">
		<?php
			if(isset($_SESSION["messageOperation"])){
		?>
				<h3><?php echo $_SESSION["messageOperation"];?></h3>
		<?php	
			} 
		?>
	</div>
</div>

<?php
if($idUsuario != -1){
	//llegue a esta pagina despues de almacenar los permisos de un usuario
?>
	<script>
		obtenerPermisosUsuario();
	</script>
<?php
} 
?>
<?php include_once("includes/footer.php");?>