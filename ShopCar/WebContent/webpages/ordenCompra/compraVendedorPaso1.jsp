<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
%>

<jsp:include page="../../includes/header.jsp"></jsp:include>

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
    getClientPageByAjax(1);
</script>

<jsp:include page="../../includes/footer.jsp"></jsp:include>