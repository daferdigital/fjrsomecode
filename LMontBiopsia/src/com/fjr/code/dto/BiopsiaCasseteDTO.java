package com.fjr.code.dto;

/**
 * 
 * Class: BiopsiaCasseteDTO
 * Creation Date: 11/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaCasseteDTO {
	private int id;
	private int numero;
	private String descripcion;
	private int bloques;
	private int laminas;
	
	public BiopsiaCasseteDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getNumero() {
		return numero;
	}

	public void setNumero(int numero) {
		this.numero = numero;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public int getBloques() {
		return bloques;
	}

	public void setBloques(int bloques) {
		this.bloques = bloques;
	}

	public int getLaminas() {
		return laminas;
	}

	public void setLaminas(int laminas) {
		this.laminas = laminas;
	}
	
	@Override
	public String toString() {
		return "BiopsiaCasseteDTO [id=" + id + ", numero=" + numero
				+ ", descripcion=" + descripcion + ", bloques=" + bloques
				+ ", laminas=" + laminas + "]";
	}
}
