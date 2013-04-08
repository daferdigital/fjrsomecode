<%@page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<div id="right-nav">
    <!-- right side menu, copy and paste what is contained between these start and end comment tags to make an extra menu -->
    <div class="right-nav-back">
        <div class="right-nav-top">
            <p>. : Carrito </p>
        </div>
        
        <jsp:include page="../carritoItems.jsp" flush="true"></jsp:include>
        
        <div class="right-nav-bottom"></div>
    </div>
    <!-- end right side menu -->
    
    <!-- comienza menu  de boletines -->
    <div class="right-nav-back">
        <div class="right-nav-top">
            <p>. : Subscribete a nuestros boletines </p>
        </div>
        
        <br />
        
        <div id="subscribe">
            <form action="yourformmailhere" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="sendtoemail" value="youremailaddress" />
                  <input type="hidden" name="redirect" value="yourwebsiteaddress" />
                  <input type="hidden" name="subject" value="Newsletter subscription from your website" />
                  <input name="name" type="text" placeholder="Nombre" class="inputstyle" />
                  <input name="email" type="text" placeholder="Direccion de correo" class="inputstyle" />
                  <input type="submit" value="Suscribirme" class="button" />
            </form>
        </div>
        
        <div class="right-nav-bottom"></div>
    </div>
    <!-- fin menu  de boletines -->
    <br />
    <br />
    <br />
</div>