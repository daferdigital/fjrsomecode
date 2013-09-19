package com.fjr.code.dao;

import java.util.List;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.PremiumCliempreDTO;

/**
 * 
 * Class: PremiumCliempreDAOListBuilder
 * Creation Date: 18/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
class PremiumCliempreDAOListBuilder implements DAOListBuilder<PremiumCliempreDTO>{
	private static final String BEGIN = "SELECT *"
			+ " FROM cliempre"
			+ " WHERE 1=1";
	
	private static final String END = " ORDER by codigo";
	
	private String customWhere;
	private List<Object> parameters;
	
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
	public List<PremiumCliempreDTO> getResults() {
		// TODO Auto-generated method stub
		return null;
	}

}
