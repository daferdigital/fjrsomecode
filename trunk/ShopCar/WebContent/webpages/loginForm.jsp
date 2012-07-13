<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
%>

<jsp:include page="../includes/header.jsp"></jsp:include>
    
    <!-- mostramos errores si existen -->
    <form method="post" action="<%= siteBean.getRootSiteURL()%>/servlet?action=doLogin">
    <table style="width:75%">
        <tr>
            <td colspan="2" align="center">Inicio de Sesi&oacute;n</td>
        </tr>
        <tr>
            <td align="right" width="50%">Usuario:</td>
            <td width="50%"><input type="text" id="<%= AppConstant.PARAM_LOGIN %>" name="<%= AppConstant.PARAM_LOGIN %>" value="" maxlength="15" size="16"></td>
        </tr>
        <tr>
            <td align="right" width="50%">Clave:</td>
            <td width="50%"><input type="password" id="<%= AppConstant.PARAM_PASSWORD %>" name="<%= AppConstant.PARAM_PASSWORD %>" value="" maxlength="15" size="16"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Ingresar"/></td>
        </tr>
    </table>
    </form>
    
<jsp:include page="../includes/footer.jsp"></jsp:include>
