package com.fjr.code.dao;

import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaPatologo;
import com.fjr.code.dao.definitions.CriterioBusquedaUsuario;
import com.fjr.code.dto.PatologoDTO;

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
}
