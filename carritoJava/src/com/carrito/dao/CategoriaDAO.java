package com.carrito.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.carrito.dto.CategoriaDTO;
import com.carrito.dto.ListPageResultDTO;
import com.carrito.dto.ProductDTO;
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
	
	/**
	 * 
	 * @return
	 */
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
	
	/**
	 * 
	 * @param categoryId
	 * @param pageNumber
	 * @return
	 */
	public static ListPageResultDTO<ProductDTO> getProductCategoryPageItems(int categoryId, int pageNumber){
		String query = "SELECT * "
				+ " FROM producto "
				+ " WHERE id_categoria=?"
				+ " ORDER BY LOWER(nombre)";
		
		List<Object> queryParameters = new LinkedList<Object>();
		queryParameters.add(categoryId);
		
		ListPageResultDTO<ProductDTO> result = new ListPageResultDTO<ProductDTO>(0,
				null);
		
		int records = DBUtil.getRecordCountToQuery(query, queryParameters);
		if(records > 0){
			CachedRowSet rows = DBUtil.getRecordsByPage(query, queryParameters, pageNumber);
			List<ProductDTO> pageElements = new LinkedList<ProductDTO>();
			try{
				while(rows.next()){
					ProductDTO product = new ProductDTO();
					product.setCantidadComprada(rows.getInt("cantidad_comprada"));
					product.setCantidadVendida(rows.getInt("cantidad_vendida"));
					product.setDescripcion(rows.getString("descripcion"));
					product.setId(rows.getInt("id"));
					product.setIdCategoria(rows.getInt("id_categoria"));
					product.setNombre(rows.getString("nombre"));
					product.setPrecioCostoActual(rows.getDouble("precio_costo_actual"));
					product.setPrecioNetoActual(rows.getDouble("precio_neto_actual"));
					
					pageElements.add(product);
				}
				
				result.setTotalRecords(records);
				result.setPageElements(pageElements);
			}catch(Exception e){
				log.error("Error: " + e.getLocalizedMessage(), e);
			}finally {
				try {
					rows.close();
				} catch (Exception e) {
					// TODO: handle exception
				}
			}
		}
		
		return result;
	}
}
