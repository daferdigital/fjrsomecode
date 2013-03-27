package com.carrito.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.carrito.dto.CategoriaDTO;
import com.carrito.util.DBUtil;

/**
 * 
 * Class: CategoriaDAO
 * Creation Date: 26/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class CategoriaDAO {
	private static Logger log = Logger.getLogger(CategoriaDAO.class);
	
	private CategoriaDAO() {
		// TODO Auto-generated constructor stub
	}
	
	public static List<CategoriaDTO> getAllCategories(){
		final String query = "SELECT id, nombre, descripcion FROM categoria ORDER by LOWER(nombre)";
		
		List<CategoriaDTO> result = new LinkedList<CategoriaDTO>();
		CachedRowSet rows = null;
		
		try {
			rows = DBUtil.executeSelectQuery(query);
			while(rows.next()){
				CategoriaDTO categoriaDTO = new CategoriaDTO();
				categoriaDTO.setId(rows.getInt("id"));
				categoriaDTO.setNombre(rows.getString("nombre"));
				categoriaDTO.setDescripcion(rows.getString("descripcion"));
				
				result.add(categoriaDTO);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error obteniendo listado de categorias. Error fue: " + e.getLocalizedMessage(), e);
		}finally{
			try {
				rows.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return result;
	}
}
