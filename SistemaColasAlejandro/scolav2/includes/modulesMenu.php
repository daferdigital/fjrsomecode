<?php
	include_once 'classes/Constants.php';
	include_once 'classes/EnvioDAO.php';
	include_once 'classes/PageAccess.php';
	
	if(! PageAccess::userIsLogged()){
		header("Location: ../index.php");
	}
	
	$usuarioDTO = $_SESSION[Constants::$KEY_USUARIO_DTO];
	$modulesAllowed = $usuarioDTO->getModulesAllowed();
?>
<div id="myjquerymenu" class="jquerycssmenu" style="height: 25px;">
<ul>
	
</ul>
<br style="clear: right;" />
</div>
