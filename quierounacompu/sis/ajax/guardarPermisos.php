<?php
include_once '../classes/Constants.php';
include_once '../classes/ModuloDAO.php';
include_once '../classes/UsuarioDTO.php';
include_once '../classes/DBUtil.php';
include_once '../includes/session.php';

if(isset($_POST["submit"]) && isset($_POST["permiso"])){
	//recibimos el formulario para almacenar la informacion
	//eliminamos los registros previos de permisos para actualizar
	$query = "DELETE FROM usuario_modulo where id_usuario=".$_POST["idUsuario"];
	BitacoraDAO::registrarComentario("Permisos borrados al usuario [".$_POST["idUsuario"]."]");
	
	$dbUtilObj = new DBUtil();
	$dbUtilObj->executeQuery($query);

	//recorremos el arreglo POST para almacenar los nuevos permisos
	$permisos = $_POST["permiso"];
	foreach($permisos as $arrayPermisoModulo) {
		foreach($arrayPermisoModulo as $keyPermisoModulo => $valuePermisoModulo) {
			if($valuePermisoModulo == 1){
				//insertamos el permiso al modulo
				$query = "INSERT into usuario_modulo (id_usuario, id_modulo)"
						." VALUES(".$_POST["idUsuario"].",".$keyPermisoModulo.")";
				$dbUtilObj->executeQuery($query);
				BitacoraDAO::registrarComentario("Asignado permiso al modulo [".$keyPermisoModulo."] al usuario [".$_POST["idUsuario"]."]");
			}
		}
	}
	
	$_SESSION["usuarioPermiso"]=$_POST["idUsuario"];
	$_SESSION[Constants::$KEY_MESSAGE_OPERATION] = "Su operaci&oacute;n fue realizada";
	
	//si el id del usuario al que se le estan cambiando los permisos
	//es el mismo que esta actualmente en session
	//debemos actualizar los permisos del mismo en la sesion
	$userDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
	if($userDTO->getId() == $_POST["idUsuario"]){
		$moduloDAO = new ModuloDAO();
		$userDTO->setModulesAllowed($moduloDAO->getModulosXUser($_POST["idUsuario"]));
	}
} else {
	//acceso no permitido a esta pagina
	BitacoraDAO::registrarComentario("Intento de acceso no autorizado a la opcion de guardar cambios en permisologia");
}

header("Location: ../permisos.php");
?>