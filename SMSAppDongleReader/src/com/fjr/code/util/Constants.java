package com.fjr.code.util;

import java.io.File;

/**
 * 
 * Class: Constants
 * Creation Date: 24/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class Constants {
	/**
	 * 
	 */
	private Constants() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Variable para almacenar el directorio desde donde se inicio la aplicacion
	 */
	public static final String BASE_PATH = new File("").getAbsolutePath();
	
	/**
	 * Variable para indicar el doirectorio temporal de la aplicacion
	 */
	public static final String TMP_PATH = BASE_PATH + File.separator + "tmp";
	
	/**
	 * Variable para indicar el directorio de logs de la aplciacion
	 * 
	 */
	public static final String LOGS_PATH = Constants.BASE_PATH + File.separator + "logs" + File.separator;
	
	public static final String APP_SOFTWARE_NAME = "SMSAppDongleReader";
	public static final String APP_SOFTWARE_VERSION = "Versión 1.0 Beta";

	public static final int MAX_RECORDS_PER_PAGE = 50;
}
