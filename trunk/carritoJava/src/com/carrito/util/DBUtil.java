package com.carrito.util;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Types;
import java.util.List;

import javax.annotation.Resource;
import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;
import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.sun.rowset.CachedRowSetImpl;

/**
 * 
 * Class: DBUtil
 * Creation Date: 27/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class DBUtil {
	
	private static final Logger log = Logger.getLogger(DBUtil.class);
	
	@Resource(name="jdbc/carrito")
	private static DataSource dataSource;
	
	static{
		try {
			Context ctx = new InitialContext();
			dataSource = (DataSource)ctx.lookup("java:comp/env/jdbc/carrito");
		} catch (NamingException e) {
			e.printStackTrace();
		}
	}
	
	private DBUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param query
	 * @return
	 */
	public static CachedRowSet executeSelectQuery(String query){
		return executeSelectQuery(query, null);
	}
	
	/**
	 * 
	 * @param query
	 * @param queryParameters
	 * @return
	 */
	public static CachedRowSet executeSelectQuery(String query, List<Object> queryParameters){
		CachedRowSet result = null;
		
		Connection con = null;
		PreparedStatement ps = null;
		ResultSet rs = null;
		
		long time0 = System.currentTimeMillis();
		
		try {
			con = dataSource.getConnection();
			ps = con.prepareStatement(query);
			
			if(queryParameters != null && queryParameters.size() > 0){
				//iteramos sobre los parametros
				int index = 1;
				for (Object object : queryParameters) {
					if(object == null || "null".equals(object.toString().toLowerCase())){
						//queremos colocar este valor como nulo para la base de datos
						ps.setNull(index, Types.NULL);
					}else{
						ps.setObject(index, object);
					}
					
					index++;
				}
			}
			
			rs = ps.executeQuery();
			
			result = new CachedRowSetImpl();
			result.populate(rs);
			
			log.info("Ejecutado query " + query + " de manera exitosa");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error ejecutando query: " + query + ". Error fue: " + e.getMessage(), e);
		} finally {
			try {
				rs.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				ps.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				con.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		log.info("Ejecucion de query " + query + " duro " + (System.currentTimeMillis() - time0) +" ms");
		return result;
	}
}
