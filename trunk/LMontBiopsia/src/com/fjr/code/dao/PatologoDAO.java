package com.fjr.code.dao;

import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

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
}
