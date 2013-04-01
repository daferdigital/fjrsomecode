package com.carrito.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.carrito.dto.CarritoItemDTO;
import com.carrito.util.DBUtil;

/**
 * 
 * Class: CarritoItemDAO
 * Creation Date: 30/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class CarritoItemDAO {
	private static final Logger log = Logger.getLogger(CarritoItemDAO.class);
	
	/**
	 * 
	 */
	private CarritoItemDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Obtenemos para determinada sesion y id de usuario el carrito temporal que se tenga.
	 * 
	 * @param sessionId
	 * @param userId
	 * @return
	 */
	public static List<CarritoItemDTO> getCarritoItems(String sessionId, int userId){
		final String query = "SELECT ctmp.id_usuario, ctmp.id_producto, p.nombre, p.precio_neto_actual"
				+ " FROM producto p, carrito_tmp ctmp"
				+ " WHERE p.id = ctmp.id_producto"
				+ " AND ctmp.id_session = ? "
				+ " AND ctmp.id_usuario = ? "
				+ " ORDER BY LOWER(p.nombre) ";
		final List<Object> parameters = new LinkedList<Object>();
		parameters.add(sessionId);
		parameters.add(userId);
		
		List<CarritoItemDTO> result = new LinkedList<CarritoItemDTO>();
		
		CachedRowSet rows = null;
		
		try {
			rows = DBUtil.executeSelectQuery(query, parameters);
			
			while(rows.next()){
				CarritoItemDTO item = new CarritoItemDTO();
				item.setProductId(rows.getInt("id_producto"));
				item.setProductName(rows.getString("nombre"));
				item.setProductPrice(rows.getDouble("precio_neto_actual"));
				item.setUserId(rows.getInt("id_usuario"));
				
				result.add(item);
			}
			
			log.info("Obtenido carrito del usuario " + userId + ". Con " + result.size() + " elemento(s)");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error obteniendo listado de categorias. Error fue: " + e.getLocalizedMessage(), e);
		}finally{
			try {
				rows.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}// TODO: handle exception
		
		return result;
	}
	
	/**
	 * 
	 * @return
	 */
	public static boolean addProductToBasket(CarritoItemDTO itemDTO){
		final String queryInsert = "INSERT INTO carrito_tmp (id_session, id_usuario, id_producto) "
				+ " VALUES(?,?,?)";
		final String queryDelete = "DELETE FROM carrito_tmp "
				+ " WHERE id_session=?"
				+ " AND id_usuario=?"
				+ " AND id_producto=?";
		
		boolean result = true;
		
		//borramos la combinacion que queremos insertar
		List<Object> queryParameters = new LinkedList<Object>();
		queryParameters.add(itemDTO.getSessionId());
		queryParameters.add(itemDTO.getUserId());
		queryParameters.add(itemDTO.getProductId());
		
		result = DBUtil.executeNonSelectQuery(queryDelete, queryParameters);
		
		log.info("Eliminada combinacion del carrito temporal, intentamos registrarla nuevamente");
		
		result = DBUtil.executeNonSelectQuery(queryInsert, queryParameters);
		if(result){
			log.info("Agregada con exito combinacion de valores al carrito temporal");
		}else{
			log.error("No se pudo agregar la combinacion al carrito temporal, esto es atipico");
		}
		
		return result;
	}
}
