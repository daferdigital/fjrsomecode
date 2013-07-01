<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>.:: Sistema Automatizado de Solicitudes Empleo ::.</title>
<script type="text/javascript" src="./js/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="./css/site.css">
<style type="text/css">
<!--
.style5 {font-size: 18px; font-family: Arial, Helvetica, sans-serif; }
.style8 {
	font-size: 18px;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-style: italic;
	font-weight: bold;
}
body {
	background-color: #FFFFFF;
	background-image: url(../TesisMaribel/Imagenes/aa.jpg);
}
.ddd {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	color: #000066;
}
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<table width="55%" border="3" align="center" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td width="13%"><div align="center">
      <p><img src="Imagenes/logo.png" width="771" height="98"></p>
      <p>&nbsp;</p>
      <p><span class="style5"><img src="Imagenes/portada.png" width="771" height="98"></span></p>
      <p>&nbsp;</p>
      <table width="40%" border="0" align="center">
        <tr>
          <td align="center">
          	<form name="form1" method="post" action="llenarSolicitud.php" onsubmit="return validarEnvio(this);">
            	<label for="dpto" class="ddd">Departamentos:</label>
            	<select name="dpto" id="dpto">
            	<option value="">- -</option>
            	<?php
                include_once 'classes/DBConnection.php';
                include_once 'classes/DBUtil.php';
                
                //obtenemos el nombre del departamento al que vamos a agregar la solicitud
                $query = "SELECT id, nombre FROM departamento ORDER BY LOWER(nombre)";
                $dptos = DBUtil::executeSelect($query);
                foreach($dptos as $dpto){
            	?>
            		<option value="<?php echo $dpto["id"];?>"><?php echo $dpto["nombre"];?></option>
            	<?php
               		}
            	?>
            	</select>
            	<div class="isMandatory" id="departmentIsMandatory" style="display: none">
            	    Disculpe, debe indicar el departamento en el cual desea almacenar la solicitud de empleo.
            	</div>
            	<br />
            	<input type="submit" value="Crear Solicitud">
          </form>
        </td>
      </tr>
    </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div></td>
  </tr>
</table>
</body>
</html>
