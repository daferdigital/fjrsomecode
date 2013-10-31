package com.fjr.code.dto;

/**
 * 
 * Class: TipoExamenDTO
 * Creation Date: 30/10/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class TipoExamenDTO {
	private int id;
	private String nombre;
	private String codigo;
	private String descripcion;
	private boolean activo;
	
	public TipoExamenDTO() {
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

	public String getCodigo() {
		return codigo;
	}

	public void setCodigo(String codigo) {
		this.codigo = codigo;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public boolean isActivo() {
		return activo;
	}

	public void setActivo(boolean activo) {
		this.activo = activo;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return nombre;
	}
}
