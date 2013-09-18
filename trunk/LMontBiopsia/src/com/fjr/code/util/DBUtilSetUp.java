package com.fjr.code.util;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Types;
import java.util.LinkedList;
import java.util.List;

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
public class DBUtilSetUp {
	
	private static final Logger log = Logger.getLogger(DBUtilSetUp.class);
	public static final String NULL_PARAMETER = "null";
	
	public DBUtilSetUp() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 * @throws SQLException 
	 */
	public static Connection getConnection() throws SQLException{
		return DBConnectionSetUpUtil.getConnection();
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
			con = getConnection();
			ps = con.prepareStatement(query);
			ps = putParameters(queryParameters, ps);
			
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
	
	/**
	 * 
	 * @param logger
	 * @param con
	 * @param query
	 * @return
	 */
	public static int getRecordCountToQuery(String query, List<Object> queryParameters){
		//sustituimos el select .... from por select count(*) from
		long t0 = System.currentTimeMillis();
		
		query = query.toLowerCase();
		query = "SELECT COUNT(*) " + query.substring(query.indexOf("from"));
		
		if(query.indexOf("order by") > 0){
			query = query.substring(0, query.indexOf("order by"));
		}
		
		CachedRowSet rs = null;
		int totalCount = -1;
		
		try {
			rs = executeSelectQuery(query, queryParameters);
			
			if(rs.next()){
				totalCount = rs.getInt(1);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error ejecutando query " + query
					+ ". Error fue: " + e.getMessage(), e);
		} finally {
			try {
				rs.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
		}
		
		log.info("Finalizo la ejecucion en " + (System.currentTimeMillis() - t0) + " ms. "
				+ "Con " + totalCount + " registros.");

		return totalCount;
	}
	
	/**
	 * 
	 * @param logger
	 * @param con
	 * @param query
	 * @return
	 */
	public static CachedRowSet getRecordsByPage(String query, List<Object> queryParameters, int pageToGet){
		//sustituimos el select .... from por select count(*) from 
		int maxRecordsPerPage = Constants.MAX_RECORDS_PER_PAGE;
		
		int minIndex = (pageToGet - 1) * maxRecordsPerPage;
		int maxIndex = pageToGet * maxRecordsPerPage;
		
		CachedRowSet results = null;
		
		List<Object> cloneParameters = new LinkedList<Object>();
		for (Object object : queryParameters) {
			cloneParameters.add(object);
		}
		cloneParameters.add(minIndex);
		cloneParameters.add(maxIndex);
		
		query += " LIMIT ?, ?";
		
		log.info("Obteniendo informacion de pagina " + pageToGet
				+ ", con indices[" + minIndex + "," +  maxIndex + "]");
		log.info(" Ejecutado query '" + query + "'");
		
		long t0 = System.currentTimeMillis();
		
		try {
			results = executeSelectQuery(query, cloneParameters);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error ejecutando query " + query
					+ ". Error fue: " + e.getMessage(), e);
		}
		
		log.info("Finalizo la ejecucion en " + (System.currentTimeMillis() - t0) + " ms. ");

		return results;
	}
	
	/**
	 * Rutina para ejecutar cualquier tipo de query que no sea un SELECT
	 * 
	 * @param query
	 * @return
	 */
	public static boolean executeNonSelectQuery(String query){
		return executeNonSelectQuery(query, null);
	}
	
	/**
	 * Rutina para ejecutar cualquier tipo de query que no sea un SELECT
	 * 
	 * @param query
	 * @param queryParameters
	 * @return
	 */
	public static boolean executeNonSelectQuery(String query, List<Object> queryParameters){
		boolean result = true;
		
		Connection con = null;
		PreparedStatement ps = null;
		
		long time0 = System.currentTimeMillis();
		
		try {
			con = getConnection();
			ps = con.prepareStatement(query);
			ps = putParameters(queryParameters, ps);
			
			ps.execute();
			
			log.info("Ejecutado query " + query + " de manera exitosa");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error ejecutando query: " + query + ". Error fue: " + e.getMessage(), e);
			result = false;
		} finally {
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
	
	/**
	 * Ejecucion de un insert, dando como resultado true o false (aplica para tablas sin campo de auto incremento)
	 * 
	 * @param query
	 * @param queryParameters
	 * @return
	 */
	public static boolean executeInsertQueryAsBoolean(String query, List<Object> queryParameters){
		Connection con = null;
		PreparedStatement ps = null;
		
		long time0 = System.currentTimeMillis();
		boolean result = false;
		try {
			con = getConnection();
			ps = con.prepareStatement(query);
			ps = putParameters(queryParameters, ps);
			
			ps.executeUpdate();
			result = true;
			
			log.info("Ejecutado query " + query + " de manera exitosa");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error ejecutando query: " + query + ". Error fue: " + e.getMessage(), e);
		} finally {
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
		
		log.info("Ejecucion de query " + query + " duro " + (System.currentTimeMillis() - time0) +" ms. Retornamos " + result);
		return result;
	}
	
	/**
	 * Rutina para ejecutar inserts donde nos interesa obtener el id del registro insertado (maestro-detalle)
	 * 
	 * @param query
	 * @return valor del id insertado o -1 en caso de error (solo aplica si la tabla tiene un campo de autoincremento)
	 */
	public static int executeInsertQuery(String query){
		return executeInsertQuery(query, null);
	}
	
	/**
	 * Rutina para ejecutar cualquier querys del tipo INSERT
	 * 
	 * @param query
	 * @param queryParameters
	 * @return valor del id insertado o -1 en caso de error (solo aplica si la tabla tiene un campo de autoincremento)
	 */
	public static int executeInsertQuery(String query, List<Object> queryParameters){
		int insertedId = -1;
		
		Connection con = null;
		PreparedStatement ps = null;
		ResultSet rs = null;
		
		long time0 = System.currentTimeMillis();
		
		try {
			con = getConnection();
			ps = con.prepareStatement(query, Statement.RETURN_GENERATED_KEYS);
			ps = putParameters(queryParameters, ps);
			
			//insertedId = ps.executeUpdate();
			ps.executeUpdate();
			rs = ps.getGeneratedKeys();
			if(rs.next()){
				insertedId = rs.getInt(1);
			}
			
			log.info("Ejecutado query " + query + " de manera exitosa");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error ejecutando query: " + query + ". Error fue: " + e.getMessage(), e);
			insertedId = -1;
		} finally {
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
		
		log.info("Ejecucion de query " + query + " duro " + (System.currentTimeMillis() - time0) +" ms. Retornamos " + insertedId);
		
		return insertedId;
	}
	
	/**
	 * 
	 * @param queryParameters
	 * @param ps
	 * @return
	 */
	private static PreparedStatement putParameters(List<Object> queryParameters, PreparedStatement ps){
		try {
			if(queryParameters != null && queryParameters.size() > 0){
				//iteramos sobre los parametros
				int index = 1;
				for (Object object : queryParameters) {
					if(object == null || NULL_PARAMETER.equals(object.toString().toLowerCase())){
						//queremos colocar este valor como nulo para la base de datos
						ps.setNull(index, Types.NULL);
					} else if(object instanceof byte[]){
						ps.setBytes(index, ((byte[]) object));
					} else {
						ps.setObject(index, object);
					}
					
					index++;
				}
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error ajustando PreparedStatement. " + e.getLocalizedMessage(), e);
		}
		
		return ps;
	}
}
