<?php
	include ("conexion.php");
	session_start();
	
	/**
	 * 
	 * @param unknown_type $connection
	 * @param unknown_type $login
	 * @param unknown_type $pwd
	 */
	function validateLoginAndPwd($conexion, $login, $pwd){
		$row = null;
		$returnValue = false;
		
		$query = "SELECT id, direccion, estado, ciudad, nombre, telefono FROM visitantes WHERE correo='".$login."' AND md5('".$pwd."') = clave";
		$consulta = mysql_query($query, $conexion);
		
		if(mysql_error() || (!mysql_error() && (mysql_num_rows($consulta) < 1))){
			//error en la consulta contra la primera tabla, validamos con la segunda
			$query = "SELECT usu_id, usu_direccion, usu_estado, usu_ciudad, usu_nombre, usu_telflocal FROM cu_usuario WHERE usu_correo='".$login."' AND md5('".$pwd."') = usu_clave";
			$consulta = mysql_query($query, $conexion);
			
			if(mysql_error()){
				echo "Error en base de datos: ".mysql_error()."<br />";
				exit();
			} else {
				if(mysql_num_rows($consulta) > 0){
					$row = mysql_fetch_array($consulta);
				}
			}
		}else {
			$row = mysql_fetch_array($consulta);
		}
		
		if($row != null){
			$_SESSION['loggedUser'] = array(
					'id' => $row[0],
					'correo' => $login,
					'direccion' => $row[1],
					'estado' => $row[2],
					'ciudad' => $row[3],
					'nombre' => $row[4],
					'telefono' => $row[5]);
			
			$returnValue = true;
		}
		
		return $returnValue;
	}
	
	if(isset($_SESSION['id']) || isset($_SESSION['qlfy'])){
		//tenemos el id del especialista.
		//o la peticion de ir a calificar
		
		//verificamos si efectivamente estamos recibiendo una peticion de login
		if(isset($_POST["submitLogin"])){
			//validamos el login contra la BD
			if(validateLoginAndPwd($conexion, $_POST["correo"], $_POST["clave"])){
				//login es valido
				if(isset($_SESSION['id'])){
					header("Location: contactForm.php");
				}
				if(isset($_SESSION['qlfy'])){
					header("Location: calificacionesPendientes.php");
				}
			}else {
				//login fue invalido
?>
				<script type="text/javascript">
					alert("Disculpe, login o clave incorrecto.\n"
						+ "Por Favor intente de nuevo.");
					window.location = "contacto.php?id=" + <?php echo $_SESSION['id'];?>;
				</script>
<?php
				exit();
			}
		}
	}else {
?>
		<script type="text/javascript">
			alert("Disculpe, no encontramos la referencia al especialista en su solicitud.\n"
					+"Por Favor intente de nuevo.");
		</script>
<?php
	}
	
	mysql_close($conexion);
?>