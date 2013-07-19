<?php
$cn=mysql_connect ("localhost","root","") or die ("Error en Conexion");
$db=mysql_select_db("seguridad3")or die("Error en Db");
return($cn);
return($db);
?>