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
final class BiopsiaNuevosCortesDAOListBuilder implements DAOListBuilder<BiopsiaCasseteDTO> {
	private static final Logger log = Logger.getLogger(BiopsiaNuevosCortesDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT mc.id, ml.cassete, ml.bloque, ml.lamina, mc.laminas"
			+ " FROM macro_cassetes mc, micro_laminas ml "
			+ " WHERE ml.id = mc.id"
			+ " AND ml.cassete = mc.numero"
			+ " AND ml.reprocesar = '1'";
	private static final String END = " ORDER BY ml.cassete, ml.bloque, ml.lamina";
	
	private String customWhere;
	private List<Object> parameters;
	
	/**
	 * 
	 */
	public BiopsiaNuevosCortesDAOListBuilder() {
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
				cassete.setBloques(rowSet.getInt(3));
				cassete.setLaminaEspecifica(rowSet.getInt(4));
				cassete.setLaminas(rowSet.getInt(5));
				
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
