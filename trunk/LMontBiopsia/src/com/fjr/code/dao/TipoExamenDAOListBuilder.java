package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.TipoExamenDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: ExamenBiopsiaDAOListBuilder
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
final class TipoExamenDAOListBuilder implements DAOListBuilder<TipoExamenDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(TipoExamenDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT te.id AS idTipoExamen, te.codigo AS codigoTipoExamen, te.nombre AS nombreTipoExamen, "
			+ " te.activo, te.descripcion "
			+ " FROM tipo_examenes te"
			+ " WHERE te.activo='1'";
	private static final String END = " ORDER BY te.nombre";


	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public TipoExamenDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}

	/**
	 * 
	 * @param idExamen
	 */
	public void searchByTipoExamenId(int idExamen){
		customWhere += " AND eb.id = ?";
		parameters.add(idExamen);
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
	public List<TipoExamenDTO> getResults(){
		List<TipoExamenDTO> results = new LinkedList<TipoExamenDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				TipoExamenDTO tipo = new TipoExamenDTO();
				tipo.setId(rowSet.getInt(1));
				tipo.setCodigo(rowSet.getString(2));
				tipo.setNombre(rowSet.getString(3));
				tipo.setActivo(rowSet.getBoolean(4));
				tipo.setDescripcion(rowSet.getString(5));
				
				results.add(tipo);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
