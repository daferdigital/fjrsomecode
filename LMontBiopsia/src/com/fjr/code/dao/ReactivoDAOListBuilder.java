package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.CategoriaReactivoDTO;
import com.fjr.code.dto.ReactivoDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: ReactivoDAOListBuilder
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class ReactivoDAOListBuilder implements DAOListBuilder<ReactivoDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(ReactivoDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT cr.id, cr.nombre, r.id, r.nombre, r.abreviatura, r.precio "
				+ " FROM reactivos r, categorias_reactivos cr"
				+ " WHERE r.id > 0"
				+ " AND r.id_categoria_reactivo = cr.id";
	
	private static final String END = " ORDER BY r.nombre";
	
	
	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public ReactivoDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}

	/**
	 * 
	 * @param id
	 */
	public void searchById(int id){
		customWhere += " AND r.id = ?";
		parameters.add(id);
	}
	
	/**
	 * 
	 * @param id
	 */
	public void searchByCategoryId(int categoryId){
		customWhere += " AND cr.id = ?";
		parameters.add(categoryId);
	}
	
	/**
	 * 
	 * @param nombre
	 */
	public void searchByLikeNombre(String nombre){
		customWhere += " AND LOWER(r.nombre) LIKE (?)";
		parameters.add("%" + nombre.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param categoriaNombre
	 */
	public void searchByLikeCategoriaNombre(String categoriaNombre){
		customWhere += " AND LOWER(cr.nombre) LIKE (?)";
		parameters.add("%" + categoriaNombre.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param abreviatura
	 */
	public void searchByLikeAbreviatura(String abreviatura){
		customWhere += " AND LOWER(r.abreviatura) LIKE (?)";
		parameters.add("%" + abreviatura.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param active
	 */
	public void searchByActive(boolean activo){
		customWhere += " AND r.activo = ?";
		parameters.add(activo);
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
	public List<ReactivoDTO> getResults(){
		List<ReactivoDTO> results = new LinkedList<ReactivoDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				CategoriaReactivoDTO categoriaDTO = new CategoriaReactivoDTO();
				categoriaDTO.setId(rowSet.getInt(1));
				categoriaDTO.setNombre(rowSet.getString(2));
				
				ReactivoDTO tempDTO = new ReactivoDTO();
				tempDTO.setId(rowSet.getInt(3));
				tempDTO.setNombre(rowSet.getString(4));
				tempDTO.setAbreviatura(rowSet.getString(5));
				tempDTO.setPrecio(rowSet.getDouble(6));
				tempDTO.setCategoriaReactivoDTO(categoriaDTO);
				
				results.add(tempDTO);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
