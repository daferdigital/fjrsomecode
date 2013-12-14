package com.fjr.code.dto;

/**
 * 
 * Class: UsuarioDTO
 * Creation Date: 14/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class UsuarioDTO {
	private int id;
	private String login;
	private String clave;
	private String nombre;
	private boolean activo;
	private String claveEscrita;
	
	public UsuarioDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getLogin() {
		return login;
	}

	public void setLogin(String login) {
		this.login = login;
	}

	public String getClave() {
		return clave;
	}

	public void setClave(String clave) {
		this.clave = clave;
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
	
	public void setClaveEscrita(String claveEscrita) {
		this.claveEscrita = claveEscrita;
	}
	
	public String getClaveEscrita() {
		return claveEscrita;
	}

	@Override
	public String toString() {
		return "UsuarioDTO [id=" + id + ", login=" + login + ", clave=" + clave
				+ ", nombre=" + nombre + "]";
	}
}
