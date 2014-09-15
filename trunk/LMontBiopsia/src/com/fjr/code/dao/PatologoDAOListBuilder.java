package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.PatologoDTO;
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
final class PatologoDAOListBuilder implements DAOListBuilder<PatologoDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(PatologoDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT p.id, p.nombre, p.activo, p.genero "
				+ " FROM patologos p"
				+ " WHERE p.activo='1'";
	
	private static final String END = " ORDER BY p.nombre";


	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public PatologoDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}

	/**
	 * 
	 * @param id
	 */
	public void searchById(int id){
		customWhere += " AND p.id = ?";
		parameters.add(id);
	}
	
	/**
	 * 
	 * @param nombre
	 */
	public void searchByLikeNombre(String nombre){
		customWhere += " AND LOWER(p.nombre) LIKE ?";
		parameters.add("%" + nombre.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param active
	 */
	public void searchByActivo(boolean active) {
		// TODO Auto-generated method stub
		customWhere += " AND p.activo=?";
		parameters.add(active);
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
	public List<PatologoDTO> getResults(){
		List<PatologoDTO> results = new LinkedList<PatologoDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				results.add(new PatologoDTO(rowSet.getInt(1),
						rowSet.getString(2),
						"1".equals(rowSet.getString(3)),
						rowSet.getString(4)));
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
