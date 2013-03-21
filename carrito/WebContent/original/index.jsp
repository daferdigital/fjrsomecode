<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	<title>Panaderia y Pasteleria El Alcazar C.A</title>
	<link rel="stylesheet" media="screen" type="text/css" href="style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
<!--
body {

	background-image: url(images/pan.jpg);
}
.Estilo1 {
	color: #FFFFFF;
	font-size: small;
}
-->
  </style></head>

  <body>
  <div id="container">
      <div id="body_space">
        <div id="header">
		  <div id="logo-block">
		    <!-- logo y slogan de la empresa -->
            <p id="logo">Pand. Y Past. <span class="logoblue">El Alcazar </span></p>
		    <p id="slogan">Tu panaderia de Confianza aqui en Santa Monica </p>
			<!-- end logo  -->
		  </div>
		  <div id="definels">
		    <!-- login -->
		    <div id="login_top">
		      <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>&nbsp;</p>
			  <p>Usuario:&nbsp;&nbsp;</p>

			    <form name="proceso" method="text" action="ingreso" >
			      <input style="" name="user"  placeholder="Usuario" id="navbar_username" size="10" accesskey="u" tabindex="101" onfocus="if (this.value == 'Usuario') this.value = '';" type="text">
			    <p>&nbsp;&nbsp;</p>
		        <div class="formspace"><input name="contra" placeholder="Password" id="navbar_password" size="10" tabindex="102" type="password"></div>
			     <div class="formspace">
                  <input name="submit2" type="submit" class="loginbutton" value="" />
                  <span class="cls"><span class="buttonC">
                 </span></span><tr>
                          <td class="textmenu" style="padding:3px; padding-right:7px;" align="right"><span class="cls Estilo5 Estilo1"><a href="registro.jsp" class="logoblue"> Crear cuenta> </a> </span></td>
                    </tr><span class="cls"></span></div>
			    </form>
			</div>
			<!-- end login -->
			<!-- Buscar -->
			<div id="search">
			  <form name="search" method="get" action="" target="_parent">
                <input type="text" class="box" />
                <button class="btn" title="Submit Search">Buscar</button>
              </form>
            </div>
		    <!-- fin buscar -->
		  </div>
		  <div class="cls"></div>
  		  <div id="top-nav-bg">
            <div id="top-nav">
			  <!-- empieza top navigation bar/barra de navegacion de tope -->
              <ul>
              <li><a href="index.jsp">Inicio</a></li>
                <li><a href="Producto.jsp">Productos</a></li>
                <li><a href="Proveedor.jsp">Proveedor</a></li>
                <li><a href="Usuario.jsp" class="Estilo1">Usuario</a></li>
                <li><a href="SobreNosotros.jsp">Sobre Nosotros </a></li>
                <li><a href="Contacto.jsp">Contacto</a></li>
                <li><a style="background-image: none;" href="http://www.direccion q queremos poner.com">Support</a></li>
              </ul>
			  <!-- fin top navigation bar -->
            </div>
	      </div>
	    </div>
	    <div id="clouds">
		  <!-- foto con slogan de propaganda -->
   	      <div id="clouds-slogan1"><p>Tu Pan de Jamon Tradicional</p></div>
	      <div id="clouds-slogan2"><p>Por el precio de 100bs</p></div>
		  <!-- fin de slogan de propaganda -->
	    </div>
	  </div>
	</div>
	<div id="page">
	  <div id="page-padding">
        <!-- empezar contenido -->
	    <div id="content">
	      <div id="content-padding">
            <h1>Buscar Los Productos Deseados  </h1>
            <div class="contLbl">
              <label>Tipo</label>
   <!--empieza el cod para la seleccion de categoria del producto -->
			  <script>

function cambiar_pagina(){
	var v = document.getElementById('pedido').value
	if(v > 0){
		var arr = new Array('','Almuerzo.jsp','Bebidas.jsp','Charcuteria.jsp','Desayunos.jsp','Dulces.jsp','Galletas.jsp')
		location.href = arr[v]
	}else{
		alert('Debe seleccionar al mennos una opcion')	
	}
	
}
function cambiar_pagina2(pa){
	var v = pa
	if(v > 0){
		var arr = new Array('','Almuerzo.jsp','Bebidas.jsp','Charcuteria.jsp','Desayunos.jsp','Dulces.jsp','Galletas.jsp')
		location.href = arr[v]
	}else{
		alert('Debe seleccionar al mennos una opcion')	
	}
	
}

</script>
<select id="pedido">
	<option value="0">Seleccione una opcion...</option>
    <option value="1">Almuerzo</option>
    <option value="2">Bebida</option>
    <option value="3">Charcuteria</option>
    <option value="4">Desayunos</option>
    <option value="5">Dulces</option>
    <option value="6">Galletas</option>
    <option value="7">Delicateses</option>
    <option value="8">Dulces</option>
    <option value="9">Otros</option>
    <optgroup label="------Categorias------">
</select>
<input type="button" name="bt" onclick="cambiar_pagina()" value="VER" />
<!--finaliza el cod para la seleccion de categoria del producto -->

              <p>&nbsp;</p>
            <script></script></div>
            <p>&nbsp;</p>
	        </div>
		</div>
		<!-- end content -->
	    <div id="right-nav">
		  <!-- right side menu, copy and paste what is contained between these start and end comment tags to make an extra menu -->
          <div class="right-nav-back">
		    <div class="right-nav-top">
		      <p>. : Carrito </p>
		    </div>
	        <ul>
			  <li>

			  </li>
		    </ul>
			<p>&nbsp;</p>
			<table class="centered">
              <tbody>
                <tr>
                  <td width="269" class="Titolmenu columnMenuHeader" id="minibasketHeader"><a href="irecionnnnn* *********" class="Titolmenu" style="color:#fff;">Cesta</a> </td>
                </tr>
                <tr>
                  <td id="minibasketMiddle"><table width="263" height="158" class="centered">
                      <tbody>
                        <tr>
                          <td width="255" class="Textmenu" style="padding-top:5px;padding-right:1px;padding-left:2px"><form action="irecionnnnn* *********" method="post">
                              <table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
                                <tbody>
                                  <tr>
                                    <td class="text" height="20">1&nbsp;u.</td>
                                    <td style="text-align:left; height:20px; padding-left:4px;"><a href="irecionnnnn* *********" class="text"> Galletera y... </a> </td>
                                    <td class="text" align="right" height="20" nowrap="nowrap">13.95 ?</td>
                                  </tr>
                                  <tr>
                                    <td class="text" height="20">1&nbsp;u.</td>
                                    <td style="text-align:left; height:20px; padding-left:4px;"><a href="direcionnnnn* *********" class="text"> Boquilla Pa... </a> </td>
                                    <td class="text" align="right" height="20" nowrap="nowrap">4.45 ?</td>
                                  </tr>
                                  <tr>
                                    <td class="text" height="20">1&nbsp;u.</td>
                                    <td style="text-align:left; height:20px; padding-left:4px;"><a href="direccion *********************" class="text"> Juego de Co... </a> </td>
                                    <td class="text" align="right" height="20" nowrap="nowrap">4.05 ?</td>
                                  </tr>
                                  <tr>
                                    <td class="text" height="20">1&nbsp;u.</td>
                                    <td style="text-align:left; height:20px; padding-left:4px;"><a href="direcionnn *******************" class="text"> Papel para ... </a> </td>
                                    <td class="text" align="right" height="20" nowrap="nowrap">2.50 ?</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" bgcolor="#ffffff"><img src="direccion de imagen ***************" border="0" height="1" /></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style=" background-color:#bdbdbe; height:1px;"></td>
                                  </tr>
                                  <tr>
                                    <td class="text" style="font-weight:bold; height:25px;" align="left" valign="middle">4&nbsp;u.</td>
                                    <td colspan="2" class="text" style="font-weight:bold;" align="right" valign="middle"> 24.96 ? </td>
                                  </tr>
                                </tbody>
                              </table>
                          </form></td>
                        </tr>
                        <tr>
                          <td class="textmenu" style="padding:3px; padding-right:7px;" align="right"><a href="direccion ***************" class="textmenu"> ver cesta </a> </td>
                        </tr>
                      </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td id="minibasketBottom"></td>
                </tr>
              </tbody>
		    </table>
			<p><br />
		      <br />
			  <br />
		    </p>
			<div class="right-nav-bottom"></div>
		  </div>
		  <!-- end right side menu -->
		  <!-- comienza menu  de boletines -->
          <div class="right-nav-back">
		    <div class="right-nav-top"><p>. : Subscribete a nuestros boletines </p></div>
		      <br />
			  <div id="subscribe">
                <form action="yourformmailhere" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="sendtoemail" value="youremailaddress" />
                  <input type="hidden" name="redirect" value="yourwebsiteaddress" />
                  <input type="hidden" name="subject" value="Newsletter subscription from your website" />
                  <input name="name" type="text" placeholder="Nombre" class="inputstyle" />
		          <input name="email" type="text" placeholder="Direccion de correo" class="inputstyle" />
		          <input type="submit" value="subscribe" class="button" />
		        </form>
		      </div>
		    <div class="right-nav-bottom"></div>
		  </div>
		  <!-- fin menu  de boletines -->
		  <br /><br /><br /><br /><br /><br />
	    </div>
	  </div>
	  <div id="footer">
	    <div id="footer-pad">
	      <div class="line"></div>
		  <!-- inicio del copyright  -->
	      <p>This site is &copy; Copyright website name 2012, All rights reserved. Rui Pereira y Alfredo Rondon </p>
		  <!-- fin del copyright  -->
	    </div>
	  </div>
	</div>
  </body>
</html>