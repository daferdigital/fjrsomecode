package com.fjr.code.dao.definitions;

/**
 * 
 * Class: TipoEdadEnum
 * Creation Date: 04/02/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public enum TipoEdadEnum {
	MESES(1, "Meses"),
	ANIOS(2, "Años");
	
	private int id;
	private String nombre;
	
	/**
	 * 
	 * @param id
	 * @param nombre
	 */
	private TipoEdadEnum(int id, String nombre) {
		// TODO Auto-generated constructor stub
		this.id = id;
		this.nombre = nombre;
	}

	public int getId() {
		return id;
	}
	
	public void setId(int id) {
		this.id = id;
	}
		
	public String getNombre() {
		return nombre;
	}
	
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return nombre;
	}
}
