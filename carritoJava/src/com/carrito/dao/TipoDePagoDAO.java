package com.carrito.dao;

import java.sql.SQLException;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.carrito.dto.TipoDePagoDTO;
import com.carrito.util.DBUtil;

/**
 * 
 * Class: TipoDePagoDAO
 * Creation Date: 07/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class TipoDePagoDAO {
	private static final Logger log = Logger.getLogger(TipoDePagoDAO.class);
	
	private TipoDePagoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 */
	public static List<TipoDePagoDTO> getAll(){
		final String query = "SELECT id, descripcion FROM tipo_de_pago ORDER BY descripcion";
		
		List<TipoDePagoDTO> tiposDePago = new LinkedList<TipoDePagoDTO>();
		
		CachedRowSet rows = DBUtil.executeSelectQuery(query);
		
		try {
			while (rows.next()){
				TipoDePagoDTO tipoDePago = new TipoDePagoDTO();
				tipoDePago.setDescripcion(rows.getString(2));
				tipoDePago.setId(rows.getInt(1));
				
				tiposDePago.add(tipoDePago);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			log.error("No se pudo obtener el listado de tipos de pago", e);
		}
		
		return tiposDePago;
	}
}
