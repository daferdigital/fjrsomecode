package com.fjr.code.util;

import java.io.File;
import java.util.Properties;


import org.apache.log4j.Logger;
import org.apache.log4j.PropertyConfigurator;

/**
 * Construccion del Logger del sistema
 * 
 * Class: SystemLogger
 * Creation Date: 16/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class SystemLogger {
	
	/**
	 * 
	 * @param logDir
	 */
	public static void init(String logDir) {
		// Adiciona el parametro del directorio como un Property del sistema
        // para que pueda ser utilizado dentro del archivo de configuración del Log4J
		new File(logDir).mkdirs();
        System.setProperty("log.directory", logDir);
        
        // Lee el nombre del archivo de configuración de Log4J
        Properties log4jProperties = new Properties();
        try {
			log4jProperties.load(SystemLogger.class.getResourceAsStream("/resources/log4j.properties"));
		} catch (Exception e) {
			// TODO: handle exception
			System.err.println("ERROR: No puede leer el archivo de configuración.");
			e.printStackTrace();
		}
        
        PropertyConfigurator.configure(log4jProperties);
        
        Logger.getLogger(SystemLogger.class).info("Log iniciado en: " + logDir);
	}
}
