package com.carrito.dao;

import java.sql.SQLException;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.carrito.util.DBUtil;

/**
 * 
 * Class: InventarioDAO
 * Creation Date: 06/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class InventarioDAO {
	private static final Logger log = Logger.getLogger(InventarioDAO.class);
	
	private InventarioDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Metodo para verificar si en el inventario se tiene la cantidad suficiente para determinado producto.
	 * 
	 * @param productoId
	 * @param cantidadAReservar
	 * @return
	 */
	public static synchronized boolean existeInventario(int productoId, int cantidadAReservar){
		boolean hayInventario = false;
		
		final String query = "SELECT p.cantidad_comprada "
				+ " FROM producto p"
				+ " WHERE p.id = ?"
				+ " AND p.cantidad_comprada >= ?";
		
		final List<Object> queryParameters = new LinkedList<Object>();
		queryParameters.add(productoId);
		queryParameters.add(cantidadAReservar);
		
		CachedRowSet row = DBUtil.executeSelectQuery(query, queryParameters);
		
		try {
			if(row.next()){
				if(row.getInt("cantidad_comprada") >= cantidadAReservar){
					hayInventario = true;
					log.info("Como para el producto " + productoId + " se tiene que"
							+ " (inventario[" + row.getInt("cantidad_comprada") + "] >="
							+ " cantidadAReservar[" + cantidadAReservar + "]), podemos permitir la orden del mismo");
				} else {
					log.info("No se tiene en inventario las unidades suficientes para surtir la solicitud"
							+ " de " + cantidadAReservar + " unidad(es) del producto " + productoId);
				}
			}else{
				log.info("No se tiene en inventario las unidades suficientes para surtir la solicitud"
						+ " de " + cantidadAReservar + " unidad(es) del producto " + productoId);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			hayInventario = false;
			log.error("Error verificando inventario de " + cantidadAReservar 
					+ " unidad(es) para el producto " + productoId
					+ ". El error fue: " + e.getLocalizedMessage(), e);
		}
		
		return hayInventario;
	}
}
