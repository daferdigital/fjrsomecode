<%@page import="com.carrito.util.Constants"%>

<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<%@ page language="java" contentType="text/html; charset=ISO-8859-1" pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Panaderia y Pasteleria El Alcazar C.A</title>
    <link rel="stylesheet" media="screen" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/carrito.js"></script>
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
                        
                        <logic:notPresent name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
                            <p>Usuario:&nbsp;&nbsp;</p>
                        
	                        <form id="proceso" method="post" action="login.do" >
	                            <input name="<%= Constants.PARAMETER_LOGIN %>" id="navbar_username" size="10" type="text" placeholder="Usuario"/>
	                            <input name="<%= Constants.PARAMETER_PASSWORD %>" id="navbar_password" size="10" type="password" placeholder="Clave"/>
	                            <input name="submit2" type="submit" class="loginbutton" value="" />
	                        </form>
                        </logic:notPresent>
                        <logic:present name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
                            <bean:define id="sessionUser" type="com.carrito.dto.UsuarioDTO" name="<%= Constants.SESSION_USER_LOGGED %>" scope="session" />
                            
                            <p>Bienvenido:&nbsp;&nbsp;</p>
                            <p>
                                <bean:write name="sessionUser" property="nombre"/>
                                <bean:write name="sessionUser" property="apellido"/>
                                <html:link href="logout.do">Salir</html:link>
                            </p>
                        </logic:present>
                    </div>
                    <!-- end login -->

                    <div class="formspace">
                        <span class="cls Estilo5 Estilo1">
                            <a href="registro.jsp" class="logoblue"> Crear cuenta ></a> 
                        </span>
                    </div>

                    <!-- Buscar -->
		            <div id="search">
		                <form name="search" method="get" action="" target="_parent">
		                    <input type="text" class="box" name="searchKey"/>
		                    <button class="btn" title="Submit Search">Buscar</button>
		                </form>
		            </div>
		            <!-- fin buscar -->
		        </div>
		        
		        <div class="cls"></div>
                
                <div id="top-nav-bg">
                    <div id="top-nav">
                        <!-- empieza top navigation bar/barra de navegacion de tope -->
                        <%@ include file="includeMenu.jsp" %>
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
        <span class="errorContainer">
            <html:errors />
        </span>
        
        <span class="messagesContainer">
            <logic:messagesPresent message="true">
			    <html:messages id="aMsg" message="true">
			        <logic:present name="aMsg">
			                <bean:write name="aMsg" filter="false" />
			        </logic:present>
			    </html:messages>
			</logic:messagesPresent>
        </span>
    