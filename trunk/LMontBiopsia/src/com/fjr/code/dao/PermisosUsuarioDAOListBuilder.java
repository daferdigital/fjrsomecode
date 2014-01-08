package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.PermisosUsuarioDTO;
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
final class PermisosUsuarioDAOListBuilder implements DAOListBuilder<PermisosUsuarioDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(PermisosUsuarioDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT um.id_usuario, m.id, m.nombre, m.descripcion, m.key"
			+ " FROM modulos m, usuario_modulos um"
			+ " WHERE m.id = um.id_modulo"
			+ " AND um.id_usuario = ?";
	private static final String END = " ORDER BY m.id";

	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 * @param idUsuario
	 */
	public PermisosUsuarioDAOListBuilder(int idUsuario) {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
		parameters.add(idUsuario);
	}
	
	/**
	 * 
	 * @return
	 */
	public String getQuery(){
		return BEGIN + customWhere + END;
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
	public List<PermisosUsuarioDTO> getResults(){
		List<PermisosUsuarioDTO> results = new LinkedList<PermisosUsuarioDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				PermisosUsuarioDTO permiso = new PermisosUsuarioDTO();
				permiso.setIdUsuario(rowSet.getInt(1));
				permiso.setIdModulo(rowSet.getInt(2));
				permiso.setNombreModulo(rowSet.getString(3));
				permiso.setDescripcionModulo(rowSet.getString(4));
				permiso.setKeyModulo(rowSet.getString(5));
				
				results.add(permiso);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
