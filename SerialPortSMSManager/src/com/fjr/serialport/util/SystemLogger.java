package com.fjr.serialport.util;

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
	 */
	public static void init() {
        // Lee el directorio donde va a ser colocado el archivo de logs
        String directory = AppProperties.getLog4jDirectory();
        
        // Adiciona el parametro del directorio como un Property del sistema
        // para que pueda ser utilizado dentro del archivo de configuración del Log4J
        System.setProperty("log.directory", directory);
        
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
        
        Logger.getLogger(SystemLogger.class).info("Log iniciado en: " + directory);
    }
}
