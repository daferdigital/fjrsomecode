package com.fjr.code.dao;

import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.ReactivoDTO;

/**
 * 
 * Class: ReactivoDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class ReactivoDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(ReactivoDAO.class);
	
	/**
	 * 
	 */
	private ReactivoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 */
	public static final ReactivoDTO getById(int id){
		ReactivoDAOListBuilder builder = new ReactivoDAOListBuilder();
		builder.searchById(id);
		
		List<ReactivoDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @return
	 */
	public static final List<ReactivoDTO> getAll(){
		ReactivoDAOListBuilder builder = new ReactivoDAOListBuilder();
		
		List<ReactivoDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * 
	 * @param combo
	 */
	public static void populateJCombo(JComboBox comboBox, int idToSelect){
		List<ReactivoDTO> items = getAll();
		
		ReactivoDTO tempDTO = new ReactivoDTO();
		tempDTO.setId(0);
		tempDTO.setNombre("Seleccione");
		
		comboBox.addItem(tempDTO);
		for (ReactivoDTO reactivoDTO : items) {
			comboBox.addItem(reactivoDTO);
			if(idToSelect == reactivoDTO.getId()){
				comboBox.setSelectedIndex(comboBox.getItemCount() - 1);
			}
		}
		
		log.info("Agregados elementos al combo-box de los reactivos");
	}
}
