<?php
	if((isset($_POST["login"]) && strlen($_POST["login"]) > 0)
			|| (isset($_POST["clave"]) && strlen($_POST["clave"]) > 0)){
		//tenemos los datos del usuario, los validamos
		
	} else {
?>
		<script type="text/javascript">
			alert("Debe indicar tanto el login como la clave para poder ingresar.");
			window.location = "index.php";
		</script>
<?php
	}
?>