package com.dafer.sms.send.japplet;

import javax.swing.JApplet;

import com.dafer.sms.send.japplet.dto.SerialPortDTO;
import com.dafer.sms.send.japplet.util.DebugLog;
import com.dafer.sms.send.japplet.util.PreparePortsManager;

public class Main extends JApplet{
	private String p1 = null;
	private boolean debug = false;
	private PreparePortsManager portsManager;
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1925431248668403790L;
	
	@Override
	public void init() {
		// TODO Auto-generated method stub
		p1 = getParameter("p1");
		debug = Boolean.parseBoolean(getParameter("p2"));
		portsManager = new PreparePortsManager();
	}
	
	@Override
	public void start() {
		// TODO Auto-generated method stub
		super.start();
		
		for (SerialPortDTO port: portsManager.getAvailablePorts().values()) {
			DebugLog.info(port.getSerialPortId());
		}
	}
}
