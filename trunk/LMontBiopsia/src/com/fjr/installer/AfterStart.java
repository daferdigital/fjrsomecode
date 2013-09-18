package com.fjr.installer;

import org.apache.log4j.Logger;

import com.fjr.code.util.Constants;
import com.fjr.code.util.SystemLogger;
import com.fjr.installer.gui.DataBaseCreate;

/**
 * 
 * Class: AfterStart <br />
 * DateCreated: 14/08/2013 <br />
 * @author T&T <br />
 *
 */
public class AfterStart {
	private static final Logger log = Logger.getLogger(AfterStart.class);
	
	static {
		//iniciamos el log para la aplicacion
		SystemLogger.init(Constants.LOGS_PATH);
	}
	
	/**
	 * 
	 * @param args
	 */
	public static void startProgram(String[] args) {
		log.info("Directorio base: " + Constants.BASE_PATH);
		
		new DataBaseCreate().setVisible(true);
	}
}
