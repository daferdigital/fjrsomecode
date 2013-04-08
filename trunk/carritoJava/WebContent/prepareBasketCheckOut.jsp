<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<jsp:include page="includes/header.jsp"></jsp:include>

<div id="page-padding">
    <!-- empezar contenido -->
    <div id="content">
        <div id="content-padding">
            <jsp:include page="carritoItemsCheckOut.jsp" flush="true"></jsp:include>
        </div>
    </div>
</div>

<jsp:include page="includes/footer.jsp"></jsp:include>