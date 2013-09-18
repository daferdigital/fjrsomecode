package com.fjr.code.util;

import java.io.FileNotFoundException;
import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.Properties;

import javax.sql.DataSource;

import org.apache.commons.dbcp.BasicDataSource;
import org.apache.log4j.Logger;


/**
 * 
 * Class: DBConnectionSetUpUtil
 * Creation Date: 17/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class DBConnectionSetUpUtil {
	private static final Logger log = Logger.getLogger(DBConnectionSetUpUtil.class);
	
	private static final Properties props = new Properties();
	
	private static final String DB_HOST_PROPERTY = "db.host";
	private static final String DB_PORT_PROPERTY = "db.port";
	private static final String DB_ROOTKEY_PROPERTY = "db.root.key";
	
	/**
	 * App SetUp DataSource
	 */
	private static DataSource dataSource;
	
	/**
	 * 
	 * @param host
	 * @param port
	 * @param rootKey
	 */
	public static void writePropertiesToFile(String host, String port, String rootKey){
		try {
			dataSource = null;
			props.setProperty(DB_HOST_PROPERTY, host);
			props.setProperty(DB_PORT_PROPERTY, port);
			props.setProperty(DB_ROOTKEY_PROPERTY, rootKey);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error creando archivo de propiedades. Error fue: " + e.getLocalizedMessage(), e);
		}
	}
	
	/**
	 * Metodo que inicia el DataSource, usando el archivo de configuracion de la misma, si existe.
	 * @throws IOException 
	 * @throws FileNotFoundException 
	 * 
	 */
	private static void setUpDataSource() throws Exception{
		String url = "jdbc:mysql://";
		url = url.concat(props.getProperty(DB_HOST_PROPERTY));
		url = url.concat(":");
		url = url.concat(props.getProperty(DB_PORT_PROPERTY));
		//url = url.concat("/lmont_biopsia");
			
		BasicDataSource basicDataSource = new BasicDataSource();
		basicDataSource.setDriverClassName("com.mysql.jdbc.Driver");
		basicDataSource.setUsername("root");
		basicDataSource.setPassword(props.getProperty(DB_ROOTKEY_PROPERTY));
		basicDataSource.setUrl(url);
		basicDataSource.setPoolPreparedStatements(true);
		basicDataSource.setLogAbandoned(true);
			
		dataSource = basicDataSource;
		log.info("Configurado DataSource de manera exitosa (sin conexiones probadas aun)");
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
