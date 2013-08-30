package com.fjr.code.util;

import java.io.File;
import java.io.FileInputStream;
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
	 * Ruta asociada al archivo de conexion a base de datos
	 */
	private static final File DB_CONFIG_FILE = new File(Constants.BASE_PATH + File.separator + "dbConfig.properties");
	
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
		if(DB_CONFIG_FILE.exists()){
			Properties props = new Properties();
			props.load(new FileInputStream(DB_CONFIG_FILE));
			
			log.info("Cargadas propiedades desde: " + DB_CONFIG_FILE.getAbsolutePath());
			
			String url = "jdbc:mysql://";
			url = url.concat(props.getProperty("db.host"));
			url = url.concat(":");
			url = url.concat(props.getProperty("db.port"));
			url = url.concat("/lmont_biopsia");
			
			BasicDataSource basicDataSource = new BasicDataSource();
			basicDataSource.setDriverClassName("com.mysql.jdbc.Driver");
			basicDataSource.setUsername("lm_biopsia_user");
			basicDataSource.setPassword("lm0ntUs3rB10ps1a");
			basicDataSource.setUrl(url);
			basicDataSource.setPoolPreparedStatements(true);
			
			dataSource = basicDataSource;
			log.info("Configurado DataSource de manera exitosa");
		} else {
			log.error("No existe el archivo de configuracion de base de datos: " + DB_CONFIG_FILE.getAbsolutePath());
		}
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
