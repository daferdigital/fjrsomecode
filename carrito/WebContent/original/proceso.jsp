<html>
<%@ page import="java.io.*,java.util.*,java.net.*,java.sql.*" %>

<%

if(request.getParameter("Registrar") != null)

{

// objetos de enlace

Connection canal = null;

ResultSet tabla= null;

Statement instruccion=null;

String strcon = "jdbc:mysql://localhost/carrito","root","";

// abriendo canal o enlace en su propio try-catch

try {

Class.forName("com.mysql.jdbc.Driver").newInstance();

canal=DriverManager.getConnection(strcon);

instruccion = canal.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,

ResultSet.CONCUR_UPDATABLE);

} catch(java.lang.ClassNotFoundException e){} catch(SQLException e) {};

//cargando los campos a grabar

// excepto clave porque en mysql es de tipo auto-increment

String cedula = request.getParameter("ced");
String nombre = request.getParameter("nombre");
String apellido = request.getParameter("apellido");
String telefono = request.getParameter("telefono");
String direccion = request.getParameter("direccion");
String correo = request.getParameter("email");
String usuario = request.getParameter("login");
String clave = request.getParameter("contraseña");

// insert into tabla(nombre,edad,estatura) values('juan', 15, 1.88);

String q="insert into usuario(cedula_usuario,nombre_usuario,apellido_usuario,telefono_usuario,direccion,email,login,clave) values(\"" +cedula+"\","+nombre+","+apellido+","+telefono+","+direccion+","+correo+","+usuario+","+clave+"); ";

try {

// agregando renglon (insert)

int n=instruccion.executeUpdate(q);

//avisando que se hizo la instruccion

out.println("REGISTRO INSERTADO");

} catch(SQLException e) {out.println(e);};

try{

// tabla.close();

instruccion.close();

canal.close();

} catch(SQLException e) {out.println(e);};

};

// construyendo forma dinamica

out.println("<FORM ACTION=prog42.jsp METHOD=post>");

out.println("ced :<INPUT TYPE=TEXT NAME=NOMBRE><BR>");

out.println("EDAD :<INPUT TYPE=TEXT NAME=EDAD><BR>");

out.println("ESTATURA:<INPUT TYPE=TEXT NAME=ESTATURA><BR>");

out.println("<INPUT TYPE=SUBMIT NAME=GRABAR VALUE=INSERTAR ><BR>");

out.println("</FORM>");

%>

</html>


