<%@page import="com.yss.dto.LoginDTO"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
    LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
%>

<jsp:include page="../includes/header.jsp"></jsp:include>

<h3>Bienvenido <b><%= loginDTO.getIdUsuario() %></b>, selecciona la opci&oacute;n que desees realizar en el menu de la izquierda.</h3>
    
<jsp:include page="../includes/footer.jsp"></jsp:include>
