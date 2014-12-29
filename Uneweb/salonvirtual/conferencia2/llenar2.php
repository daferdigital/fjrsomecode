<?php session_start();
if($_SESSION['clan']!=3535){
header("location:index.php");
exit();}
include "conexion.php";
if($_POST[diapo]){
$va="update dida set cual='$_POST[diapo]'";
mysql_query($va,$conex);
} ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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


<form action="" method="POST" enctype="multipart/form-data" name="form2" id="form2">
  <label>
  <div align="center"><ul><li><a href="admin2.php">Inicio</a></li><li><a href="llenar.php">Pizarra</a></li><li><a href="llenar2.php">Diapositivas</a></li><li><a href="cargardia.php">Cargar diapositivas</a></li></ul>
   
  </div>
  </label>

 
  <table width="1192" border="1" align="center">
    <tr>
      <td width="255" align="left" valign="top"><div id="ac"></div></td>
      <td width="921" height="103" align="left">
        
        <p>Colocar diapositiva en la pizarra</p>
        <p><?php 
include "conexion.php";
$sql="select * from diapositivas";
$chu=mysql_query($sql,$conex)

?>
          <label for="diapo">Diapositiva</label>
          <select name="diapo" id="diapo">
         <?php  while($ver=mysql_fetch_array($chu)){?>
         <option value="<?php print $ver[0]?>"><?php print "curso".$ver[3]." - ".$ver[1]?></option>
         <?php }?>
          
          </select>
        </p>
        <p><input type="submit" name="button2" id="button2" value="Cargar" /></p>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center"><?php $esco="select cual from dida";
$tu=mysql_query($esco,$conex);
$cho=mysql_fetch_array($tu);


$sql="select imagen from diapositivas where id='$cho[0]'";
$ver=mysql_fetch_array(mysql_query($sql,$conex));
?>
<center><img src="dia/<?php print $ver[0];?>"  width="300" height="300" /></center></td>
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