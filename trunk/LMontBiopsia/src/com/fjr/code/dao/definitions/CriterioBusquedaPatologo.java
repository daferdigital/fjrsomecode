package com.fjr.code.dao.definitions;

/**
 * 
 * Class: CriterioBusquedaPatologo
 * Creation Date: 09/08/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public enum CriterioBusquedaPatologo {
	TODOS("Seleccione"),
	NOMBRE("Nombre"),
	ACTIVO("Activo", false),
	INACTIVO("Inactivo", false);
	
	private String textoDelCombo;
	private boolean showInCombo;
	
	/**
	 * 
	 * @param textoDelCombo
	 */
	private CriterioBusquedaPatologo(String textoDelCombo) {
		// TODO Auto-generated constructor stub
		this(textoDelCombo, true);
	}
	
	/**
	 * 
	 * @param textoDelCombo
	 * @param showInCombo
	 */
	private CriterioBusquedaPatologo(String textoDelCombo, boolean showInCombo) {
		// TODO Auto-generated constructor stub
		this.textoDelCombo = textoDelCombo;
		this.showInCombo = showInCombo;
	}
	
	public String getTextoDelCombo() {
		return textoDelCombo;
	}
	
	public boolean isShowInCombo() {
		return showInCombo;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return textoDelCombo;
	}
}
