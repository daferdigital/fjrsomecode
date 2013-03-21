<%@ page contentType="text/html; charset=utf-8" language="java" import="java.sql.*" %>
<html>
    <head>
        <%
        String usuario;
        String pass;
        String DRIVER = "com.mysql.jdbc.Driver";
 String url = "jdbc:mysql://localhost/prueba";
 Class.forName(DRIVER);
 ResultSet rs = null;
 Connection con = null;
 Statement stmt = null;
 
 con = DriverManager.getConnection(url, "root", "");
 stmt = con.createStatement();
        %>
        
        
    </head>
    <body>
        <%
        usuario=request.getParameter("user");
        pass=request.getParameter("contra");
        
        if(usuario.equals("admin")&& pass.equals("2548")){
            response.sendRedirect("Admin.jsp");
        }
               else{
            out.println("Usuario No Registrado");
               response.sendRedirect("login.jsp");
               }
        %>
        
    </body>
    
</html>