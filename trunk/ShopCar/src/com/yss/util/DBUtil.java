package com.yss.util;

import java.io.File;
import java.io.FileInputStream;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.Properties;

import javax.sql.DataSource;

import org.apache.commons.dbcp.BasicDataSourceFactory;

/**
 * 
 * Class: DBUtil
 * Creation Date: 01/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class DBUtil {
	private static DataSource appDatasource;
	
	/**
	 * 
	 * @param basePath
	 * @return
	 * @throws Exception
	 */
	public static void getDataSourceFromMetaInfDBCPInfo(String basePath) 
			throws Exception {
        System.out.println("Commons DBCP pool starting, from: " + basePath);
        
        //cargamos el properties de valores de la base de datos
        
        Properties dataSourceProperties = new Properties();
        dataSourceProperties.load(new FileInputStream(basePath + File.separator
        		+ "META-INF" + File.separator + "dataSource.properties"));
        
        dataSourceProperties.setProperty("factory", "org.apache.commons.dbcp.BasicDataSourceFactory");
        /*
        dataSourceProperties.setProperty("driverClassName", driverClassName);
        dataSourceProperties.setProperty("url", URL);
        dataSourceProperties.setProperty("username", login);
        dataSourceProperties.setProperty("password", password);
        dataSourceProperties.setProperty("maxActive", String.valueOf(maxActive));
        dataSourceProperties.setProperty("maxWait", String.valueOf(maxWait));
        dataSourceProperties.setProperty("maxIdle", String.valueOf(maxIdle));
        */
        dataSourceProperties.setProperty("removeAbandoned", "true");
        dataSourceProperties.setProperty("logAbandoned", "true");
        dataSourceProperties.setProperty("removeAbandonedTimeout", "10");
        
        appDatasource = BasicDataSourceFactory.createDataSource(dataSourceProperties);
        
        //probamos el datasource
        try {
			Connection con = appDatasource.getConnection();
			con.close();
			con = null;
		} catch (Throwable e) {
			// TODO: handle exception
			e.printStackTrace();
			throw (Exception) e;
		}
    }
	
	/**
	 * 
	 * @return
	 */
	public static DataSource getAppDataSource(){
		return appDatasource;
	}
	
	/**
	 * 
	 * @return
	 * @throws SQLException 
	 */
	public static Connection getConnection() throws SQLException{
		return appDatasource.getConnection();
	}
}
