package com.fjr.code.dto;

/**
 * 
 * Class: PatologoDTO
 * Creation Date: 30/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class PatologoDTO {
	private int id;
	private String nombre;
	private boolean activo;
	
	/**
	 * 
	 * @param id
	 * @param nombre
	 * @param activo
	 */
	public PatologoDTO(int id, String nombre, boolean activo) {
		// TODO Auto-generated constructor stub
		this.id = id;
		this.nombre = nombre;
		this.activo = activo;
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

	public void setActivo(boolean activo) {
		this.activo = activo;
	}
	
	public boolean isActivo() {
		return activo;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return nombre;
	}
}
