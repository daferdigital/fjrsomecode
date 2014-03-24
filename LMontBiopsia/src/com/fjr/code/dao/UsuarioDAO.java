package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaUsuario;
import com.fjr.code.dto.PermisosUsuarioDTO;
import com.fjr.code.dto.UsuarioDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: UsuarioDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class UsuarioDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(UsuarioDAO.class);
	
	/**
	 * 
	 */
	private UsuarioDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Obtenemos todos los usuarios posibles del sistema.
	 * 
	 * @return
	 */
	public static final List<UsuarioDTO> getAll(){
		UsuarioDAOListBuilder builder = new UsuarioDAOListBuilder();
		
		List<UsuarioDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * Obtenemos el usuario en base a su id.
	 * 
	 * @return
	 */
	public static final UsuarioDTO getById(int idUsuario){
		UsuarioDAOListBuilder builder = new UsuarioDAOListBuilder();
		builder.searchById(idUsuario);
		
		List<UsuarioDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * Obtenemos el usuario en base a su id.
	 * 
	 * @return
	 */
	public static final UsuarioDTO getByLogin(String login){
		UsuarioDAOListBuilder builder = new UsuarioDAOListBuilder();
		builder.searchByLogin(login);
		
		List<UsuarioDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * Validamos si para determinado login, la clave tipeada en la ventana inicial es la misma
	 * que la indicada en la base de datos. 
	 * 
	 * @param login
	 * @param pwd
	 * @return
	 */
	public static final boolean checkPwdValidity(String login, String pwd){
		UsuarioDAOListBuilder builder = new UsuarioDAOListBuilder(pwd);
		builder.searchByLogin(login);
		builder.searchByActivo(true);
		
		List<UsuarioDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			UsuarioDTO dto = result.get(0);
			
			log.info("Comparando '" + dto.getClave() + "' y '"
					+ dto.getClaveEscrita() + "'");
			if(dto.getClave().equals(dto.getClaveEscrita().toString())){
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * 
	 * @param comboBox
	 */
	public static void populateJCombo(JComboBox comboBox){
		List<UsuarioDTO> items = getAll();
		
		for (UsuarioDTO tipoEstudioDTO : items) {
			comboBox.addItem(tipoEstudioDTO);
		}
		
		log.info("Agregados elementos al combo-box de los usuarios");
	}
	
	/**
	 * 
	 * @param valores
	 * @return 
	 */
	public static List<UsuarioDTO> searchAllByCriteria(
			Map<CriterioBusquedaUsuario, String> valores) {
		// TODO Auto-generated method stub
		UsuarioDAOListBuilder builder = new UsuarioDAOListBuilder();
		
		if(valores != null){
			for (CriterioBusquedaUsuario criterio : valores.keySet()) {
				if(CriterioBusquedaUsuario.NOMBRE.equals(criterio)
						|| CriterioBusquedaUsuario.APELLIDO.equals(criterio)){
					builder.searchByLikeNombre(valores.get(criterio));
				}
			}
		}
		
		builder.searchByActivo(true);
		return builder.getResults();
	}
	
	/**
	 * Metodo para crear una nueva cuenta de usuario
	 * 
	 * @param usuario
	 * @return
	 */
	public static int createUsuario(UsuarioDTO usuario){
		final String query = "INSERT INTO usuarios (login, clave, nombre) VALUES(?,MD5(?),?)";
		int newId = -1;
		
		try {
			List<Object> parametros = new LinkedList<Object>();
			parametros.add(usuario.getLogin());
			parametros.add(usuario.getClave());
			parametros.add(usuario.getNombre());
			
			newId = DBUtil.executeInsertQuery(query, parametros);
			log.info("Creado el usuario " + usuario.getLogin() + " con el id " + newId);
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		return newId;
	}
	
	/**
	 * Metodo para crear una nueva cuenta de usuario
	 * 
	 * @param usuario
	 * @return
	 */
	public static boolean updateUsuario(UsuarioDTO usuario){
		final boolean changeClave = ! "".equals(usuario.getClave().trim());
		final String query = "UPDATE usuarios SET nombre=?"
				+ (changeClave ? ", clave=MD5(?)" : "")
				+ " WHERE id=?";
		boolean result = false;
		
		try {
			List<Object> parametros = new LinkedList<Object>();
			parametros.add(usuario.getNombre());
			if(changeClave){
				parametros.add(usuario.getClave());
			}
			parametros.add(usuario.getId());
			
			result = DBUtil.executeNonSelectQuery(query, parametros);
			log.info("Actualizado el usuario " + usuario.getLogin() + " de manera exitosa");
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		return result;
	}
	
	/**
	 * 
	 */
	public static void setPermisosToUsuario(int idUsuario, List<PermisosUsuarioDTO> permisos){
		final String queryDelete = "DELETE FROM usuario_modulos WHERE id_usuario=?";
		final String queryInsert = "INSERT INTO usuario_modulos (id_usuario, id_modulo) VALUES (?, (SELECT m.id from modulos m where LOWER(m.key) = LOWER(?)))";
		
		List<Object> parametros = new LinkedList<Object>();
		
		try {
			parametros.add(idUsuario);
			
			if(DBUtil.executeNonSelectQuery(queryDelete, parametros)){
				//se pudo borrar ahora se procesan los permisos
				if(permisos != null){
					for (PermisosUsuarioDTO permiso : permisos) {
						parametros.clear();
						parametros.add(idUsuario);
						parametros.add(permiso.getKeyModulo());
						
						if(DBUtil.executeInsertQueryAsBoolean(queryInsert, parametros)){
							log.info("Permiso '" + permiso.getKeyModulo() + "' almacenado para el usuario " + idUsuario);
						} else {
							log.info("ERROR almacenando permiso '" + permiso.getKeyModulo() + "' para el usuario " + idUsuario);
						}
					}
				}
			}
			
			log.info("Permisos del usuario " + idUsuario + " almacenados correctamente");
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
	}

	/**
	 * 
	 * @param idUsuario
	 * @param active
	 * @return
	 */
	public static boolean setActiveUsuario(int idUsuario, boolean active) {
		// TODO Auto-generated method stub
		final String query = "UPDATE usuarios SET activo=? WHERE id=?";
		boolean result = false;
		
		try {
			List<Object> parametros = new LinkedList<Object>();
			parametros.add(active);
			parametros.add(idUsuario);
			
			result = DBUtil.executeNonSelectQuery(query, parametros);
			
			log.info("El usuario de id=" + idUsuario + " fue colocado en activo=" + active);
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		return result;
	}
}
