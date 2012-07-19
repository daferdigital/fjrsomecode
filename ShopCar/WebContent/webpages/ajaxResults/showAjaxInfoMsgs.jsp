<%@page import="java.util.Iterator"%>
<%@page import="com.yss.dto.ErrorMessageDTO"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>

<%
    ErrorMessageDTO errores = (ErrorMessageDTO) request.getAttribute(AppConstant.ATT_ERRORES_MSGS);
    Boolean redirectToHome = (Boolean) request.getAttribute(AppConstant.ATT_REDIRECT_TO_WELCOME);
    redirectToHome = (redirectToHome == null) ? Boolean.FALSE : redirectToHome;
%>
    <%
        if((errores != null) && (errores.getErrorCount() > 0)){
            Iterator<String> errorIter = errores.getErrorMessages().iterator();
    %>
        <div id="msgsAjaxContainer" class="msgsAjaxContainer">
            <div><input id="errorContainerClose" type="button" value="[X]" title="Click para cerrar" onclick="hideErrors(<%=redirectToHome%>)"/></div>
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
    
<%

%>