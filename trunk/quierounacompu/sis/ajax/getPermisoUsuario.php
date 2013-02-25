<?php
    include_once '../classes/DBUtil.php';
    $idUsuario = $_POST["usrId"];
    
    if($idUsuario == -1){
    	die();
    }
    
    $query = "SELECT l.id, l.descripcion, um.id_usuario"
    ." FROM modulos l LEFT JOIN usuario_modulo um ON um.id_modulo=l.id AND um.id_usuario = ".$idUsuario;
    
    $dbUtilObj = new DBUtil();
    $arrayResults = $dbUtilObj->executeSelect($query);
?>

<form action="guardarPermisos.php" method="post">
</form>
    foreach ($arrayResults as $row){
    	
    }
?>