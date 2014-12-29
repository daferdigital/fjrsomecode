<?php 
	include "conexion.php";

	
	$s="insert into pizarra values('','$_POST[editor1]',1,1)";
	mysql_query($s,$conex);
	print mysql_error();
	if(!mysql_error()){ print "Se agrego con exito";
	?>
	<meta http-equiv="refresh" content="1;URL=llenar.php" />

	<?php
	
	
	}else{ print "hubo error en la carga";}
	  ?>
