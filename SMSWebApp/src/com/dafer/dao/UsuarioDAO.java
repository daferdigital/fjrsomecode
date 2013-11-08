package com.dafer.dao;

import java.sql.SQLException;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.dafer.dto.UsuarioDTO;
import com.dafer.forms.UsuarioForm;
import com.dafer.util.DBUtil;

/**
 * 
 * Class: UsuarioDAO
 * Creation Date: 30/03/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class UsuarioDAO {
	private static final Logger log = Logger.getLogger(UsuarioDAO.class);
	
	private UsuarioDAO() {
		// TODO Auto-generated constructor stub
	}
	
	
	public static boolean userLoginAlreadyExists(String login){
		final String query = "SELECT COUNT(*) AS existe FROM usuario u"
				+ " WHERE u.login=?";
		List<Object> queryParameters = new LinkedList<Object>();
		queryParameters.add(login);
		
		boolean exists = true;
		CachedRowSet row = DBUtil.executeSelectQuery(query, queryParameters);
		try {
			if(row.next()){
				if(row.getInt(1) == 0){
					//login no existia
					log.info("El login '" + login + "' no existe en este momento en el sistema.");
					exists = false;
				}else{
					//login ya existia
					log.info("El login '" + login + "' ya existe en el sistema.");
					exists = true;
				}
			} else{
				log.info("La consulta de revision del login '" + login + "' no trajo resultados (esto no debio pasar).");
				exists = true;
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			log.error("No pudo revisarse el resultado al consultar si el login '"
					+ login + "' existia en el sistema. Error fue: " + e.getLocalizedMessage(), e);
			exists = true;
		}
		
		return exists;
	}
	
	/**
	 * 
	 * @param login
	 * @param password
	 * @return
	 */
	public static UsuarioDTO getUserByLoginData(String login, String password){
		final String query = "SELECT u.id, u.cedula, u.nombre, u.apellido, u.direccion, u.telefono, u.email, u.login, u.id_perfil, p.nombre nombrePerfil"
				+ " FROM perfil p, usuario u"
				+ " WHERE u.id_perfil = p.id "
				+ " AND u.login = ? "
				+ " AND u.clave = MD5(?) ";
		
		UsuarioDTO user = null;
		CachedRowSet row = null;
		
		List<Object> queryParameters = new LinkedList<Object>();
		queryParameters.add(login);
		queryParameters.add(password);
		
		try {
			row = DBUtil.executeSelectQuery(query, queryParameters);
			
			if(row.next()){
				user = new UsuarioDTO();
				user.setApellido(row.getString("apellido"));
				user.setCedula(row.getString("cedula"));
				user.setDireccion(row.getString("direccion"));
				user.setEmail(row.getString("email"));
				user.setId(row.getInt("id"));
				user.setIdPerfil(row.getInt("id_perfil"));
				user.setLogin(login);
				user.setNombre(row.getString("nombre"));
				//se usa el numero ya que por alguna razon con el CachedRowSet se esta perdiendo del nombre de la columna
				user.setNombrePerfil(row.getString(10));
				user.setTelefono(row.getString("telefono"));
				
				log.info("Credenciales correctas, acceso permitido a usuario " + login);
			} else{
				//no fue posible verificar las credenciales en la base de datos
				log.info("No fue posible validar las credenciales de " + login + " en la base de datos");
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error obteniendo datos de login de usuario. Error fue: " + e.getLocalizedMessage(), e);
		}finally {
			try {
				row.close();
			} catch (Exception e2) {
				// TODO: handle exception
			}
		}
		
		return user;
	}
	
	/**
	 * 
	 * @param userForm
	 * @return
	 */
	public static boolean addUserToDataBase(UsuarioForm userForm){
		final String query = "INSERT INTO usuario (tipo_identidad, cedula, nombre, apellido, telefono, direccion, email, login, clave, id_perfil)" 
				+ " VALUES(?,?,?,?,?,?,?,?,MD5(?),?)";
		List<Object> queryParameters = new LinkedList<Object>();
		queryParameters.add(userForm.getTipoDocumento());
		queryParameters.add(userForm.getCedula());
		queryParameters.add(userForm.getNombre());
		queryParameters.add(userForm.getApellido());
		queryParameters.add(userForm.getTelefono());
		queryParameters.add(userForm.getDireccion());
		queryParameters.add(userForm.getEmail());
		queryParameters.add(userForm.getLogin());
		queryParameters.add(userForm.getClave());
		queryParameters.add(userForm.getIdPerfil());
		
		boolean result = true;
		
		result = DBUtil.executeNonSelectQuery(query, queryParameters);
		
		if(result){
			log.info("Creada cuenta de usuario de manera exitosa");
		} else{
			log.info("No fue posible crear la cuenta de usuario solicitada");
		}
		
		return result;
	}
}
