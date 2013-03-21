<%@page import="java.sql.*" %>
<body>
   <%try{Class.forName("com.mysql.jdbc.Driver");
Connection conexion=DriverManager.getConnection
("jdbc:mysql://localhost/prueba","root","" );
out.println("Conexión realizada con éxito a: "+conexion.getCatalog());
conexion.close();
} catch(SQLException ex)
{%>
<%="Se produjo una excepción durante la conexión:"+ex%>
<%}catch(Exception ex){ %>
<%="Se produjo una excepción:"+ex%>
<%}%>
</body>