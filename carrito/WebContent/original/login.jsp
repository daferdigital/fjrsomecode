<%@ page language="java" import="java.util.*" %>

<html>
    <head>
        <title>Incio de Sesion</title>
    </head>
    <body bgcolor="#ffffee">
        <h1><center>BIENVENIDO AL INICIO DE SESION  </center></h1>
        <form method="POST" action="ingreso">
        
                  
            <tr>
                <th>Usuario:</th>
                <td><input name="user" type="text"></td>
            </tr>
            <tr>
                <th>Contrase�a:</th>
                <td><input name="contra" type="password"></td>
            </tr>
            
        </table>
        <br>
        <center>
            <input name="pagemode" type="hidden" value="submit">
            <input type="submit" value="Iniciar Sesi�n">
                </center>
        <hr>
        <center>
            <destacar><a href="index.jsp">Volver a la P�gina Inicial 
                  </a></destacar>
        </center>
    </body>
</html>