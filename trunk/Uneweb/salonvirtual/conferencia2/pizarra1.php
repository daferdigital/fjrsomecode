<?php 
include "conexion.php";


$esco="select cual from dida";
$tu=mysql_query($esco,$conex);
$cho=mysql_fetch_array($tu);


$sql="select imagen from diapositivas where id='$cho[0]'";
$ver=mysql_fetch_array(mysql_query($sql,$conex));
?>
<center><img src="dia/<?php print $ver[0];?>"  width="860" height="480" /></center>

