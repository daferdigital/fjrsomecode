package com.fjr.code.dto;

import java.util.List;

/**
 * 
 * Class: BiopsiaMicroLaminasDTO
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaMicroLaminasDTO {
	private int id;
	private int cassete;
	private int bloque;
	private int lamina;
	private String descripcion;
	private List<ReactivoDTO> reactivosDTO;
	private List<BiopsiaMicroLaminasFileDTO> microLaminasFilesDTO; 
	
	public BiopsiaMicroLaminasDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getCassete() {
		return cassete;
	}

	public void setCassete(int cassete) {
		this.cassete = cassete;
	}

	public int getBloque() {
		return bloque;
	}

	public void setBloque(int bloque) {
		this.bloque = bloque;
	}

	public int getLamina() {
		return lamina;
	}

	public void setLamina(int lamina) {
		this.lamina = lamina;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public List<ReactivoDTO> getReactivosDTO() {
		return reactivosDTO;
	}

	public void setReactivosDTO(List<ReactivoDTO> reactivosDTO) {
		this.reactivosDTO = reactivosDTO;
	}
	
	public List<BiopsiaMicroLaminasFileDTO> getMicroLaminasFilesDTO() {
		return microLaminasFilesDTO;
	}
	
	public void setMicroLaminasFilesDTO(
			List<BiopsiaMicroLaminasFileDTO> microLaminasFilesDTO) {
		this.microLaminasFilesDTO = microLaminasFilesDTO;
	}

	@Override
	public String toString() {
		return "BiopsiaMicroLaminasDTO [id=" + id + ", cassete=" + cassete
				+ ", bloque=" + bloque + ", lamina=" + lamina
				+ ", descripcion=" + descripcion + ", reactivoDTO="
				+ reactivosDTO + ", microLaminasFilesDTO="
				+ microLaminasFilesDTO + "]";
	}
}
