<%@page import="com.carrito.dto.CarritoItemDTO"%>
<%@ page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<jsp:include page="includes/header.jsp"></jsp:include>

<div id="page-padding">
    <!-- empezar contenido -->
    <div id="content">
        <div id="content-padding">
            <logic:present name="<%= Constants.PARAMETER_ITEMS_TO_BUY %>" scope="request">
                <bean:define id="itemsToBuy" type="java.util.List" name="<%= Constants.PARAMETER_ITEMS_TO_BUY %>" scope="request" />
                
                <logic:empty name="itemsToBuy">
                    <span class="menuRigthSpan">
                        <bean:message key="carrito.noitems" />
                    </span>
                </logic:empty>
                <logic:notEmpty name="itemsToBuy">
                    <% double total = 0; %>
                    <html:form action="completeBasketCheckOut.do" method="post" onsubmit="return validateBeforeCompleteCheckOut()">
                        <table class="centered">
                            <tr>
                                <td align="left">
                                    Banco:
                                </td>
                                <td align="left">
                                    <select id="idBanco" name="idBanco">
                                        <logic:iterate id="listadoBancos" name="<%= Constants.PARAMETER_LIST_BANCOS %>" scope="request">
                                            <option value="<bean:write name="listadoBancos" property="id"/>">
                                                <bean:write name="listadoBancos" property="nombre"/>
                                            </option>
                                        </logic:iterate>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    Tipo de pago:
                                </td>
                                <td align="left">
                                    <select id="idTipoPago" name="idTipoPago">
                                        <logic:iterate id="listadoPagos" name="<%= Constants.PARAMETER_LIST_TIPOS_DE_PAGO %>" scope="request">
                                            <option value="<bean:write name="listadoPagos" property="id"/>">
                                                <bean:write name="listadoPagos" property="descripcion"/>
                                            </option>
                                        </logic:iterate>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    N&uacute;mero tarjeta o cheque:
                                </td>
                                <td align="left">
                                    <html:text property="nroTarjetaCheque" onkeypress="return textInputOnlyNumbers(event)"></html:text>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        </table>
                        
                        <table class="centered">
                            <tr>
                                <td width="60%">Producto</td>
                                <td width="10%">Cantidad</td>
                                <td width="20%">Precio Unitario</td>
                            </tr>
                            <logic:iterate id="listadoItemsCarrito" name="itemsToBuy" >
                                <tr>
                                    <td class="text" align="left">
                                        <html:hidden name="listadoItemsCarrito" property="productId"/>
                                        <a href="#" onclick="javascript:showProductDetail(<%= ((CarritoItemDTO) listadoItemsCarrito).getProductId() %>)">
                                            <bean:write name="listadoItemsCarrito" property="productName"/>
                                        </a>
                                    </td>
                                    <td>
                                        <html:hidden name="listadoItemsCarrito" property="cantidad"/>
                                        <bean:write name="listadoItemsCarrito" property="cantidad"/>
                                    </td>
                                    <td class="text" align="right">
                                        <%
                                        total += ((CarritoItemDTO) listadoItemsCarrito).getCantidad() * ((CarritoItemDTO) listadoItemsCarrito).getProductPrice();
                                        %>
                                        <html:hidden name="listadoItemsCarrito" property="productPrice"/>
                                        <b>
                                            <bean:write name="listadoItemsCarrito" property="productPrice"/> Bs.
                                        </b>
                                    </td>
                                </tr>
                            </logic:iterate>
                            <tr>
                                <td colspan="2" class="text" align="right" width="30%">
                                    <b> Total: </b>
                                </td>
                                <td align="right">
                                    <b> <%= total %> Bs.</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text" align="right" width="30%">
                                    <html:submit value="Comprar"></html:submit>
                                </td>
                            </tr>
                        </table>
                    </html:form>
                </logic:notEmpty>
        </logic:present>
        <logic:notPresent name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
            <span class="menuRigthSpan">
                <bean:message key="carrito.noitems.mustlog" />
            </span>
        </logic:notPresent>
        </div>
    </div>
</div>

<jsp:include page="includes/footer.jsp"></jsp:include>