<%@page import="java.util.ResourceBundle"%>
<%@page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<div id="right-nav">
    <!-- right side menu, copy and paste what is contained between these start and end comment tags to make an extra menu -->
    <div class="right-nav-back">
        <div class="right-nav-top">
            <p>. : Carrito </p>
        </div>
        
        <logic:present name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
            <bean:define id="sessionUser" type="com.carrito.dto.UsuarioDTO" name="<%= Constants.SESSION_USER_LOGGED %>" scope="session" />
            
            <div id="basketItemDetail">
                <logic:empty name="sessionUser" property="carritoItems">
	                <span class="menuRigthSpan">
	                    <%= ResourceBundle.getBundle(Constants.APP_RESOURCE_NAME).getString("carrito.noitems") %>
	                </span>
	            </logic:empty>
	            
	            <logic:notEmpty name="sessionUser" property="carritoItems">
	                <table class="centered">
	                    <logic:iterate id="listadoItemsCarrito" name="sessionUser" property="carritoItems">
	                        <tr>
	                            <td class="text" align="right" nowrap="nowrap">
	                                <bean:write name="listadoItemsCarrito" property="productName"/>
	                            </td>
	                            <td class="text" align="right" nowrap="nowrap">
	                                <bean:write name="listadoItemsCarrito" property="productPrice"/>
	                            </td>
	                        </tr>
	                    </logic:iterate>
	                </table>
	            </logic:notEmpty>
            </div>
        </logic:present>
        <logic:notPresent name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
            <span class="menuRigthSpan">
                <%= ResourceBundle.getBundle(Constants.APP_RESOURCE_NAME).getString("carrito.noitems.mustlog") %>
            </span>
        </logic:notPresent>
        <div class="right-nav-bottom"></div>
    </div>
    <!-- end right side menu -->
    
    <!-- comienza menu  de boletines -->
    <div class="right-nav-back">
        <div class="right-nav-top">
            <p>. : Subscribete a nuestros boletines </p>
        </div>
        
        <br />
        
        <div id="subscribe">
            <form action="yourformmailhere" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="sendtoemail" value="youremailaddress" />
                  <input type="hidden" name="redirect" value="yourwebsiteaddress" />
                  <input type="hidden" name="subject" value="Newsletter subscription from your website" />
                  <input name="name" type="text" placeholder="Nombre" class="inputstyle" />
                  <input name="email" type="text" placeholder="Direccion de correo" class="inputstyle" />
                  <input type="submit" value="Suscribirme" class="button" />
            </form>
        </div>
        
        <div class="right-nav-bottom"></div>
    </div>
    <!-- fin menu  de boletines -->
    <br />
    <br />
    <br />
</div>