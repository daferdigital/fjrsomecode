package com.fjr.code.dao;

import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.CategoriaReactivoDTO;

/**
 * 
 * Class: ExamenBiopsiaDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class CategoriaReactivoDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(CategoriaReactivoDAO.class);
	
	/**
	 * 
	 */
	private CategoriaReactivoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * 
	 * @return
	 */
	public static final CategoriaReactivoDTO getById(int id){
		CategoriaReactivoDAOListBuilder builder = new CategoriaReactivoDAOListBuilder();
		builder.searchById(id);
		
		List<CategoriaReactivoDTO> result = builder.getResults();
		if(result != null && result.size() > 0){
			return result.get(0);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @return
	 */
	public static final List<CategoriaReactivoDTO> getAll(){
		CategoriaReactivoDAOListBuilder builder = new CategoriaReactivoDAOListBuilder();
		
		List<CategoriaReactivoDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * 
	 * @param combo
	 */
	public static void populateJCombo(JComboBox comboBox){
		List<CategoriaReactivoDTO> items = getAll();
		
		CategoriaReactivoDTO tempDTO = new CategoriaReactivoDTO();
		tempDTO.setId(0);
		tempDTO.setNombre("Seleccione");
		
		comboBox.addItem(tempDTO);
		for (CategoriaReactivoDTO categoriaReactivoDTO : items) {
			comboBox.addItem(categoriaReactivoDTO);
		}
		
		log.info("Agregados elementos al combo-box de las categorias de los reactivos");
	}
}
