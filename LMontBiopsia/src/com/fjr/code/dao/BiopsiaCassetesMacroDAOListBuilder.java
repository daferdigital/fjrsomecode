package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaFotosMacroDAOListBuilder
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class BiopsiaCassetesMacroDAOListBuilder implements DAOListBuilder<BiopsiaCasseteDTO> {
	private static final Logger log = Logger.getLogger(BiopsiaCassetesMacroDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT mc.id, mc.numero, mc.descripcion, mc.bloques, mc.laminas, mc.reprocesar"
			+ " FROM macro_cassetes mc "
			+ " WHERE 1 = 1";
	private static final String END = " ORDER BY mc.id, mc.numero";
	
	private String customWhere;
	private List<Object> parameters;
	
	/**
	 * 
	 */
	public BiopsiaCassetesMacroDAOListBuilder() {
		// TODO Auto-generated constructor stub
		customWhere = "";
		parameters = new LinkedList<Object>();
	}
	
	
	public void searchByIdBiopsia(int id){
		customWhere += " AND mc.id = ?";
		parameters.add(id);
	}
	
	@Override
	public List<Object> getParameters() {
		// TODO Auto-generated method stub
		return parameters;
	}

	@Override
	public String getQuery() {
		// TODO Auto-generated method stub
		return BEGIN + customWhere + END;
	}

	@Override
	public List<BiopsiaCasseteDTO> getResults() {
		// TODO Auto-generated method stub
		List<BiopsiaCasseteDTO> results = new LinkedList<BiopsiaCasseteDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				BiopsiaCasseteDTO cassete = new BiopsiaCasseteDTO();
				cassete.setId(rowSet.getInt(1));
				cassete.setNumero(rowSet.getInt(2));
				cassete.setDescripcion(rowSet.getString(3));
				cassete.setBloques(rowSet.getInt(4));
				cassete.setLaminas(rowSet.getInt(5));
				cassete.setReprocesar(rowSet.getBoolean(6));
				
				log.info("Leida de la base de datos cassete: " + cassete);
				results.add(cassete);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}

}
