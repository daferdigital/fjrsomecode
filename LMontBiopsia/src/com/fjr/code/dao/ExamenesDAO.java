package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaExamenBiopsia;
import com.fjr.code.dto.ExamenBiopsiaDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: ExamenBiopsiaDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class ExamenesDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(ExamenesDAO.class);
	
	/**
	 * 
	 */
	private ExamenesDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Obtenemos todos los examenes posibles de las biopsias.
	 * 
	 * @return
	 */
	public static final List<ExamenBiopsiaDTO> getAll(){
		ExamenesDAOListBuilder builder = new ExamenesDAOListBuilder();
		
		List<ExamenBiopsiaDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * Obtenemos el examen en base a su id.
	 * 
	 * @return
	 */
	public static final ExamenBiopsiaDTO getById(int idExamen){
		ExamenesDAOListBuilder builder = new ExamenesDAOListBuilder();
		builder.searchByExamenId(idExamen);
		
		List<ExamenBiopsiaDTO> result = builder.getResults();
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
		List<ExamenBiopsiaDTO> items = getAll();
		
		comboBox.addItem(new ExamenBiopsiaDTO(0, 
				"", 
				"Seleccione", 
				0, 
				0, 
				"", 
				"",
				""));
		for (ExamenBiopsiaDTO examenBiopsiaDTO : items) {
			comboBox.addItem(examenBiopsiaDTO);
		}
		
		log.info("Agregados elementos al combo-box de los examenes");
	}

	public static int insert(ExamenBiopsiaDTO examenDTO) {
		// TODO Auto-generated method stub
		int idCreated = -1;
		
		try {
			final String query = "INSERT INTO examenes_biopsias (nombre, codigo, dias_resultado, codigo_premium, id_tipo_examen) VALUES (?,?,?,?,?)";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(examenDTO.getNombreExamen());
			parameters.add(examenDTO.getCodigoExamen());
			parameters.add(examenDTO.getDiasParaResultado());
			parameters.add(examenDTO.getCodigoExamen());
			parameters.add(examenDTO.getIdTipoExamen());
			
			idCreated = DBUtil.executeInsertQuery(query, parameters);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error creando examen. Error: " + e.getMessage(), e);
		}
		
		return idCreated;
	}
	
	/**
	 * 
	 * @param valores
	 * @return 
	 */
	public static List<ExamenBiopsiaDTO> searchAllByCriteria(
			Map<CriterioBusquedaExamenBiopsia, String> valores) {
		// TODO Auto-generated method stub
		ExamenesDAOListBuilder builder = new ExamenesDAOListBuilder();
		
		if(valores != null){
			for (CriterioBusquedaExamenBiopsia criterio : valores.keySet()) {
				if(CriterioBusquedaExamenBiopsia.NOMBRE.equals(criterio)){
					builder.searchByLikeNombre(valores.get(criterio));
				} else if(CriterioBusquedaExamenBiopsia.CODIGO_PREMIUM.equals(criterio)){
					builder.searchByLikeCodigoPremium(valores.get(criterio));
				} else if(CriterioBusquedaExamenBiopsia.CODIGO.equals(criterio)){
					builder.searchByLikeCodigo(valores.get(criterio));
				} else if(CriterioBusquedaExamenBiopsia.ESPECIALIDAD.equals(criterio)){
					builder.searchByLikeEspecialidad(valores.get(criterio));
				}
			}
		}
		
		//verificamos las fechas desde y hasta
		return builder.getResults();
	}
	
	/**
	 * 
	 * @param tipoEstudioDTO
	 * @return
	 */
	public static boolean update(ExamenBiopsiaDTO examenDTO) {
		// TODO Auto-generated method stub
		boolean wasUpdated = true;
		
		try {
			final String query = "UPDATE examenes_biopsias SET nombre=?, codigo=?, id_tipo_examen=?," 
					+ " codigo_premium=?, dias_resultado=? WHERE id=?";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(examenDTO.getNombreExamen());
			parameters.add(examenDTO.getCodigoExamen());
			parameters.add(examenDTO.getIdTipoExamen());
			parameters.add(examenDTO.getCodigoPremium());
			parameters.add(examenDTO.getDiasParaResultado());
			parameters.add(examenDTO.getId());
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Actualizado examen de id=" + examenDTO.getId());
		} catch (Exception e) {
			// TODO: handle exception
			wasUpdated = false;
			log.error("Error actualizando examen. Error: " + e.getMessage(), e);
		}
		
		return wasUpdated;
	}
	
	/**
	 * 
	 * @param idExamen
	 * @return
	 */
	public static boolean delete(int idExamen) {
		// TODO Auto-generated method stub
		boolean wasDeleted = true;
		
		try {
			final String query = "UPDATE examenes_biopsias SET activo='0' WHERE id=?";
			
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(idExamen);
			
			wasDeleted = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Borrado (logicamente) examen de id=" + idExamen);
		} catch (Exception e) {
			// TODO: handle exception
			wasDeleted = false;
			log.error("Error borrando (logicamente) examen de id=" 
					+ idExamen + ". Error: " + e.getMessage(), e);
		}
		
		return wasDeleted;
	}
}
