<?php 
include_once("classes/UsuarioDAO.php");
include_once("includes/header.php");
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
				<option value="<?php echo $userDTO->getId()?>"><?php echo $userDTO->getNombre()." ".$userDTO->getApellido()?></option>
		<?php
			} 
		?>
	</select>
	<br />
	<br />
	
	<div class="centered" id="ajaxAnswerContainer">
	</div>
</div>

<div class="ajaxAnswer">
</div>
<?php include_once("includes/footer.php");?>