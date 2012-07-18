<%@page import="com.yss.dto.ProductoDTO"%>
<%@page import="com.yss.util.PagingUtil"%>
<%@page import="com.yss.util.UtilText"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%@page import="java.util.Iterator"%>
<%@page import="com.yss.properties.MessagesProperties"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.dto.ClienteDTO"%>
<%@page import="com.yss.dto.ListPageResultDTO"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
    
<%
    final String javaScriptAjaxFunction = "getProductPageByAjax";
    ListPageResultDTO<ProductoDTO> results = (ListPageResultDTO<ProductoDTO>) request.getAttribute(AppConstant.ATT_PAGING_RESULTS);
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
    //obtenemos los valores de los distintos filtros para mantenerlos
    String idProductToSearch = UtilText.emptyIfNull((String) request.getAttribute(AppConstant.PARAM_ID_PRODUCTO));
    String descProductToSearch = UtilText.emptyIfNull((String) request.getAttribute(AppConstant.PARAM_DESC_PRODUCTO));
    String lineaProductToSearch = UtilText.emptyIfNull((String) request.getAttribute(AppConstant.PARAM_LINEA_PRODUCTO));
    String marcaProductToSearch = UtilText.emptyIfNull((String) request.getAttribute(AppConstant.PARAM_MARCA_PRODUCTO));    
%>

<div id="infoContainer">
    <div id="loadingCape">
        <img src="<%= siteBean.getRootSiteURL() %>/images/cargando.gif" width="80px" height="80px"/>
    </div>
    
<table class="listTable">
    <tr>
        <td class="headerTD" style="min-width:5; max-width:5%">
            Agregar <br />
            a Carrito
        </td>
        <td class="headerTD" style="min-width:15%; max-width:15%">
            Id Producto
            <br />
            <input type="text" name="<%= AppConstant.PARAM_ID_PRODUCTO %>" 
                id="<%= AppConstant.PARAM_ID_PRODUCTO %>" size="15%" value="<%= idProductToSearch %>" 
                onkeypress="onclickIfKeyWasENTER('link_<%= AppConstant.PARAM_ID_PRODUCTO %>', event)"/>
            <a href="#<%= AppConstant.PARAM_ID_PRODUCTO %>"  id="link_<%= AppConstant.PARAM_ID_PRODUCTO %>" 
                onclick="<%=javaScriptAjaxFunction%>(1)">
                <img border="0" src="<%= siteBean.getRootSiteURL() %>/images/icons/view.gif" />
            </a>
        </td>
        <td class="headerTD" style="min-width:30%; max-width:30%">
            Descripci&oacute;n
            <br />
            <input type="text" name="<%= AppConstant.PARAM_DESC_PRODUCTO %>" 
                id="<%= AppConstant.PARAM_DESC_PRODUCTO %>" size="30%" value="<%= descProductToSearch %>"
                onkeypress="onclickIfKeyWasENTER('link_<%= AppConstant.PARAM_DESC_PRODUCTO %>', event)"/>
                
            <a href="#<%= AppConstant.PARAM_DESC_PRODUCTO %>" id="link_<%= AppConstant.PARAM_DESC_PRODUCTO %>"
                onclick="<%=javaScriptAjaxFunction%>(1)">
                <img border="0" src="<%= siteBean.getRootSiteURL() %>/images/icons/view.gif" />
            </a>
        </td>
        <td class="headerTD" style="min-width:15%; max-width:15%">
            Linea
            <br />
            <input type="text" name="<%= AppConstant.PARAM_LINEA_PRODUCTO %>" 
                id="<%= AppConstant.PARAM_LINEA_PRODUCTO %>" size="15%" value="<%= lineaProductToSearch %>"
                onkeypress="onclickIfKeyWasENTER('link_<%= AppConstant.PARAM_LINEA_PRODUCTO %>', event)"/>
                
            <a href="#<%= AppConstant.PARAM_LINEA_PRODUCTO %>" id="link_<%= AppConstant.PARAM_LINEA_PRODUCTO %>"
                onclick="<%=javaScriptAjaxFunction%>(1)">
                <img border="0" src="<%= siteBean.getRootSiteURL() %>/images/icons/view.gif" />
            </a>
        </td>
        <td class="headerTD" style="min-width:15%; max-width:15%">
            Marca
            <br />
            <input type="text" name="<%= AppConstant.PARAM_MARCA_PRODUCTO %>" 
                id="<%= AppConstant.PARAM_MARCA_PRODUCTO %>" size="15%" value="<%= marcaProductToSearch %>"
                onkeypress="onclickIfKeyWasENTER('link_<%= AppConstant.PARAM_MARCA_PRODUCTO %>', event)"/>
                
            <a href="#<%= AppConstant.PARAM_MARCA_PRODUCTO %>" id="link_<%= AppConstant.PARAM_MARCA_PRODUCTO %>"
                onclick="<%=javaScriptAjaxFunction%>(1)">
                <img border="0" src="<%= siteBean.getRootSiteURL() %>/images/icons/view.gif" />
            </a>
        </td>
    </tr>
<%
    if(results == null){
%>
    <tr>
        <td colspan="5" align="center"><%= MessagesProperties.getPropertyValue("requestAjaxThrowError") %></td>
    </tr>
<%    	
    } else {
    	if(results.getTotalRecords() == 0){
%>
	    <tr>
	        <td colspan="5" align="center"><%= MessagesProperties.getPropertyValue("requestAjaxCeroRecords") %></td>
	    </tr>
<%    		
    	}else {
    		//debemos iterar en el listado de resultados
    		Iterator<ProductoDTO> iterCliente = results.getPageElements().iterator();
    		ProductoDTO tmp = null;
    		
    		while(iterCliente.hasNext()){
    			tmp = iterCliente.next();
%>
                <tr>
			        <td class="" style="min-width:8%; text-align:center">
			            <a href="#" onclick="addProductInShopCar('<%= tmp.getIdProducto() %>')">
			                <img onmouseover="swapImage(this, '<%= siteBean.getRootSiteURL() %>/images/icons/shopCar.jpg')" onmouseout="swapImage(this, '<%= siteBean.getRootSiteURL() %>/images/icons/shopCar_off.jpg')" border="0" id="img_<%= tmp.getIdProducto() %>" src="<%= siteBean.getRootSiteURL() %>/images/icons/shopCar_off.jpg" />
                        </a>
                        &nbsp;
                        <input type="text" id="cantidad_<%= tmp.getIdProducto() %>" name="cantidad_<%= tmp.getIdProducto() %>" 
                            onkeypress="return justAllowNumbers(event);" size="5" value="1" />
			        </td>
			        <td class="" style="min-width:15%; max-width:15%">
			            <%= tmp.getIdProducto() %>
			        </td>
			        <td class="" style="min-width:30%; max-width:30%">
			            <%= tmp.getDescripcion() %>
			        </td>
			        <td class="" style="min-width:15%; max-width:15%">
			            <%= UtilText.emptyIfNull(tmp.getLinea()) %>
			        </td>
			        <td class="" style="min-width:15%; max-width:15%">
			            <%= UtilText.emptyIfNull(tmp.getMarca()) %>
			        </td>
			    </tr>
<%
    		}
    		
    		//dibujamos el footer
%>
            <tr>
                <td class="pagingFooter" colspan="6" >
                    <%= new PagingUtil(request, results.getTotalRecords(), javaScriptAjaxFunction).getTRFooterPaging() %>
                </td>
            </tr>
<%
    	}
    }
%>
</table>
</div>
