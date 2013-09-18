package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.CategoriaReactivoDTO;
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
final class CategoriaReactivoDAOListBuilder implements DAOListBuilder<CategoriaReactivoDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(CategoriaReactivoDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT cr.id, cr.nombre "
				+ " FROM categorias_reactivos cr"
				+ " WHERE 1 = 1";
	
	private static final String END = " ORDER BY cr.nombre";


	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public CategoriaReactivoDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}

	/**
	 * 
	 * @param id
	 */
	public void searchById(int id){
		customWhere += " AND cr.id = ?";
		parameters.add(id);
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
	public List<CategoriaReactivoDTO> getResults(){
		List<CategoriaReactivoDTO> results = new LinkedList<CategoriaReactivoDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				CategoriaReactivoDTO tempDTO = new CategoriaReactivoDTO();
				tempDTO.setId(rowSet.getInt(1));
				tempDTO.setNombre(rowSet.getString(2));
				
				results.add(tempDTO);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
