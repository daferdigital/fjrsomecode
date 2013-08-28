package com.fjr.serialport;

import java.sql.SQLException;

import org.apache.log4j.Logger;

import com.fjr.serialport.util.AppProperties;
import com.fjr.serialport.util.DBConnectionUtil;
import com.fjr.serialport.util.LicenseUtil;
import com.fjr.serialport.util.SystemLogger;

/**
 * Clase principal del sistema de lectura de SMS
 * 
 * Class: Main
 * Creation Date: 16/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class Main {
	private static final Logger log = Logger.getLogger(Main.class);
	
	public static void main(String[] args) {
		SystemLogger.init();
		
		log.info("Verificando licencia del aplicativo.");
		if(! LicenseUtil.isValidLicense()){
			log.error("Disculpe, para poder utilizar el sistema, debe introducir la clave de activación primero");
			System.exit(1);
		}
		
		log.info("Iniciando ejecucion del " + AppProperties.getAppName());
		
		try {
			DBConnectionUtil.getConnection();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			log.error("No hay conexion con la base de datos, debemos finalizar la aplicacion", e);
			System.exit(1);
		}
		
		new PortScanManager();
	}
}
