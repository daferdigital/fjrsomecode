<%@ page language="java" import="java.util.*" %>

<html>
    <head>
        <title>Registro de Usuario</title>
    </head>
    <script>
        function validar(form1){
            var ok="yes";
            var tem;
            var valid="0123456789";
            var valor2=document.form1.cedula.value;
            for(var i=0;i<=valor2.length;i++){
                tem=""+valor2.substring(i,i+1);
                if(valid.indexOf(tem)=="-1")
                    ok="no";
            }
        if(ok=="no"){alert("Debe Ingresar Solo Numeros en el Campo Cedula");
            document.form1.cedula.focus();
            return false;
        }
             var valor2=document.form1.telefono.value;
            for(var i=0;i<=valor2.length;i++){
                tem=""+valor2.substring(i,i+1);
                if(valid.indexOf(tem)=="-1")
                    ok="no";
            }
        if(ok=="no"){alert("Debe Ingresar Solo Numeros en el Campo telefono");
            document.form1.telefono.focus();
            return false;
        }
            if(document.form1.nombre.value=="" && document.form1.cedula.value=="" && document.form1.apellido.value=="" && document.form1.telefono.value=="" && document.form1.direccion.value=="" && document.form1.email.value=="" && document.form1.usuario.value==""&& document.form1.contraseña.value=="" ){
              alert("Hay Campos Vacios");
              return false;
            }
            if(document.form1.cedula.value==""){
                alert("No Ha Ingresado Ninguna Cedula");
                document.form1.cedula.focus();
                return false;
            }
            if(document.form1.nombre.value==""){
                alert("No Ha Ingresado Ningun Nombre");
                document.form1.nombre.focus();
                return false;
            }
             
            if(document.form1.apellido.value==""){
                alert("No Ha Ingresado Ningun Apellido");
                document.form1.apellido.focus();
                return false;
            }
               if(document.form1.telefono.value==""){
                alert("No Ha Ingresado Ningun Telefono");
                document.form1.telefono.focus();
                return false;
            }
            if(document.form1.direccion.value==""){
                alert("No Ha Ingresado Ninguna Direccion");
                document.form1.direccion.focus();
                return false;
            } 
            if(document.form1.email.value==""){
                alert("No Ha Ingresado Ningun Correo Electronico");
                document.form1.email.focus();
                return false;
            }
            if(document.form1.usuario.value==""){
                alert("No Ha Ingresado Ningun Usuario");
                document.form1.usuario.focus();
                return false;
            }
             if(document.form1.contraseña.value==""){
                alert("No Ha Ingresado Ninguna Contraseña ");
                document.form1.contraseña.focus();
                return false;
            }
            
            else{ 
                return true;
            }
            
            
            
        }
        
    </script>    
    <body bgcolor="#ffffee">
        <h1><center>Bienvenido a la Pagina de Registro </center></h1>
        <form method="post" action="insertar.jsp" id="form1"  name="form1" onsubmit="return validar()">
        <table align="center" cellpadding="2" cellspacing="2" border="1" 
                   width="80%" bgcolor="#dddddd">
            <tr>
                <th>Cedula:</th>
                <td><input name="cedula" type="text"></td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><input name="nombre" type="text"></td>
            </tr>
            <tr>
                <th>Apellido:</th>
                <td><input name="apellido" type="text"></td>
            </tr>
            <tr>
                <th>Telefono:</th>
                <td><input name="telefono" type="text"></td>
            </tr>
            <tr>
                <th>Direccion:</th>
                <td><input name="direccion" type="text"></td>
            </tr>
           
            <tr>
                <th>Email:</th>
                <td><input name="email" type="email"></td>
            </tr>
            <tr>
                <th>Usuario:</th>
                <td><input name="usuario" type="text"></td>
            </tr>
            <tr>
                <th>Contraseña:</th>
                <td><input name="contraseña" type="password"></td>
            </tr>
        </table>
        <br>
        <center>
            <input name="pagemode" type="hidden" value="submit">
            <input type="submit" value="Registrar">
            <input type="Reset" value="Borrar">
        </center>
        <hr>
        <center>
            <destacar><a href="index.jsp">Volver a la Página Inicial 
                   [el Registro no se añadirá]</a></destacar>
        </center>
    </body>
</html>