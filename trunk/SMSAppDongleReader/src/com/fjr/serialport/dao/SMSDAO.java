package com.fjr.serialport.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.Timestamp;

import org.apache.log4j.Logger;

import com.fjr.serialport.dto.SMSDTO;
import com.fjr.code.util.DBConnectionUtil;

/**
 * 
 * Class: SMSDAO
 * Creation Date: 17/05/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class SMSDAO {
	private static final Logger log = Logger.getLogger(SMSDAO.class);
	
	/**
	 * 
	 * @param smsDTO
	 * @return
	 */
	public static final boolean storeSMSAtDataBase(SMSDTO smsDTO){
		final String query = "INSERT INTO mensajes (fecha_recibido, number_from, message_value) VALUES (?,?,?)";
		
		boolean wasStored = false;
		
		Connection con = null;
		PreparedStatement ps = null;
		
		try {
			con = DBConnectionUtil.getConnection();
			ps = con.prepareStatement(query);
			ps.setTimestamp(1, new Timestamp(smsDTO.getDateOfMessage().getTimeInMillis()));
			ps.setString(2, smsDTO.getNumberFrom());
			ps.setString(3, smsDTO.getMessage());
			
			ps.execute();
			log.info("Almacenado de manera exitosa el mensaje " + smsDTO);
			wasStored = true;
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error almacenando mensaje en base de datos, el error fue: "
					+ e.getLocalizedMessage() + " y los valores " + smsDTO, e);
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
