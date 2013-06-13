<?php
include_once '../classes/DBConnection.php';
include_once '../classes/DBUtil.php';

$query = "SELECT COUNT(*) FROM usuarios WHERE login='".$_POST["login"]."' AND clave='".$_POST["clave"]."'";
$result = DBUtil::

?>