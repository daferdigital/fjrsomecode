<%@page import="java.util.Iterator"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.dto.ErrorMessageDTO"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%
    ErrorMessageDTO errores = (ErrorMessageDTO) request.getAttribute(AppConstant.ATT_ERRORES_MSGS);
%>
    <%
        if((errores != null) && (errores.getErrorCount() > 0)){
        	Iterator<String> errorIter = errores.getErrorMessages().iterator();
    %>
        <div id="errorContainer" class="errorContainer">
            <div><input id="errorContainerClose" type="button" value="[X]" title="Click para cerrar" onclick="hideErrors()"/></div>
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