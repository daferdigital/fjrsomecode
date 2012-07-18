<%@page import="java.util.Iterator"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.dto.ErrorMessageDTO"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%
    ErrorMessageDTO errores = (ErrorMessageDTO) request.getAttribute(AppConstant.ATT_ERRORES_MSGS);
%>
    <%
        if(errores != null){
        	Iterator<String> errorIter = errores.getErrorMessages().iterator();
    %>
        <div id="errorContainer" class="errorContainer">
            <div><a href="#errorContainer">[X]</a></div>
            <ul>
    <%
        	while(errorIter.hasNext()){
    %>
        		<li><%= errorIter.next() %></li>
    <%
        	}
    %>
            </ul>
        </div>
    <%
        }
    %>