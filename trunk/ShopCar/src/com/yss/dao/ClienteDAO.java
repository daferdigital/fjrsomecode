package com.yss.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.yss.dto.ClienteDTO;
import com.yss.dto.ListPageResultDTO;
import com.yss.util.DBUtil;
import com.yss.util.QueryDBUtil;

/**
 * 
 * Class: ClienteDAO
 * Creation Date: 06/07/2012
 * (c) 2012
 *
 * @author T&T
 *
 */
public final class ClienteDAO {
	private static final Logger logger = Logger.getLogger(ClienteDAO.class);
	
	private ClienteDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @param idCliente
	 * @return
	 */
	public static ClienteDTO getClienteById(String idCliente){
		final String method = "getClienteById(" + idCliente + "): ";
		final String query = "SELECT rif, nombre, contacto, conTelefono, conFax "
				+ "FROM cliente c "
				+ "WHERE c.idcliente = ?";
		
		long t0 = System.currentTimeMillis();
		ClienteDTO cliente = null;
		
		Connection con = null;
		PreparedStatement ps = null;
		ResultSet rs = null;
		
		try {
			con = DBUtil.getConnection();
			ps = con.prepareStatement(query);
			ps.setString(1, idCliente);
			
			rs = ps.executeQuery();
			if(rs.next()){
				cliente = new ClienteDTO();
				cliente.setIdCliente(idCliente);
				cliente.setRif(rs.getString(1));
				cliente.setRazonSocial(rs.getString(2));
				cliente.setContacto(rs.getString(3));
				cliente.setTelefono(rs.getString(4));
				cliente.setFax(rs.getString(5));
			}
		} catch (Exception e) {
			// TODO: handle exception
			logger.error(method + "Error fue: " + e.getLocalizedMessage(), e);
		} finally {
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
		
		logger.info(method + "Ejecucion duro " + (System.currentTimeMillis() - t0) + " ms. Retornando: " + cliente);
		return cliente;
	}
	
	/**
	 * 
	 * @param pageNumber
	 * @param rifToSearch
	 * @param nameToSearch
	 * @param contactToSearch
	 * @return
	 */
	public static ListPageResultDTO<ClienteDTO> getClientListByCriteria(int pageNumber, String rifToSearch, 
			String nameToSearch, String contactToSearch){
		ListPageResultDTO<ClienteDTO> result = null;
		
		//ejecutar la cuenta
		try {
			String query = "SELECT idcliente, rif, nombre, contacto, conTelefono, conFax "
					+ "FROM cliente "
					+ "WHERE idcliente = idcliente ";
			
			if(rifToSearch != ""){
				query += "AND LOWER(rif) LIKE '%" + rifToSearch.toLowerCase() + "%'";
			}
			if(nameToSearch != ""){
				query += "AND LOWER(nombre) LIKE '%" + nameToSearch.toLowerCase() + "%'";
			}
			if(contactToSearch != ""){
				query += "AND LOWER(contacto) LIKE '%" + contactToSearch.toLowerCase() + "%'";
			}
			
			query += "ORDER BY rif";
			
			int records = QueryDBUtil.getRecordCountToQuery(logger, DBUtil.getConnection(), query);
			
			if(records == -1){
				//hubo un error obteniendo la cuenta
			} else {
				//vemos si la cuenta fue cero o no
				List<ClienteDTO> results = new LinkedList<ClienteDTO>();
				
				if(records == 0){
					//la cuenta dio cero, no vale la pena ir por registros como tal
				}else{
					//si tenemos registros en base a los criterios de busqueda, entonces paginamos
					CachedRowSet rowSet = QueryDBUtil.getRecordsByPage(logger, DBUtil.getConnection(), query,
							pageNumber);
					if(rowSet != null){
						//recorremos este resultset y creamos los registros
						ClienteDTO cliente = null;
						
						while(rowSet.next()){
							cliente = new ClienteDTO();
							cliente.setIdCliente(rowSet.getString(1));
							cliente.setRif(rowSet.getString(2));
							cliente.setRazonSocial(rowSet.getString(3));
							cliente.setContacto(rowSet.getString(4));
							cliente.setTelefono(rowSet.getString(5));
							cliente.setFax(rowSet.getString(6));
							results.add(cliente);
						}
					}
				}
				
				result = new ListPageResultDTO<ClienteDTO>(records, results);
			}
		} catch (Exception e) {
			// TODO Auto-generated catch block
			logger.error("Error ejecutando la logica de paginacion: "
					+ e.getMessage(), e);
		}
		
		//ejecutamos la busqueda con indices de paginacion
		return result;
	}
}
