package com.fjr.code.dao;

import java.util.List;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dto.TipoExamenDTO;

/**
 * 
 * Class: TipoExamenDAO
 * Creation Date: 28/08/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public final class TipoExamenDAO {
	/**
	 * 
	 */
	private static final Logger log = Logger.getLogger(TipoExamenDAO.class);
	
	/**
	 * 
	 */
	private TipoExamenDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Obtenemos todos los examenes posibles de las biopsias.
	 * 
	 * @return
	 */
	public static final List<TipoExamenDTO> getAll(){
		TipoExamenDAOListBuilder builder = new TipoExamenDAOListBuilder();
		
		List<TipoExamenDTO> result = builder.getResults();
		
		return result;
	}
	
	/**
	 * Obtenemos el examen en base a su id.
	 * 
	 * @return
	 */
	public static final TipoExamenDTO getById(int idTipoExamen){
		TipoExamenDAOListBuilder builder = new TipoExamenDAOListBuilder();
		builder.searchByTipoExamenId(idTipoExamen);
		
		List<TipoExamenDTO> result = builder.getResults();
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
		List<TipoExamenDTO> items = getAll();
		
		TipoExamenDTO tipo = new TipoExamenDTO();
		tipo.setId(-1);
		tipo.setCodigo("");
		tipo.setNombre("Seleccione");
		tipo.setActivo(false);
		tipo.setDescripcion("");
		
		comboBox.addItem(tipo);
		for (TipoExamenDTO tipoExamenDTO : items) {
			comboBox.addItem(tipoExamenDTO);
		}
		
		log.info("Agregados elementos al combo-box de los tipos de examenes");
	}
}