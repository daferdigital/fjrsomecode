package com.fjr.code.util;

import java.io.FileNotFoundException;
import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;

import javax.naming.Context;
import javax.naming.InitialContext;
import javax.sql.DataSource;

import org.apache.commons.dbcp.BasicDataSource;
import org.apache.log4j.Logger;


/**
 * 
 * Class: DBConnectionUtil
 * Creation Date: 17/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class DBConnectionUtil {
	private static final Logger log = Logger.getLogger(DBConnectionUtil.class);
	
	/**
	 * App DataSource
	 */
	private static DataSource dataSource;
	
	
	
	/**
	 * Metodo que inicia el DataSource, usando el archivo de configuracion de la misma, si existe.
	 * @throws IOException 
	 * @throws FileNotFoundException 
	 * 
	 */
	private static void setUpDataSource() throws Exception{
		try {
			String url = "jdbc:derby:DB/SmsReaderApp;create=true";
			
			BasicDataSource basicDataSource = new BasicDataSource();
			basicDataSource.setDriverClassName("org.apache.derby.jdbc.EmbeddedDriver");
			basicDataSource.setUsername("sms_reader_user");
			basicDataSource.setPassword("5m5_u53r");
			basicDataSource.setUrl(url);
			basicDataSource.setPoolPreparedStatements(true);
			basicDataSource.setLogAbandoned(true);
			
			dataSource = basicDataSource;
			
			if(haveValidConnectionConfiguration()){
				//verificamos que la base de datos exista o no
				DataBaseCreateOperations.createDerbyDataBase();
			}
			log.info("Configurado DataSource de manera exitosa (sin conexiones probadas aun)");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error en lookup del DataSource. Error: " + e.getLocalizedMessage(), e);
		}
	}
	
	/**
	 * Test if the database connection is valid.
	 * 
	 * @return
	 */
	public static boolean haveValidConnectionConfiguration(){
		boolean isValid = false;
		
		try {
			getConnection().close();
			isValid = true;
		} catch (Exception e) {
			// TODO: handle exception
			dataSource = null;
			log.error(e.getLocalizedMessage(), e);
		}
		
		return isValid;
	}
	
	/**
	 * Metodo para obtener conexiones del data source.
	 * 
	 * @return
	 * @throws SQLException
	 */
	public static Connection getConnection() throws SQLException{
		if(dataSource == null){
			try {
				setUpDataSource();
			} catch (Exception e) {
				// TODO Auto-generated catch block
				log.error(e.getMessage(), e);
				throw new SQLException("Error configurando DataSource. " + e.getLocalizedMessage());
			}
		}
		
		return dataSource.getConnection();
	}
}
