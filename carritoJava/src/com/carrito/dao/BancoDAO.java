package com.carrito.dao;

import java.sql.SQLException;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.carrito.dto.BancoDTO;
import com.carrito.util.DBUtil;

/**
 * 
 * Class: BancoDAO
 * Creation Date: 07/04/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class BancoDAO {
	private static final Logger log = Logger.getLogger(BancoDAO.class);
	
	private BancoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	public static List<BancoDTO> getAll(){
		final String query = "SELECT id, nombre FROM banco ORDER BY nombre";
		
		List<BancoDTO> bancos = new LinkedList<BancoDTO>();
		
		CachedRowSet rows = DBUtil.executeSelectQuery(query);
		
		try {
			while (rows.next()){
				BancoDTO banco = new BancoDTO();
				banco.setId(rows.getInt(1));
				banco.setNombre(rows.getString(2));
				
				bancos.add(banco);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			log.error("No se pudo obtener el listado de bancos", e);
		}
		
		return bancos;
	}
}
