<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
  <label>
  <div align="center">
    <ul><li><a href="admin2.php">Inicio</a></li><li><a href="llenar.php">Pizarra</a></li><li><a href="llenar2.php">Diapositivas</a></li><li><a href="cargardia.php">Cargar diapositivas</a></li>
    </ul>
    <br />
  </div>
  </label>


<form name="form1" method="post" action="videos.php">	
        <p align="center">

          <label>Titulo

            <input name="titulo" type="text" id="titulo">

          </label>
          <label for="codigo">Codigos          </label>
          <textarea name="codigo" id="codigo" cols="40" rows="3"></textarea>
          <label>Status

            <select name="status" id="status">
              <option value="1">Video</option>
              
            </select>

          </label>
          <label>
            
            <input type="submit" name="Submit" value="Enviar">
          </label>
        </p>
<p>&nbsp;      </p>

</form>
<?php 

if($_POST[titulo]){

include "conexion.php";
$sql="insert into embebidos values('','$_POST[titulo]','$_POST[codigo]','$_POST[status]')";
$consulta=mysql_query($sql,$conexion);

if(!mysql_error()){

print("<br>");


?><script> alert("La insercion tuvo exito"); </script> <?php } else{ ?><script> alert("Estamos en mantenimiento"); </script><?php

}
mysql_close($conexion);

}?>


</body>
</html>