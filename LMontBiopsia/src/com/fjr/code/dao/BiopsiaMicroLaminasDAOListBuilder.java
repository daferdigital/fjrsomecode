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
	
	private static final String BEGIN = "SELECT ml.id, ml.cassete, ml.bloque, ml.lamina, ml.descripcion, ml.id_reactivo"
			+ " FROM micro_laminas ml "
			+ " WHERE 1 = 1";
	private static final String END = " ORDER BY ml.id, ml.cassete, ml.bloque, ml.lamina";
	
	private String customWhere;
	private List<Object> parameters;
	
	/**
	 * 
	 */
	public BiopsiaMicroLaminasDAOListBuilder() {
		// TODO Auto-generated constructor stub
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
				lamina.setReactivoDTO(ReactivoDAO.getById(rowSet.getInt(6)));

				BiopsiaMicroLaminasFileDAO.setMicroLaminasFotos(lamina);
				
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
