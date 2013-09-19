package com.fjr.code.dto;

/**
 * 
 * Class: PremiumCliempreDTO
 * Creation Date: 18/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class PremiumCliempreDTO {
	private String codigo;
	private String nroCedula;
	private String rif;
	private String direccion;
	private String telefono;
	private String email;
	private int edad;
	
	public PremiumCliempreDTO() {
		// TODO Auto-generated constructor stub
	}

	public String getCodigo() {
		return codigo;
	}

	public void setCodigo(String codigo) {
		this.codigo = codigo;
	}

	public String getNroCedula() {
		return nroCedula;
	}

	public void setNroCedula(String nroCedula) {
		this.nroCedula = nroCedula;
	}

	public String getRif() {
		return rif;
	}

	public void setRif(String rif) {
		this.rif = rif;
	}

	public String getDireccion() {
		return direccion;
	}

	public void setDireccion(String direccion) {
		this.direccion = direccion;
	}

	public String getTelefono() {
		return telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public int getEdad() {
		return edad;
	}

	public void setEdad(int edad) {
		this.edad = edad;
	}
}
