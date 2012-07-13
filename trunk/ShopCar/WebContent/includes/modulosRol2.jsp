<!-- Inicio modulosRol2.jsp (Vendedores) -->
<%@page import="com.yss.dto.LoginDTO"%>
<%@page import="com.yss.javabeans.view.UserSiteBean"%>
<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.javabeans.view.SiteBean"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%
    SiteBean siteBean = (SiteBean) request.getAttribute(AppConstant.ATT_BEAN_SITE);
    LoginDTO loginDTO = (LoginDTO) request.getSession().getAttribute(AppConstant.ATT_BEAN_USER_VIEW);
%>

<%
    if((loginDTO != null) && (loginDTO.isLogged())){
%>
    <div id="opcionesDespuesDeLogin">
           <ul class="">
                    <li class="header"><h3>Catalogo</h3></li>
                    <li class="itemLink">
                        <a class="" href="<%= siteBean.getRootSiteURL() %>/servlet?action=createShopCar">
                            <span class="menuitem-text">Orden de compra</span>
                        </a>
                    </li>
                    <li class="itemLink">
                        <a class="" href="<%= siteBean.getRootSiteURL() %>/servlet?action=viewCurrentShopCar">
                            <span class="menuitem-text">Visualizar carrito </span>
                            <span id="numberOfElementsInShopCar"></span>
                        </a>
                    </li>
                    <li class="itemLink">
                        <a class="" href="/ShoppingCar/pg/home.jsf">
                            <span class="menuitem-text">CheckOut carrito (pre-pedido)</span>
                        </a>
                    </li>
                </ul>
      </div>
<%
    }
%>

<!-- Fin modulosRol2.jsp  -->