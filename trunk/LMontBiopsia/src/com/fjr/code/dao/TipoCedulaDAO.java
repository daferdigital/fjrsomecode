package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.TipoCedulaDTO;

/**
 * 
 * Class: TipoCedulaDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class TipoCedulaDAO {
	private static final Logger log = Logger.getLogger(TipoCedulaDAO.class);
	
	private TipoCedulaDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Metodo para obtener los tipos de cedula que se manejaran en el sistema.
	 * 
	 * @return
	 */
	public static List<TipoCedulaDTO> getAll(){
		List<TipoCedulaDTO> result = new LinkedList<TipoCedulaDTO>();
		
		result.add(new TipoCedulaDTO("V-", "V -"));
		result.add(new TipoCedulaDTO("E-", "E -"));
		
		return result;
	}
	
	/**
	 * 
	 * @param comboBox
	 */
	public static void populateJCombo(JComboBox comboBox){
		populateJCombo(comboBox, null);
	}
	
	/**
	 * 
	 * @param comboBox
	 * @param keyToSelect
	 */
	public static void populateJCombo(JComboBox comboBox, String keyToSelect){
		List<TipoCedulaDTO> items = getAll();
		
		for (TipoCedulaDTO tipoCedulaDTO : items) {
			comboBox.addItem(tipoCedulaDTO);
			if(tipoCedulaDTO.getKeyCedula().equals(keyToSelect)){
				comboBox.setSelectedIndex(comboBox.getItemCount() - 1);
			}
		}
		
		log.info("Agregados elementos al combo-box de los tipos de cedula");
	}
}
