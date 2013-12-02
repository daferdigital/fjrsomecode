package com.fjr.serialport.dto;

/**
 * 
 * Class: ErrorDTO
 * Creation Date: 17/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ErrorDTO {
	private String error;
	
	public ErrorDTO(String error) {
		// TODO Auto-generated constructor stub
		this.error = error;
	}

	/**
	 * 
	 * @return
	 */
	public String getError() {
		return error;
	}

	/**
	 * 
	 * @param error
	 */
	public void setError(String error) {
		this.error = error;
	}
}
