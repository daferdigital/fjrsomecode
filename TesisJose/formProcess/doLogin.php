<?php
	session_start();
	
	include_once '../classes/DBConnection.php';
	include_once '../classes/DBUtil.php';
	include_once '../classes/SessionUtil.php';
	include_once '../classes/UsuarioDAO.php';
	include_once '../classes/UsuarioDTO.php';
	
	//verificamos si vienen los valores para el login
	if(isset($_POST["usuario"]) && isset($_POST["clave"])){
		$login = $_POST["usuario"];
		$clave = $_POST["clave"];
		
		$message = "";
		$exists = UsuarioDAO::checkIfLoginExits($login);
		if($exists){
			$usuarioDTO = UsuarioDAO::validateUserLoginAndPwd($_POST["usuario"],
					$_POST["clave"]);
			if($usuarioDTO != null){
				//usuario valido
				$_SESSION[SessionUtil::$KEY_USER_LOGGED] = true;
				$_SESSION["usuario"] = $usuarioDTO;
				header("Location: ../logged.php");
			} else {
				$message = "Disculpe, la clave indicada es incorrecta";
			}
		} else {
			$message = "Disculpe, el usuario indicado no existe";
		}	
	} else {
		//no recibimos el usuario ni la clave
		//verificamos si por casualidad ya estabamos logueados
		if(SessionUtil::checkIfUserIsLogged()){
			//el usuario esta en sesion, lo enviamos a la pagina de inicio despues del login
			$_SESSION[SessionUtil::$KEY_USER_LOGGED] = true;
			header("Location: ../logged.php");
		} else {
			//definitivamente, llegamos a esta pagina desde un flujo incorrecto, volvemos a inicio
			header("Location: ../index.php");
		}
	}
?>
<script type="text/javascript">
	alert("<?php echo $message;?>");
	window.location = "../index.php";
</script>