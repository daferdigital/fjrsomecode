package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.dto.BiopsiaMicroLaminasDTO;
import com.fjr.code.util.DBUtil;

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
	
	/**
	 * 
	 * @param reprocesar
	 * @param idBiopsia
	 * 
	 * @return
	 */
	public static boolean setReprocesarToBiopsia(boolean reprocesar, int idBiopsia){
		final String query = "UPDATE micro_laminas SET reprocesar=?"
				+ " WHERE id=?";
		boolean wasUpdated = false;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(reprocesar ? "1" : "0");
			parameters.add(idBiopsia);
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Resultado de actualizar micro_lamina (reprocesar/idBiopsia) "
					+ reprocesar + "/" + idBiopsia + ", fue: " + wasUpdated);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error actualizando micro_lamina (reprocesar/idBiopsia) "
					+ reprocesar + "/" + idBiopsia + ". Error: " + e.getLocalizedMessage(), e);
		}
		
		return wasUpdated;
	}
	
	/**
	 * 
	 * @param reprocesar
	 * @param idBiopsia
	 * @param cassete
	 * @param bloque
	 * @param lamina
	 * @return
	 */
	public static boolean setReprocesarToMicroLamina(boolean reprocesar, int idBiopsia,
			int cassete, int bloque, int lamina){
		final String query = "UPDATE micro_laminas SET reprocesar=?"
				+ " WHERE id=? AND cassete=? AND bloque=? AND lamina=?";
		boolean wasUpdated = false;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(reprocesar ? "1" : "0");
			parameters.add(idBiopsia);
			parameters.add(cassete);
			parameters.add(bloque);
			parameters.add(lamina);
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Resultado de actualizar micro_lamina (reprocesar/idBiopsia/cassete/bloque/lamina) "
					+ reprocesar + "/" + idBiopsia + "/" + cassete + "/"
					+ bloque + "/" + lamina + ", fue: " + wasUpdated);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error actualizando micro_lamina (reprocesar/idBiopsia/cassete/bloque/lamina) "
					+ reprocesar + "/" + idBiopsia + "/" + cassete + "/"
					+ bloque + "/" + lamina + ". Error: " + e.getLocalizedMessage(), e);
		}
		
		return wasUpdated;
	}
}
