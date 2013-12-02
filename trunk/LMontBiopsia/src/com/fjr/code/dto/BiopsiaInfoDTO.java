package com.fjr.code.dto;

import java.util.Calendar;

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
	private String side1CodeBiopsia;
	private String side2CodeBiopsia;
	private int idTipoEstudio;
	private String abreviaturaTipoEstudio;
	private Calendar fechaRegistro;
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

	public String getSide1CodeBiopsia() {
		return side1CodeBiopsia;
	}
	
	public void setSide1CodeBiopsia(String side1CodeBiopsia) {
		this.side1CodeBiopsia = side1CodeBiopsia;
	}
	
	public String getSide2CodeBiopsia() {
		return side2CodeBiopsia;
	}
	
	public void setSide2CodeBiopsia(String side2CodeBiopsia) {
		this.side2CodeBiopsia = side2CodeBiopsia;
	}
	
	public int getIdTipoEstudio() {
		return idTipoEstudio;
	}
	
	public void setIdTipoEstudio(int idTipoEstudio) {
		this.idTipoEstudio = idTipoEstudio;
	}
	
	public String getAbreviaturaTipoEstudio() {
		return abreviaturaTipoEstudio;
	}
	
	public void setAbreviaturaTipoEstudio(String abreviaturaTipoEstudio) {
		this.abreviaturaTipoEstudio = abreviaturaTipoEstudio;
	}
	
	public Calendar getFechaRegistro() {
		return fechaRegistro;
	}
	
	public void setFechaRegistro(Calendar fechaRegistro) {
		this.fechaRegistro = fechaRegistro;
	}
	
	public String getCodigo() {
		String code = side1CodeBiopsia + "-" + side2CodeBiopsia;
		try {
			code = String.format("%02d-%05d", Integer.parseInt(side1CodeBiopsia), Integer.parseInt(side2CodeBiopsia));
			code += abreviaturaTipoEstudio;
		} catch (Exception e) {
			// TODO: handle exception
			//e.printStackTrace();
		}
		
		return code;
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
