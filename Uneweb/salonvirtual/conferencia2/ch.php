<?php include "conexion.php";

$ju="select usu,cuento from chat order by id desc limit 0,15";
$consu=mysql_query($ju,$conex);
while($ver=mysql_fetch_array($consu)){
print $ver[0].": ".$ver[1]."<br>";
}?>