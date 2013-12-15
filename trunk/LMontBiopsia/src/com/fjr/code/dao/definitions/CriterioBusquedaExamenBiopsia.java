package com.fjr.code.dao.definitions;

/**
 * 
 * Class: CriterioBusquedaExamenBiopsia
 * Creation Date: 02/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public enum CriterioBusquedaExamenBiopsia {
	TODOS("Seleccione"),
	NOMBRE("Nombre"),
	CODIGO("Código"),
	CODIGO_PREMIUM("Código Premium"),
	ESPECIALIDAD("Especialidad"),
	ACTIVO("Activo", false),
	INACTIVO("Inactivo", false);
	
	private String textoDelCombo;
	private boolean showInCombo;
	
	/**
	 * 
	 * @param textoDelCombo
	 */
	private CriterioBusquedaExamenBiopsia(String textoDelCombo) {
		// TODO Auto-generated constructor stub
		this(textoDelCombo, true);
	}
	
	/**
	 * 
	 * @param textoDelCombo
	 * @param showInCombo
	 */
	private CriterioBusquedaExamenBiopsia(String textoDelCombo, boolean showInCombo) {
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
