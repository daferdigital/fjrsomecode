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
public class BiopsiaMicroscopicaDTO {
	private int id;
	private String idx;
	private String diagnostico;
	private List<BiopsiaMicroLaminasDTO> laminasDTO;
	
	public BiopsiaMicroscopicaDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getIdx() {
		return idx;
	}

	public void setIdx(String idx) {
		this.idx = idx;
	}

	public String getDiagnostico() {
		return diagnostico;
	}

	public void setDiagnostico(String diagnostico) {
		this.diagnostico = diagnostico;
	}

	public List<BiopsiaMicroLaminasDTO> getLaminasDTO() {
		return laminasDTO;
	}

	public void setLaminasDTO(List<BiopsiaMicroLaminasDTO> laminasDTO) {
		this.laminasDTO = laminasDTO;
	}
}