package com.fjr.code.dao.definitions;

/**
 * 
 * Class: FasesBiopsia
 * Creation Date: 01/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public enum FasesBiopsia {
	INGRESO(1, "Ingreso", "biopsias_ingresos"),
	MACROSCOPICA(2, "Macroscópica", "biopsias_macroscopicas"),
	HISTOLOGIA(3, "Histología", "biopsias_histologias"),
	MICROSCOPICA(4, "Microscópica", "biopsias_microscopicas"),
	IHQ(5, "IHQ", "biopsias_ihq");
	
	private int codigoFase;
	private String nombreFase;
	private String tablaRelacionada;
	
	/**
	 * 
	 * @param codigoFase
	 * @param nombreFase
	 */
	private FasesBiopsia(int codigoFase, String nombreFase,
			String tablaRelacionada) {
		// TODO Auto-generated constructor stub
		this.codigoFase = codigoFase;
		this.nombreFase = nombreFase;
		this.tablaRelacionada = tablaRelacionada;
	}
	
	/**
	 * 
	 * @param codigoFase
	 * @return
	 */
	public static FasesBiopsia getInfoByCode(int codigoFase){
		for (int i = 0; i < values().length; i++) {
			if(values()[i].getCodigoFase() == codigoFase){
				return values()[i];
			}
		}
		
		return null;
	}
	
	public int getCodigoFase() {
		return codigoFase;
	}
	
	public String getNombreFase() {
		return nombreFase;
	}
	
	public String getTablaRelacionada() {
		return tablaRelacionada;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return this.nombreFase;
	}
}
