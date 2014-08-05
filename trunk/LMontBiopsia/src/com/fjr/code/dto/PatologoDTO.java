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
	private String genero;
	private boolean activo;
	
	/**
	 * 
	 * @param id
	 * @param nombre
	 * @param activo
	 * @param genero
	 */
	public PatologoDTO(int id, String nombre, boolean activo,
			String genero) {
		// TODO Auto-generated constructor stub
		this.id = id;
		this.nombre = nombre;
		this.activo = activo;
		this.genero = genero;
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
	
	public void setGenero(String genero) {
		this.genero = genero;
	}
	
	public String getGenero() {
		return genero;
	}
	
	public String getFirmaInforme(){
		return genero + " " + nombre;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return genero + " " + nombre;
	}
}
