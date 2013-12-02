package com.fjr.code.dto;

/**
 * 
 * Class: TipoEstudioDTO
 * Creation Date: 30/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class TipoEstudioDTO {
	private int id;
	private String nombre;
	private boolean activo;
	private String abreviatura;
	
	public TipoEstudioDTO() {
		// TODO Auto-generated constructor stub
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

	public boolean isActivo() {
		return activo;
	}

	public void setActivo(boolean activo) {
		this.activo = activo;
	}
	
	public String getAbreviatura() {
		return abreviatura;
	}

	public void setAbreviatura(String abreviatura) {
		this.abreviatura = abreviatura;
	}

	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return nombre;
	}
}
