<%@ page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>
    <logic:present name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
            <bean:define id="sessionUser" type="com.carrito.dto.UsuarioDTO" name="<%= Constants.SESSION_USER_LOGGED %>" scope="session" />
            
            <div id="basketItemDetail">
                <logic:empty name="sessionUser" property="carritoItems">
                    <span class="menuRigthSpan">
                        <bean:message key="carrito.noitems" />
                    </span>
                </logic:empty>
                
                <logic:notEmpty name="sessionUser" property="carritoItems">
                    <table class="centered">
                        <logic:iterate id="listadoItemsCarrito" name="sessionUser" property="carritoItems">
                            <tr>
                                <td class="text" align="left" width="70%">
                                    <bean:define id="codigoProducto" name="listadoItemsCarrito" property="productId"></bean:define>
                                    
                                    <img style="cursor: pointer;" src="images/icons/delete.gif" title="Eliminar de la cesta" onclick="deleteFromBasket(<%= codigoProducto %>, '<%= Constants.COME_FROM_MENU_RIGTH %>')" />
                                    &nbsp;&nbsp;
                                    <a href="#" onclick="javascript:showProductDetail(<%= codigoProducto %>)">
                                        <bean:write name="listadoItemsCarrito" property="productName"/>
                                    </a>
                                </td>
                                <td class="text" align="right" width="30%">
                                    <b>
                                        <bean:write name="listadoItemsCarrito" property="productPrice"/> Bs.
                                    </b>
                                </td>
                            </tr>
                        </logic:iterate>
                        <tr>
                            <td colspan="2" class="text" align="right" width="30%">
                                <a href="prepareBasketCheckOut.do">
                                    [Ver Cesta]
                                </a>
                            </td>
                        </tr>
                    </table>
                </logic:notEmpty>
            </div>
        </logic:present>
        <logic:notPresent name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
            <span class="menuRigthSpan">
                <bean:message key="carrito.noitems.mustlog" />
            </span>
        </logic:notPresent>