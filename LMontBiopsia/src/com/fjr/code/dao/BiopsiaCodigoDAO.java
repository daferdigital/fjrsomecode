package com.fjr.code.dao;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaCodigoDAO <br />
 * DateCreated: 06/09/2013 <br />
 * @author T&T <br />
 *
 */
public final class BiopsiaCodigoDAO {
	private static final Logger log = Logger.getLogger(BiopsiaCodigoDAO.class);
	
	private BiopsiaCodigoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param year
	 * @return
	 */
	public static int[] getAutomaticYearAndNumber(){
		final String query = "SELECT DATE_FORMAT(NOW(),'%y') AS year, IF(MAX(numero_biopsia) IS NULL, 0, MAX(numero_biopsia)) + 1 AS numeroBiopsia"
				+ " FROM biopsias"
				+ " WHERE year_biopsia = DATE_FORMAT(NOW(),'%y')";
		
		int[] result = {-1, -1};
		
		try {
			CachedRowSet row = DBUtil.executeSelectQuery(query);
			if(row.next()){
				result[0] = row.getInt(1);
				result[1] = row.getInt(2);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		log.info("El calculo automatico del codigo de biopsia arrojo como resultado: "
				+ result[0] + "-" + result[1]);
		
		return result;
	}
}
