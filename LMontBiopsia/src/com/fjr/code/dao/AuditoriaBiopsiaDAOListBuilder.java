package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.AuditoriaBiopsiaDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: CategoriaReactivoDAOListBuilder
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class AuditoriaBiopsiaDAOListBuilder implements DAOListBuilder<AuditoriaBiopsiaDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(AuditoriaBiopsiaDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT te.nombre, COUNT(b.id) "
				+ " FROM tipo_estudio te, biopsias b"
				+ " WHERE te.id = b.id_tipo_estudio";
	
	private static final String END = " GROUP BY te.id"
			+ " ORDER BY te.nombre";

	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public AuditoriaBiopsiaDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}

	/**
	 * Ajuste para buscar por fecha desde
	 * @param fechaDesde
	 */
	public void searchByFechaDesde(String fechaDesde){
		customWhere += " AND b.fecha_registro >= ?";
		parameters.add(fechaDesde);
	}
	
	/**
	 * Ajuste para buscar por fecha hasta
	 * @param fechaHasta
	 */
	public void searchByFechaHasta(String fechaHasta){
		customWhere += " AND b.fecha_registro <= ?";
		parameters.add(fechaHasta);
	}
	
	/**
	 * 
	 * @return
	 */
	public String getQuery(){
		return BEGIN + customWhere + END;
	}
	
	/**
	 * 
	 * @return
	 */
	public List<Object> getParameters(){
		return parameters;
	}
	
	/**
	 * Ejecutamos el query contenido en el objeto y retornamos los resultados en una lista.
	 * 
	 * @return
	 */
	public List<AuditoriaBiopsiaDTO> getResults(){
		List<AuditoriaBiopsiaDTO> results = new LinkedList<AuditoriaBiopsiaDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				AuditoriaBiopsiaDTO tempDTO = new AuditoriaBiopsiaDTO();
				tempDTO.setNombreEstudio(rowSet.getString(1));
				tempDTO.setCantidad(rowSet.getInt(2));
				
				results.add(tempDTO);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
