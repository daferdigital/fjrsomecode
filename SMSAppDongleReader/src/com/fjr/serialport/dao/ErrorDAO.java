package com.fjr.serialport.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;

import org.apache.log4j.Logger;

import com.fjr.serialport.dto.ErrorDTO;
import com.fjr.code.util.DBConnectionUtil;

/**
 * 
 * Class: ErrorDAO
 * Creation Date: 17/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class ErrorDAO {
	private static final Logger log = Logger.getLogger(ErrorDAO.class);
	
	/**
	 * 
	 * @param smsDTO
	 * @return
	 */
	public static final boolean storeErrorAtDataBase(ErrorDTO errorDTO){
		final String query = "INSERT INTO errores (fecha, error) VALUES (CURRENT_DATE,?)";
		
		boolean wasStored = false;
		
		Connection con = null;
		PreparedStatement ps = null;
		
		try {
			con = DBConnectionUtil.getConnection();
			ps = con.prepareStatement(query);
			ps.setString(1, errorDTO.getError());
			
			ps.execute();
			log.info("Almacenado de manera exitosa el error " + errorDTO);
			wasStored = true;
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error almacenando registro de error en base de datos, el error fue: "
					+ e.getLocalizedMessage() + " y los valores " + errorDTO, e);
		} finally {
			try {
				ps.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
			
			try {
				con.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return wasStored;
	}
}
