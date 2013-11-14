<%@page import="com.dafer.util.SessionUtil"%>
<%@page import="com.dafer.util.Constants"%>

<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<%@ page language="java" contentType="text/html; charset=ISO-8859-1" pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>.:: Dafer System ::.</title>
    <link rel="stylesheet" type="text/css" href="css/site.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/jsDatePick_ltr.css" />
    <link rel="stylesheet" type="text/css" href="css/superfish.css" />
    
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jsDatePick.full.1.3.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="js/hoverIntent.js"></script>
    <script type="text/javascript" src="js/site.js"></script>
</head>
<body>
<table class="centered">
    <tr>
        <td colspan="2">
            <img border="0" alt="" id="header" src="imagenes/header.jpg" name="header" />
        </td>
    </tr>
    <%
    //verificamos si el usuario esta logueado, para mostrar el menu
    if(SessionUtil.getUserBeanInSession(request) != null){
    	//el usuario esta logueado
    %>
        <jsp:include page="menuUser.jsp" flush="true">
            <jsp:param value="idTipoUsuario" name="idTipoUsuario"/>
        </jsp:include>
    <%
    }
    %>
    <tr>
        <td colspan="2" align="center">
	        <span class="errorContainer">
	            <html:errors />
	        </span>
	        
	        <span class="messagesContainer">
	            <logic:messagesPresent message="true">
	                <html:messages id="aMsg" message="true">
	                    <logic:present name="aMsg">
	                            <bean:write name="aMsg" filter="false" />
	                    </logic:present>
	                </html:messages>
	            </logic:messagesPresent>
	        </span>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <!-- fin header.jsp -->