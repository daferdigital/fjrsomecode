package com.fjr.code.dto;

import java.io.FileInputStream;

/**
 * 
 * Class: BiopsiaMacroFotoDTO
 * Creation Date: 11/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaMacroFotoDTO {
	private int id;
	private String notacion;
	private String descripcion;
	private String fotoName;
	private FileInputStream fotoBlob;
	
	public BiopsiaMacroFotoDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getNotacion() {
		return notacion;
	}

	public void setNotacion(String notacion) {
		this.notacion = notacion;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public FileInputStream getFotoBlob() {
		return fotoBlob;
	}

	public void setFotoBlob(FileInputStream fotoBlob) {
		this.fotoBlob = fotoBlob;
	}
	
	public void setFotoName(String fotoName) {
		this.fotoName = fotoName;
	}
	
	public String getFotoName() {
		return fotoName;
	}
}
