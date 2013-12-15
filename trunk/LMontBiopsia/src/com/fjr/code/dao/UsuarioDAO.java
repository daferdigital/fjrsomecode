package com.fjr.code.dao;

import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.UsuarioDTO;

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
		
		List<UsuarioDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			if(result.get(0).getClave().equals(
					result.get(0).getClaveEscrita())){
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
}