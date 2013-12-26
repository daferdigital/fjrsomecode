package com.fjr.code.dao;

import java.util.LinkedList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import org.apache.log4j.Logger;

import com.fjr.code.dto.BiopsiaCasseteDTO;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.util.DBUtil;

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
	
	/**
	 * 
	 * @param idBiopsia
	 * @return
	 */
	public static boolean markBiopsiaAsReprocessed(int idBiopsia){
		final String query = "UPDATE macro_cassetes SET reprocesar=? WHERE id=?";
		boolean wasUpdated = false;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add("0");
			parameters.add(idBiopsia);
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Marcada como reprocesada biopsia " + idBiopsia);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error intentando marcar para como reprocesada biopsia " + idBiopsia, e);
		}
		
		return wasUpdated;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @param cassete
	 * @param bloque
	 * @return
	 */
	public static boolean markReprocess(boolean reprocesar, int idBiopsia, int cassete, int bloque){
		final String query = "UPDATE macro_cassetes SET reprocesar=? WHERE id=? AND numero=? AND bloques=?";
		boolean wasUpdated = false;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(reprocesar ? "1": "0");
			parameters.add(idBiopsia);
			parameters.add(cassete);
			parameters.add(bloque);
			
			wasUpdated = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Marcada para reprocesar(" + reprocesar + ") (id/numero/bloque) " + idBiopsia
					+ "/" + cassete + "/" + bloque);
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error intentando marcar para reprocesar(" + reprocesar + ") (id/numero/bloque) " + idBiopsia
					+ "/" + cassete + "/" + bloque, e);
		}
		
		return wasUpdated;
	}
	
	/**
	 * 
	 * @param idBiopsia
	 * @return
	 */
	public static boolean checkIfMustReprocessBiopsia(int idBiopsia){
		final String query = "SELECT COUNT(*) FROM macro_cassetes"
				+ " WHERE id=?"
				+ " AND reprocesar=?";
		boolean mustReprocess = false;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(idBiopsia);
			parameters.add("1");
			
			CachedRowSet rows = DBUtil.executeSelectQuery(query, parameters);
			if(rows.next()){
				if(rows.getInt(1) > 0){
					mustReprocess = true;
					log.info("A la biopsia " + idBiopsia + ", se le solicitaron nuevos cortes");
				}
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Error: " + e.getLocalizedMessage(), e);
		}
		
		return mustReprocess;
	}
}
