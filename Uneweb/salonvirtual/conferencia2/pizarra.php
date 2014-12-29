<?php 
include "conexion.php";
$sql="select texto from pizarra order by id desc limit 0,1";
$ver=mysql_fetch_array(mysql_query($sql,$conex));
?>
<xmp><?php print $ver[0];  ?></xmp>


