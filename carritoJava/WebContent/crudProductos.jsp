<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<jsp:include page="includes/header.jsp"></jsp:include>

    <div id="page-padding">
        <!-- empezar contenido -->
        <div id="content">
            <div id="content-padding">
                <h1>Manejo de productos  </h1>
            
                <div class="contLbl">
                    <html:form>
                        <label>Categor&iacute;a</label>
	                    <select id="categoria" onchange="getProductList(1)">
	                        <option value="0">Seleccione una opci&oacute;n...</option>
	                        <logic:iterate id="listadoCategorias" name="indexVOForm" property="categorias">
	                            <option value="<bean:write name="listadoCategorias" property="id"/>">
	                                <bean:write name="listadoCategorias" property="nombre"/>
	                            </option>
	                        </logic:iterate>
	                    </select>
	                    <br />
	                    <br />
                    </html:form>
                </div>
                <div id="ajaxAnswer"></div>
            </div>
        </div>
        <!-- end content -->
        
        <jsp:include page="includes/menuDerecha.jsp" flush="true"></jsp:include>
      </div>

<jsp:include page="includes/footer.jsp"></jsp:include>