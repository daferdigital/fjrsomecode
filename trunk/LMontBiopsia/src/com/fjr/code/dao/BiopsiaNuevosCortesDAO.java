package com.fjr.code.dao;

import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaCasseteDTO;

/**
 * 
 * Class: BiopsiaNuevosCortesDAO
 * Creation Date: 21/12/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaNuevosCortesDAO {
	private static final Logger log = Logger.getLogger(BiopsiaNuevosCortesDAO.class);
	
	/**
	 * 
	 * @param idBiopsia
	 * @return
	 */
	public static List<BiopsiaCasseteDTO> getNuevosCortes(int idBiopsia){
		List<BiopsiaCasseteDTO> nuevosCortes = null;
		
		try {
			BiopsiaNuevosCortesDAOListBuilder builder = new BiopsiaNuevosCortesDAOListBuilder();
			builder.searchByIdBiopsia(idBiopsia);
			
			nuevosCortes = builder.getResults();
			log.info("Obtenidos nuevos cortes para la biopsia " + idBiopsia);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error obteniendo nuevos cortes para la biopsia " + idBiopsia
					+ ". Error: " + e.getLocalizedMessage(), e);
		}
		
		return nuevosCortes;
	}
}
