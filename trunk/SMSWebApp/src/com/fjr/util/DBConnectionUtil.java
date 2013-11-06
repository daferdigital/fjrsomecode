package com.fjr.util;

import java.io.FileNotFoundException;
import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;

import javax.naming.Context;
import javax.naming.InitialContext;
import javax.sql.DataSource;

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
		Connection connection = null;
		
		try {
			Context context = new InitialContext();
			DataSource ds = (DataSource) context.lookup("java:comp/env/jdbc/AppDataSource");
			connection = ds.getConnection();
			dataSource = ds;
			log.info("DataSource configurado correctamente desde el lookup");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error en lookup del DataSource. Error: " + e.getLocalizedMessage(), e);
		} finally {
			try {
				connection.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
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
