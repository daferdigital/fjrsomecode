package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaTipoEstudio;
import com.fjr.code.dto.TipoEstudioDTO;
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
public final class TipoEstudioDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(TipoEstudioDAO.class);
	
	/**
	 * 
	 */
	private TipoEstudioDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Obtenemos todos los examenes posibles de las biopsias.
	 * 
	 * @return
	 */
	public static final List<TipoEstudioDTO> getAll(){
		TipoEstudioDAOListBuilder builder = new TipoEstudioDAOListBuilder();
		
		List<TipoEstudioDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * Obtenemos el examen en base a su id.
	 * 
	 * @return
	 */
	public static final TipoEstudioDTO getById(int idTipoEstudio){
		TipoEstudioDAOListBuilder builder = new TipoEstudioDAOListBuilder();
		builder.searchByTipoEstudioId(idTipoEstudio);
		
		List<TipoEstudioDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @param combo
	 */
	public static void populateJCombo(JComboBox comboBox){
		List<TipoEstudioDTO> items = getAll();
		
		for (TipoEstudioDTO tipoEstudioDTO : items) {
			comboBox.addItem(tipoEstudioDTO);
		}
		
		log.info("Agregados elementos al combo-box de los tipos de estudios");
	}
	
	/**
	 * 
	 * @param valores
	 * @return 
	 */
	public static List<TipoEstudioDTO> searchAllByCriteria(
			Map<CriterioBusquedaTipoEstudio, String> valores) {
		// TODO Auto-generated method stub
		TipoEstudioDAOListBuilder builder = new TipoEstudioDAOListBuilder();
		
		if(valores != null){
			for (CriterioBusquedaTipoEstudio criterio : valores.keySet()) {
				if(CriterioBusquedaTipoEstudio.NOMBRE.equals(criterio)){
					builder.searchByLikeNombre(valores.get(criterio));
				} else if(CriterioBusquedaTipoEstudio.ABREVIATURA.equals(criterio)){
					builder.searchByLikeAbreviatura(valores.get(criterio));
				}
			}
		}
		
		return builder.getResults();
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static int insert(TipoEstudioDTO tipoEstudioDTO) {
		// TODO Auto-generated method stub
		int idCreated = -1;
		
		try {
			final String query = "INSERT INTO tipo_estudio (nombre, abreviatura) VALUES (?,?)";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(tipoEstudioDTO.getNombre());
			parameters.add(tipoEstudioDTO.getAbreviatura());
			
			idCreated = DBUtil.executeInsertQuery(query, parameters);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error creando examen. Error: " + e.getMessage(), e);
		}
		
		return idCreated;
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean update(TipoEstudioDTO tipoEstudioDTO) {
		// TODO Auto-generated method stub
		boolean wasUpdated = true;
		
		try {
			final String query = "UPDATE tipo_estudio SET nombre=?, abreviatura=? WHERE id=?";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(tipoEstudioDTO.getNombre());
			parameters.add(tipoEstudioDTO.getAbreviatura());
			parameters.add(tipoEstudioDTO.getId());
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
		} catch (Exception e) {
			// TODO: handle exception
			wasUpdated = false;
			log.error("Error creando examen. Error: " + e.getMessage(), e);
		}
		
		return wasUpdated;
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean delete(int idTipoEstudio) {
		// TODO Auto-generated method stub
		boolean wasDeleted = true;
		
		try {
			final String query = "UPDATE tipo_estudio SET activo='0' WHERE id=?";
			
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(idTipoEstudio);
			
			wasDeleted = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Borrado (logicamente) tipo de estudio de id=" + idTipoEstudio);
		} catch (Exception e) {
			// TODO: handle exception
			wasDeleted = false;
			log.error("Error borrando (logicamente) tipo de estudio de id=" 
					+ idTipoEstudio + ". Error: " + e.getMessage(), e);
		}
		
		return wasDeleted;
	}
}
