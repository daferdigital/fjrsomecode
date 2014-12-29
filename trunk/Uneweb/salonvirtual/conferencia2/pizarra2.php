<?php session_start();
if($_SESSION['clan']!=1967){
header("location:index.php");
exit();} 

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
.video{
	width:55%;
	height:500px;
	border:1px solid #006;
	margin:5px;
	float:left;
	overflow:auto;
	background-color:#000;
	color:#FFFFFF;
	padding-left:110px;

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
      <img src="logo.png" width="249" height="50" />
 <?php if($_SESSION[nivel]==2){?> <a href="admin2.php">Administrar curso</a><?php }?></div>
   <div class="video"> <iframe  width="500" height="500" src="http://www.ustream.tv/embed/16229975?v=3&amp;wmode=direct" scrolling="no" frameborder="0" style="border: 0px none transparent;">    </iframe></div>
 
    <div class="chat"><div id="ac"></div>
      <form action="" method="post"> <textarea name="men" id="men" cols="30"></textarea>
        <input type="submit" name="w" id="enviar" value="Mensaje"  /> </form><br />
<br />


    </div>
    
</body>
</html>



