package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.TipoEstudioDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: ExamenBiopsiaDAOListBuilder
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class TipoEstudioDAOListBuilder implements DAOListBuilder<TipoEstudioDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(TipoEstudioDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT te.id AS idTipoEstudio, te.nombre AS nombreTipoEstudio, te.activo, te.abreviatura "
			+ " FROM tipo_estudio te"
			+ " WHERE te.activo='1'";
	private static final String END = " ORDER BY te.nombre";

	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public TipoEstudioDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}

	/**
	 * 
	 * @param idExamen
	 */
	public void searchByTipoEstudioId(int idExamen){
		customWhere += " AND te.id = ?";
		parameters.add(idExamen);
	}
	
	/**
	 * 
	 * @param nombre
	 */
	public void searchByLikeNombre(String nombre){
		customWhere += " AND LOWER(te.nombre) = LIKE ?";
		parameters.add("%" + nombre.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param abreviatura
	 */
	public void searchByLikeAbreviatura(String abreviatura){
		customWhere += " AND LOWER(te.abreviatura) = LIKE ?";
		parameters.add("%" + abreviatura.toLowerCase() + "%");
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
	public List<TipoEstudioDTO> getResults(){
		List<TipoEstudioDTO> results = new LinkedList<TipoEstudioDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				TipoEstudioDTO tipo = new TipoEstudioDTO();
				tipo.setId(rowSet.getInt(1));
				tipo.setNombre(rowSet.getString(2));
				tipo.setActivo(rowSet.getBoolean(3));
				tipo.setAbreviatura(rowSet.getString(4));
				
				results.add(tipo);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
