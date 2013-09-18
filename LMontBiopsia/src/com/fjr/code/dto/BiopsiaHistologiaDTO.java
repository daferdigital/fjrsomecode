package com.fjr.code.dto;

import java.util.List;

/**
 * 
 * Class: BiopsiaHistologiaDTO
 * Creation Date: 01/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaHistologiaDTO {
	private int id;
	private String descripcion;
	private List<BiopsiaCasseteDTO> cassetesDTO;
	
	public BiopsiaHistologiaDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getDescripcion() {
		return descripcion;
	}
	
	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public List<BiopsiaCasseteDTO> getCassetesDTO() {
		return cassetesDTO;
	}

	public void setCassetesDTO(List<BiopsiaCasseteDTO> cassetesDTO) {
		this.cassetesDTO = cassetesDTO;
	}
}
