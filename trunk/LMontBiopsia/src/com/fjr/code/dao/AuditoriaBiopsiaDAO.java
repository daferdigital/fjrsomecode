package com.fjr.code.dao;

import java.util.List;
import java.util.Map;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.CriterioBusquedaBiopsia;
import com.fjr.code.dto.AuditoriaBiopsiaDTO;

/**
 * 
 * Class: AuditoriaBiopsiaDAO
 * Creation Date: 05/01/2014
 * (c) 2014
 *
 * @author T&T
 *
 */
public class AuditoriaBiopsiaDAO {
	private static final Logger log = Logger.getLogger(AuditoriaBiopsiaDAO.class);
	
	private AuditoriaBiopsiaDAO(){
		
	}
	
	/**
	 * 
	 * @param valores
	 * @return
	 */
	public static List<AuditoriaBiopsiaDTO> searchByDates(
			Map<CriterioBusquedaBiopsia, String> valores){
		
		AuditoriaBiopsiaDAOListBuilder builder = new AuditoriaBiopsiaDAOListBuilder();
		
		for (CriterioBusquedaBiopsia criterio : valores.keySet()) {
			if(CriterioBusquedaBiopsia.FECHA_DESDE.equals(criterio)){
				builder.searchByFechaDesde(valores.get(criterio));
			} else if(CriterioBusquedaBiopsia.FECHA_HASTA.equals(criterio)){
				builder.searchByFechaHasta(valores.get(criterio));
			}
		}
		
		log.info("Retornando registro de auditoria basado en fechas");
		
		return builder.getResults();
	}
}
