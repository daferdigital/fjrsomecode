<%@ page language="java" contentType="text/html; charset=ISO-8859-1" pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Panaderia y Pasteleria El Alcazar C.A</title>
    <link rel="stylesheet" media="screen" type="text/css" href="css/style.css" />
</head>
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
