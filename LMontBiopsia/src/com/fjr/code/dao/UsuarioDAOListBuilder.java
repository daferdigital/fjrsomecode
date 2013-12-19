package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.UsuarioDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: UsuarioDAOListBuilder
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class UsuarioDAOListBuilder implements DAOListBuilder<UsuarioDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(UsuarioDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT u.id, u.nombre, u.activo, u.login, u.clave ";
	private static final String EXTRA_BEGIN = ", MD5(?) ";
	private static final String END_BEGIN = " FROM usuarios u"
			+ " WHERE 1 = 1";
	private static final String END = " ORDER BY u.nombre";

	private boolean addPwdInfo = false;
	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public UsuarioDAOListBuilder() {
		// TODO Auto-generated constructor stub
		this(null);
	}

	public UsuarioDAOListBuilder(String pwd) {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
		
		if(pwd != null){
			addPwdInfo = true;
			parameters.add(pwd);
		}
	}
	
	/**
	 * 
	 * @param idUsuario
	 */
	public void searchById(int idUsuario){
		customWhere += " AND u.id = ?";
		parameters.add(idUsuario);
	}
	
	/**
	 * 
	 * @param login
	 */
	public void searchByLogin(String login){
		customWhere += " AND LOWER(u.login) = ?";
		parameters.add(login.toLowerCase());
	}
	
	/**
	 * 
	 * @return
	 */
	public String getQuery(){
		return BEGIN + (addPwdInfo ? EXTRA_BEGIN : "") + END_BEGIN + customWhere + END;
	}
	
	/**
	 * 
	 * @return
	 */
	public List<Object> getParameters(){
		return parameters;
	}
	
	/**
	 * Ejecutamos el query contenido en el objeto y retornamos los resultados en una lista.
	 * 
	 * @return
	 */
	public List<UsuarioDTO> getResults(){
		List<UsuarioDTO> results = new LinkedList<UsuarioDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				UsuarioDTO usuario = new UsuarioDTO();
				usuario.setId(rowSet.getInt(1));
				usuario.setNombre(rowSet.getString(2));
				usuario.setActivo(rowSet.getBoolean(3));
				usuario.setLogin(rowSet.getString(4));
				usuario.setClave(rowSet.getString(5));
				if(addPwdInfo){
					if(rowSet.getObject(6) instanceof String){
						log.info("Tratando MD5 como String");
						usuario.setClaveEscrita(rowSet.getString(6));
					} else {
						//se trata como array de bytes
						log.info("Tratando MD5 como Array de bytes?: " + rowSet.getObject(6).getClass().getSimpleName());
						usuario.setClaveEscrita(new String(rowSet.getBytes(6)));
					}
				}
				
				results.add(usuario);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
