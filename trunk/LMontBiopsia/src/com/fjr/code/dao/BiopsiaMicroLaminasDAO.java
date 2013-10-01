package com.fjr.code.dao;

import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;

/**
 * 
 * Class: BiopsiaMicroLaminasDAO
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaMicroLaminasDAO {
	private static final Logger log = Logger.getLogger(BiopsiaMicroLaminasDAO.class);
	
	/**
	 * Obtenemos la informacion de las laminas en fase de micro.
	 * 
	 * @param biopsiaInfoDTO
	 * @param isIHQ
	 * @return
	 */
	public static BiopsiaInfoDTO setMicroLaminas(BiopsiaInfoDTO biopsiaInfoDTO, boolean isIHQ) {
		// TODO Auto-generated method stub
		if(biopsiaInfoDTO == null || biopsiaInfoDTO.getMicroscopicaDTO() == null){
			log.error("Se desea almacenar la informacion de las laminas micro, pero no existe el DTO maestro de la fase micro.");
		} else {
			BiopsiaMicroLaminasDAOListBuilder builder = new BiopsiaMicroLaminasDAOListBuilder(isIHQ);
			builder.searchByIdBiopsia(biopsiaInfoDTO.getId());
			
			List<BiopsiaMicroLaminasDTO> microLaminasDTO = builder.getResults();
			if(microLaminasDTO != null){
				log.info("Se almacenaron " + microLaminasDTO.size() + " micro_laminas en la biopsia '" 
						+ biopsiaInfoDTO.getCodigo() + "'");
				biopsiaInfoDTO.getMicroscopicaDTO().setLaminasDTO(microLaminasDTO);
			} else {
				log.info("No se encontraron micro_laminas en la biopsia '" + biopsiaInfoDTO.getCodigo() + "'");
			}
		}
		
		return biopsiaInfoDTO;
	}
}
