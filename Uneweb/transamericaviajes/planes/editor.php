<?php 
	$location = null;
	$query = "SELECT seccion FROM programas WHERE id=".$_REQUEST['id'];
	mysql_close();