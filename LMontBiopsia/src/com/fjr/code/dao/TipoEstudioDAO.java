package com.fjr.code.dao;

import java.util.List;
import java.util.Map;

import javax.swing.JComboBox;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaTipoEstudio;
import com.fjr.code.dto.TipoEstudioDTO;

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
		
		for (CriterioBusquedaTipoEstudio criterio : valores.keySet()) {
			if(CriterioBusquedaTipoEstudio.NOMBRE.equals(criterio)){
				builder.searchByLikeNombre(valores.get(criterio));
			} else if(CriterioBusquedaTipoEstudio.ABREVIATURA.equals(criterio)){
				builder.searchByLikeAbreviatura(valores.get(criterio));
			}
		}
		
		//verificamos las fechas desde y hasta
		return builder.getResults();
	}
}
