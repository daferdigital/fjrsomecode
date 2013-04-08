<%@ page import="com.carrito.dto.ProductDTO"%>
<%@ page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<bean:define id="pageBeanElements" type="com.carrito.dto.ListPageResultDTO" name="<%= Constants.PARAMETER_PAGE_LIST_ELEMENTS %>" scope="request" />
<bean:define id="pagingUtil" type="com.carrito.util.PagingUtil" name="<%= Constants.PARAMETER_PAGING_UTIL %>" scope="request" />

<logic:greaterThan name="pageBeanElements" property="totalRecords" value="0">
	<table>
	    <% 
	    for(int i = 0; i < 3; i++){
	    %>
	        <tr>
	        <%
	        for(int j = (i*3); j < ((i + 1) * 3) && j < pageBeanElements.getPageElements().size(); j++){
	        %>
	            <td width="33%" class="productDetail">
	                <%= ((ProductDTO) pageBeanElements.getPageElements().get(j)).getNombre() %>
	                <br />
	                Precio: <b><%= ((ProductDTO) pageBeanElements.getPageElements().get(j)).getPrecioNetoActual() %></b> Bs.
	                <br />
	                <img src="images/productos/producto<%= ((ProductDTO) pageBeanElements.getPageElements().get(j)).getId() %>.jpg" alt="<%= ((ProductDTO) pageBeanElements.getPageElements().get(j)).getNombre() %>"/>
	                
	                <logic:present name="<%= Constants.SESSION_USER_LOGGED %>" scope="session">
	                   <br />
	                   <a href="#" onclick="javascript:addToBasket(<%= ((ProductDTO) pageBeanElements.getPageElements().get(j)).getId() %>)">
	                       Agregar a la cesta
	                   </a>
	                </logic:present>
	                
	                <br />
                    <a href="#" onclick="javascript:showProductDetail(<%= ((ProductDTO) pageBeanElements.getPageElements().get(j)).getId() %>)">
                        Ver m&aacute;s...
                    </a>
	            </td>
	        <%
	        }
	        %>
	        </tr>
	    <%	
	    }
	    %>
		<tr>
		   <td colspan="3">
		       <bean:write name="pagingUtil" property="TRFooterPaging"/>
		   </td>
		</tr>
	</table>
</logic:greaterThan>

<logic:lessEqual name="pageBeanElements" property="totalRecords" value="0">
    <h2>
        <bean:message key="category.noproducts" />
    </h2>
</logic:lessEqual>