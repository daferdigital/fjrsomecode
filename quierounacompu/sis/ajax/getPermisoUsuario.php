<?php
    include_once '../classes/DBUtil.php';
    include_once '../classes/UsuarioDTO.php';
    include_once '../classes/BitacoraDAO.php';
    include_once '../classes/PageAccess.php';
    include_once '../includes/session.php';
	
    PageAccess::validateAccess(Constants::$OPCION_ADMIN_PERMISOS);
    
    $idUsuario = $_POST["usrId"];
    
    if($idUsuario == -1){
    	die();
    }
    
    $query = "SELECT m.id, m.descripcion, um.id_usuario"
    ." FROM modulos m LEFT JOIN usuario_modulo um ON um.id_modulo=m.id AND um.id_usuario = ".$idUsuario
    ." ORDER BY m.categoria, LOWER(m.descripcion)";
    
    $arrayResults = DBUtil::executeSelect($query);
    BitacoraDAO::registrarComentario("Consultados permisos via ajax del usuario con id=[".$idUsuario."]");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<body>
	<form action="formProcess/guardarPermisos.php" method="post">
		<table class="borderCollapse">
			<tr>
				<td class="tableAjaxResultHeader">Modulo</td>
				<td class="tableAjaxResultHeader">Permitido?</td>
			</tr>
			<?php
	   	 	foreach ($arrayResults as $row){
	   	 	?>
	   	 		<tr>
	   	 			<td><?php echo $row["descripcion"]?></td>
	   	 			<td>
	   	 				<input type="radio" value="1" name="<?php echo "permiso[][".$row["id"]."]";?>" <?php echo ($idUsuario == $row["id_usuario"]) ? "checked" : "";?>/> S&iacute;
	   	 				<input type="radio" value="0" name="<?php echo "permiso[][".$row["id"]."]";?>" <?php echo ($idUsuario != $row["id_usuario"]) ? "checked" : "";?>/> No
	   	 			</td>
	   	 		</tr>
	   	 	<?php
	    	}
			?>
		</table>
		<input type="hidden" name="idUsuario" value="<?php echo $idUsuario;?>"/>
		<input type="submit" name="submit" value="Guardar Permisos"/>
	</form>
</body>
</html>