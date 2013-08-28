package com.fjr.serialport.util;

import java.sql.Connection;
import java.sql.SQLException;
import java.util.Properties;

import javax.sql.DataSource;

import org.apache.commons.dbcp.BasicDataSource;

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
	private static DataSource dataSource;
	
	static {
		try {
			Properties props = new Properties();
			props.load(DBConnectionUtil.class.getResourceAsStream("/META-INF/context.properties"));
			
			BasicDataSource basicDataSource = new BasicDataSource();
			basicDataSource.setDriverClassName(props.getProperty("driverClassName"));
			basicDataSource.setUsername(props.getProperty("userName"));
			basicDataSource.setPassword(props.getProperty("password"));
			basicDataSource.setUrl(props.getProperty("url"));
			basicDataSource.setPoolPreparedStatements(true);
			
			DBConnectionUtil.dataSource = basicDataSource;
			System.out.println("Configuracion de base de datos establecida.");
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	public static Connection getConnection() throws SQLException{
		return dataSource.getConnection();
	}
}
