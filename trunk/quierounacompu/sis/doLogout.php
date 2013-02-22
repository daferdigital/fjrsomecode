<?php
include_once("includes/session.php");

session_destroy();
?>
<script>
	alert("Gracias por usar el Sistema");
	window.location = "index.php";
</script>