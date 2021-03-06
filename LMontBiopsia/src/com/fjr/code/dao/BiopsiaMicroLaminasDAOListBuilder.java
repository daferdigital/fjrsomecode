package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaMicroLaminasDAOListBuilder
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class BiopsiaMicroLaminasDAOListBuilder implements DAOListBuilder<BiopsiaMicroLaminasDTO> {
	private static final Logger log = Logger.getLogger(BiopsiaMicroLaminasDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT ml.id, ml.cassete, ml.bloque, ml.lamina, ml.descripcion, ml.reprocesar"
			+ " FROM micro_laminas ml "
			+ " WHERE 1 = 1";
	private static final String END = " GROUP BY ml.id, ml.cassete, ml.bloque, ml.lamina"
			+ " ORDER BY ml.id, ml.cassete, ml.bloque, ml.lamina";
	
	private boolean isIHQ;
	private String customWhere;
	private List<Object> parameters;
	
	/**
	 * 
	 * @param isIHQ
	 */
	public BiopsiaMicroLaminasDAOListBuilder(boolean isIHQ) {
		// TODO Auto-generated constructor stub
		this.isIHQ = isIHQ;
		customWhere = "";
		parameters = new LinkedList<Object>();
	}
	
	
	public void searchByIdBiopsia(int id){
		customWhere += " AND ml.id = ?";
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
	public List<BiopsiaMicroLaminasDTO> getResults() {
		// TODO Auto-generated method stub
		List<BiopsiaMicroLaminasDTO> results = new LinkedList<BiopsiaMicroLaminasDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				BiopsiaMicroLaminasDTO lamina = new BiopsiaMicroLaminasDTO();
				lamina.setId(rowSet.getInt(1));
				lamina.setCassete(rowSet.getInt(2));
				lamina.setBloque(rowSet.getInt(3));
				lamina.setLamina(rowSet.getInt(4));
				lamina.setDescripcion(rowSet.getString(5));
				lamina.setMustReprocess(rowSet.getBoolean(6));
				
				BiopsiaMicroLaminasReactivosDAO.setMicroLaminasReactivos(lamina);
				BiopsiaMicroLaminasFileDAO.setMicroLaminasFotos(lamina, isIHQ);
								
				log.info("Leida de la base de datos lamina micro: " + lamina);
				results.add(lamina);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}

}
