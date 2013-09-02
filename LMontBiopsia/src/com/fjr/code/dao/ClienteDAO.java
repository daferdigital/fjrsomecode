package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.ClienteDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: ClienteDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class ClienteDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(ClienteDAO.class);
	
	/**
	 * 
	 */
	private ClienteDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param id
	 * @return
	 */
	public static final ClienteDTO getById(int id){
		ClienteDAOListBuilder builder = new ClienteDAOListBuilder();
		ClienteDTO cliente = null;
		
		try {
			builder.searchById(id);
			
			List<ClienteDTO> result = builder.getResults();
			if(result != null && result.size() > 0){
				cliente = result.get(0);
			}
			
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return cliente;
	}
	
	/**
	 * 
	 * @param cedula
	 * @return
	 */
	public static final ClienteDTO getByCedula(String cedula){
		ClienteDAOListBuilder builder = new ClienteDAOListBuilder();
		ClienteDTO cliente = null;
		
		try {
			builder.searchByCedula(cedula);
			
			List<ClienteDTO> result = builder.getResults();
			if(result != null && result.size() > 0){
				cliente = result.get(0);
			}
			
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return cliente;
	}
	
	/**
	 * 
	 * @return
	 */
	public static final List<ClienteDTO> getAll(){
		ClienteDAOListBuilder builder = new ClienteDAOListBuilder();
		List<ClienteDTO> result = new LinkedList<ClienteDTO>();
		
		try {
			result = builder.getResults();
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param combo
	 */
	public static void populateJCombo(JComboBox comboBox){
		List<ClienteDTO> items = getAll();
		
		for (ClienteDTO clienteDTO : items) {
			comboBox.addItem(clienteDTO);
		}
		
		log.info("Agregados elementos al combo-box de los clientes");
	}

	/**
	 * Insertamos en la base de datos el registro contenido en el parametro
	 * 
	 * @param clienteDTO
	 * @return
	 */
	public static int insertRecord(ClienteDTO clienteDTO) {
		// TODO Auto-generated method stub
		final String query = "INSERT INTO cliente (id_premium, cedula, nombres, apellidos, edad, telefono, correo, direccion, activo)"
				+ "VALUES (?,?,?,?,?,?,?,?,?)";
		
		List<Object> parameters = new LinkedList<Object>();
		parameters.add(clienteDTO.getIdPremium());
		parameters.add(clienteDTO.getCedula());
		parameters.add(clienteDTO.getNombres());
		parameters.add(clienteDTO.getApellidos());
		parameters.add(clienteDTO.getEdad());
		parameters.add(clienteDTO.getTelefono());
		parameters.add(clienteDTO.getCorreo());
		parameters.add(clienteDTO.getDireccion());
		parameters.add(clienteDTO.isActivo());
		
		return DBUtil.executeInsertQuery(query, parameters);
	}
}
