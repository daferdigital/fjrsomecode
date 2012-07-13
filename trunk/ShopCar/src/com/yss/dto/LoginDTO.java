package com.yss.dto;

/**
 * 
 * Class: LoginDTO
 * Creation Date: 05/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class LoginDTO {
	private String idUsuario;
	private int idRol;
	private long lastLoginTime = -1;
	private boolean isLogged;
	private String email;
	private String idClienteRelated;
	
	public LoginDTO() {
		// TODO Auto-generated constructor stub
	}

	public String getIdUsuario() {
		return idUsuario;
	}

	public void setIdUsuario(String idUsuario) {
		this.idUsuario = idUsuario;
	}

	public int getIdRol() {
		return idRol;
	}

	public void setIdRol(int idRol) {
		this.idRol = idRol;
	}

	public long getLastLoginTime() {
		return lastLoginTime;
	}

	public void setLastLoginTime(long lastLoginTime) {
		this.lastLoginTime = lastLoginTime;
	}
	
	public void setLogged(boolean isLogged) {
		this.isLogged = isLogged;
	}
	
	public boolean isLogged() {
		return isLogged;
	}
	
	public void setEmail(String email) {
		this.email = email;
	}
	
	public String getEmail() {
		return email;
	}
	
	public void setIdClienteRelated(String idClienteRelated) {
		this.idClienteRelated = idClienteRelated;
	}
	
	public String getIdClienteRelated() {
		return idClienteRelated;
	}
}
