package com.fjr.code.dao.definitions;

/**
 * 
 * Class: ModulosSistema
 * Creation Date: 21/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public enum ModulosSistema {
	ENTREGA("ENTREGA"),
	INGRESO("INGRESO"),
	MACROSCOPICA("MACRO"),
	HISTOLOGIA("HISTOLOGIA"),
	MICROSCOPICA("MICRO"),
	INFORME_COMPLEMENTARIO("INFORME_COMPLEMENTARIO"),
	IHQ("IHQ"),
	MAESTROS("MAESTROS"),
	BUSQUEDA("BUSQUEDAS");
	
	private String key;
	
	/**
	 * 
	 * @param key
	 */
	private ModulosSistema(String key) {
		// TODO Auto-generated constructor stub
		this.key = key;
	}
	
	/**
	 * 
	 * @return
	 */
	public String getKey() {
		return key;
	}
}
