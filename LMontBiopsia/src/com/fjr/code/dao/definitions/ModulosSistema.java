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
	INGRESO("ingreso"),
	MACROSCOPICA("macro"),
	HISTOLOGIA("histologia"),
	MICROSCOPICA("micro"),
	IHQ("ihq"),
	MAESTROS("maestros"),
	BUSQUEDA("busqueda"),
	ENTREGA("entrega");
	
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
