<%@page import="java.util.ResourceBundle"%>
<%@page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<logic:present name="<%= Constants.REQUEST_PRODUCT_DTO %>" scope="request">
    <bean:define id="producto" type="com.carrito.dto.ProductDTO" name="<%= Constants.REQUEST_PRODUCT_DTO %>" scope="request"></bean:define>
    <table>
        <tr>
            <td>Categor&iacute;a: </td>
            <td><bean:write name="producto" property="nombreCategoria"/></td>
        </tr>
        <tr>
            <td>Producto: </td>
            <td><bean:write name="producto" property="nombre"/></td>
        </tr>
        <tr>
            <td>Descripci&oacute;n: </td>
            <td><bean:write name="producto" property="descripcion"/></td>
        </tr>
        <tr>
            <td>Precio: </td>
            <td><bean:write name="producto" property="precioNetoActual"/></td>
        </tr>
        <tr>
            <td>Foto: </td>
            <td>
                <img src="images/productos/producto<bean:write name="producto" property="id"/>.jpg" alt="<bean:write name="producto" property="nombre"/>"/>
            </td>
        </tr>
    </table>
</logic:present>
<logic:notPresent name="<%= Constants.REQUEST_PRODUCT_DTO %>" scope="request">
    <%= ResourceBundle.getBundle(Constants.APP_RESOURCE_NAME).getString("error.noproductdetail") %>
</logic:notPresent>
