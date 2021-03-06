package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.ExamenBiopsiaDTO;
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
final class ExamenesDAOListBuilder implements DAOListBuilder<ExamenBiopsiaDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(ExamenesDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT te.id AS idTipoExamen, te.codigo AS codigoTipoExamen, te.nombre AS nombreTipoExamen, "
			+ " eb.id AS idExamen, eb.codigo AS codigoExamen, eb.nombre AS nombreExamen, eb.dias_resultado, eb.codigo_premium "
			+ " FROM especialidad te, examenes_biopsias eb"
			+ " WHERE te.activo='1'"
			+ " AND eb.activo='1'"
			+ " AND te.id = eb.id_tipo_examen";
	private static final String END = " ORDER BY eb.nombre";


	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public ExamenesDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}

	/**
	 * 
	 * @param idExamen
	 */
	public void searchByExamenId(int idExamen){
		customWhere += " AND eb.id = ?";
		parameters.add(idExamen);
	}
	
	/**
	 * 
	 * @param nombre
	 */
	public void searchByLikeNombre(String nombre){
		customWhere += " AND LOWER(eb.nombre) LIKE(?)";
		parameters.add("%" + nombre.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param codigo
	 */
	public void searchByLikeCodigo(String codigo){
		customWhere += " AND LOWER(eb.codigo) LIKE(?)";
		parameters.add("%" + codigo.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param codigoPremium
	 */
	public void searchByLikeCodigoPremium(String codigoPremium){
		customWhere += " AND LOWER(eb.codigo_premium) LIKE(?)";
		parameters.add("%" + codigoPremium.toLowerCase() + "%");
	}
	
	/**
	 * 
	 * @param especialidad
	 */
	public void searchByLikeEspecialidad(String especialidad){
		customWhere += " AND LOWER(te.nombre) LIKE(?)";
		parameters.add("%" + especialidad.toLowerCase() + "%");
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
	public List<ExamenBiopsiaDTO> getResults(){
		List<ExamenBiopsiaDTO> results = new LinkedList<ExamenBiopsiaDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				results.add(new ExamenBiopsiaDTO(rowSet.getInt(4),
						rowSet.getString(5),
						rowSet.getString(6),
						rowSet.getInt(7),
						rowSet.getInt(1),
						rowSet.getString(2),
						rowSet.getString(3),
						rowSet.getString(8)));
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
