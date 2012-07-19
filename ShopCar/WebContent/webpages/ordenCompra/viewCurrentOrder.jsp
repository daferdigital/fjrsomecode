<%@page import="com.yss.dto.ProductoDTO"%>
<%@page import="java.util.Iterator"%>
<%@page import="com.yss.dto.ShopCarDTO"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.dto.LoginDTO"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>

<jsp:include page="../../includes/header.jsp"></jsp:include>

<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
    LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
    ShopCarDTO shopCar = (ShopCarDTO) request.getAttribute(AppConstant.ATT_SHOP_CAR_DTO);
    int colSpan = 3;
%>

<div id="infoContainer">
    <div id="loadingCape">
        <h3>Su solicitud esta siendo procesada, espere por favor.</h3>
        <br />
        <img src="<%= siteBean.getRootSiteURL() %>/images/cargando.gif" width="80px" height="80px"/>
    </div>

<%
    //verificamos si existe un carrito en este punto
    if((shopCar == null) || ((shopCar != null) && (shopCar.getShopCarSize() == 0))){
    	//el carrito no existe o esta vacio.
%>
    <h3>
        Disculpe, no ha seleccionado ningun producto para esta orden de compra.
        <br />
        Ingrese en la secci&oacute;n "Orden de Compra" por favor.
    </h3>
<%
    } else {
%>
    <h3>
        Por favor. Modifique las cantidades de los productos que desea solicitar, para obtener el total de la orden.
    </h3>

    <%
        if(AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()){
            //el usuario es vendedor, le informamos que puede indicar el respectivo descuento en los productos.
    %>
        <h3>
            Recuerda que como vendedor puedes indicar descuentos en ciertos productos.
        </h3>
    <%
        }
    %>
    
    <div style="display: inline-block; vertical-align:top">
        <h3>
            Indique los comentarios que desea realizar
            <br /> sobre esta orden de compra por favor:
        </h3>
    </div>
    <div style="display: inline-block">
        <textarea rows="6" cols="50" name="observaciones" style="resize: none"></textarea>
    </div>
    
    <br /><br />
    
    <table class="listTable">
        <tr>
            <td class="headerTD">Id Producto</td>
            <td class="headerTD">Descripci&oacute;n Producto</td>
            <td class="headerTD" width="25%">
                Cantidad &nbsp;
                <!-- 
                <a href="javascript:refreshOrder()" title="Haga click para refrescar el total del carrito.">
                    <img src="<%= siteBean.getRootSiteURL() %>/images/icons/refresh.png" border="0"/>
                </a>
                 -->
            </td>
            <td class="headerTD">Precio Unitario</td>
            <%
                if(AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()){
                	colSpan = 4;
                //el usuario es vendedor, le informamos que puede indicar el respectivo descuento en los productos.
            %>
            <td class="headerTD">% de Descuento</td>
            <%
                }
            %>
        </tr>
        <%
            Iterator<ProductoDTO> carItems = shopCar.getProductList().iterator();
            int itemNumber = 0;
            
            while(carItems.hasNext()){
            	ProductoDTO tmp = carItems.next();
        %>
        <tr>
            <td>
                <input type="hidden" name="idProducto_<%=itemNumber%>" value="<%=tmp.getIdProducto()%>"/>
                <%=tmp.getIdProducto()%>
            </td>
            <td><%=tmp.getDescripcion()%></td>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text"  id="cantidad_<%=itemNumber%>" name="cantidad_<%=itemNumber%>" onkeypress="return justAllowNumbers(event);" onkeyup="setTotalOfCar();" value="<%=tmp.getCantidadEnCarrito()%>"/>
                &nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            <td>
                <input type="hidden" id="precio_<%=itemNumber%>" name="precio_<%=itemNumber%>" value="<%=tmp.getPriceOfClient(Integer.parseInt(shopCar.getCliente().getPrecioA().trim()))%>"/>
                <%=tmp.getPriceOfClient(Integer.parseInt(shopCar.getCliente().getPrecioA().trim()))%>
            </td>
        
            <%
                if(AppConstant.ROL_VENDEDOR_VALUE == loginDTO.getIdRol()){
                //el usuario es vendedor, le informamos que puede indicar el respectivo descuento en los productos.
            %>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" id="descuento_<%=itemNumber%>" name="descuento_<%=itemNumber%>" onkeypress="return allowCharactersToNumberDouble(this.value, event);" onkeyup="setTotalOfCar();" value="0"/>
                &nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
            <%
                }
            %>
        <%
                itemNumber ++;
            }
        %>
        <tr>
            <td align="right" colspan="<%=colSpan%>"><b>Total: </b></td>
            <td align="center"><span id="totalPriceOrder"></span></td>
        </tr>
        <tr>
            <td align="center" colspan="<%=colSpan + 1%>">
                <input type="button" value="Pre-Ordenar" onclick="doPreOrder()"/>
                &nbsp;
                <input type="button" value="Descartar Orden" onclick="discardShopOrder()"/>
            </td>
        </tr>
    </table>
    
    <script>
        setTotalOfCar();
    </script>
    <%
    }
%>
</div>

<jsp:include page="../../includes/footer.jsp"></jsp:include>
