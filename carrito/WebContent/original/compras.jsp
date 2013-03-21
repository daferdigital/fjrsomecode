<%-- 
    Document   : compra
    Created on : 02/03/2013, 05:45:29 PM
    Author     : Administrador
--%>
<%

String cedula=(String) session.getAttribute("ced");
String nombre=(String) session.getAttribute("nom");
String apellido=(String) session.getAttribute("ape");
String login=(String) session.getAttribute("log");
%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Compras</title>
    </head>
    <body>
        <h1> <%=cedula%>;<%=nombre%>;<%=apellido%></h1>;
        <h1><a href="cerrar.jsp">Cerrar Session</a></h1>
    </body>
</html>