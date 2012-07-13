<%@page import="com.yss.dto.LoginDTO"%>
<%@page import="com.yss.javabeans.view.UserSiteBean"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
    LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
    String pageToInclude = "modulosRol";
%>

<%
    if((loginDTO != null) && (loginDTO.isLogged())){
    	pageToInclude += loginDTO.getIdRol() + ".jsp";
%>
        <jsp:include page="<%= pageToInclude %>"></jsp:include>
<%
    }
%>
