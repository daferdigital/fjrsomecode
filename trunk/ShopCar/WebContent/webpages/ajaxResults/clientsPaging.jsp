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
    ListPageResultDTO<ClienteDTO> results = (ListPageResultDTO<ClienteDTO>) request.getAttribute(AppConstant.ATT_PAGING_RESULTS);
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
    //obtenemos los valores de los distintos filtros para mantenerlos
    String rif = UtilText.emptyIfNull((String) request.getAttribute(AppConstant.PARAM_RIF_CLIENTE));
    String razonSocial = UtilText.emptyIfNull((String) request.getAttribute(AppConstant.PARAM_RAZON_SOCIAL_CLIENTE));
    String contacto = UtilText.emptyIfNull((String) request.getAttribute(AppConstant.PARAM_CONTACTO_CLIENTE));
%>

<div id="infoContainer">
<table class="listTable">
    <tr>
        <td class="headerTD" style="min-width:5; max-width:5%">
            Generar <br />
            Orden <br />
            para <br />
            este <br />
            cliente
        </td>
        <td class="headerTD" style="min-width:15%; max-width:15%">
            R.I.F
            <br />
            <input type="text" name="<%= AppConstant.PARAM_RIF_CLIENTE %>" 
                id="<%= AppConstant.PARAM_RIF_CLIENTE %>" size="15%" value="<%= rif %>" 
                onkeypress="onclickIfKeyWasENTER('link_<%= AppConstant.PARAM_RIF_CLIENTE %>', event)"/>
            <a href="#<%= AppConstant.PARAM_RIF_CLIENTE %>"  id="link_<%= AppConstant.PARAM_RIF_CLIENTE %>" 
                onclick="getClientPageByAjax(1)">
                <img border="0" src="<%= siteBean.getRootSiteURL() %>/images/icons/view.gif" />
            </a>
        </td>
        <td class="headerTD" style="min-width:30%; max-width:30%">
            Raz&oacute;n Social
            <br />
            <input type="text" name="<%= AppConstant.PARAM_RAZON_SOCIAL_CLIENTE %>" 
                id="<%= AppConstant.PARAM_RAZON_SOCIAL_CLIENTE %>" size="30%" value="<%= razonSocial %>"
                onkeypress="onclickIfKeyWasENTER('link_<%= AppConstant.PARAM_RAZON_SOCIAL_CLIENTE %>', event)"/>
                
            <a href="#<%= AppConstant.PARAM_RAZON_SOCIAL_CLIENTE %>" id="link_<%= AppConstant.PARAM_RAZON_SOCIAL_CLIENTE %>"
                onclick="getClientPageByAjax(1)">
                <img border="0" src="<%= siteBean.getRootSiteURL() %>/images/icons/view.gif" />
            </a>
        </td>
        <td class="headerTD" style="min-width:15%; max-width:15%">
            Contacto
            <br />
            <input type="text" name="<%= AppConstant.PARAM_CONTACTO_CLIENTE %>" 
                id="<%= AppConstant.PARAM_CONTACTO_CLIENTE %>" size="15%" value="<%= contacto %>"
                onkeypress="onclickIfKeyWasENTER('link_<%= AppConstant.PARAM_CONTACTO_CLIENTE %>', event)"/>
                
            <a href="#<%= AppConstant.PARAM_CONTACTO_CLIENTE %>" id="link_<%= AppConstant.PARAM_CONTACTO_CLIENTE %>"
                onclick="getClientPageByAjax(1)">
                <img border="0" src="<%= siteBean.getRootSiteURL() %>/images/icons/view.gif" />
            </a>
        </td>
        <td class="headerTD" style="min-width:15%; max-width:15%">
            Telefono
        </td>
        <td class="headerTD" style="min-width:15%; max-width:15%">
            Fax
        </td>
    </tr>
<%
    if(results == null){
%>
    <tr>
        <td colspan="6" align="center"><%= MessagesProperties.getPropertyValue("requestAjaxThrowError") %></td>
    </tr>
<%    	
    } else {
    	if(results.getTotalRecords() == 0){
%>
	    <tr>
	        <td colspan="6" align="center"><%= MessagesProperties.getPropertyValue("requestAjaxCeroRecords") %></td>
	    </tr>
<%    		
    	}else {
    		//debemos iterar en el listado de resultados
    		Iterator<ClienteDTO> iterCliente = results.getPageElements().iterator();
    		ClienteDTO tmp = null;
    		
    		while(iterCliente.hasNext()){
    			tmp = iterCliente.next();
%>
                <tr>
			        <td class="" style="min-width:5%; text-align:center">
			            <a href="#<%= AppConstant.PARAM_RIF_CLIENTE %>" id="link_<%= AppConstant.PARAM_RIF_CLIENTE %>" 
			                onclick="showProductListIfAcceptClient('<%=tmp.getIdCliente()%>', '<%=tmp.getRazonSocial()%>')">
			                <img onmouseover="swapImage(this, '<%= siteBean.getRootSiteURL() %>/images/icons/shopCar.jpg')" onmouseout="swapImage(this, '<%= siteBean.getRootSiteURL() %>/images/icons/shopCar_off.jpg')" border="0" src="<%= siteBean.getRootSiteURL() %>/images/icons/shopCar_off.jpg" />
                        </a>
			        </td>
			        <td class="" style="min-width:15%; max-width:15%">
			            <%= tmp.getRif() %>
			        </td>
			        <td class="" style="min-width:30%; max-width:30%">
			            <%= tmp.getRazonSocial() %>
			        </td>
			        <td class="" style="min-width:15%; max-width:15%">
			            <%= UtilText.emptyIfNull(tmp.getContacto()) %>
			        </td>
			        <td class="" style="min-width:15%; max-width:15%">
			            <%= UtilText.emptyIfNull(tmp.getTelefono()) %>
			        </td>
			        <td class="" style="min-width:15%; max-width:15%">
			            <%= UtilText.emptyIfNull(tmp.getFax()) %>
			        </td>
			    </tr>
<%
    		}
    		
    		//dibujamos el footer
%>
            <tr>
                <td class="pagingFooter" colspan="6" >
                    <%= new PagingUtil(request, results.getTotalRecords(), "getClientPageByAjax").getTRFooterPaging() %>
                </td>
            </tr>
<%
    	}
    }
%>
</table>
</div>
