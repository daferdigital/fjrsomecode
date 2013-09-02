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
	INGRESO(1, "Ingreso"),
	MACROSCOPICA(2, "Macroscópica"),
	HISTOLOGIA(3, "Histología"),
	MICROSCOPICA(4, "Microscópica"),
	IHQ(5, "IHQ");
	
	private int codigoFase;
	private String nombreFase;
	
	/**
	 * 
	 * @param codigoFase
	 * @param nombreFase
	 */
	private FasesBiopsia(int codigoFase, String nombreFase) {
		// TODO Auto-generated constructor stub
		this.codigoFase = codigoFase;
		this.nombreFase = nombreFase;
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
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return this.nombreFase;
	}
}
