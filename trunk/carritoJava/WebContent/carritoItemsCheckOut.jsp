<%@ page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<logic:present name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
            <bean:define id="sessionUser" type="com.carrito.dto.UsuarioDTO" name="<%= Constants.SESSION_USER_LOGGED %>" scope="session" />
            
            <div id="basketItemDetail" class="centered">
                <logic:empty name="sessionUser" property="carritoItems">
                    <span class="menuRigthSpan">
                        <bean:message key="carrito.noitems" />
                    </span>
                </logic:empty>
                
                <logic:notEmpty name="sessionUser" property="carritoItems">
                    <html:form action="showBasketResume.do" method="post" onsubmit="return validateBasketCheckOut();">
                        <html:hidden property="idUser" value="<%= Integer.toString(sessionUser.getId()) %>"></html:hidden>
                        <table class="centered">
                            <thead>
                                <tr>
                                    <td width="10%">Ordenar?</td>
                                    <td width="50%">Producto</td>
                                    <td width="10%">Cantidad</td>
                                    <td width="20%">Precio Unitario</td>
                                </tr>
                            </thead>
                            <logic:iterate id="listadoItemsCarrito" name="sessionUser" property="carritoItems">
                                <bean:define id="codigoProducto" name="listadoItemsCarrito" property="productId"></bean:define>
                                <tr>
                                    <td>
                                        <html:checkbox property="productosSeleccionados" value="<%= codigoProducto.toString() %>"></html:checkbox>
                                    </td>
                                    <td class="text" align="left">
                                        <img style="cursor: pointer;" src="images/icons/delete.gif" title="Eliminar de la cesta" onclick="deleteFromBasket(<%= codigoProducto %>, '<%= Constants.COME_FROM_PREV_CHECKOUT %>')" />
                                        &nbsp;&nbsp;
                                        <a href="#" onclick="javascript:showProductDetail(<%= codigoProducto %>)">
                                            <bean:write name="listadoItemsCarrito" property="productName"/>
                                        </a>
                                    </td>
                                    <td>
                                        <html:text property="cantidadesSeleccionadas" value="1" onkeypress="return textInputOnlyNumbers(event)" onkeyup="colocarSiVacio('1', this);" size="5" maxlength="5"></html:text>
                                    </td>
                                    <td class="text" align="right">
                                        <b>
                                            <bean:write name="listadoItemsCarrito" property="productPrice"/> Bs.
                                        </b>
                                    </td>
                                </tr>
                            </logic:iterate>
                            <tr>
                                <td colspan="2" class="text" align="right" width="30%">
                                    <html:submit value="Pre ordenar"></html:submit>
                                </td>
                            </tr>
                        </table>
                    </html:form>
                </logic:notEmpty>
            </div>
        </logic:present>
        <logic:notPresent name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
            <span class="menuRigthSpan">
                <bean:message key="carrito.noitems.mustlog" />
            </span>
        </logic:notPresent>