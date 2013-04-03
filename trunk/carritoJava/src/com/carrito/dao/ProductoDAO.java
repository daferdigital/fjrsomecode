package com.carrito.dao;

import java.sql.SQLException;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.carrito.dto.ProductDTO;
import com.carrito.util.DBUtil;

/**
 * 
 * Class: ProductoDAO <br />
 * DateCreated: 01/04/2013 <br />
 * @author T&T <br />
 *
 */
public final class ProductoDAO {
	private static final Logger log = Logger.getLogger(ProductoDAO.class);
	
	private ProductoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param productId
	 * @return
	 */
	public static final ProductDTO getProductInfo(int productId){
		final String query = "SELECT p.cantidad_comprada, p.cantidad_vendida, p.descripcion, p.id, p.id_categoria, p.nombre, "
				+ " p.precio_costo_actual, p.precio_neto_actual, c.nombre AS categoria"
				+ " FROM categoria c, producto p"
				+ " WHERE p.id_categoria = c.id"
				+ " AND p.id = ?";
		List<Object> queryParameters = new LinkedList<Object>();
		queryParameters.add(productId);
		
		ProductDTO product = null;
		CachedRowSet row = DBUtil.executeSelectQuery(query, queryParameters);
		
		try {
			if(row.next()){
				log.info("Fue encontrada la informacion para el producto " + productId );
				product = new ProductDTO();

				product.setCantidadComprada(row.getInt("cantidad_comprada"));
				product.setCantidadVendida(row.getInt("cantidad_vendida"));
				product.setDescripcion(row.getString("descripcion"));
				product.setId(row.getInt("id"));
				product.setIdCategoria(row.getInt("id_categoria"));
				product.setNombre(row.getString("nombre"));
				product.setNombreCategoria(row.getString(9));
				product.setPrecioCostoActual(row.getDouble("precio_costo_actual"));
				product.setPrecioNetoActual(row.getDouble("precio_neto_actual"));
			}else{
				log.info("NO fue encontrada la informacion del producto " + productId );
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			log.error("Error obteniendo detalle de producto '" + productId 
					+ "'. Error fue: " + e.getLocalizedMessage(), e);
		}
		
		return product;
	}
}
