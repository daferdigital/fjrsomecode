package com.fjr.serialport.events;

import javax.comm.SerialPortEvent;
import javax.comm.SerialPortEventListener;

/**
 * 
 * Class: SerialPortEventHandler
 * Creation Date: 02/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SerialPortEventHandler implements SerialPortEventListener{
	
	@Override
	public void serialEvent(SerialPortEvent e) {
		// TODO Auto-generated method stub
		System.out.println(e.getEventType());
		
		if(SerialPortEvent.DATA_AVAILABLE == e.getEventType()){
			System.out.println("Evento de data available");
		}
	}

}
