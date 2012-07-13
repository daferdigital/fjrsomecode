package com.yss.dto;

/**
 * 
 * Class: ClienteDTO
 * Creation Date: 06/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public class ClienteDTO {
	private String idCliente;
	private String rif;
	private String razonSocial;
	private String contacto;
	private String telefono;
	private String fax;
	
	public ClienteDTO() {
		// TODO Auto-generated constructor stub
	}

	public String getIdCliente() {
		return idCliente;
	}

	public void setIdCliente(String idCliente) {
		this.idCliente = idCliente;
	}

	public String getRif() {
		return rif;
	}

	public void setRif(String rif) {
		this.rif = rif;
	}

	public String getRazonSocial() {
		return razonSocial;
	}

	public void setRazonSocial(String razonSocial) {
		this.razonSocial = razonSocial;
	}

	public String getContacto() {
		return contacto;
	}

	public void setContacto(String contacto) {
		this.contacto = contacto;
	}

	public String getTelefono() {
		return telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getFax() {
		return fax;
	}

	public void setFax(String fax) {
		this.fax = fax;
	}
}
