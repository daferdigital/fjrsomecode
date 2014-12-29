<?php session_start();
 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="migracion.js"></script>
    <title>Conferencia on line</title>
    <style>
.radio{
	width:96%;
	height:90px;
	border:1px solid #006;
	margin:5px;
}
.pizarra{
	width:70%;
	height:500px;
	border:1px solid #006;
	margin:5px;
	float:left;
	overflow:auto;
	background-color:#000;
	color:#FFFFFF;

}
.chat{
	width:25%;
	height:500px;
	margin:5px;
	border:1px solid #006;
	float:left;
}
#nombre{
	padding-bottom:2px;
	
}
</style>


 <script>var x;
x=$(document);
x.ready(inicializarEventos);

function inicializarEventos()
{
  var x;
  x=$("#enviar");
  x.click(presionSubmit);
}

function presionSubmit()
{
  var v=$("#men").attr("value");
  
  $.post("pag.php",{numero:v},llegadaDatos); 
  $("#men").attr("value","");
  return false;
  
}

function llegadaDatos(datos)
{
 $("#habla").html(datos);
}
 function actualiza(){
    $(".pizarra").load("pizarra.php");
  }
  setInterval( "actualiza()", 5000 );
  
  	$(document).ready(function(){
setInterval(loadClima,1000);
});

function loadClima(){
$("#ac").load("ch.php");
}
</script>
  </head>
  <body>
    <div class="radio">
      <img src="logo.png" width="249" height="50" /> <iframe width="200" height="90" src="http://www.ustream.tv/embed/16229975?v=3&amp;wmode=direct" scrolling="no" frameborder="0" style="border: 0px none transparent;">    </iframe>
  <img src="fotoprachat.jpg" width="91" height="92" alt="Aluirson Añez" title="Aluirson Añez"  /></div>
 <?php include "conexion.php";
 $sql="select cual from cual";
$ver=mysql_fetch_array(mysql_query($sql,$conex));
if($ver==1){
 
 
 ?>   <div class="pizarra"></div>
 <?php }
 elseif($ver==2){
 
 
 ?>   <div class="diapositivas"></div>
 <?php }
  elseif($ver==3){
 
 
 ?>   <div class="canal"></div>
 <?php }?>
    <div class="chat"><div id="ac"></div>
      <form action="" method="post"> <textarea name="men" id="men" cols="30"></textarea>
        <input type="submit" name="w" id="enviar" value="Mensaje"  /> </form><br />
<br />


    </div>
    
</body>
</html>
