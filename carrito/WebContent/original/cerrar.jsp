<%-- 
    Document   : cerrar
    Created on : 02/03/2013, 04:31:20 PM
    Author     : Administrador
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<%
session.invalidate();
%>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1> A ABANDONADO LA SESION,PARA INGRESAR DE NUEVO CLICK <a href="index.jsp">AQUI</a> </h1>
    </body>
</html>
