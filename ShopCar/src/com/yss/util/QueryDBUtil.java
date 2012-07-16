package com.yss.util;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.sun.rowset.CachedRowSetImpl;
import com.yss.properties.AppProperties;
import com.yss.properties.AppProperties.AppPropertyNames;

/**
 * 
 * Class: QueryDBUtil
 * Creation Date: 05/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class QueryDBUtil {
	private QueryDBUtil() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param logger
	 * @param con
	 * @param query
	 * @return
	 */
	public static int getRecordCountToQuery(Logger logger, Connection con, String query){
		//sustituimos el select .... from por select count(*) from
		final String method = "getRecordCount(): ";
		long t0 = System.currentTimeMillis();
		
		query = query.toLowerCase();
		query = "SELECT COUNT(*) " + query.substring(query.indexOf("from"));
		
		if(query.indexOf("order by") > 0){
			query = query.substring(0, query.indexOf("order by"));
		}
		
		PreparedStatement ps = null;
		ResultSet rs = null;
		int totalCount = -1;
		
		try {
			ps = con.prepareStatement(query);
			rs = ps.executeQuery();
			
			if(rs.next()){
				totalCount = rs.getInt(1);
			}
		} catch (Exception e) {
			// TODO: handle exception
			logger.error(method + "Error ejecutando query " + query
					+ ". Error fue: " + e.getMessage(), e);
		} finally {
			try {
				rs.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
			try {
				ps.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
			try {
				con.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
		}
		
		logger.info(method + "Finalizo la ejecucion en " + (System.currentTimeMillis() - t0) + " ms. "
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
	public static CachedRowSet getRecordsByPage(Logger logger, Connection con, String query, int pageToGet){
		//sustituimos el select .... from por select count(*) from
		final String method = "getRecordsByPage(): ";
		int maxRecordsPerPage = Integer.parseInt(AppProperties.getPropertyValue(AppPropertyNames.APP_pagingRecordsNumber, "20"));
		
		int minIndex = (pageToGet - 1) * maxRecordsPerPage;
		int maxIndex = pageToGet * maxRecordsPerPage;
		
		CachedRowSet results = null;
		
		query = query.toLowerCase();
		
		int indexFrom = query.indexOf("from");
		String orderBySection = query.toLowerCase().substring(query.indexOf("order by"));
		
		//remove the order by section
		query = query.substring(0, query.indexOf("order by"));
		
		query = query.substring(0, indexFrom - 1) + ", ROW_NUMBER() OVER (" + orderBySection + ") AS row "
				+ query.substring(indexFrom);
		
		query = "SELECT * FROM (" + query + ") AS alias "
				+ " WHERE row > " + minIndex
				+ " AND row <= " + maxIndex;
		
		logger.info(method + "Obteniendo informacion de pagina " + pageToGet
				+ ", con indices[" + minIndex + "," +  maxIndex + "]");
		logger.info(method + " Ejecutado query '" + query + "'");
		
		PreparedStatement ps = null;
		ResultSet rs = null;
		long t0 = System.currentTimeMillis();
		
		try {
			ps = con.prepareStatement(query);
			rs = ps.executeQuery();
			
			results = new CachedRowSetImpl();
			results.populate(rs);
		} catch (Exception e) {
			// TODO: handle exception
			logger.error(method + "Error ejecutando query " + query
					+ ". Error fue: " + e.getMessage(), e);
		} finally {
			try {
				rs.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
			try {
				ps.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
			try {
				con.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
		}
		
		logger.info(method + "Finalizo la ejecucion en " + (System.currentTimeMillis() - t0) + " ms. ");

		return results;
	}
}
