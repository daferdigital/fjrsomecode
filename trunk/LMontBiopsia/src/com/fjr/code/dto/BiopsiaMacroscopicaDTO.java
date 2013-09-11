package com.fjr.code.dto;

import java.util.List;

/**
 * 
 * Class: BiopsiaInfoDTO
 * Creation Date: 01/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaMacroscopicaDTO {
	private int id;
	private String descMacroscopica;
	private String descPerOperatoria;
	private List<BiopsiaCasseteDTO> cassetesDTO;
	private List<BiopsiaMacroFotoDTO> macroFotosDTO;
	
	public BiopsiaMacroscopicaDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getDescMacroscopica() {
		return descMacroscopica;
	}

	public void setDescMacroscopica(String descMacroscopica) {
		this.descMacroscopica = descMacroscopica;
	}

	public String getDescPerOperatoria() {
		return descPerOperatoria;
	}

	public void setDescPerOperatoria(String descPerOperatoria) {
		this.descPerOperatoria = descPerOperatoria;
	}
	
	public void setCassetesDTO(List<BiopsiaCasseteDTO> cassetesDTO) {
		this.cassetesDTO = cassetesDTO;
	}
	
	public List<BiopsiaCasseteDTO> getCassetesDTO() {
		return cassetesDTO;
	}
	
	public void setMacroFotosDTO(List<BiopsiaMacroFotoDTO> macroFotosDTO) {
		this.macroFotosDTO = macroFotosDTO;
	}
	
	public List<BiopsiaMacroFotoDTO> getMacroFotosDTO() {
		return macroFotosDTO;
	}
}
