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
		
		if(getBiopsiaByNumero(nroBiopsia) != null){
			biopsiaExists = true;
			log.info("La biopsia con numero " + nroBiopsia + " ya esta registrada");
		}
		
		return biopsiaExists;
	}
	
	/**
	 * Obtenemos el registro completo de una determinada biopsia.
	 * 
	 * @param numero
	 * @return
	 */
	public static BiopsiaInfoDTO getBiopsiaByNumero(String numero){
		BiopsiaInfoDTO biopsia = null;
		
		BiopsiaInfoDAOListBuilder builder = new BiopsiaInfoDAOListBuilder();
		builder.searchByNumeroBiopsia(numero);
		List<BiopsiaInfoDTO> records = builder.getResults();
		
		if(records != null && records.size() > 0){
			biopsia = records.get(0);
		}
		
		return biopsia;
	}
	
	/**
	 * 
	 * @param biopsiaInfo
	 * @return
	 */
	public static int insertBiopsiaInfo(BiopsiaInfoDTO biopsiaInfo){
		int insertedId = 0;
		
		final String queryBasico = "INSERT INTO biopsias (year_biopsia, numero_biopsia, fecha_registro, id_examen_biopsia, id_cliente, id_fase_actual)"
				+ " VALUES(?,?,?,?,?,?)";
		final String queryIngreso = "INSERT INTO biopsias_ingresos(id, procedencia, pieza_recibida, referido_medico, idx, id_patologo_turno)"
				+ " VALUES(?,?,?,?,?,?)";
		
		int[] result = null;
		if(biopsiaInfo.getNumeroBiopsia() < 0){
			result = BiopsiaCodigoDAO.getAutomaticYearAndNumber();
			if(result[0] < 0){
				//no se pudo obtener de manera automatica el valor del codigo de biopsia
				//debemos salir
				log.error("No se pudo obtener el codigo de la biopsia de manera automatica.");
				return -1;
			}else {
				biopsiaInfo.setYearBiopsia(result[0]);
				biopsiaInfo.setNumeroBiopsia(result[1]);
			}
		}
		
		try {
			//preparamos el query basico
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(biopsiaInfo.getYearBiopsia());
			parameters.add(biopsiaInfo.getNumeroBiopsia());
			parameters.add(new Timestamp(System.currentTimeMillis()));
			parameters.add(biopsiaInfo.getExamenBiopsia().getId());
			parameters.add(biopsiaInfo.getCliente().getId());
			parameters.add(FasesBiopsia.INGRESO.getCodigoFase());
			
			insertedId = DBUtil.executeInsertQuery(queryBasico, parameters);
			
			if(insertedId > 0){
				log.info("Se inserto el registro maestro de la biopsia " + biopsiaInfo.getCodigo());
				
				parameters.clear();
				parameters.add(insertedId);
				parameters.add(biopsiaInfo.getIngresoDTO().getProcedencia());
				parameters.add(biopsiaInfo.getIngresoDTO().getPiezaRecibida());
				parameters.add(biopsiaInfo.getIngresoDTO().getReferidoMedico());
				parameters.add(biopsiaInfo.getIngresoDTO().getIdx());
				parameters.add(biopsiaInfo.getIngresoDTO().getPatologoTurno().getId());
				
				//la tabla de ingreso
				if(DBUtil.executeInsertQuery(queryIngreso, parameters) > 0){
					log.info("Registrado el detalle de ingreso para la biopsia " + biopsiaInfo.getCodigo());
				} else {
					log.error("No pudo registrarse el detalle de ingreso para la biopsia " + biopsiaInfo.getCodigo());
				}
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		return insertedId;
	}

	/**
	 * Actualizacion en base de datos de una biopsia y su ingreso.
	 * 
	 * @param ingreso
	 * @return
	 */
	public static boolean updateIngreso(BiopsiaInfoDTO ingreso) {
		// TODO Auto-generated method stub
		/*
		 * en este punto debo garantizar tener el id de la biopsia en el DTO 
		 */
		boolean result = false;
		
		final String updateBiopsia = "UPDATE biopsias "
				+ " SET year_biopsia = ?, numero_biopsia = ?, id_examen_biopsia = ?,"
				+ " id_cliente = ? WHERE id = ?";
		final String updateIngreso = "UPDATE biopsias_ingresos "
				+ " SET procedencia = ?, pieza_recibida = ?, referido_medico = ?,"
				+ "idx = ?, id_patologo_turno = ? WHERE id = ?";
		
		List<Object> parameters = new LinkedList<Object>();
		
		try {
			parameters.add(ingreso.getYearBiopsia());
			parameters.add(ingreso.getNumeroBiopsia());
			parameters.add(ingreso.getExamenBiopsia().getId());
			parameters.add(ingreso.getCliente().getId());
			parameters.add(ingreso.getId());
			
			if(DBUtil.executeNonSelectQuery(updateBiopsia, parameters)){
				log.info("Actualizado registro maestro de la biopsia " + ingreso.getCodigo());
				parameters.clear();
			
				parameters.add(ingreso.getIngresoDTO().getProcedencia());
				parameters.add(ingreso.getIngresoDTO().getPiezaRecibida());
				parameters.add(ingreso.getIngresoDTO().getReferidoMedico());
				parameters.add(ingreso.getIngresoDTO().getIdx());
				if(ingreso.getIngresoDTO().getPatologoTurno() == null){
					parameters.add(DBUtil.NULL_PARAMETER);
				} else {
					parameters.add(ingreso.getIngresoDTO().getPatologoTurno().getId());
				}
				
				parameters.add(ingreso.getId());
					
				result = DBUtil.executeNonSelectQuery(updateIngreso, parameters);
			}
		} catch (Exception e) {
			// TODO: handle exception
			log.error(e.getLocalizedMessage(), e);
		}
		
		return result;
	}
	
	/**
	 * 
	 * @param biopsia
	 * @param nuevaFase
	 * @return
	 */
	public static boolean moveBiopsiaToFase(BiopsiaInfoDTO biopsia, FasesBiopsia nuevaFase) {
		// TODO Auto-generated method stub
		final String query = "UPDATE biopsias SET id_fase_actual = ? WHERE id = ?";
		boolean result = false;
		
		try {
			List<Object> parameters = new LinkedList<Object>();
			parameters.add(nuevaFase.getCodigoFase());
			parameters.add(biopsia.getId());
			
			result = DBUtil.executeNonSelectQuery(query, parameters);
			log.info("Biopsia " + biopsia.getCodigo() + ", llevada a fase " + nuevaFase.getNombreFase());
		} catch (Exception e) {
			// TODO: handle exception
			log.error("Biopsia " + biopsia.getCodigo() + " no pudo ser llevada a fase " + nuevaFase.getNombreFase(), e);
		}
		
		return result;
	}

	public static boolean updateMacro(BiopsiaInfoDTO biopsiaInfoDTO) {
		final String queryMacro = "";
		final String queryCassetes = "";
		final String queryFotos = "";
		
		boolean result = false;
		
		
		// TODO Auto-generated method stub
		return result ;
	}
}
