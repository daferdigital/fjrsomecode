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
	private ReactivoDTO reactivoDTO;
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

	public ReactivoDTO getReactivoDTO() {
		return reactivoDTO;
	}

	public void setReactivoDTO(ReactivoDTO reactivoDTO) {
		this.reactivoDTO = reactivoDTO;
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
				+ reactivoDTO + ", microLaminasFilesDTO="
				+ microLaminasFilesDTO + "]";
	}
}
