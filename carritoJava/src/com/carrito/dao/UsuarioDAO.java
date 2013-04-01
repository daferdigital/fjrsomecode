package com.carrito.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.carrito.dto.UsuarioDTO;
import com.carrito.util.DBUtil;

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
}
