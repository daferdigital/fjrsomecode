package com.carrito.forms;

import javax.servlet.http.HttpServletRequest;

import org.apache.struts.action.ActionErrors;
import org.apache.struts.action.ActionForm;
import org.apache.struts.action.ActionMapping;

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
	private int idBanco;
	private int idTipoPago;
	private String nroTarjetaCheque;
	private int[] productosSeleccionados;
	private int[] cantidadesSeleccionadas;
	
	public BasketForm() {
		// TODO Auto-generated constructor stub
	}

	@Override
	public ActionErrors validate(ActionMapping mapping,
			HttpServletRequest request) {
		// TODO Auto-generated method stub
		ActionErrors errors = new ActionErrors();
		
		
		
		return errors;
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
	
	public int getIdBanco() {
		return idBanco;
	}
	
	public void setIdBanco(int idBanco) {
		this.idBanco = idBanco;
	}
	
	public int getIdTipoPago() {
		return idTipoPago;
	}
	
	public void setIdTipoPago(int idTipoPago) {
		this.idTipoPago = idTipoPago;
	}
	
	public String getNroTarjetaCheque() {
		return nroTarjetaCheque;
	}
	
	public void setNroTarjetaCheque(String nroTarjetaCheque) {
		this.nroTarjetaCheque = nroTarjetaCheque;
	}
}
