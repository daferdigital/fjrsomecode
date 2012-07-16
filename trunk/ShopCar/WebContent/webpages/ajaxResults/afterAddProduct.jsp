<%@page import="com.yss.controller.AppConstant"%>
<%@page import="com.yss.dto.ShopCarDTO"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%
    ShopCarDTO shopCar = (ShopCarDTO) request.getAttribute(AppConstant.ATT_SHOP_CAR_DTO);
    //simplemente voy a escribir para el ajax la cantidad de elementos en el carrito
%>
<b>(<%=shopCar.getShopCarSize()%>)</b>