package com.fjr.code.dao;

import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.ExamenBiopsiaDTO;

/**
 * 
 * Class: ExamenBiopsiaDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class ExamenBiopsiaDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(ExamenBiopsiaDAO.class);
	
	/**
	 * 
	 */
	private ExamenBiopsiaDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Obtenemos todos los examenes posibles de las biopsias.
	 * 
	 * @return
	 */
	public static final List<ExamenBiopsiaDTO> getAll(){
		ExamenBiopsiaDAOListBuilder builder = new ExamenBiopsiaDAOListBuilder();
		
		List<ExamenBiopsiaDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * Obtenemos el examen en base a su id.
	 * 
	 * @return
	 */
	public static final ExamenBiopsiaDTO getById(int idExamen){
		ExamenBiopsiaDAOListBuilder builder = new ExamenBiopsiaDAOListBuilder();
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
				""));
		for (ExamenBiopsiaDTO examenBiopsiaDTO : items) {
			comboBox.addItem(examenBiopsiaDTO);
		}
		
		log.info("Agregados elementos al combo-box de los tipos de examenes");
	}
}
