<%@page import="com.yss.dto.ShopCarDTO"%>
<%@page import="com.yss.dto.ClienteDTO"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
    ClienteDTO cliente = (ClienteDTO) request.getAttribute(AppConstant.ATT_CLIENTE_DTO);
    ShopCarDTO shopCar = (ShopCarDTO) request.getAttribute(AppConstant.ATT_SHOP_CAR_DTO);
%>

<jsp:include page="../../includes/header.jsp"></jsp:include>

<!-- mostramos la informacion del cliente al que se le va a generar la orden de compra -->
<h3>
    Seleccione los productos a agregar en la orden de compra del cliente
    <br />
    <%= cliente.getRif() %>, <%= cliente.getRazonSocial() %>
</h3>

<script type="text/javascript">
    updateElementsShopCarCount(<%=shopCar.getShopCarSize()%>);
</script>

<table id="ajaxExecution" style="display: none; width:100%; height: 100%;">
    <tr>
        <td align="center">
            <img src="<%= siteBean.getRootSiteURL() %>/images/cargando.gif" width="80px" height="80px"/>
        </td>
    </tr>
</table>

<span id="pagingValues">
</span>

<script type="text/javascript">
    getProductPageByAjax(1);
</script>

<jsp:include page="../../includes/footer.jsp"></jsp:include>