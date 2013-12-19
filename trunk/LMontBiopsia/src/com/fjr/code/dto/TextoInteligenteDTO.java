package com.fjr.code.dto;

/**
 * 
 * Class: TextoInteligenteDTO
 * Creation Date: 17/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class TextoInteligenteDTO {
	private String keyCode;
	private String abreviatura;
	private String texto;
	
	public TextoInteligenteDTO() {
		// TODO Auto-generated constructor stub
	}

	public String getKeyCode() {
		return keyCode;
	}
	
	public void setKeyCode(String keyCode) {
		this.keyCode = keyCode;
	}
	
	public String getAbreviatura() {
		return abreviatura;
	}
	
	public void setAbreviatura(String abreviatura) {
		this.abreviatura = abreviatura;
	}
	
	public String getTexto() {
		return texto;
	}
	
	public void setTexto(String texto) {
		this.texto = texto;
	}
}
