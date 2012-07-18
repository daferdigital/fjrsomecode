<%@page import="com.yss.dto.LoginDTO"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1" pageEncoding="ISO-8859-1"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
    LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
%>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Electrodom&eacute;sticos Home Products</title>
    <link href="<%= siteBean.getRootSiteURL() %>/css/estilo.css" rel="stylesheet" type="text/css" />
    <link href="<%= siteBean.getRootSiteURL() %>/resources/css/cssLayout.css" rel="stylesheet" type="text/css" />
    <link href="<%= siteBean.getRootSiteURL() %>/resources/css/primefaces.css" rel="stylesheet" type="text/css" />
    <link href="<%= siteBean.getRootSiteURL() %>/resources/css/bluesky/skin.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<%= siteBean.getRootSiteURL() %>/js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="<%= siteBean.getRootSiteURL() %>/js/jquery-ui-1.8.21.js"></script>
    <script type="text/javascript" src="<%= siteBean.getRootSiteURL() %>/js/ajaxCalls.js"></script>
    <script type="text/javascript" src="<%= siteBean.getRootSiteURL() %>/js/validaciones.js"></script>
</head>
<body>

<div id="ajaxErrorContainer">
</div>
<div id="ajaxErrorValues"></div>

<table class="mainContainer">
    <tr>
        <td colspan="2">
            <div class="cabecera">
                <table border="0">
                    <tr>
                        <td><img src="<%= siteBean.getRootSiteURL() %>/images/ehp-logo.png" alt="" height="100" width="100" /></td>
                        <td>
                            <h1>Electrodom&eacute;sticos Home Products</h1>
                            <h2>Sistemas de Compras Online</h2>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
       <td width="180px" id="menuLeft" valign="top">
           <div>
               <ul class="">
                        <li class="header"><h3>Opciones</h3></li>
                        <li class="itemLink">
                            <a class="" href="<%= siteBean.getRootSiteURL() %>">
                                <span class="menuitem-text">Inicio</span>
                            </a>
                        </li>
                        <li class="itemLink">
                            <%
                                if(loginDTO != null && loginDTO.isLogged()){
                            %>
                                <b>Bienvenido <%= loginDTO.getIdUsuario() %></b>
                            <%	
                                } else {
                            %>
	                            <font color="#BED6F8">^</font>
	                            <a class="" href="<%= siteBean.getRootSiteURL() %>/servlet?action=showLoginForm">
	                                <span class="menuitem-text">Iniciar Sesi&oacute;n</span>
	                            </a>
                            <%
                                }
                            %>

                        </li>
                        <li class="itemLink">
                            <a class="" href="<%= siteBean.getRootSiteURL() %>/servlet?action=doLogout">
                                <span class="menuitem-text">Cerrar Sesi&oacute;n</span>
                            </a>
                        </li>
                    </ul>
            </div>
            <br />
            <jsp:include page="modulosAfterLogin.jsp"></jsp:include>
       </td>
       <td width="1000px" id="workArea" valign="top">
           <div>
               <jsp:include page="./erroresMsgs.jsp"></jsp:include>
           </div>

