package com.fjr.code.dao;

import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasFileDTO;

/**
 * 
 * Class: BiopsiaMicroLaminasFileDAO
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaMicroLaminasFileDAO {
	private static final Logger log = Logger.getLogger(BiopsiaMicroLaminasFileDAO.class);
	
	/**
	 * 
	 */
	private BiopsiaMicroLaminasFileDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Se realiza la lectura de las fotos de la fase macro.
	 * 
	 * @param biopsia
	 * @return
	 */
	public static void setMicroLaminasFotos(BiopsiaMicroLaminasDTO biopsia) {
		if(biopsia == null){
			log.error("Se desea almacenar la informacion de fotos macro, pero no existe el DTO maestro de la fase macro.");
		} else {
			//ubicamos las fotos de la fase macro, para colocarlas en la informacion de la biopsia
			BiopsiaMicroLaminasFileDAOListBuilder builder = new BiopsiaMicroLaminasFileDAOListBuilder();
			builder.searchByIdBiopsia(biopsia.getId());
			builder.searchByCassete(biopsia.getCassete());
			builder.searchByBloque(biopsia.getBloque());
			builder.searchByLamina(biopsia.getLamina());
			
			List<BiopsiaMicroLaminasFileDTO> microFiles = builder.getResults();
			String codigo = biopsia.getId() + "/" + biopsia.getCassete() 
					+ "/" + biopsia.getBloque() + "/" + biopsia.getLamina();
			if(microFiles != null){
				log.info("Se almacenaron " + microFiles.size() + " micro fotos en la lamina '" 
						+ codigo + "'");
				biopsia.setMicroLaminasFilesDTO(microFiles);
			} else {
				log.info("No se encontraron fotos en la biopsia '" + codigo + "'");
			}
		}
	}
}
