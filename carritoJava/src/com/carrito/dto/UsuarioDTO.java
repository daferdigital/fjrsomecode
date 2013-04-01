package com.carrito.dto;

import java.util.List;

/**
 * 
 * Class: UsuarioDTO
 * Creation Date: 30/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class UsuarioDTO {
	private int id;
	private String cedula;
	private String nombre;
	private String apellido;
	private String telefono;
	private String direccion;
	private String email;
	private String login;
	private int idPerfil;
	private String nombrePerfil;
	private List<CarritoItemDTO> carritoItems;
	
	public UsuarioDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getCedula() {
		return cedula;
	}

	public void setCedula(String cedula) {
		this.cedula = cedula;
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getApellido() {
		return apellido;
	}

	public void setApellido(String apellido) {
		this.apellido = apellido;
	}

	public String getTelefono() {
		return telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getDireccion() {
		return direccion;
	}

	public void setDireccion(String direccion) {
		this.direccion = direccion;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getLogin() {
		return login;
	}

	public void setLogin(String login) {
		this.login = login;
	}

	public int getIdPerfil() {
		return idPerfil;
	}

	public void setIdPerfil(int idPerfil) {
		this.idPerfil = idPerfil;
	}

	public String getNombrePerfil() {
		return nombrePerfil;
	}

	public void setNombrePerfil(String nombrePerfil) {
		this.nombrePerfil = nombrePerfil;
	}

	public void setItemsCarrito(List<CarritoItemDTO> carritoItems) {
		// TODO Auto-generated method stub
		this.carritoItems = carritoItems;
	}
	
	public List<CarritoItemDTO> getCarritoItems() {
		return carritoItems;
	}
}
