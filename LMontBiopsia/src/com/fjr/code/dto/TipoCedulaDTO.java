package com.fjr.code.dto;

/**
 * 
 * Class: TipoCedulaDTO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class TipoCedulaDTO {
	private String keyCedula;
	private String textCedula;
	
	/**
	 * 
	 * @param keyCedula
	 * @param textCedula
	 */
	public TipoCedulaDTO(String keyCedula, String textCedula) {
		// TODO Auto-generated constructor stub
		this.keyCedula = keyCedula;
		this.textCedula = textCedula;
	}

	public String getKeyCedula() {
		return keyCedula;
	}

	public void setKeyCedula(String keyCedula) {
		this.keyCedula = keyCedula;
	}

	public String getTextCedula() {
		return textCedula;
	}

	public void setTextCedula(String textCedula) {
		this.textCedula = textCedula;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return textCedula;
	}
}
