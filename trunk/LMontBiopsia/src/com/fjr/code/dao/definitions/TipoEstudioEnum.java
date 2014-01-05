package com.fjr.code.dao.definitions;

/**
 * 
 * Class: TipoEstudioEnum
 * Creation Date: 04/01/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public enum TipoEstudioEnum {
	BIOPSIA(1, "", "Biopsia"),
	CITOLOGIA(2, "-C", "Citologia"),
	IHQ(3, "", "IHQ"),
	CISH(4, "-CISH", "CISH");
	
	private int id;
	private String abreviatura;
	private String nombre;
	
	/**
	 * 
	 * @param id
	 * @param abreviatura
	 * @param nombre
	 */
	private TipoEstudioEnum(int id, String abreviatura,
			String nombre) {
		// TODO Auto-generated constructor stub
		this.id = id;
		this.abreviatura = abreviatura;
		this.nombre = nombre;
	}

	public int getId() {
		return id;
	}
	
	public void setId(int id) {
		this.id = id;
	}
	
	public String getAbreviatura() {
		return abreviatura;
	}
	
	public void setAbreviatura(String abreviatura) {
		this.abreviatura = abreviatura;
	}
	
	public String getNombre() {
		return nombre;
	}
	
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
}
