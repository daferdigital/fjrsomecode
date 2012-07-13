package com.yss.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import org.apache.log4j.Logger;

import com.yss.dto.ErrorMessageDTO;
import com.yss.dto.LoginDTO;
import com.yss.util.DBUtil;

/**
 * 
 * Class: LoginDAO
 * Creation Date: 05/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class LoginDAO {
	private static final Logger logger = Logger.getLogger(LoginDAO.class);
	
	private LoginDAO(){
		
	}
	
	/**
	 * 
	 * @param erroresDTO
	 * @param login
	 * @param password
	 * @return
	 */
	public static LoginDTO checkIfCredentialsAreValid(ErrorMessageDTO erroresDTO, String login, String password){
		final String query = "SELECT idRol, lastLoginTime, email, idCliente FROM usuario u"
				+ " WHERE u.idUsuario = '" + login + "'"
				+ " AND u.clave = '" + password + "'";
		final long t0 = System.currentTimeMillis();
		
		LoginDTO loginDTO = null;
		
		Connection con = null;
		PreparedStatement ps = null;
		ResultSet rs = null;
		
		try{
			con = DBUtil.getConnection();
			ps = con.prepareStatement(query);
			rs = ps.executeQuery();
			
			if(rs.next()){
				loginDTO = new LoginDTO();
				loginDTO.setIdUsuario(login);
				loginDTO.setIdRol(rs.getInt(1));
				
				if(rs.getDate(2) != null){
					loginDTO.setLastLoginTime(rs.getDate(2).getTime());
				}
				
				loginDTO.setEmail(rs.getString(3));
				loginDTO.setIdClienteRelated(rs.getString(4));
				loginDTO.setLogged(true);
			}
		}catch (Exception e) {
			// TODO: handle exception
			logger.error("Error ejecutando query '" + query + "'"
					+ ". Error fue: " + e.getMessage(), e);
		}finally{
			try {
				rs.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
			
			try {
				ps.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
			
			try {
				con.close();
			} catch (Exception e) {
				// TODO: handle exception
			}
		}
		
		logger.info("Ejecucion del metodo duro " + (System.currentTimeMillis() - t0) + " ms. Retornando " + loginDTO);
		return loginDTO;
	}
}
