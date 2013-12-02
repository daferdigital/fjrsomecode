package com.fjr.serialport.dao;

import java.util.LinkedList;
import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: LicenciaDAO <br />
 * DateCreated: 02/12/2013 <br />
 * @author T&T <br />
 *
 */
public final class LicenciaDAO {
	private static final int ID_REGISTRO = 1;
	
	private static final Logger log = Logger.getLogger(LicenciaDAO.class);
	
	private LicenciaDAO() {
		// TODO Auto-generated constructor stub
	}
	
	
	/**
	 * 
	 * @param licenseCode
	 */
	public static void setLicenseCode(String licenseCode){
		final String query = "UPDATE licencia SET server_code = ? WHERE id = ?";
		
		try {
			List<Object> queryParameters = new LinkedList<Object>();
			queryParameters.add(licenseCode);
			queryParameters.add(ID_REGISTRO);
			
			DBUtil.executeNonSelectQuery(query, queryParameters);
			log.info("Almacenado el server code");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getMessage(), e);
		}
	}
}
