package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.EspecialidadDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: EspecialidadDAOListBuilder
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class EspecialidadDAOListBuilder implements DAOListBuilder<EspecialidadDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(EspecialidadDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT te.id AS idTipoExamen, te.codigo AS codigoTipoExamen, te.nombre AS nombreTipoExamen, "
			+ " te.activo, te.descripcion "
			+ " FROM especialidad te"
			+ " WHERE te.activo='1'";
	private static final String END = " ORDER BY te.nombre";


	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public EspecialidadDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}
	
	/**
	 * 
	 * @param nombre
	 */
	public void searchByLikeNombre(String nombre){
		customWhere += " AND LOWER(te.nombre) LIKE(?)";
		parameters.add("%" + nombre.toLowerCase() + "%");
	}

	/**
	 * 
	 * @param descripcion
	 */
	public void searchByLikeDescripcion(String descripcion){
		customWhere += " AND LOWER(te.descripcion) LIKE(?)";
		parameters.add("%" + descripcion.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param codigo
	 */
	public void searchByLikeCodigo(String codigo){
		customWhere += " AND LOWER(te.codigo) LIKE(?)";
		parameters.add("%" + codigo.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param idExamen
	 */
	public void searchById(int idEspecialidad){
		customWhere += " AND te.id = ?";
		parameters.add(idEspecialidad);
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
	public List<EspecialidadDTO> getResults(){
		List<EspecialidadDTO> results = new LinkedList<EspecialidadDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				EspecialidadDTO tipo = new EspecialidadDTO();
				tipo.setId(rowSet.getInt(1));
				tipo.setCodigo(rowSet.getString(2));
				tipo.setNombre(rowSet.getString(3));
				tipo.setActivo(rowSet.getBoolean(4));
				tipo.setDescripcion(rowSet.getString(5));
				
				results.add(tipo);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
