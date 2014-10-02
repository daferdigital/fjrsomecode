package com.dafer.sms.send.japplet.dto;

import javax.comm.CommPortIdentifier;

import com.dafer.sms.send.japplet.util.Commands;
import com.dafer.sms.send.japplet.util.SendCommandUtil;

/**
 * 
 * Class: SerialPortDTO
 * Creation Date: 01/10/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class SerialPortDTO {
	private String serialPortName;
	private String serialPortId;
	private CommPortIdentifier commPort;
	
	/**
	 * 
	 * @param serialPortName
	 * @param commPort
	 */
	public SerialPortDTO(String serialPortName, CommPortIdentifier commPort) {
		// TODO Auto-generated constructor stub
		this.serialPortName = serialPortName;
		this.commPort = commPort;
		
		serialPortId = SendCommandUtil.sendCommandToPort(commPort, Commands.AT_GET_IMEI_COMMAND);
		if(serialPortId != null 
				&& serialPortId.length() > (Commands.AT_GET_IMEI_COMMAND.length() + 2)){
			serialPortId = serialPortId.replaceAll("\n", "").replaceAll("\r", "");
			serialPortId = serialPortId.substring(Commands.AT_GET_IMEI_COMMAND.length(), serialPortId.lastIndexOf("OK"));
		}
	}

	public String getSerialPortName() {
		return serialPortName;
	}

	public String getSerialPortId() {
		return serialPortId;
	}

	public CommPortIdentifier getCommPort() {
		return commPort;
	}
}
