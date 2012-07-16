<!-- Inicio modulosRol1.jsp (Administrador) -->
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
           <ul class="ui-menu-list ui-helper-reset">
                    <li class="header"><h3>Mantenimiento</h3></li>
                    <li class="itemLink">
                        <a class="" href="/ShoppingCar/pg/home.jsf">
                            <span class="menuitem-text">Sincronizar Usuarios con Profit</span>
                        </a>
                    </li>
                    <li class="itemLink">
                        <a class="" href="/ShoppingCar/pg/home.jsf">
                            <span class="menuitem-text">Sincronizar Clientes con Profit</span>
                        </a>
                    </li>
                    <li class="itemLink">
                        <a class="" href="/ShoppingCar/pg/home.jsf">
                            <span class="menuitem-text">Sincronizar Productos con Profit</span>
                        </a>
                    </li>
                    <li class="itemLink">
                        <a class="" href="/ShoppingCar/pg/home.jsf">
                            <span class="menuitem-text">Autorizaci&oacute;n registro/cambio de clave</span>
                        </a>
                    </li>
                </ul>
      </div>
<%
    }
%>

<!-- Fin modulosRol1.jsp (Administrador) -->