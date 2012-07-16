<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
%>

<jsp:include page="../includes/header.jsp"></jsp:include>
    
<jsp:include page="../includes/footer.jsp"></jsp:include>
