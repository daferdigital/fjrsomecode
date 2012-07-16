package com.yss.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.yss.dto.ListPageResultDTO;
import com.yss.dto.ProductoDTO;
import com.yss.util.DBUtil;
import com.yss.util.QueryDBUtil;

/**
 * 
 * Class: ClienteDAO
 * Creation Date: 06/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class ProductoDAO {
	private static final Logger logger = Logger.getLogger(ProductoDAO.class);
	
	private ProductoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param idCliente
	 * @return
	 */
	public static ProductoDTO getProductoById(String idProducto){
		final String method = "getProductoById(" + idProducto + "): ";
		final String query = "SELECT l.idlinea, l.nombre, m.idMarca, m.marca, p.Descripcion, "
				+ "p.precio1, p.precio2, p.precio3, p.precio4, p.precio5 "
				+ "FROM producto p "
				+ "LEFT OUTER JOIN linea l ON p.idLinea = l.idLinea "
				+ "LEFT OUTER JOIN marca m ON p.idMarca = m.idMarca "
				+ "WHERE p.idProducto  = ?";
		
		long t0 = System.currentTimeMillis();
		ProductoDTO producto = null;
		
		Connection con = null;
		PreparedStatement ps = null;
		ResultSet rs = null;
		
		try {
			con = DBUtil.getConnection();
			ps = con.prepareStatement(query);
			ps.setString(1, idProducto);
			
			rs = ps.executeQuery();
			if(rs.next()){
				producto = new ProductoDTO();
				producto.setIdProducto(idProducto);
				producto.setIdLinea(rs.getInt(1));
				producto.setLinea(rs.getString(2));
				producto.setIdMarca(rs.getInt(3));
				producto.setMarca(rs.getString(4));
				producto.setDescripcion(rs.getString(5));
				producto.setPrecio1(rs.getDouble(6));
				producto.setPrecio2(rs.getDouble(7));
				producto.setPrecio3(rs.getDouble(8));
				producto.setPrecio4(rs.getDouble(9));
				producto.setPrecio5(rs.getDouble(10));
			}
		} catch (Exception e) {
			// TODO: handle exception
			logger.error(method + "Error fue: " + e.getLocalizedMessage(), e);
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
		
		logger.info(method + "Ejecucion duro " + (System.currentTimeMillis() - t0) + " ms. Retornando: " + producto);
		return producto;
	}
	
	/**
	 * 
	 * @param pageNumber
	 * @param rifToSearch
	 * @param nameToSearch
	 * @param contactToSearch
	 * @return
	 */
	public static ListPageResultDTO<ProductoDTO> getProductListByCriteria(int pageNumber, String idProductToSearch, 
			String lineaToSearch, String marcaToSearch, String descProductToSearch){
		ListPageResultDTO<ProductoDTO> result = null;
		
		//ejecutar la cuenta
		try {
			String query = "SELECT p.idProducto, l.idlinea, l.nombre, m.idMarca, m.marca, p.Descripcion "
					+ "FROM producto p "
					+ "LEFT OUTER JOIN linea l ON p.idLinea = l.idLinea "
					+ "LEFT OUTER JOIN marca m ON p.idMarca = m.idMarca "
					+ "WHERE p.idProducto = p.idProducto ";
			
			if(idProductToSearch != ""){
				query += "AND LOWER(p.idProducto) LIKE '%" + idProductToSearch.toLowerCase() + "%'";
			}
			if(lineaToSearch != ""){
				query += "AND LOWER(p.idLinea) LIKE '%" + lineaToSearch.toLowerCase() + "%'";
			}
			if(marcaToSearch != ""){
				query += "AND LOWER(p.idMarca) LIKE '%" + marcaToSearch.toLowerCase() + "%'";
			}
			if(descProductToSearch != ""){
				query += "AND LOWER(p.Descripcion) LIKE '%" + descProductToSearch.toLowerCase() + "%'";
			}
			
			query += "ORDER BY p.idProducto";
			
			int records = QueryDBUtil.getRecordCountToQuery(logger, DBUtil.getConnection(), query);
			
			if(records == -1){
				//hubo un error obteniendo la cuenta
			} else {
				//vemos si la cuenta fue cero o no
				List<ProductoDTO> results = new LinkedList<ProductoDTO>();
				
				if(records == 0){
					//la cuenta dio cero, no vale la pena ir por registros como tal
				}else{
					//si tenemos registros en base a los criterios de busqueda, entonces paginamos
					CachedRowSet rowSet = QueryDBUtil.getRecordsByPage(logger, DBUtil.getConnection(), query,
							pageNumber);
					if(rowSet != null){
						//recorremos este resultset y creamos los registros
						ProductoDTO producto = null;
						
						while(rowSet.next()){
							producto = new ProductoDTO();
							producto.setIdProducto(rowSet.getString(1));
							producto.setIdLinea(rowSet.getInt(2));
							producto.setLinea(rowSet.getString(3));
							producto.setIdMarca(rowSet.getInt(4));
							producto.setMarca(rowSet.getString(5));
							producto.setDescripcion(rowSet.getString(6));
							results.add(producto);
						}
					}
				}
				
				result = new ListPageResultDTO<ProductoDTO>(records, results);
			}
		} catch (Exception e) {
			// TODO Auto-generated catch block
			logger.error("Error ejecutando la logica de paginacion: "
					+ e.getMessage(), e);
		}
		
		//ejecutamos la busqueda con indices de paginacion
		return result;
	}
}
