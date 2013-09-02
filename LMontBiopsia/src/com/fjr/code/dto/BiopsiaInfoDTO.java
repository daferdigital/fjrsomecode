package com.fjr.code.dto;

import com.fjr.code.dao.definitions.FasesBiopsia;

/**
 * 
 * Class: BiopsiaInfoDTO
 * Creation Date: 01/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaInfoDTO {
	private int id;
	private String numero;
	private ExamenBiopsiaDTO examenBiopsia;
	private ClienteDTO cliente;
	private FasesBiopsia faseActual;
	private BiopsiaIngresoDTO ingresoDTO;
	private BiopsiaMacroscopicaDTO macroscopicaDTO;
	private BiopsiaHistologiaDTO histologiaDTO;
	private BiopsiaMicroscopicaDTO microscopicaDTO;
	private BiopsiaIHQDTO ihqDTO;
	
	public BiopsiaInfoDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getNumero() {
		return numero;
	}

	public void setNumero(String numero) {
		this.numero = numero;
	}

	public ExamenBiopsiaDTO getExamenBiopsia() {
		return examenBiopsia;
	}

	public void setExamenBiopsia(ExamenBiopsiaDTO examenBiopsia) {
		this.examenBiopsia = examenBiopsia;
	}

	public ClienteDTO getCliente() {
		return cliente;
	}

	public void setCliente(ClienteDTO cliente) {
		this.cliente = cliente;
	}

	public FasesBiopsia getFaseActual() {
		return faseActual;
	}

	public void setFaseActual(FasesBiopsia faseActual) {
		this.faseActual = faseActual;
	}

	public BiopsiaIngresoDTO getIngresoDTO() {
		return ingresoDTO;
	}

	public void setIngresoDTO(BiopsiaIngresoDTO ingresoDTO) {
		this.ingresoDTO = ingresoDTO;
	}

	public BiopsiaMacroscopicaDTO getMacroscopicaDTO() {
		return macroscopicaDTO;
	}

	public void setMacroscopicaDTO(BiopsiaMacroscopicaDTO macroscopicaDTO) {
		this.macroscopicaDTO = macroscopicaDTO;
	}

	public BiopsiaHistologiaDTO getHistologiaDTO() {
		return histologiaDTO;
	}

	public void setHistologiaDTO(BiopsiaHistologiaDTO histologiaDTO) {
		this.histologiaDTO = histologiaDTO;
	}

	public BiopsiaMicroscopicaDTO getMicroscopicaDTO() {
		return microscopicaDTO;
	}

	public void setMicroscopicaDTO(BiopsiaMicroscopicaDTO microscopicaDTO) {
		this.microscopicaDTO = microscopicaDTO;
	}

	public BiopsiaIHQDTO getIhqDTO() {
		return ihqDTO;
	}

	public void setIhqDTO(BiopsiaIHQDTO ihqDTO) {
		this.ihqDTO = ihqDTO;
	}
}
