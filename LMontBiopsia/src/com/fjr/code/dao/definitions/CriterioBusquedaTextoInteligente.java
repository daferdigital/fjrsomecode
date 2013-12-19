package com.fjr.code.dao.definitions;

/**
 * 
 * Class: CriterioBusquedaTextoInteligente
 * Creation Date: 02/11/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public enum CriterioBusquedaTextoInteligente {
	TODOS("Seleccione"),
	NOMBRE("Código"),
	DESCRIPCION("Descripción"),
	TEXTO("Parte del Texto");
	
	private String textoDelCombo;
	private boolean showInCombo;
	
	/**
	 * 
	 * @param textoDelCombo
	 */
	private CriterioBusquedaTextoInteligente(String textoDelCombo) {
		// TODO Auto-generated constructor stub
		this(textoDelCombo, true);
	}
	
	/**
	 * 
	 * @param textoDelCombo
	 * @param showInCombo
	 */
	private CriterioBusquedaTextoInteligente(String textoDelCombo, boolean showInCombo) {
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
