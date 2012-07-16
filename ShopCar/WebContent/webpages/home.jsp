<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
%>

<jsp:include page="../includes/header.jsp"></jsp:include>

    <div id="contenido">
        <div id="principal">
            <input name="j_idt30" value="j_idt30" type="hidden">
            <div id="" class="ui-accordion ui-widget ui-helper-reset ui-hidden-container">
                <h3 id="productos_header" class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active ui-corner-top" role="tab" aria-expanded="true">
                    <span class="ui-icon ui-icon-triangle-1-s"></span>
                    <a href="#" tabindex="-1">Productos</a>
                </h3>
                
                <div id="productos" class="ui-accordion-content ui-helper-reset ui-widget-content" role="tabpanel" aria-hidden="false">
                    <table>
	                    <tr>
	                        <td><img id="j_idt30:j_idt31:j_idt34" src="<%= siteBean.getRootSiteURL() %>/images/miidea.jpg" alt="" /></td>
	                        <td><img id="j_idt30:j_idt31:j_idt35" src="<%= siteBean.getRootSiteURL() %>/images/baco.jpg" alt="" /></td>
	                    </tr>
	                    <tr>
							<td><img id="j_idt30:j_idt31:j_idt36" src="<%= siteBean.getRootSiteURL() %>/images/krolls.jpg" alt="" /></td>
							<td><img id="j_idt30:j_idt31:j_idt37" src="<%= siteBean.getRootSiteURL() %>/images/aita.jpg" alt="" /></td>
	                    </tr>
                    </table>
                </div>
                
                <h3 id="about_us_header" class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all">
                    <span class="ui-icon ui-icon-triangle-1-e"></span>
                    <a href="#" tabindex="-1">Acerca de nosotros</a>
                </h3>
                
                <div id="about_us_content" class="ui-accordion-content ui-helper-reset ui-widget-content ui-helper-hidden">
                    Informacion de acerca de...
                </div>
            </div>
        </div>
        
        <div id="secundario">
            <span id="j_idt44:growl"></span>
            <div id="j_idt44:pnl" class="ui-panel ui-widget ui-widget-content ui-corner-all">
                <div id="j_idt44:pnl_header" class="ui-panel-titlebar ui-widget-header ui-corner-all">
                    <span class="ui-panel-title">Detalle del carrito</span>
                    <a id="closeDiv" href="#" class="ui-panel-titlebar-icon ui-corner-all ui-state-default">
                        <span id="j_idt44:pnl_closer" class="ui-icon ui-icon-closethick"></span>
                    </a>
                    <a id="hideDiv" href="#" class="ui-panel-titlebar-icon ui-corner-all ui-state-default">
                        <span id="j_idt44:pnl_toggler" class="ui-icon ui-icon-minusthick"></span>
                    </a>
                </div>
                <div id="j_idt44_pnl_content" class="ui-panel-content ui-widget-content">
                    Indicar aqui la descripcion del carrito
                </div>
            </div>
        </div>
    </div>
    
    <div style="clear: both;"></div>

<script type="text/javascript">
    $("#productos_header").click(function () {
    	if($("#productos_header > span").attr('class') == "ui-icon ui-icon-triangle-1-s"){
    		$("#productos_header > span").attr("class", "ui-icon ui-icon-triangle-1-e");
    		$("#productos").fadeOut(500);
    	}else{
    		$("#productos_header > span").attr("class", "ui-icon ui-icon-triangle-1-s");
            $("#productos").fadeIn(2000);
    	}
    });
    
    $("#about_us_header").click(function () {
        if($("#about_us_header > span").attr('class') == "ui-icon ui-icon-triangle-1-s"){
            $("#about_us_header > span").attr("class", "ui-icon ui-icon-triangle-1-e");
            $("#about_us_content").fadeOut(500);
        }else{
            $("#about_us_header > span").attr("class", "ui-icon ui-icon-triangle-1-s");
            $("#about_us_content").fadeIn(2000);
        }
    });
    
    $("#closeDiv").click(function () {
    	$("#secundario").fadeOut(500);
    });
    
    $("#hideDiv").click(function () {
        if($("#hideDiv > span").attr("class") == "ui-icon ui-icon-minusthick"){
        	$("#hideDiv > span").attr("class", "ui-icon ui-icon-plusthick");
        	$("#j_idt44_pnl_content").fadeOut(500);
        } else {
        	$("#hideDiv > span").attr("class", "ui-icon ui-icon-minusthick");
        	$("#j_idt44_pnl_content").fadeIn(2000);
        }
    });
</script>

<jsp:include page="../includes/footer.jsp"></jsp:include>
