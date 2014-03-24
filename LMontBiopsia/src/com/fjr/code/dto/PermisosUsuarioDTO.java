package com.fjr.code.dto;

/**
 * 
 * Class: PermisosUsuarioDTO <br />
 * DateCreated: 08/01/2014 <br />
 * @author T&T <br />
 *
 */
public class PermisosUsuarioDTO {
	private int idUsuario;
	private int idModulo;
	private String nombreModulo;
	private String descripcionModulo;
	private String keyModulo;
	
	public PermisosUsuarioDTO() {
		// TODO Auto-generated constructor stub
	}

	public PermisosUsuarioDTO(String keyModulo) {
		// TODO Auto-generated constructor stub
		this.keyModulo = keyModulo;
	}
	
	public int getIdUsuario() {
		return idUsuario;
	}

	public void setIdUsuario(int idUsuario) {
		this.idUsuario = idUsuario;
	}

	public int getIdModulo() {
		return idModulo;
	}

	public void setIdModulo(int idModulo) {
		this.idModulo = idModulo;
	}

	public String getNombreModulo() {
		return nombreModulo;
	}

	public void setNombreModulo(String nombreModulo) {
		this.nombreModulo = nombreModulo;
	}

	public String getDescripcionModulo() {
		return descripcionModulo;
	}

	public void setDescripcionModulo(String descripcionModulo) {
		this.descripcionModulo = descripcionModulo;
	}

	public String getKeyModulo() {
		return keyModulo;
	}

	public void setKeyModulo(String keyModulo) {
		this.keyModulo = keyModulo;
	}
}
