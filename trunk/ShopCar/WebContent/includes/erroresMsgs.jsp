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
            <div><input id="errorContainerClose" type="button" value="[X]" title="Click para cerrar"/></div>
            <ul>
    <%
        	while(errorIter.hasNext()){
    %>
        		<li><%= errorIter.next() %></li>
    <%
        	}
    %>
            </ul>
            
            <script type="text/javascript">
                //colocamos aqui todos los contenedores posibles donde pueden estar los errores
                //para ocultar todos los elementos relacionados de una vez
                $("#errorContainerClose").click (function(){
                	$("#errorContainer").fadeOut(700);
                	$("#ajaxErrorValues").fadeOut(700);
                	$("#ajaxErrorContainer").fadeOut(700);
                });
            </script>
        </div>
    <%
        }
    %>