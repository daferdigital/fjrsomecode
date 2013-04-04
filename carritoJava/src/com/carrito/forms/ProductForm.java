package com.carrito.forms;

import org.apache.struts.action.ActionForm;

import com.carrito.util.Constants;

/**
 * 
 * Class: AddProductToBasketForm
 * Creation Date: 31/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ProductForm extends ActionForm {

	/**
	 * 
	 */
	private static final long serialVersionUID = -6888728783046642152L;

	private int productId;
	private String pageComeFrom = Constants.COME_FROM_MENU_RIGTH;
	
	public ProductForm() {
		// TODO Auto-generated constructor stub
	}
	
	public void setProductId(int productId) {
		this.productId = productId;
	}
	
	public int getProductId() {
		return productId;
	}
	
	public void setPageComeFrom(String pageComeFrom) {
		this.pageComeFrom = pageComeFrom;
	}
	
	public String getPageComeFrom() {
		return pageComeFrom;
	}
}
