package com.fjr.code.dao;

import java.sql.Timestamp;
import java.util.LinkedList;
import java.util.List;

import org.apache.log4j.Logger;

import com.fjr.code.dao.definitions.FasesBiopsia;
import com.fjr.code.dto.BiopsiaInfoDTO;
import com.fjr.code.util.DBUtil;

/**
 * 
 * Class: BiopsiaInfoDAO
 * Creation Date: 01/09/2013
 * (c) 2013
 *
 * @author T&T
 *
 */
public class BiopsiaInfoDAO {
	private static final Logger log = Logger.getLogger(BiopsiaInfoDAO.class);
	
	private BiopsiaInfoDAO() {
		// TODO Auto-generated constructor stub
	}
	
	/**
	 * Verifica si un determinado numero de biopsia ya esta registrado.
	 * 
	 * @param nroBiopsia
	 * @return
	 */
	public static boolean biopsiaAlreadyExists(String nroBiopsia){
		boolean biopsiaExists = false;
		
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		builder.searchByNumeroBiopsia(nroBiopsia);
		List<BiopsiaInfoDTO> records = builder.getResults();
		
		if(records != null && records.size() > 0){
			biopsiaExists = true;
			log.info("La biopsia con numero " + nroBiopsia + " ya esta registrada");
		}
		
		return biopsiaExists;
	}
	
	/**
	 * 
	 * @param biopsiaInfo
	 * @return
	 */
	public static int insertBiopsiaInfo(BiopsiaInfoDTO biopsiaInfo){
		int insertedId = 0;
		
		final String queryBasico = "INSERT INTO biopsias (numero, fecha_registro, id_examen_biopsia, id_cliente, id_fase_actual)"
				+ " VALUES(?,?,?,?,?)";
		final String queryIngreso = "INSERT INTO biopsias_ingresos(id, procedencia, pieza_recibida, referido_medico, idx, id_patologo_turno)"
				+ " VALUES(?,?,?,?,?,?)";
		
		try {
			//preparamos el query basico
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(biopsiaInfo.getNumero());
			parameters.add(new Timestamp(System.currentTimeMillis()));
			parameters.add(biopsiaInfo.getExamenBiopsia().getId());
			parameters.add(biopsiaInfo.getCliente().getId());
			parameters.add(FasesBiopsia.INGRESO.getCodigoFase());
			
			insertedId = DBUtil.executeInsertQuery(queryBasico, parameters);
			
			if(insertedId > 0){
				log.info("Se inserto el registro maestro de la biopsia " + biopsiaInfo.getNumero());
				
				parameters.clear();
				parameters.add(insertedId);
				parameters.add(biopsiaInfo.getIngresoDTO().getProcedencia());
				parameters.add(biopsiaInfo.getIngresoDTO().getPiezaRecibida());
				parameters.add(biopsiaInfo.getIngresoDTO().getReferidoMedico());
				parameters.add(biopsiaInfo.getIngresoDTO().getIdx());
				parameters.add(biopsiaInfo.getIngresoDTO().getPatologoTurno().getId());
				
				if(DBUtil.executeInsertQuery(queryIngreso, parameters) > 0){
					log.info("Registrado el detalle de ingreso para la biopsia " + biopsiaInfo.getNumero());
				} else {
					log.error("No pudo registrarse el detalle de ingreso para la biopsia " + biopsiaInfo.getNumero());
				}
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		return insertedId;
	}
}
