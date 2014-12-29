<?php /*session_start();
if($_SESSION['clan']!=1967){
header("location:index.php");
exit();} */?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
</head>

<body>



  <label>
  <div align="center">
    <form id="form1" name="form1" method="post" action="">
      <label for="materia">Materia</label>
      <select name="materia" id="materia" onchange="this.form.submit()"> <option value="1">Mercadeo 2.0</option>
        <option value="2">Mercadeo Viral</option>
                 <option value="3">SEO</option>
                  <option value="4">Compita con ventaja</option>
                 
      </select>
    </form>
  </div>
  </label>
<form action="cargar2.php" method="POST" enctype="multipart/form-data" name="form2" id="form2">
 
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