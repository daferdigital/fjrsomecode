<%@page import="java.sql.*" %>
<body>
   <%try{Class.forName("com.mysql.jdbc.Driver");
Connection conexion=DriverManager.getConnection
("jdbc:mysql://localhost/prueba","root","" );
out.println("Conexi�n realizada con �xito a: "+conexion.getCatalog());
conexion.close();
} catch(SQLException ex)
{%>
<%="Se produjo una excepci�n durante la conexi�n:"+ex%>
<%}catch(Exception ex){ %>
<%="Se produjo una excepci�n:"+ex%>
<%}%>
</body>