package com.fjr.code.dto;

/**
 * 
 * Class: BiopsiaIngresoDTO
 * Creation Date: 01/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaIngresoDTO {
	private int idBiopsia;
	private String procedencia;
	private String piezaRecibida;
	private String referidoMedico;
	private String idx;
	private PatologoDTO patologoTurno;
	
	/**
	 * 
	 */
	public BiopsiaIngresoDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getIdBiopsia() {
		return idBiopsia;
	}

	public void setIdBiopsia(int idBiopsia) {
		this.idBiopsia = idBiopsia;
	}

	public String getProcedencia() {
		return procedencia;
	}

	public void setProcedencia(String procedencia) {
		this.procedencia = procedencia;
	}

	public String getPiezaRecibida() {
		return piezaRecibida;
	}

	public void setPiezaRecibida(String piezaRecibida) {
		this.piezaRecibida = piezaRecibida;
	}

	public String getReferidoMedico() {
		return referidoMedico;
	}

	public void setReferidoMedico(String referidoMedico) {
		this.referidoMedico = referidoMedico;
	}

	public String getIdx() {
		return idx;
	}

	public void setIdx(String idx) {
		this.idx = idx;
	}

	public PatologoDTO getPatologoTurno() {
		return patologoTurno;
	}

	public void setPatologoTurno(PatologoDTO patologoTurno) {
		this.patologoTurno = patologoTurno;
	}
}
