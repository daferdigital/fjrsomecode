package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaTextoInteligente;
import com.fjr.code.dto.TextoInteligenteDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: TipoExamenDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class TextoInteligenteDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(TextoInteligenteDAO.class);
	
	/**
	 * 
	 */
	private TextoInteligenteDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Obtenemos todos los examenes posibles de las biopsias.
	 * 
	 * @return
	 */
	public static final List<TextoInteligenteDTO> getAll(){
		TextoInteligenteDAOListBuilder builder = new TextoInteligenteDAOListBuilder();
		
		List<TextoInteligenteDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * Obtenemos el registro en base a su keyCode.
	 * 
	 * @return
	 */
	public static final TextoInteligenteDTO getByKeyCode(String keyCode){
		TextoInteligenteDAOListBuilder builder = new TextoInteligenteDAOListBuilder();
		builder.searchByKeyCode(keyCode);
		
		List<TextoInteligenteDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean insert(TextoInteligenteDTO textoDTO) {
		// TODO Auto-generated method stub
		boolean wasCreated = false;
		
		try {
			final String query = "INSERT INTO texto_inteligente (key_code, abreviatura, texto) VALUES (LOWER(?),?,?)";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(textoDTO.getKeyCode());
			parameters.add(textoDTO.getAbreviatura());
			parameters.add(textoDTO.getTexto());
			
			wasCreated = DBUtil.executeInsertQueryAsBoolean(query, parameters);
			log.info("Creado registro de texto inteligente (" + textoDTO.getKeyCode()
					+ "/" + textoDTO.getAbreviatura() + ")");
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error creando registro de texto inteligente (" + textoDTO.getKeyCode()
					+ "/" + textoDTO.getAbreviatura() + "). Error: " + e.getMessage(), e);
		}
		
		return wasCreated;
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean update(TextoInteligenteDTO textoDTO) {
		// TODO Auto-generated method stub
		boolean wasUpdated = true;
		
		try {
			final String query = "UPDATE texto_inteligente SET texto=?, abreviatura=? WHERE key_code=LOWER(?)";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(textoDTO.getTexto());
			parameters.add(textoDTO.getAbreviatura());
			parameters.add(textoDTO.getKeyCode());
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Actualizado registro de texto inteligente (" + textoDTO.getKeyCode()
					+ "/" + textoDTO.getAbreviatura() + ")");
		} catch (Exception e) {
			// TODO: handle exception
			wasUpdated = false;
			log.error("Error actualizando registro de texto inteligente (" + textoDTO.getKeyCode()
					+ "/" + textoDTO.getAbreviatura() + "). Error: " + e.getMessage(), e);
		}
		
		return wasUpdated;
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean delete(TextoInteligenteDTO textoDTO) {
		// TODO Auto-generated method stub
		boolean wasDeleted = true;
		
		try {
			final String query = "DELETE texto_inteligente WHERE LOWER(key_code) = LOWER(?)";
			
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(textoDTO.getKeyCode());
			
			wasDeleted = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Borrado registro de texto inteligente (" + textoDTO.getKeyCode() + ")");
		} catch (Exception e) {
			// TODO: handle exception
			wasDeleted = false;
			log.info("Error Borrando registro de texto inteligente (" + textoDTO.getKeyCode() 
					+ "). Error: " + e.getMessage(), e);
		}
		
		return wasDeleted;
	}

	/**
	 * 
	 * @param valores
	 * @return
	 */
	public static List<TextoInteligenteDTO> searchAllByCriteria(
			Map<CriterioBusquedaTextoInteligente, String> valores) {
		// TODO Auto-generated method stub
		TextoInteligenteDAOListBuilder builder = new TextoInteligenteDAOListBuilder();
		
		if(valores != null){
			for (CriterioBusquedaTextoInteligente criterio : valores.keySet()) {
				if(CriterioBusquedaTextoInteligente.NOMBRE.equals(criterio)){
					builder.searchByKeyCode(valores.get(criterio));
				} else if(CriterioBusquedaTextoInteligente.DESCRIPCION.equals(criterio)){
					builder.searchByLikeAbreviatura(valores.get(criterio));
				} else if(CriterioBusquedaTextoInteligente.TEXTO.equals(criterio)){
					builder.searchByLikeAbreviatura(valores.get(criterio));
				}
			}
		}
			
		//verificamos las fechas desde y hasta
		return builder.getResults();
	}
}
