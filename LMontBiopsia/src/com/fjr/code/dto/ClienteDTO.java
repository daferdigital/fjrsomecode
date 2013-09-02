package com.fjr.code.dto;

/**
 * 
 * Class: ClienteDTO
 * Creation Date: 31/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ClienteDTO {
	private int id;
	private String idPremium;
	private String cedula;
	private String nombres;
	private String apellidos;
	private int edad;
	private String telefono;
	private String correo;
	private String direccion;
	private boolean activo;
	
	/**
	 * 
	 * @param id
	 * @param idPremium
	 * @param cedula
	 * @param nombres
	 * @param apellidos
	 * @param edad
	 * @param telefono
	 * @param correo
	 * @param direccion
	 * @param activo
	 */
	public ClienteDTO(int id, String idPremium, String cedula, String nombres,
			String apellidos, int edad, String telefono, String correo, 
			String direccion, boolean activo) {
		// TODO Auto-generated constructor stub
		setId(id);
		setIdPremium(idPremium);
		setCedula(cedula);
		setNombres(nombres);
		setApellidos(apellidos);
		setEdad(edad);
		setTelefono(telefono);
		setCorreo(correo);
		setDireccion(direccion);
		setActivo(activo);
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getIdPremium() {
		return idPremium;
	}

	public void setIdPremium(String idPremium) {
		this.idPremium = idPremium;
	}

	public String getCedula() {
		return cedula;
	}

	public void setCedula(String cedula) {
		this.cedula = cedula;
	}

	public String getNombres() {
		return nombres;
	}

	public void setNombres(String nombres) {
		this.nombres = nombres;
	}

	public String getApellidos() {
		return apellidos;
	}

	public void setApellidos(String apellidos) {
		this.apellidos = apellidos;
	}

	public int getEdad() {
		return edad;
	}

	public void setEdad(int edad) {
		this.edad = edad;
	}

	public String getTelefono() {
		return telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getCorreo() {
		return correo;
	}

	public void setCorreo(String correo) {
		this.correo = correo;
	}

	public String getDireccion() {
		return direccion;
	}

	public void setDireccion(String direccion) {
		this.direccion = direccion;
	}
	
	public void setActivo(boolean activo) {
		this.activo = activo;
	}
	
	public boolean isActivo() {
		return activo;
	}
}
