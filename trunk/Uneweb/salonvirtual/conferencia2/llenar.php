<?php session_start();
if($_SESSION['clan']!=3535){
header("location:index.php");
exit();} 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mandox administrador</title>
<script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="migracion.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
setInterval(loadClima,1000);
});

function loadClima(){
$("#ac").load("ch.php");
}

</script>
<style>
ul li
{
display: inline;
list-style-type: none;
padding-right: 20px;
}
</style>


</head>

<body>
  <label>
  <div align="center">
    <ul><li><a href="admin2.php">Inicio</a></li><li><a href="llenar.php">Pizarra</a></li><li><a href="llenar2.php">Diapositivas</a></li><li><a href="cargardia.php">Cargar diapositivas</a></li>
    </ul>
</div>
  </label>
<form name="form1"  method="POST" id="form1" action="llenar.php">	
        <p align="center">
          <label for="codigo">Embed de Youtube (alto 200px)      </label>
          <textarea name="codigo" id="codigo" cols="40" rows="3"></textarea> 
          <label>
            
            <input type="submit" name="Submit" value="Enviar">
          </label>
  </p>
</form>
<?php 

if($_POST[codigo]){

include "conexion.php";
$sql="update embebidos set codigo='$_POST[codigo]'";
$consulta=mysql_query($sql,$conex);

if(!mysql_error()){

print("<br>");


?><script> alert("La insercion tuvo exito"); </script> <?php } else{ ?><script> alert("Estamos en mantenimiento"); </script><?php

}
mysql_close($conex);

}?>
<form name="form2"  method="POST" id="form2" action="llenar.php">	
        <p align="center">
          <label for="codigo"><a href="http://vocaroo.com/" target="_blank">http://vocaroo.com/</a> Embed de Vocaroo       </label>
          <textarea name="vocaroo" id="vocaroo" cols="40" rows="3"></textarea> 
          <label>
            
            <input type="submit" name="Submit" value="Enviar">
          </label>
  </p>
</form>
<?php 

if($_POST[vocaroo]){

include "conexion.php";
$sqla="update embed set vocaroo='$_POST[vocaroo]'";
$consultaa=mysql_query($sqla,$conex);

if(!mysql_error()){

print("<br>");


?><script> alert("La insercion tuvo exito"); </script> <?php } else{ ?><script> alert("Estamos en mantenimiento"); </script><?php

}
mysql_close($conex);

}?>




<form action="cargar.php" method="POST" enctype="multipart/form-data" name="form2" id="form2">


 
  <table width="1192" border="1" align="center">
    <tr>
      <td width="255" align="left" valign="top"><div id="ac"></div></td>
      <td width="921" height="103" align="left">
        
        <p>Colocarlos codigos aqui</p>
        <p>
          <textarea name="editor1" cols="100" rows="30"></textarea>
      </p>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center"><input type="submit" name="button2" id="button2" value="Cargar" /></td>
    </tr>
  </table>
  <label></label>
  <p>
    <label></label>
  </p>
  <label></label>
</form>


</body>
</html>