package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.DAOListBuilder;
import com.fjr.code.dto.TextoInteligenteDTO;
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
final class TextoInteligenteDAOListBuilder implements DAOListBuilder<TextoInteligenteDTO>{
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(TextoInteligenteDAOListBuilder.class);
	
	
	private static final String BEGIN = "SELECT ti.key_code, ti.abreviatura, ti.texto"
			+ " FROM texto_inteligente ti"
			+ " WHERE 1=1";
	private static final String END = " ORDER BY ti.texto";

	private List<Object> parameters;
	private String customWhere;
	
	/**
	 * 
	 */
	public TextoInteligenteDAOListBuilder() {
		// TODO Auto-generated constructor stub
		parameters = new LinkedList<Object>();
		customWhere = "";
	}

	/**
	 * 
	 * @param idUsuario
	 */
	public void searchByIdUsuario(int idUsuario){
		customWhere += " AND ti.id_usuario = ?";
		parameters.add(idUsuario);
	}
	
	/**
	 * 
	 * @param nombre
	 */
	public void searchByKeyCode(String keyCode){
		customWhere += " AND LOWER(ti.key_code) = LOWER(?)";
		parameters.add(keyCode);
	}
	
	/**
	 * 
	 * @param abreviatura
	 */
	public void searchByLikeAbreviatura(String abreviatura){
		customWhere += " AND LOWER(ti.abreviatura) LIKE LOWER(?)";
		parameters.add("%" + abreviatura + "%");
	}
	
	/**
	 * 
	 * @param texto
	 */
	public void searchByLikeTexto(String texto){
		customWhere += " AND LOWER(ti.texto) LIKE LOWER(?)";
		parameters.add("%" + texto + "%");
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
	public List<TextoInteligenteDTO> getResults(){
		List<TextoInteligenteDTO> results = new LinkedList<TextoInteligenteDTO>();
		
		try {
			CachedRowSet rowSet = DBUtil.executeSelectQuery(getQuery(), getParameters());
			
			while (rowSet.next()) {
				TextoInteligenteDTO texto = new TextoInteligenteDTO();
				texto.setKeyCode(rowSet.getString(1));
				texto.setAbreviatura(rowSet.getString(2));
				texto.setTexto(rowSet.getString(3));
				
				results.add(texto);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getMessage(), e);
		}
		
		return results;
	}
}
