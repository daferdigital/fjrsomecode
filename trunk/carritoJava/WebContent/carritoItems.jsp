<%@page import="java.util.ResourceBundle"%>
<%@page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>
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
                                <td class="text" align="left" width="50%">
                                    <bean:define id="codigoProducto" name="listadoItemsCarrito" property="productId"></bean:define>
                                    <a href="#" onclick="javascript:showProductDetail(<%= codigoProducto %>)">
                                        <bean:write name="listadoItemsCarrito" property="productName"/>
                                    </a>
                                </td>
                                <td class="text" align="right" width="50%">
                                    <b>
                                        <bean:write name="listadoItemsCarrito" property="productPrice"/>
                                    </b>
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