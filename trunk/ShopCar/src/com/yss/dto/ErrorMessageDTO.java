package com.yss.dto;

import java.util.LinkedList;
import java.util.List;

/**
 * 
 * Class: ErrorMessageDTO
 * Creation Date: 05/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class ErrorMessageDTO {
	private List<String> errorMessages;
	
	/**
	 * 
	 */
	public ErrorMessageDTO() {
		// TODO Auto-generated constructor stub
		errorMessages = new LinkedList<String>();
	}
	
	public List<String> getErrorMessages() {
		return errorMessages;
	}
	
	public void addErrorMessage(String errorMessage) {
		errorMessages.add(errorMessage);
	}
	
	public int getErrorCount(){
		return errorMessages.size();
	}
}
