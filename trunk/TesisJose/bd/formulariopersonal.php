<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>FORMULARIO  DE PERSONAL</title>
</head>
<body background=master04.jpg>
<center>
<img src="foto1.jpg"/></p>
</center>



<!--DE AQUI COMIENZA SI DESEAR COPIAR A TU SITIO WEB TOMALO COMO SI EMPEZARAS DESDE BODY-->

<?php
$var="";
$var1="";
$var2="";
$var3="";
$var4="";
$var5="";
$var6="";
$var7="";
$var8="";
$var9="";











if(isset($_POST["btn1"])){
$btn=$_POST["btn1"];
$bus=$_POST["txtbus"];


if($btn=="Buscar"){
		
$sql="select * from personal where cod='$bus'";
$cs=mysql_query($sql,$cn);
while($resul=mysql_fetch_array($cs)){
$var=$resul[0];
$var1=$resul[1];
$var2=$resul[2];
$var3=$resul[3];
$var4=$resul[4];
$var5=$resul[5];
$var6=$resul[6];
$var7=$resul[7];
$var8=$resul[8];
$var9=$resul[9];



			



}

if($var9=="vigilante"){
$var9="selected";
}
			
}


if($btn=="Nuevo"){
		
$sql="select count(Cod),Max(Cod) from personal";
$cs=mysql_query($sql,$cn);
while($resul=mysql_fetch_array($cs)){
$count=$resul[0];
$max=$resul[1];
}


if($count==0){
$var="A0001";
}
else{
$var='A'.substr((substr($max,1)+10001),1);
}
			
}

if($btn=="Agregar"){

$cod=$_POST["txtcod"];
$nombre=$_POST["txtnombre"];
$apellido=$_POST["txtapellido"];
$cedula=$_POST["txtcedula"];
$direccion=$_POST["txtdireccion"];
$turno=$_POST["txtturno"];
$ubicacion=$_POST["txtubicacion"];
$fechaingreso=$_POST["txtfechaingreso"];
$telefono=$_POST["txttelefono"];
$cargo=$_POST["cbocargo"];		



$sql="insert into personal values ('$cod','$nombre','$apellido','$cedula','$direccion','$turno','$ubicacion','$fechaingreso','$telefono','$cargo')";
		
$cs=mysql_query($sql,$cn);
echo "<script> alert('Se Agrego correctamente');</script>";
}


if($btn=="Actualizar"){

$cod=$_POST["txtcod"];
$nombre=$_POST["txtnombre"];
$apellido=$_POST["txtapellido"];
$cedula=$_POST["txtcedula"];
$direccion=$_POST["txtdireccion"];
$turno=$_POST["txtturno"];
$ubicacion=$_POST["txtubicacion"];
$fechaingreso=$_POST["txtfechaingreso"];
$telefono=$_POST["txttelefono"];
$cargo=$_POST["cbocargo"];		

		






$sql="update personal set nombre='$nombre',apellido='$apellido',cedula='$cedula',direccion='$direccion',turno='$turno',ubicacion='$ubicacion',fechaingreso='$fechaingreso',telefono='$fechaingreso',cargo='$cargo' where Cod='$cod'";
		
$cs=mysql_query($sql,$cn);
echo "<script> alert('Se actualizo correctamente');</script>";
}
		



if($btn=="Eliminar"){
$cod=$_POST["txtcod"];
			
$sql="delete from personal where Cod='$cod'";
		
$cs=mysql_query($sql,$cn);
echo "<script> alert('Se elimnino correctamente');</script>";
}
}

?>
<form name="fe" action="" method="post">
<center>
<table border="2">
<tr>
<td>Buscar</td>
<td><input type="text" name="txtbus"/></td>
<td><input type="submit" name="btn1"  value="Buscar"  /></td>
</tr></table>

<table border="2">
<tr>
<td>Codigo</td>
<td><input type="text" name="txtcod" value="<?php echo $var?>" /></td>
</tr>

<tr>
<td>Nombre</td>
<td><input type="text" name="txtnom"  value="<?php echo $var1?>"/></td>
</tr>
<tr>
<td>Apellido</td>
<td><input type="text" name="txtape"  value="<?php echo $var2?>"/></td>
</tr>
<tr>
<td>Cedula</td>
<td><input type="text" name="txttel"  value="<?php echo $var3?>"/></td>
</tr>

<tr>
<td>Direccion</td>
<td><input type="text" name="txttel"  value="<?php echo $var4?>"/></td>
</tr>
<tr>
<td>Turno</td>
<td><input type="text" name="txttel"  value="<?php echo $var5?>"/></td>
</tr>


<tr>
<td>Ubicacion</td>
<td><input type="text" name="txttel"  value="<?php echo $var6?>"/></td>
</tr>

<tr>
<td>Fecha de Ingreso</td>
<td><input type="text" name="txttel"  value="<?php echo $var7?>"/></td>
</tr>
<tr>
<td>Telefono</td>
<td><input type="text" name="txttel"  value="<?php echo $var8?>"/></td>
</tr>

<td>Cargo</td>
<td><select name="cbosex">
<option>supervisor</option>
<option <?php echo $var9?> >vigilante</option>
</select></td>
</tr>

<tr align="center">
<td colspan="2"><input type="submit" name="btn1" value="Nuevo"/>
<input type="submit" name="btn1" value="Listar"/>
</td>
</tr>
<tr align="center"><td colspan="2"><input type="submit" name="btn1" value="Actualizar"/><input type="submit" name="btn1"value="Eliminar"/>
<input type="submit" name="btn1"value="Agregar"/></td></tr>

</table>

</center>
<br />
<hr>
</form>
<br />



<?php
if(isset($_POST["btn1"])){
$btn=$_POST["btn1"];

if($btn=="Listar"){
		
$sql="select * from personal";
$cs=mysql_query($sql,$cn);
echo"<center>
<table border='3'>
<tr>
<td>Codigo</td>
<td>Nombre</td>
<td>Apellido</td>
<td>Cedula</td>
<td>Direccion</td>
<td>Turno</td>
<td>Ubicacion</td>
<td>Fecha de Ingreso </td>
<td>Telefono</td>
<td>Cargo</td>
</tr>";
while($resul=mysql_fetch_array($cs)){
$var=$resul[0];
$var1=$resul[1];
$var2=$resul[2];
$var3=$resul[3];
$var4=$resul[4];
$var5=$resul[5];
$var6=$resul[6];
$var7=$resul[7];
$var8=$resul[8];
$var9=$resul[9];
			
echo "<tr>

<td>$var</td>
<td>$var1</td>
<td>$var2</td>
<td>$var3</td>
<td>$var4</td>
<td>$var5</td>
<td>$var6</td>
<td>$var7</td>
<td>$var8</td>
<td>$var9</td>
</tr>";
}
			
echo "</table>
</center>";
	}
	}
?>


</body>
</html>