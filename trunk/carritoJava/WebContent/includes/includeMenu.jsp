<%@page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>

<ul>
    <li><a href="index.do">Inicio</a></li>
	
	<!-- inicio menu particular -->
	<logic:present name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
	    <bean:define id="sessionUser" type="com.carrito.dto.UsuarioDTO" name="<%= Constants.SESSION_USER_LOGGED %>" scope="session" />
	    <jsp:include page='<%= "includeMenu" + sessionUser.getNombrePerfil() + ".jsp" %>'></jsp:include>
    </logic:present>
    <!-- fin menu particular -->
    
    <li><a href="aboutUs.jsp">Sobre Nosotros </a></li>
    <li><a href="contacto.jsp">Contacto</a></li>
    <li><a style="background-image: none;" href="http://www.direccion q queremos poner.com">Support</a></li>
</ul>