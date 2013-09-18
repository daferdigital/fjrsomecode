package com.fjr.code.dao;

import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.dto.BiopsiaInfoDTO;

/**
 * 
 * Class: BiopsiaCassetesMacroDAO
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaCassetesMacroDAO {
	private static final Logger log = Logger.getLogger(BiopsiaCassetesMacroDAO.class);
	
	private BiopsiaCassetesMacroDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Se realiza la lectura de los cassetes de la fase macro.
	 * 
	 * @param biopsia
	 * @return
	 */
	public static BiopsiaInfoDTO setMacroCassetes(BiopsiaInfoDTO biopsia) {
		if(biopsia == null || biopsia.getMacroscopicaDTO() == null){
			log.error("Se desea almacenar la informacion de los cassetes macro, pero no existe el DTO maestro de la fase macro.");
		} else {
			//ubicamos las fotos de la fase macro, para colocarlas en la informacion de la biopsia
			BiopsiaCassetesMacroDAOListBuilder builder = new BiopsiaCassetesMacroDAOListBuilder();
			builder.searchByIdBiopsia(biopsia.getId());
			
			List<BiopsiaCasseteDTO> cassetes = builder.getResults();
			if(cassetes != null){
				log.info("Se almacenaron " + cassetes.size() + " cassetes en la biopsia '" 
						+ biopsia.getCodigo() + "'");
				biopsia.getMacroscopicaDTO().setCassetesDTO(cassetes);
				biopsia.getHistologiaDTO().setCassetesDTO(cassetes);
			} else {
				log.info("No se encontraron cassetes en la biopsia '" + biopsia.getCodigo() + "'");
			}
		}
		
		return biopsia;
	}
	
	/**
	 * Se realiza la lectura de los cassetes de la fase histologia.
	 * 
	 * @param biopsia
	 * @return
	 */
	public static BiopsiaInfoDTO setHistoCassetes(BiopsiaInfoDTO biopsia) {
		if(biopsia == null || biopsia.getHistologiaDTO() == null){
			log.error("Se desea almacenar la informacion de los cassetes histo, pero no existe el DTO maestro de la fase macro.");
		} else {
			//ubicamos las fotos de la fase macro, para colocarlas en la informacion de la biopsia
			BiopsiaCassetesMacroDAOListBuilder builder = new BiopsiaCassetesMacroDAOListBuilder();
			builder.searchByIdBiopsia(biopsia.getId());
			
			List<BiopsiaCasseteDTO> cassetes = builder.getResults();
			if(cassetes != null){
				log.info("Se almacenaron " + cassetes.size() + " cassetes en la biopsia '" 
						+ biopsia.getCodigo() + "'");
				biopsia.getHistologiaDTO().setCassetesDTO(cassetes);
			} else {
				log.info("No se encontraron cassetes en la biopsia '" + biopsia.getCodigo() + "'");
			}
		}
		
		return biopsia;
	}
}
