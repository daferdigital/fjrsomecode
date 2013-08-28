package com.fjr.serialport.util;

import java.util.Properties;

/**
 * 
 * Class: AppProperties
 * Creation Date: 16/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class AppProperties {
	private static Properties props = new Properties();
	
	static {
		try {
			props.load(AppProperties.class.getResourceAsStream("/resources/application.properties"));
		} catch (Exception e) {
			// TODO: handle exception
			e.printStackTrace();
		}
	}
	
	/**
	 * Directorio base para los archivos de la aplicacion
	 * @return
	 */
	public static String getBaseAppDirectory(){
		return props.getProperty("base.app.directory");
	}
	
	/**
	 * Directorio base para los logs del sistema
	 * @return
	 */
	public static String getLog4jDirectory(){
		return props.getProperty("log.directory");
	}
	
	/**
	 * Numero maximo de intentos antes de descartar definitivamente un puerto serial
	 * @return
	 */
	public static int getMaxPortAttempts(){
		return Integer.parseInt(props.getProperty("max.port.attempts"));
	}
	
	/**
	 * Nombre de la aplicacion
	 * @return
	 */
	public static String getAppName(){
		return props.getProperty("app.name");
	}
	
	/**
	 * Delay en milisegundos entre cada lectura de puertos.
	 * @return
	 */
	public static int getDelayPortRead(){
		return Integer.parseInt(props.getProperty("delay.milliseconds"));
	}
	
	/**
	 * Numero maximo de SMSs a leer en cada iteracion
	 * @return
	 */
	public static int getMaxSMSToRead(){
		return Integer.parseInt(props.getProperty("max.sms.to.read"));
	}
}
