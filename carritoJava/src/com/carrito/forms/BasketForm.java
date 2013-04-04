package com.carrito.forms;

import org.apache.struts.action.ActionForm;

/**
 * 
 * Class: BasketForm
 * Creation Date: 04/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BasketForm extends ActionForm{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 5902409297663715729L;
	
	private int userId;
	private int[] productosSeleccionados;
	private int[] cantidadesSeleccionadas;
	
	public BasketForm() {
		// TODO Auto-generated constructor stub
	}

	public int getUserId() {
		return userId;
	}

	public void setUserId(int userId) {
		this.userId = userId;
	}

	public int[] getProductosSeleccionados() {
		return productosSeleccionados;
	}

	public void setProductosSeleccionados(int[] productosSeleccionados) {
		this.productosSeleccionados = productosSeleccionados;
	}
	
	public int[] getCantidadesSeleccionadas() {
		return cantidadesSeleccionadas;
	}
	
	public void setCantidadesSeleccionadas(int[] cantidadesSeleccionadas) {
		this.cantidadesSeleccionadas = cantidadesSeleccionadas;
	}
}
