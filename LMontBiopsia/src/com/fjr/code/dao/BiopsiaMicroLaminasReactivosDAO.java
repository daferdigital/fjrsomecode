package com.fjr.code.dao;

import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.dto.ReactivoDTO;

/**
 * 
 * Class: BiopsiaMicroLaminasReactivosDAO
 * Creation Date: 15/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaMicroLaminasReactivosDAO {
	private static final Logger log = Logger.getLogger(BiopsiaMicroLaminasReactivosDAO.class);
	
	/**
	 * 
	 */
	private BiopsiaMicroLaminasReactivosDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Se realiza la lectura de los reactivos asignados a las laminas, para el estudio de IHQ
	 * 
	 * @param biopsia
	 * @return
	 */
	public static void setMicroLaminasReactivos(BiopsiaMicroLaminasDTO biopsia) {
		if(biopsia == null){
			log.error("Se desea almacenar la informacion de reactivos para IHQ, pero no existe el DTO maestro de la fase micro.");
		} else {
			//ubicamos las fotos de la fase macro, para colocarlas en la informacion de la biopsia
			BiopsiaMicroLaminasReactivosDAOListBuilder builder = new BiopsiaMicroLaminasReactivosDAOListBuilder();
			builder.searchByIdBiopsia(biopsia.getId());
			builder.searchByCassete(biopsia.getCassete());
			builder.searchByBloque(biopsia.getBloque());
			builder.searchByLamina(biopsia.getLamina());
			
			List<ReactivoDTO> microReactivos = builder.getResults();
			String codigo = biopsia.getId() + "/" + biopsia.getCassete() 
					+ "/" + biopsia.getBloque() + "/" + biopsia.getLamina();
			if(microReactivos != null){
				log.info("Se almacenaron " + microReactivos.size() + " micro fotos en la lamina '" 
						+ codigo + "'");
				biopsia.setReactivosDTO(microReactivos);
			} else {
				log.info("No se encontraron reactivos micro en la biopsia '" + codigo + "'");
			}
		}
	}
}
