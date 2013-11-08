<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>
<%@page import="com.dafer.util.SessionUtil"%>

<jsp:include page="includes/header.jsp"></jsp:include>
<!-- inicio index.jsp -->
    <%
    //verificamos si el usuario esta logueado, para mostrar el menu
    if(SessionUtil.getUserBeanInSession(request) == null){
        //el usuario esta logueado
    %>
        <html:form action="doLogin.do" method="post" styleClass="centered">
            <table>
                <tr>
                    <td>Login:</td>
                    <td><html:text property="login"></html:text></td>
                </tr>
                <tr>
                    <td>Clave:</td>
                    <td><html:password property="password"></html:password></td>
                </tr>
            </table>
        </html:form>
    <%
    }
    %>
<!-- fin index.jsp -->    
<jsp:include page="includes/footer.jsp"></jsp:include>