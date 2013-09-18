package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.ClienteDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: ClienteDAOListBuilder
 * Creation Date: 31/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class ClienteDAOListBuilder implements DAOListBuilder<ClienteDTO>{
	private static final Logger log = Logger.getLogger(ClienteDAOListBuilder.class);
	
	private static final String BEGIN = "SELECT c.id, c.id_premium, c.cedula, c.nombres, c.apellidos, "
				+ " c.edad, c.telefono, c.correo, c.direccion, c.activo"
				+ " FROM cliente c"
				+ " WHERE 1 = 1";
	private static final String END = " ORDER BY c.nombres, c.apellidos";
	
	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public ClienteDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}
	
	/**
	 * 
	 * @param cedula
	 */
	public void searchByCedula(String cedula){
		customWhere += " AND c.cedula = ?";
		parameters.add(cedula);
	}
	
	/**
	 * 
	 * @param id
	 */
	public void searchById(int id){
		customWhere += " AND c.id = ?";
		parameters.add(id);
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
	public List<ClienteDTO> getResults(){
		List<ClienteDTO> results = new LinkedList<ClienteDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(),
					getParameters());
			
			while (rowSet.next()) {
				results.add(new ClienteDTO(rowSet.getInt(1), 
						rowSet.getString(2), 
						rowSet.getString(3), 
						rowSet.getString(4), 
						rowSet.getString(5), 
						rowSet.getInt(6), 
						rowSet.getString(7), 
						rowSet.getString(8), 
						rowSet.getString(9),
						rowSet.getBoolean(10)));
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
