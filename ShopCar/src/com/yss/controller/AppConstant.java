package com.yss.controller;

/**
 * 
 * Class: AppConstant
 * Creation Date: 01/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class AppConstant {
	
	private AppConstant() {
		/**/
	}
	
	public static final String SERVLET_NAME = "SERVLET";
	
	public static final String ACTION = "action";
	
	public static final int ROL_ADMIN_VALUE = 1;
	public static final int ROL_VENDEDOR_VALUE = 2;
	public static final int ROL_CLIENTE_VALUE = 3;
	public static final int ROL_APROBADOR_VALUE = 4;
	
	public static final String ATT_BEAN_SITE = "attBeanSite";
	public static final String ATT_BEAN_USER_VIEW = "attBeanUserSite";
	public static final String ATT_ERRORES_MSGS = "attErroresMsgs";
	public static final String ATT_PAGING_RESULTS = "attPagingResults";
	public static final String ATT_CLIENTE_DTO = "attClienteDTO";
	public static final String ATT_SHOP_CAR_DTO = "attShopCarDTO";
	
	//constantes asociadas a la paginacion
	public static final String PAGING_PAGE_NUMBER = "pagingPageNumber";
	
	public static final String PARAM_LOGIN = "paramLogin";
	public static final String PARAM_PASSWORD = "paramPassword";
	public static final String PARAM_ID_CLIENTE = "paramIdCliente";
	public static final String PARAM_RIF_CLIENTE = "paramRifCliente";
	public static final String PARAM_RAZON_SOCIAL_CLIENTE = "paramRazonSocialCliente";
	public static final String PARAM_CONTACTO_CLIENTE = "paramContactoCliente";
	public static final String PARAM_ID_PRODUCTO = "paramIdProducto";
	public static final String PARAM_DESC_PRODUCTO = "paramDescProducto";
	public static final String PARAM_LINEA_PRODUCTO = "paramLineaProducto";
	public static final String PARAM_MARCA_PRODUCTO = "paramMarcaProducto";
}
