package com.fjr.code.dto;

/**
 * 
 * Class: AuditoriaBiopsiaDTO
 * Creation Date: 05/01/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class AuditoriaBiopsiaDTO {
	private String nombreEstudio;
	private int cantidad;
	
	public AuditoriaBiopsiaDTO() {
		// TODO Auto-generated constructor stub
	}

	public String getNombreEstudio() {
		return nombreEstudio;
	}

	public void setNombreEstudio(String nombreEstudio) {
		this.nombreEstudio = nombreEstudio;
	}

	public int getCantidad() {
		return cantidad;
	}

	public void setCantidad(int cantidad) {
		this.cantidad = cantidad;
	}
}
