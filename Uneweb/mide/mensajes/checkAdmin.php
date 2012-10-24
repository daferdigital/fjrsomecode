<?php
	if((isset($_POST["login"]) && strlen($_POST["login"]) > 0)
			|| (isset($_POST["clave"]) && strlen($_POST["clave"]) > 0)){
		
		session_start();
		
		include("../conexion.php");
		
		//tenemos los datos del usuario, los validamos
		$query = "SELECT * FROM administrador"
		." WHERE login = '".$_POST["login"]."'"
		." AND password = '".$_POST["clave"]."'";
		
		$result = mysql_query($query);
		if(mysql_error()){
			//hubo un error ejecutando el query de consulta
?>
			<script type="text/javascript">
				alert("Disculpe, no fue posible procesar su solicitud, favor intente de nuevo.");
				window.location = "index.php";
			</script>
<?php
		} else {
			//no hubo error en la cosulta, vemos si la combinacion usuario-clave
			if(mysql_num_rows($result) == 0) {
				//la combinacion usuario - clave no fue correcta
?>
			<script type="text/javascript">
				alert("Disculpe, la combinacion de usuario y clave no es correcta, favor intente de nuevo.");
				window.location = "index.php";
			</script>
<?php
			} else {
				//login exitoso
				$result = mysql_fetch_array($result);
				$_SESSION["loggedAsAdmin"] = "logged";
				$_SESSION["idAdmin"] = $result["id"];
				header("location: createMessage.php");
			}
		}
	} else {
?>
		<script type="text/javascript">
			alert("Debe indicar tanto el login como la clave para poder ingresar.");
			window.location = "index.php";
		</script>
<?php
	}
	
	mysql_close();
?>