<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:::Delivery 4T:::. | Realice su Pedido</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<table width="1000"  border="0" align="center" cellpadding="0" cellspacing="0" id="tab" bgcolor="#FFFFFF" >
  <tr>
    <th height="79" colspan="3" scope="col"><img src="img/encab.jpg" id="td1"/></th>
  </tr>
  <tr>
    <td height="39" colspan="3" align="center" id="td1" >
    	<nav>
			<ul>
				<li><a href="index.htm">Home</a></li>
				<li><a href="nosotros.htm">Nosotros</a></li>
				<li><a href="funcion.htm">C&oacute;mo Funciona</a></li>
				<li><a href="pedido.htm">Realice su pedido</a></li>
				<li><a href="contacto.htm">Contacto</a></li>
			</ul>
		</nav>
    </td>
  </tr>
  <tr>
    <td width="956" height="533" colspan="2" background="img/datosfondo.jpg" align="center">

        <h1>Contacto</h1>
     <h3>Ingrese los datos que le solicita el formulario, brevemente le responderemos:</h3>
    
        <?php include 'includes/header.php'; ?>
  
  <div class="Resaltado1">
    </div>
    <br />
    
      <form name="sendEmail" method="post" action="sendEmail.php">
      <table>
      <tr>
              <td align="right" width="20%"> Email:</td>
              <td align="left"> info@delivery4t.com </td>
          </tr>
          <tr>
              <td align="right" width="20%">Nombre:</td>
              <td align="left"> <input type="text" name="name" size="30"/> </td>
          </tr>
          <tr>
              <td align="right" width="20%"> Tu Correo:</td>
              <td align="left"> <input type="text" name="email" size="30"/> </td>
          </tr>
          <tr>
              <td align="right" width="20%"> Asunto:</td>
              <td align="left"> <input type="text" name="subject" size="30"/> </td>
          </tr>
          <tr>
              <td align="right" width="20%">
                          <p> Mensaje:</p>
                        </td>

                          <td align="left"><font color="#000000">
                                <textarea rows="7" name="message" cols="35"></textarea>
                          </font></td>
          </tr>
          <tr>
              <td align="right" colspan="2"> <br /><input type="submit" class="button_submit" value=""/> </td>

          </tr>
    </table>
      </form>

        <?php include 'includes/footer.php'; ?>

    </tr>
    </td>
  </tr>
  <tr id="tab">
    <td height="41" colspan="3" align="center" bgcolor="#2D5287"> <p style="color:#FFF">Delivery 4T 2013 | &#169; Copyright | Master: 0426-5361168 | Correo: info@delivery4t.com</p></td>
  </tr>
</table>

</body>
</html>
