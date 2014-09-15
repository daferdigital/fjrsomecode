package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaPatologo;
import com.fjr.code.dao.definitions.CriterioBusquedaUsuario;
import com.fjr.code.dto.PatologoDTO;
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
public final class PatologoDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(PatologoDAO.class);
	
	/**
	 * 
	 */
	private PatologoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 */
	public static final PatologoDTO getById(int id){
		PatologoDAOListBuilder builder = new PatologoDAOListBuilder();
		builder.searchById(id);
		
		List<PatologoDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @return
	 */
	public static final List<PatologoDTO> getAll(){
		PatologoDAOListBuilder builder = new PatologoDAOListBuilder();
		
		List<PatologoDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * 
	 * @param combo
	 */
	public static void populateJCombo(JComboBox comboBox){
		populateJCombo(comboBox, true);
	}
	
	/**
	 * 
	 * @param comboBox
	 * @param addEmptyValue
	 */
	public static void populateJCombo(JComboBox comboBox, boolean addEmptyValue){
		List<PatologoDTO> items = getAll();
		
		if (addEmptyValue) {
			comboBox.addItem(new PatologoDTO(0, "Seleccione", false, ""));
		}
		
		for (PatologoDTO patologoDTO : items) {
			comboBox.addItem(patologoDTO);
		}
		
		log.info("Agregados elementos al combo-box de los patologos");
	}
	
	/**
	 * 
	 * @param comboBox
	 * @param addEmptyValue
	 */
	public static void populateJCombo(JComboBox comboBox,
			boolean addEmptyValue, int idToSelect){
		List<PatologoDTO> items = getAll();
		
		if (addEmptyValue) {
			comboBox.addItem(new PatologoDTO(0, "Seleccione", false, ""));
		}
		
		for (PatologoDTO patologoDTO : items) {
			comboBox.addItem(patologoDTO);
			if(idToSelect == patologoDTO.getId()){
				comboBox.setSelectedIndex(comboBox.getItemCount()-1);
			}
		}
		
		log.info("Agregados elementos al combo-box de los patologos");
	}
	
	/**
	 * 
	 * @param valores
	 * @return
	 */
	public static List<PatologoDTO> searchAllByCriteria(
			Map<CriterioBusquedaUsuario, String> valores) {
		// TODO Auto-generated method stub
		PatologoDAOListBuilder builder = new PatologoDAOListBuilder();
		
		if(valores != null){
			for (CriterioBusquedaUsuario criterio : valores.keySet()) {
				if(CriterioBusquedaPatologo.NOMBRE.equals(criterio)){
					builder.searchByLikeNombre(valores.get(criterio));
				}
			}
		}
		
		builder.searchByActivo(true);
		return builder.getResults();
	}

	/**
	 * 
	 * @param patologoDTO
	 * @return
	 */
	public static int insert(PatologoDTO patologoDTO) {
		// TODO Auto-generated method stub
		int idCreated = -1;
		
		try {
			final String query = "INSERT INTO patologos (nombre, genero) VALUES (?,?)";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(patologoDTO.getNombre());
			parameters.add(patologoDTO.getGenero());
			
			idCreated = DBUtil.executeInsertQuery(query, parameters);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error creando examen. Error: " + e.getMessage(), e);
		}
		
		return idCreated;
	}
	
	/**
	 * 
	 * @param idPatologo
	 * @param active
	 * @return
	 */
	public static boolean setActivePatologo(int idPatologo, boolean active) {
		// TODO Auto-generated method stub
		final String query = "UPDATE patologos SET activo=? WHERE id=?";
		boolean result = false;
		
		try {
			List<Object> parametros = new LinkedList<Object>();
			parametros.add(active);
			parametros.add(idPatologo);
			
			result = DBUtil.executeNonSelectQuery(query, parametros);
			
			log.info("El patologo de id=" + idPatologo + " fue colocado en activo=" + active);
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param patologoDTO
	 * @return
	 */
	public static boolean update(PatologoDTO patologoDTO) {
		// TODO Auto-generated method stub
		boolean wasUpdated = true;
		
		try {
			final String query = "UPDATE patologos SET nombre=?, genero=? WHERE id=?";
			List<Object> parameters = new LinkedList<Object>();
			
			parameters.add(patologoDTO.getNombre());
			parameters.add(patologoDTO.getGenero());
			parameters.add(patologoDTO.getId());
			
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
	 * @param idPatologo
	 * @return
	 */
	public static boolean delete(int idPatologo) {
		// TODO Auto-generated method stub
		boolean wasDeleted = true;
		
		try {
			final String query = "UPDATE patologos SET activo='0' WHERE id=?";
			
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(idPatologo);
			
			wasDeleted = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Borrado (logicamente) patologo de id=" + idPatologo);
		} catch (Exception e) {
			// TODO: handle exception
			wasDeleted = false;
			log.error("Error borrando (logicamente) patologo de id=" 
					+ idPatologo + ". Error: " + e.getMessage(), e);
		}
		
		return wasDeleted;
	}
}
