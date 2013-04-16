<%@page import="com.carrito.util.Constants"%>
<%@ taglib uri="/WEB-INF/struts-logic.tld" prefix="logic" %>
<%@ taglib uri="/WEB-INF/struts-bean.tld" prefix="bean" %>
<%@ taglib uri="/WEB-INF/struts-html.tld" prefix="html" %>

<jsp:include page="includes/header.jsp"></jsp:include>

<div id="page-padding">
    <!-- empezar contenido -->
    <div id="content">
        <div id="content-padding">
            <div id="tabs">
		        <ul>
		            <li><a href="#tabs-0">Ventas por categor&iacute;as</a></li>
		            <li><a href="#tabs-1">Ventas de productos</a></li>
		        </ul>
		        
		        <div id="tabs-0" style="background-color: white;">
		            <html:form action="exportCategoryReport" method="post">
		                <h3>Ventas por categor&iacute;as</h3>
		                <br />
		                Desde: <input type="text" name="dateFrom" id="dateFrom" value=""/>
		                <script>
		                    new JsDatePick({
		                        useMode:2,
		                        target:"dateFrom",        
		                        isStripped:true,
		                        weekStartDay:0,
		                        limitToToday:true,
		                        dateFormat:"%Y-%m-%d",
		                        imgPath:"./images/"
		                    });
		                </script>
		                <br />
		                
		                Hasta: <input type="text" name="dateTo" id="dateTo" />
                        <script>
                            var fecha = new Date();
                            
                            document.getElementById("dateFrom").value = fecha.getFullYear()
                            + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate();
                            
                            document.getElementById("dateTo").value = document.getElementById("dateFrom").value
                            
                            new JsDatePick({
                                useMode:2,
                                target:"dateTo",        
                                isStripped:true,
                                weekStartDay:0,
                                limitToToday:true,
                                dateFormat:"%Y-%m-%d",
                                imgPath:"./images/"
                            });
                        </script>
                        <br />
                        <br />
		                <html:submit>Descargar Reporte</html:submit>
		            </html:form>
		        </div>
		        <div id="tabs-1" style="background-color: white;">
                    <html:form action="exportInventarioReport" method="post">
                        <h3>Ventas por productos</h3>
                        <br />
                        Desde: <input type="text" name="dateFrom" id="dateFrom2" value=""/>
                        <script>
                            new JsDatePick({
                                useMode:2,
                                target:"dateFrom2",        
                                isStripped:true,
                                weekStartDay:0,
                                limitToToday:true,
                                dateFormat:"%Y-%m-%d",
                                imgPath:"./images/"
                            });
                        </script>
                        <br />
                        
                        Hasta: <input type="text" name="dateTo" id="dateTo2" />
                        <script>
                            var fecha = new Date();
                            
                            document.getElementById("dateFrom2").value = fecha.getFullYear()
                            + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate();
                            
                            document.getElementById("dateTo2").value = document.getElementById("dateFrom2").value
                            
                            new JsDatePick({
                                useMode:2,
                                target:"dateTo2",        
                                isStripped:true,
                                weekStartDay:0,
                                limitToToday:true,
                                dateFormat:"%Y-%m-%d",
                                imgPath:"./images/"
                            });
                        </script>
                        <br />
                        <br />
                        <html:submit>Descargar Reporte</html:submit>
                    </html:form>
                </div>
		    </div>
		    
		    <script>
			  $(function() {
			    $( "#tabs" ).tabs();
			  });
			</script>
        </div>
    </div>
</div>

<jsp:include page="includes/footer.jsp"></jsp:include>