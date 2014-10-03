package com.dafer.sms.send.japplet.dto;

/**
 * 
 * Class: ATCommandDTO <br />
 * DateCreated: 03/10/2014 <br />
 * @author T&T <br />
 *
 */
public class ATCommandDTO {
	private String command;
	private String charset;
	
	/**
	 * 
	 * @param command
	 */
	public ATCommandDTO(String command) {
		this(command, null);
	}
	
	/**
	 * 
	 * @param command
	 * @param charset
	 */
	public ATCommandDTO(String command, String charset) {
		// TODO Auto-generated constructor stub
		this.command = command;
		this.charset = charset;
	}
	
	public String getCharset() {
		return charset;
	}
	
	public String getCommand() {
		return command;
	}
	
	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return "ATCommandDTO[command='"
				+ command + "',charset='"
				+ charset + "']";
	}
}
