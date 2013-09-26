package com.fjr.serialport.dto;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;

/**
 * 
 * Class: SMSDTO
 * Creation Date: 17/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SMSDTO {
	private static final DateFormat df = new SimpleDateFormat("\"yy/MM/dd HH:mm:ss-SS\"");
	private String numberFrom;
	private String dateReceived;
	private String message;
	private Calendar dateOfMessage;
	
	public SMSDTO() {
		// TODO Auto-generated constructor stub
	}

	public String getNumberFrom() {
		return numberFrom;
	}

	public void setNumberFrom(String numberFrom) {
		this.numberFrom = numberFrom;
	}

	public String getDateReceived() {
		return dateReceived;
	}

	public void setDateReceived(String dateReceived) {
		this.dateReceived = dateReceived;
		setDateOfMessage(dateReceived);
	}

	public String getMessage() {
		return message;
	}

	public void setMessage(String message) {
		this.message = message;
	}
	
	private void setDateOfMessage(String dateReceived) {
		try {
			dateOfMessage = Calendar.getInstance();
			dateOfMessage.setTime(df.parse(dateReceived));
		} catch (ParseException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	public Calendar getDateOfMessage() {
		return dateOfMessage;
	}
	
	@Override
	public String toString() {
		return "SMSDTO [numberFrom=" + numberFrom + ", dateReceived="
				+ dateReceived + ", message=" + message + "]";
	}
}
