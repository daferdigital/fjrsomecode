<%-- 
    Document   : verusuario
    Created on : 14/03/2013, 03:37:03 PM
    Author     : Rui
--%>

<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
          
 <%
 
 String DRIVER = "com.mysql.jdbc.Driver";
 String url = "jdbc:mysql://localhost/carrito";
 Class.forName(DRIVER);
 ResultSet rs = null;
 Connection con = null;
 Statement stmt = null;
 
 con = DriverManager.getConnection(url, "root", "");
 stmt = con.createStatement();
 try{
	 rs = stmt.executeQuery("SELECT * FROM usuario");

	 while (rs.next()){
		 %>
<tr>
         	<td><%= rs.getInt("cedula_usuario") %></td>
            <td><%= rs.getString("nombre_usuario") %></td>
            <td><%= rs.getString("apellido_usuario") %></td>
            <td><%= rs.getString("telefono_usuario") %></td>
            <td><%= rs.getString("direccion") %></td>
            <td><%= rs.getString("email") %></td>
            <td><%= rs.getString("login") %></td>
            <td><%= rs.getString("clave")%> </td>
  </tr>
  <%
	} 
 }
 catch (Exception e){
 }
 finally{	 
	//con.close();
 	rs.close();
 	//stmt.close();
 }

 %>
    </body>
</html>
