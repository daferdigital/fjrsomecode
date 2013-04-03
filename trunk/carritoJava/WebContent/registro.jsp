<%@ include file="includes/header.jsp" %>

<div id="page-padding">
    <!-- empezar contenido -->
    <div id="content">
        <div id="content-padding">
            <html:form action="addAccount.do" method="post">
                <table class="centered">
	               <tr>
                       <td>Nombre:</td>
                       <td><html:text property="nombre" onkeypress="return textInputOnlyLetters(event)"></html:text></td>
                   </tr>
                   <tr>
                       <td>Apellido:</td>
                       <td><html:text property="apellido"></html:text></td>
                   </tr>
                   <tr>
                       <td>Cedula:</td>
                       <td><html:text property="cedula" onkeypress="return textInputOnlyNumbers(event)"></html:text></td>
                   </tr>
                   <tr>
                       <td>Telefono:</td>
                       <td><html:text property="telefono" onkeypress="return textInputOnlyNumbers(event)"></html:text></td>
                   </tr>
                   <tr>
                       <td>Direcci&oacute;n:</td>
                       <td><html:text property="direccion"></html:text></td>
                   </tr>
                   <tr>
                       <td>Email:</td>
                       <td><html:text property="email"></html:text></td>
                   </tr>
                   <tr>
                       <td>Login:</td>
                       <td><html:text property="login"></html:text></td>
                   </tr>
                   <tr>
                       <td>Clave:</td>
                       <td><input type="password" name="clave"/></td>
                   </tr>
                   <logic:empty scope="session" name="<%= Constants.SESSION_USER_LOGGED %>">
                   <tr>
                       <td>Tipo de usuario:</td>
                       <td>
                           Cliente
                           <input type="hidden" name="idPerfil" value="2"/>
                       </td>
                   </tr>
                   </logic:empty>
                   <logic:notEmpty scope="session" name="<%= Constants.SESSION_USER_LOGGED %>">
                   <tr>
                       <td>Tipo de usuario:</td>
                       <td>
                           Cliente
                           <input type="hidden" name="idPerfil" value="2"/>
                       </td>
                   </tr>
                   </logic:notEmpty>
                   <tr>
                       <td colspan="2" align="center">
                           <input type="submit" value="Crear Usuario"/>
                       </td>
                   </tr>
	            </table>
            </html:form>
        </div>
    </div>
</div>

<%@ include file="includes/footer.jsp" %>