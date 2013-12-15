package com.fjr.code.dto;

/**
 * 
 * Class: ExamenBiopsiaDTO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ExamenBiopsiaDTO {
	private int id;
	private String codigoExamen;
	private String nombreExamen;
	private int diasParaResultado;
	private int idTipoExamen;
	private String codigoTipoExamen;
	private String nombreTipoExamen;
	private String codigoPremium;
	
	/**
	 * 
	 * @param id
	 * @param codigoExamen
	 * @param nombreExamen
	 * @param diasParaResultado
	 * @param idTipoExamen
	 * @param codigoTipoExamen
	 * @param nombreTipoExamen
	 * @param codigoPremium
	 */
	public ExamenBiopsiaDTO(int id, String codigoExamen, String nombreExamen,
			int diasParaResultado, int idTipoExamen, String codigoTipoExamen,
			String nombreTipoExamen, String codigoPremium) {
		// TODO Auto-generated constructor stub
		this.id = id;
		this.codigoExamen = codigoExamen;
		this.nombreExamen = nombreExamen;
		this.diasParaResultado = diasParaResultado;
		this.idTipoExamen = idTipoExamen;
		this.codigoTipoExamen = codigoTipoExamen;
		this.nombreTipoExamen = nombreTipoExamen;
		this.codigoPremium = codigoPremium;
	}

	public ExamenBiopsiaDTO() {
		// TODO Auto-generated constructor stub
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getCodigoExamen() {
		return codigoExamen;
	}

	public void setCodigoExamen(String codigoExamen) {
		this.codigoExamen = codigoExamen;
	}

	public String getNombreExamen() {
		return nombreExamen;
	}

	public void setNombreExamen(String nombreExamen) {
		this.nombreExamen = nombreExamen;
	}

	public int getDiasParaResultado() {
		return diasParaResultado;
	}

	public void setDiasParaResultado(int diasParaResultado) {
		this.diasParaResultado = diasParaResultado;
	}

	public int getIdTipoExamen() {
		return idTipoExamen;
	}

	public void setIdTipoExamen(int idTipoExamen) {
		this.idTipoExamen = idTipoExamen;
	}

	public String getCodigoTipoExamen() {
		return codigoTipoExamen;
	}

	public void setCodigoTipoExamen(String codigoTipoExamen) {
		this.codigoTipoExamen = codigoTipoExamen;
	}

	public String getNombreTipoExamen() {
		return nombreTipoExamen;
	}

	public void setNombreTipoExamen(String nombreTipoExamen) {
		this.nombreTipoExamen = nombreTipoExamen;
	}
	
	public String getCodigoPremium() {
		return codigoPremium;
	}
	
	public void setCodigoPremium(String codigoPremium) {
		this.codigoPremium = codigoPremium;
	}
	
	@Override
	public String toString() {
		return nombreExamen;
	}
}
