<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
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
            <td><%= rs.getString("clave") %></td>
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
  
<%
	String name1 = request.getParameter("cedula").toUpperCase();;
        String name2= request.getParameter("nombre").toUpperCase();;
        String name3 = request.getParameter("apellido").toUpperCase();;
        String name4 = request.getParameter("telefono");
        String name5 = request.getParameter("direccion").toUpperCase();;
        String name6 = request.getParameter("email");
        String name7 = request.getParameter("usuario");
	String ocupation = request.getParameter("contraseña");
        
	if (name7 != null && ocupation != null){
		try{
	stmt.executeUpdate("INSERT INTO usuario (cedula_usuario,nombre_usuario,apellido_usuario,telefono_usuario,direccion,email,login,clave) VALUES ('"
	+name1+"','"+name2+"','"+name3+"','"+name4+"','"+name5+"','" +name6+ "','"+name7+"','"+ocupation+"')");
		}
		catch (Exception e){
		}
		finally{
			con.close();
			stmt.close();
		}
	}else{
        
        }
%>
</body>
</html>