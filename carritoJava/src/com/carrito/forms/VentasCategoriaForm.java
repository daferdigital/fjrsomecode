package com.carrito.forms;

import org.apache.struts.action.ActionForm;

public class VentasCategoriaForm extends ActionForm{
	/**
	 * 
	 */
	private static final long serialVersionUID = -4207514535447320460L;
	
	private String dateFrom;
	private String dateTo;
	
	public VentasCategoriaForm() {
		// TODO Auto-generated constructor stub
	}
	
	public void setDateFrom(String dateFrom) {
		this.dateFrom = dateFrom;
	}
	
	public String getDateFrom() {
		return dateFrom;
	}
	
	public void setDateTo(String dateTo) {
		this.dateTo = dateTo;
	}
	
	public String getDateTo() {
		return dateTo;
	}

	@Override
	public String toString() {
		return "VentasCategoriaForm [dateFrom=" + dateFrom 
				+ ", dateTo=" + dateTo + "]";
	}
}
