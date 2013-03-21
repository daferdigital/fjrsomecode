<%-- 
    Document   : usuarios
    Created on : 23/02/2013, 11:09:20 AM
    Author     : Rui
--%>
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
.Estilo1 {color: #00FF66}
.Estilo2 {font-size: small}
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
		      <form name="login" method="get" action="" target="_parent"><div class="formspace"><tr>
		        <td class="textmenu" style="padding:3px; padding-right:7px;" align="right"><span class="cls Estilo5 Estilo1 Estilo2"><a href="file:///C:\Users\USER\Desktop\47\Registrar.jsp" class="logoblue"></a> Menú ADMINISTRADOR</span></td>
                  </tr><span class="cls">
		          </span></div>
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
            <li><a href="admin.jsp">Resumen</a></li>
                <li><a href="productos.jsp">Productos</a></li>
                <li><a href="usuario.jsp" class="Estilo1">Usuarios</a></li>
                <li><a href="index.jsp">Salir</a></li>
              </ul>
			  <!-- fin top navigation bar -->
            </div>
	      </div>
	    </div>
    </div>
  </div>
	<div id="page">
	  <div id="page-padding">
        <!-- empezar contenido -->	    
	    <div id="content">
	      <div id="content-padding">
            <h1>Menu Usuarios.</h1>
                  <h1> <script>
function cambiar_pagina(){
	var v = document.getElementById('pedido').value
	if(v > 0){
		var arr = new Array('','pag1.html','pag2.html','verusuario.jsp')
		location.href = arr[v]
	}else{
		alert('Debe seleccionar al menos una opcion')	
	}
	
}

</script>
</head>
<body>
<p>Escoja una opcion para producto</p>
<p>
  <select id="pedido">
    <option value="0">Seleccione las opcion para el usuario</option>
    <option value="1">Editar usuario</option>
    <option value="2">Eliminar usuario</option>
    <option value="3">Ver Usuario</option>
  </select>
  <input type="button" name="bt" onclick="cambiar_pagina()" value="Cambiar" />
  
  
</p>
            </h1>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp; </p>
            <p>&nbsp;</p>
            <p>&nbsp; </p>
	      </div>
		</div>
		<!-- end content -->
	    <div id="right-nav">
		  <!-- right side menu, copy and paste what is contained between these start and end comment tags to make an extra menu -->
          <div class="right-nav-back">
		    <div class="right-nav-top">
		      <p>. : </p>
		    </div>
	        <ul>
			  <li>
			     
			  </li>
		    </ul>
			<p>&nbsp;</p>
			<table class="centered">
              <tbody>
                <tr>
                  <td width="269" class="Titolmenu columnMenuHeader" id="minibasketHeader"><a href="http://www.mundodelareposteria.es/shop/comprar/order-Recalc-Yes.htm" class="Titolmenu" style="color:#fff;">Cesta</a> </td>
                </tr>
                <tr>
                  <td id="minibasketMiddle">&nbsp;</td>
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
		  <!-- start second menu for the newletter -->
          <div class="right-nav-back">
		    <div class="right-nav-top"><p>. : </p>
		    </div>
		      <br />
			  <div id="subscribe">
                <form action="yourformmailhere" enctype="multipart/form-data" method="post">
                </form>
		      </div>
		    <div class="right-nav-bottom"></div>
		  </div>
		  <!-- end second right side menu, newletter -->
		  <br /><br /><br /><br /><br /><br />
	    </div>
	  </div>
	  <div id="footer">
	    <div id="footer-pad">
	      <div class="line"></div>
		  <!-- footer and copyright notice -->
	      <p>This site is &copy; Copyright website name 2012, All rights reserved. Rui Pereira y Alfredo Rondon </p>
		  <!-- end footer and copyright notice -->
	    </div>
	  </div>
	</div>
  </body>
</html>
