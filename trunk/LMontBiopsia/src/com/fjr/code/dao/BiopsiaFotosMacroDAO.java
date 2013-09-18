package com.fjr.code.dao;

import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMacroFotoDTO;

/**
 * 
 * Class: BiopsiaFotosMacroDAO
 * Creation Date: 14/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaFotosMacroDAO {
	private static final Logger log = Logger.getLogger(BiopsiaFotosMacroDAO.class);
	
	private BiopsiaFotosMacroDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Se realiza la lectura de las fotos de la fase macro.
	 * 
	 * @param biopsia
	 * @return
	 */
	public static BiopsiaInfoDTO setMacroFotos(BiopsiaInfoDTO biopsia) {
		if(biopsia == null || biopsia.getMacroscopicaDTO() == null){
			log.error("Se desea almacenar la informacion de fotos macro, pero no existe el DTO maestro de la fase macro.");
		} else {
			//ubicamos las fotos de la fase macro, para colocarlas en la informacion de la biopsia
			BiopsiaFotosMacroDAOListBuilder builder = new BiopsiaFotosMacroDAOListBuilder();
			builder.searchByIdBiopsia(biopsia.getId());
			
			List<BiopsiaMacroFotoDTO> macroFotosDTO = builder.getResults();
			if(macroFotosDTO != null){
				log.info("Se almacenaron " + macroFotosDTO.size() + " fotos en la biopsia '" 
						+ biopsia.getCodigo() + "'");
				biopsia.getMacroscopicaDTO().setMacroFotosDTO(macroFotosDTO);
			} else {
				log.info("No se encontraron fotos en la biopsia '" + biopsia.getCodigo() + "'");
			}
		}
		
		return biopsia;
	}
}
