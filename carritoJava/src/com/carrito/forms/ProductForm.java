package com.carrito.forms;

import org.apache.struts.action.ActionForm;

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
	
	public ProductForm() {
		// TODO Auto-generated constructor stub
	}
	
	public void setProductId(int productId) {
		this.productId = productId;
	}
	
	public int getProductId() {
		return productId;
	}
}
